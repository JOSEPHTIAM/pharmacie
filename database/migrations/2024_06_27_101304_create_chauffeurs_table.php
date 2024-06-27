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
        Schema::create('chauffeurs', function (Blueprint $table) {

            //$table->string('matricule')->unique();
            $table->string('matricule_chau')->primary();
            $table->string('photo_chau')->nullable();
            $table->string('nom_chau');
            $table->string('prenom_chau');
            $table->string('contact_chau');
            $table->string('gmail_chau')->unique();
            $table->string('mot_de_passe_chau');
            $table->year('annee_inscription_chau');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chauffeurs');
    }
};
