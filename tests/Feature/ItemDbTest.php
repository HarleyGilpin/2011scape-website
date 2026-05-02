<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemDbTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (! is_file(base_path('storage/app/items.json'))) {
            $this->markTestSkipped('items.json not generated; run `php artisan items:import` first');
        }
    }

    public function test_search_finds_dragon_items(): void
    {
        $response = $this->get('/services/m=itemdb_rs/results?query=dragon');

        $response->assertOk();
        $response->assertSeeText('Dragonfire Shield Charged');
    }

    public function test_view_item_by_id(): void
    {
        $response = $this->get('/services/m=itemdb_rs/viewitem.ws?obj=9747');

        $response->assertOk();
        $response->assertSeeText('Attack Cape');
        $response->assertSeeText('The cape worn by masters of Attack.');
    }

    public function test_view_item_unknown_id_404s(): void
    {
        $this->get('/services/m=itemdb_rs/viewitem.ws?obj=999999999')->assertNotFound();
    }

    public function test_empty_search_renders_landing(): void
    {
        $this->get('/services/m=itemdb_rs/frontpage.html')
            ->assertOk()
            ->assertSeeText('Item Database');
    }
}
