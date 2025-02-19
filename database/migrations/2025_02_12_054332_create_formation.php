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
        Schema::create('formation', function (Blueprint $table) {
            $table->string('id_formation', 255)->primary(); // Clé primaire de type string, 255
            
            $table->string('nom_formation', 255)->default('Aucun');
            $table->text('description_formation')->nullable(); // Par défaut "Bonne qualite"
            
            // Pour le champ "categorie_service"
            $table->string('categorie_formation', 255);

            
            // Clé étrangère vers la table 'user'
            $table->string('matricule', 255);
            $table->foreign('matricule')->references('matricule')->on('user')->onDelete('cascade');
            
            // Ceci pour l'option de la categorie_formation = "Video" 
            $table->string('video_formation')->nullable(); // URL ou chemin de la vidéo
            
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
        Schema::dropIfExists('formation');
    }
};
