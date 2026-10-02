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
            Schema::table('products', function (Blueprint $table) {
                $table->foreignId('category_id')
                    ->after('id')
                    ->constrained('categories')
                    ->onDelete('cascade');

                $table->string('name')->after('category_id');
                $table->string('sku')->unique()->after('name');
                $table->text('description')->nullable()->after('sku');
                $table->decimal('purchase_price', 15, 2)->default(0)->after('description');
                $table->decimal('selling_price', 15, 2)->default(0)->after('purchase_price');
                $table->integer('stock')->default(0)->after('selling_price');
            });
        }
};
