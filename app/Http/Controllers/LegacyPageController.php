<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class LegacyPageController extends Controller
{
    public function show(string $relative): Response
    {
        $base = realpath(base_path('_legacy'));
        $candidate = realpath(base_path('_legacy/'.ltrim($relative, '/')));

        abort_unless(
            $base !== false && $candidate !== false
                && str_starts_with($candidate, $base.DIRECTORY_SEPARATOR)
                && is_file($candidate)
                && str_ends_with($candidate, '.html'),
            404,
        );

        $html = file_get_contents($candidate);
        abort_if($html === false, 404);

        $html = $this->rewriteAssetPaths($html);
        $html = $this->stripWaybackInjections($html);

        return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
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
        ];

        return preg_replace($patterns, '', $html) ?? $html;
    }
}
