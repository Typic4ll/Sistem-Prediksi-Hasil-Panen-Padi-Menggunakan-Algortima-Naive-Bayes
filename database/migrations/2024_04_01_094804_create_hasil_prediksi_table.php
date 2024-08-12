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
        Schema::create('hasil_prediksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->bigInteger('kode_wilayah');
            $table->string('luas');
            $table->string('lahan');
            $table->string('daun');
            $table->string('luas_tanam');
            $table->string('kondisi_lahan');
            $table->string('kondisi_daun');
            $table->string('hama');
            $table->string('pupuk');
            $table->string('hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_prediksi');
    }
};
