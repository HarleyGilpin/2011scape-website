<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Yosymfony\Toml\Toml;

class ItemsImport extends Command
{
    protected $signature = 'items:import {--source= : Path to void data dir; defaults to GAME_TOML_DIR env}
                                          {--out= : Output JSON path; defaults to GAME_ITEMS_JSON env}';

    protected $description = 'Walk void *.items.toml files, flatten into a single JSON keyed by slug.';

    public function handle(): int
    {
        $source = (string) ($this->option('source') ?: env('GAME_TOML_DIR', ''));
        $out = (string) ($this->option('out') ?: env('GAME_ITEMS_JSON', storage_path('app/items.json')));

        if ($source === '' || ! is_dir($source)) {
            $this->error("Source dir not found: {$source}");
            return self::FAILURE;
        }

        $files = $this->collectFiles($source);
        $this->info(sprintf('Found %d *.items.toml files under %s', count($files), $source));

        $items = [];
        $bar = $this->output->createProgressBar(count($files));
        $bar->start();

        foreach ($files as $file) {
            try {
                $parsed = Toml::ParseFile($file);
            } catch (\Throwable $e) {
                $this->warn("\nSkip {$file}: ".$e->getMessage());
                $bar->advance();
                continue;
            }

            foreach ($parsed as $slug => $row) {
                if (! is_array($row)) {
                    continue;
                }

                $items[$slug] = $row + ['slug' => $slug, 'source' => $this->relative($file, $source)];
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $dir = dirname($out);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $json = json_encode($items, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            $this->error('Failed to encode JSON: '.json_last_error_msg());
            return self::FAILURE;
        }

        if (file_put_contents($out, $json) === false) {
            $this->error("Failed to write {$out}");
            return self::FAILURE;
        }

        $this->info(sprintf('Wrote %d items to %s (%.1f KB)', count($items), $out, strlen($json) / 1024));
        return self::SUCCESS;
    }

    /** @return list<string> */
    private function collectFiles(string $root): array
    {
        $files = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS));
        foreach ($iterator as $file) {
            if ($file->isFile() && str_ends_with($file->getFilename(), '.items.toml')) {
                $files[] = $file->getPathname();
            }
        }
        sort($files);
        return $files;
    }

    private function relative(string $path, string $root): string
    {
        return ltrim(str_replace(rtrim($root, DIRECTORY_SEPARATOR), '', $path), DIRECTORY_SEPARATOR);
    }
}
