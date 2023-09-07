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
        Schema::table('commodities', function (Blueprint $table) {
            $table->integer('buying_price')->after('stock');
            $table->integer('selling_price')->after('buying_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commodities', function (Blueprint $table) {
            $table->dropColumn('buying_price');
            $table->dropColumn('selling_price');
        });
    }
};
