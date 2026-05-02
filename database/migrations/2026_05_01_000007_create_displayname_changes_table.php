<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('displayname_changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_account_id')->index();
            $table->string('old_name');
            $table->string('new_name');
            $table->timestamp('requested_at');
            $table->timestamp('applied_at')->nullable();
            $table->string('status', 32)->default('pending')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('displayname_changes');
    }
};
