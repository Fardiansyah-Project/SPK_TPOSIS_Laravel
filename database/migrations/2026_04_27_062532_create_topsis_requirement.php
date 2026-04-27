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
        Schema::create('matriks_keputusan', function (Blueprint $table) {
            $table->id();
            $table->double("nilai");
            $table->foreignId("kriteria_id")->constrained("kriterias", "id");
            $table->timestamps();
        });
        Schema::create('matriks_normalisasi_keputusan', function (Blueprint $table) {
            $table->id();
            $table->double("nilai");
            $table->foreignId("alternatif_id")->constrained("alternatifs", "id");
            $table->foreignId("kriteria_id")->constrained("kriterias", "id");
            $table->timestamps();
        });
        Schema::create('matriks_normalisasi_bobot_keputusan', function (Blueprint $table) {
            $table->id();
            $table->double("nilai");
            $table->foreignId("alternatif_id")->constrained("alternatifs", "id");
            $table->foreignId("kriteria_id")->constrained("kriterias", "id");
            $table->timestamps();
        });
        Schema::create('ideal_positif', function (Blueprint $table) {
            $table->id();
            $table->double("nilai");
            $table->foreignId("alternatif_id")->constrained("alternatifs", "id");
            $table->foreignId("kriteria_id")->constrained("kriterias", "id");
            $table->timestamps();
        });
        Schema::create('ideal_negatif', function (Blueprint $table) {
            $table->id();
            $table->double("nilai");
            $table->foreignId("alternatif_id")->constrained("alternatifs", "id");
            $table->foreignId("kriteria_id")->constrained("kriterias", "id");
            $table->timestamps();
        });
        Schema::create('solusi_ideal_positif', function (Blueprint $table) {
            $table->id();
            $table->double("nilai");
            $table->foreignId("alternatif_id")->constrained("alternatifs", "id");
            $table->timestamps();
        });
        Schema::create('solusi_ideal_negatif', function (Blueprint $table) {
            $table->id();
            $table->double("nilai");
            $table->foreignId("alternatif_id")->constrained("alternatifs", "id");
            $table->timestamps();
        });
        Schema::create('hasil_solusi_topsis', function (Blueprint $table) {
            $table->id();
            $table->double("nilai");
            $table->foreignId("alternatif_id")->constrained("alternatifs", "id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topsis');
    }
};
