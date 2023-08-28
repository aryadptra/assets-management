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
        Schema::create('commodity_incomings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commodity_id');
            $table->integer('quantity');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('commodity_id')->references('id')->on('commodities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commodity_incomings');
    }
};