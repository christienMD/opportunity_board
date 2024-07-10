<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (app()->environment('testing')) {
            Schema::table('opportunities', function (Blueprint $table) {
                $table->string('img_url')->nullable()->default(null)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (app()->environment('testing')) {
            Schema::table('opportunities', function (Blueprint $table) {
                // Reverse the change if needed, e.g., setting the default to an empty string or not nullable
                $table->string('img_url')->nullable(false)->default('')->change();
            });
        }
    }
};
