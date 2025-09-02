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
        Schema::create('commodity_productions_cc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commodity_id');
            $table->tinyInteger('bulan');
            $table->year('tahun');
            $table->integer('produksi', 11)->nullable();

            $table->foreign('commodity_id')->references('id')->on('commodities_cc')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commodity_productions_cc');
    }
};
