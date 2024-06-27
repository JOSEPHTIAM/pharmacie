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
        Schema::create('administrateurs', function (Blueprint $table) {

            //$table->string('matricule')->unique();
            $table->string('matricule_admin')->primary();
            $table->string('photo_admin')->nullable();
            $table->string('nom_admin');
            $table->string('prenom_admin');
            $table->string('contact_admin');
            $table->string('gmail_admin')->unique();
            $table->string('mot_de_passe_admin');
            $table->year('annee_inscription_admin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrateurs');
    }
};
