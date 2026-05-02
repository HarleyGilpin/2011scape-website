<?php

namespace App\Console\Commands;

use App\Models\KbArticle;
use App\Models\KbCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class KbaseImport extends Command
{
    protected $signature = 'kbase:import {--dry-run : Parse without writing} {--purge : Delete _legacy/kbase/guid after success} {--legacy=_legacy/kbase : Path to legacy kbase dump}';

    protected $description = 'Import knowledge-base articles from the static dump into kb_articles.';

    public function handle(): int
    {
        $legacy = base_path((string) $this->option('legacy'));

        if (! is_dir($legacy)) {
            $this->error("Legacy kbase path not found: {$legacy}");
            return self::FAILURE;
        }

        $this->importCategories($legacy);
        $this->importArticles($legacy);

        if ($this->option('purge') && ! $this->option('dry-run')) {
            $this->purge($legacy.'/guid');
        }

        $count = KbArticle::query()->count();
        $this->info("kb_articles total: {$count}");

        return self::SUCCESS;
    }

    private function importCategories(string $legacy): void
    {
        $files = glob($legacy.'/view-guid-*.html') ?: [];

        foreach ($files as $file) {
            $slug = Str::of(basename($file, '.html'))
                ->after('view-guid-')
                ->lower()
                ->replace(' ', '_')
                ->value();

            $name = $this->extractCategoryName($file) ?? Str::of($slug)->replace('_', ' ')->title()->value();

            if (! $this->option('dry-run')) {
                KbCategory::query()->updateOrCreate(['slug' => $slug], ['name' => $name]);
            }
            $this->line("  category: {$slug} -> {$name}");
        }
    }

    private function extractCategoryName(string $file): ?string
    {
        $html = file_get_contents($file);
        if ($html === false) {
            return null;
        }

        $crawler = new Crawler($html);
        $h1 = $crawler->filter('h1.plaque');
        if ($h1->count() === 0) {
            return null;
        }

        return trim($h1->first()->text());
    }

    private function importArticles(string $legacy): void
    {
        $dir = $legacy.'/guid';
        if (! is_dir($dir)) {
            $this->error("Article dir not found: {$dir}");
            return;
        }

        $catBySlug = $this->option('dry-run')
            ? collect()
            : KbCategory::query()->pluck('id', 'slug');

        $files = glob($dir.'/*.html') ?: [];
        $total = count($files);
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        LazyCollection::make($files)
            ->chunk(50)
            ->each(function ($chunk) use ($catBySlug, $bar): void {
                if ($this->option('dry-run')) {
                    $chunk->each(fn ($file) => $this->parseArticle($file, $catBySlug, $bar, true));
                    return;
                }

                DB::transaction(function () use ($chunk, $catBySlug, $bar): void {
                    $chunk->each(fn ($file) => $this->parseArticle($file, $catBySlug, $bar, false));
                });
            });

        $bar->finish();
        $this->newLine();
    }

    private function parseArticle(string $file, $catBySlug, $bar, bool $dryRun): void
    {
        $slug = basename($file, '.html');
        $html = file_get_contents($file);
        if ($html === false) {
            $bar->advance();
            return;
        }

        $crawler = new Crawler($html);

        $title = $this->firstText($crawler, 'h1.plaque') ?? Str::of($slug)->replace('_', ' ')->title()->value();
        $body = $this->innerHtml($crawler, 'div.article') ?? $this->innerHtml($crawler, 'div.newsJustify') ?? '';
        $categorySlug = $this->detectCategory($crawler);
        $categoryId = $categorySlug ? ($catBySlug[$categorySlug] ?? null) : null;

        $search = trim(strip_tags($title.' '.$body));

        if ($dryRun) {
            $bar->advance();
            return;
        }

        KbArticle::query()->updateOrCreate(
            ['slug' => $slug],
            [
                'title' => $title,
                'category_id' => $categoryId,
                'body_html' => $body,
                'search_text' => $search,
                'legacy_path' => 'kbase/guid/'.$slug.'.html',
            ],
        );

        $bar->advance();
    }

    private function firstText(Crawler $crawler, string $selector): ?string
    {
        $node = $crawler->filter($selector);
        return $node->count() > 0 ? trim($node->first()->text()) : null;
    }

    private function innerHtml(Crawler $crawler, string $selector): ?string
    {
        $node = $crawler->filter($selector);
        return $node->count() > 0 ? $node->first()->html() : null;
    }

    private function detectCategory(Crawler $crawler): ?string
    {
        $links = $crawler->filter('div.navigation div.location a');
        if ($links->count() < 2) {
            return null;
        }

        $candidate = $links->eq($links->count() - 1);
        $href = (string) $candidate->attr('href');
        if (preg_match('#guid/([A-Za-z0-9_\-]+)\.html#', $href, $m)) {
            return strtolower($m[1]);
        }

        $select = $crawler->filter('select[name="category"] option[selected]');
        if ($select->count() > 0) {
            return Str::of($select->first()->text())->lower()->replace(' ', '_')->value();
        }

        return null;
    }

    private function purge(string $dir): void
    {
        if (! is_dir($dir)) {
            return;
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST,
        );

        foreach ($iterator as $file) {
            $file->isDir() ? rmdir($file->getRealPath()) : unlink($file->getRealPath());
        }
        rmdir($dir);
        $this->info("Purged {$dir}");
    }
}
