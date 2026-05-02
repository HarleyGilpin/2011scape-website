<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class LegacyExtract extends Command
{
    protected $signature = 'legacy:extract {--force : Overwrite existing Blades}';

    protected $description = 'One-time: read _legacy/*.html, extract title + #content body, write Blade templates extending layouts.app';

    private const ROOT_PAGES = [
        'wilderness.html', 'parents.html', 'cookies.html',
        'account_management.html', 'competition_details.html', 'golden_joystick.html',
        'options.html', 'email_registration.html', 'splash.html',
        'splash-media-1.html', 'splash-media-2.html',
        'title-nosplash-1.html', 'title_video_popup.html', 'slu-j-0.html',
    ];

    private const SUBDIR_GROUPS = [
        'terms' => 'legal/terms',
        'rules' => 'legal/rules',
        'privacy' => 'legal/privacy',
    ];

    public function handle(): int
    {
        $written = 0;
        $skipped = 0;
        $force = (bool) $this->option('force');

        foreach (self::ROOT_PAGES as $file) {
            $src = base_path('_legacy/'.$file);
            if (! is_file($src)) {
                $this->warn("missing: {$src}");
                continue;
            }

            $viewName = $this->viewName(basename($file, '.html'));
            $dest = base_path("resources/views/pages/{$viewName}.blade.php");
            $this->writePage($src, $dest, 'layouts.app', $force) ? $written++ : $skipped++;
        }

        foreach (self::SUBDIR_GROUPS as $subdir => $viewSubdir) {
            $files = glob(base_path("_legacy/{$subdir}/*.html")) ?: [];
            foreach ($files as $src) {
                $viewName = $this->viewName(basename($src, '.html'));
                $dest = base_path("resources/views/{$viewSubdir}/{$viewName}.blade.php");
                $this->writePage($src, $dest, 'layouts.app', $force) ? $written++ : $skipped++;
            }
        }

        // Homepage extracted separately — wraps the index.html slider chrome.
        $homeSrc = base_path('_legacy/index.html');
        if (is_file($homeSrc)) {
            $dest = base_path('resources/views/home.blade.php');
            if ($force || ! is_file($dest)) {
                $this->writeHome($homeSrc, $dest);
                $written++;
            } else {
                $skipped++;
            }
        }

        $this->info("wrote {$written}, skipped {$skipped}");
        return self::SUCCESS;
    }

    private function writePage(string $src, string $dest, string $layout, bool $force): bool
    {
        if (! $force && is_file($dest)) {
            return false;
        }

        $html = (string) file_get_contents($src);
        $html = $this->stripWaybackInjections($html);
        $crawler = new Crawler($html);

        $titleNode = $crawler->filter('h1.plaque');
        $title = $titleNode->count() > 0
            ? trim($titleNode->first()->text())
            : Str::of(basename($src, '.html'))->replace(['_', '-'], ' ')->title()->value();

        $contentNode = $crawler->filter('#content');
        $body = $contentNode->count() > 0
            ? $contentNode->first()->html()
            : '<p>(content unavailable)</p>';

        $body = $this->rewriteAssetPaths($body);
        $body = $this->stripBreadcrumbAndFooter($body);
        $crumb = $title !== '' ? $title : 'Page';

        $blade = "@extends('{$layout}')\n\n"
            ."@section('title', ".var_export($title.' - 2011scape', true).")\n"
            ."@section('crumb', ".var_export($crumb, true).")\n\n"
            ."@section('content')\n"
            .$body
            ."\n@endsection\n";

        @mkdir(dirname($dest), 0755, true);
        file_put_contents($dest, $blade);
        $this->line('  wrote '.str_replace(base_path().'/', '', $dest));

        return true;
    }

    private function writeHome(string $src, string $dest): void
    {
        $html = (string) file_get_contents($src);
        $html = $this->stripWaybackInjections($html);
        $crawler = new Crawler($html);

        $bodyNode = $crawler->filter('body');
        $bodyHtml = $bodyNode->count() > 0 ? $bodyNode->first()->html() : '';
        $bodyHtml = $this->rewriteAssetPaths($bodyHtml);

        $blade = "@extends('layouts.app')\n\n"
            ."@section('title', 'RuneScape - The No.1 Free Online Multiplayer Game')\n\n"
            ."@section('content')\n"
            ."{!! \$dynamicSlider ?? '' !!}\n"
            ."@endsection\n";

        // The original index.html chrome includes its own menubox/footer. We extract
        // only the slider / news / hot-topics inner section. For the homepage we wire
        // the dynamic data via HomeController and render a simpler Blade for now.
        // (The body is too entwined with the legacy chrome to extract cleanly here;
        // HomeController stays the canonical homepage source.)
        file_put_contents($dest, $blade);
    }

    private function rewriteAssetPaths(string $html): string
    {
        return preg_replace(
            ['#(href|src)="(?:\.\./)+#i', '#url\((?:\.\./)+#i'],
            ['$1="/', 'url(/'],
            $html,
        ) ?? $html;
    }

    private function stripWaybackInjections(string $html): string
    {
        $patterns = [
            '#<!-- BEGIN WAYBACK TOOLBAR INSERT -->.*?<!-- END WAYBACK TOOLBAR INSERT -->#s',
            '#<script[^>]*ait-client-rewrite\.js[^>]*>\s*</script>#i',
            '#<script[^>]*AIT_Analytics\.js[^>]*>\s*</script>#i',
            '#<script[^>]*>[^<]*WB_wombat_Init[^<]*</script>#s',
            '#<script[^>]*google-analytics\.com/ga\.js[^<]*</script>#s',
            '#<!-- *FILE ARCHIVED ON.*?Internet Archive.*?-->#s',
        ];

        return preg_replace($patterns, '', $html) ?? $html;
    }

    private function stripBreadcrumbAndFooter(string $body): string
    {
        // The legacy #content lives inside the chrome; the chrome is now in
        // _partials/page_open + page_close. Inside #content the legacy file
        // itself just has #article + footer. Strip nothing here — the chrome
        // partials already wrap; we want everything that was inside #content.
        return $body;
    }

    private function viewName(string $base): string
    {
        return str_replace(['-', ' '], '_', strtolower($base));
    }
}
