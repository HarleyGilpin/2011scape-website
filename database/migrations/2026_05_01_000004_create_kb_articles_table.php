<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kb_articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->foreignId('category_id')->nullable()->constrained('kb_categories')->nullOnDelete();
            $table->longText('body_html');
            $table->longText('search_text')->nullable();
            $table->string('legacy_path')->nullable();
            $table->timestamps();
        });

        DB::statement(<<<'SQL'
            ALTER TABLE kb_articles ADD COLUMN search_tsv tsvector
              GENERATED ALWAYS AS (
                setweight(to_tsvector('english', coalesce(title, '')), 'A') ||
                setweight(to_tsvector('english', coalesce(search_text, '')), 'B')
              ) STORED
        SQL);
        DB::statement('CREATE INDEX kb_articles_search_tsv_idx ON kb_articles USING GIN (search_tsv)');
    }

    public function down(): void
    {
        Schema::dropIfExists('kb_articles');
    }
};
