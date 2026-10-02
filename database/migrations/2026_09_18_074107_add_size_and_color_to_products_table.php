<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('products', 'size')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('size')->nullable();
            });
        }

        if (!Schema::hasColumn('products', 'color')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('color')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('products', 'size')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('size');
            });
        }

        if (Schema::hasColumn('products', 'color')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('color');
            });
        }
    }
};