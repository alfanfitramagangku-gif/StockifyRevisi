<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | STOCK INS
        |--------------------------------------------------------------------------
        */

        Schema::table('stock_ins', function (Blueprint $table) {

            $table->string('status')
                ->default('confirmed')
                ->after('description');

            $table->foreignId('confirmed_by')
                ->nullable()
                ->after('status')
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('confirmed_at')
                ->nullable()
                ->after('confirmed_by');
        });


        /*
        |--------------------------------------------------------------------------
        | STOCK OUTS
        |--------------------------------------------------------------------------
        */

        Schema::table('stock_outs', function (Blueprint $table) {

            $table->string('status')
                ->default('confirmed')
                ->after('description');

            $table->foreignId('confirmed_by')
                ->nullable()
                ->after('status')
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('confirmed_at')
                ->nullable()
                ->after('confirmed_by');
        });
    }


    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | STOCK INS
        |--------------------------------------------------------------------------
        */

        Schema::table('stock_ins', function (Blueprint $table) {

            $table->dropForeign([
                'confirmed_by'
            ]);

            $table->dropColumn([
                'status',
                'confirmed_by',
                'confirmed_at'
            ]);
        });


        /*
        |--------------------------------------------------------------------------
        | STOCK OUTS
        |--------------------------------------------------------------------------
        */

        Schema::table('stock_outs', function (Blueprint $table) {

            $table->dropForeign([
                'confirmed_by'
            ]);

            $table->dropColumn([
                'status',
                'confirmed_by',
                'confirmed_at'
            ]);
        });
    }
};