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
        Schema::create('datauji', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik_petani');
            $table->string('luas_tanam');
            $table->string('kondisi_lahan');
            $table->string('kondisi_daun');
            $table->string('pupuk');
            $table->string('hama');
            $table->string('hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datauji');
    }
};
