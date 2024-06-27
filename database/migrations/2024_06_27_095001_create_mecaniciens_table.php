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
        Schema::create('mecaniciens', function (Blueprint $table) {

            //$table->string('matricule')->unique();
            $table->string('matricule_meca')->primary();
            $table->string('photo_meca')->nullable();
            $table->string('nom_meca');
            $table->string('prenom_meca');
            $table->string('contact_meca');
            $table->string('gmail_meca')->unique();
            $table->string('mot_de_passe_meca');
            $table->year('annee_inscription_meca');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mecaniciens');
    }
};
