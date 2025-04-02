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
        Schema::create('formation1', function (Blueprint $table) {
            $table->string('id_formation1', 255)->primary(); // Clé primaire de type string, 255
            
            $table->string('nom_formation', 255)->default('Aucun');
            $table->string('description_formation')->nullable(); // Description
            $table->unsignedInteger('prix_formation');  // Prix unitaire (positif uniquement)
            $table->unsignedInteger('total_formation'); // 
            
            // Clé étrangère vers la table 'magasin'
            $table->string('id_magasin', 255);
            $table->foreign('id_magasin')->references('id_magasin')->on('magasin')->onDelete('cascade');

            // Clé étrangère vers la table 'localisation'
            $table->string('id_localisation', 255);
            $table->foreign('id_localisation')->references('id_localisation')->on('localisation')->onDelete('cascade');

            // Clé étrangère vers la table 'user'
            $table->string('matricule', 255);
            $table->foreign('matricule')->references('matricule')->on('user')->onDelete('cascade');
            
            // Ceci pour l'option de la categorie_formation = "Video" 
            //$table->string('video_formation')->nullable(); // URL ou chemin de la vidéo
            
            // Ceci pour l'option de la categorie_formation = "Pdf" 
            $table->string('pdf_formation')->nullable(); // URL ou chemin de la pdf
           
            // Champs created_at et updated_at
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation1');
    }
};
