<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'size')) {
                $table->string('size')->nullable()->after('name');
            }

            if (!Schema::hasColumn('products', 'color')) {
                $table->string('color')->nullable()->after('size');
            }

            if (!Schema::hasColumn('products', 'minimum_stock')) {
                $table->unsignedInteger('minimum_stock')->default(5)->after('stock');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('products', 'size')) {
                $columns[] = 'size';
            }

            if (Schema::hasColumn('products', 'color')) {
                $columns[] = 'color';
            }

            if (Schema::hasColumn('products', 'minimum_stock')) {
                $columns[] = 'minimum_stock';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};