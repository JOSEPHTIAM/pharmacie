<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->string('matricule', 255)->primary();
            
            $table->string('photo')->nullable();
            $table->string('nom', 255);
            $table->string('prenom', 255)->nullable();
            $table->string('contact', 20)->unique();
            
            $table->string('role', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255)->unique();
            
            $table->string('statut', 255)->default("Actif");
            $table->string('nom_societe', 255)->nullable();
            $table->smallInteger('numero_societe')->nullable();
            $table->string('non_redevence')->nullable(); // Document choisi lors de l'enregistrement
            
            $table->time('periode')->nullable(); // Champ période de type time
            $table->boolean('is_online')->default(true); // Champ pour le statut en ligne
            
            $table->decimal('latitude', 10, 8)->nullable(); // Champ pour la latitude
            $table->decimal('longitude', 11, 8)->nullable(); // Champ pour la longitude

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
