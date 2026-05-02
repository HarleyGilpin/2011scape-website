<?php

namespace Tests\Feature;

use App\Console\Commands\KbaseImport;
use App\Models\KbArticle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KbaseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (KbArticle::query()->doesntExist()) {
            $this->artisan(KbaseImport::class)->assertSuccessful();
        }
    }

    public function test_kbase_import_loaded_all_1231_articles(): void
    {
        $this->assertSame(1231, KbArticle::query()->count());
    }

    public function test_search_for_wilderness_finds_results_with_highlighted_snippets(): void
    {
        $response = $this->get('/kb?q=wilderness');

        $response->assertOk();
        $response->assertSee('<mark>', escape: false);
        $body = $response->getContent();
        $this->assertGreaterThan(50, substr_count($body, '<mark>'), 'expected many highlighted matches');
        $this->assertMatchesRegularExpression('/[1-9]\d* results/', $body);
    }

    public function test_article_renders_with_kbase_chrome(): void
    {
        $response = $this->get('/kb/10th_anniversary');

        $response->assertOk();
        $response->assertSeeText('RuneScape 10th Anniversary');
        $response->assertSee('class="plaque"', escape: false);
        $response->assertSee('/css/kbase-32.css', escape: false);
        // Confirms the §17 chrome fix: outer wrapper present.
        $response->assertSee('class="bodyBackground"', escape: false);
        $response->assertSee('class="bodyBackgroundHead"', escape: false);
    }

    public function test_unknown_article_404s(): void
    {
        $this->get('/kb/this_does_not_exist')->assertNotFound();
    }
}
