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
        Schema::create('shipper_productions_cc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipper_id');
            $table->tinyInteger('bulan');
            $table->year('tahun');
            $table->integer('produksi', 11)->nullable();

            $table->foreign('shipper_id')->references('id')->on('shippers_cc')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipper_productions_cc');
    }
};
