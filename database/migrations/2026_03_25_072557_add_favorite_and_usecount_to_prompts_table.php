<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prompts', function (Blueprint $table) {
            $table->boolean('is_favorite')->default(false)->after('tags');
            $table->unsignedInteger('use_count')->default(0)->after('is_favorite');
        });
    }

    public function down(): void
    {
        Schema::table('prompts', function (Blueprint $table) {
            $table->dropColumn(['is_favorite', 'use_count']);
        });
    }
};
