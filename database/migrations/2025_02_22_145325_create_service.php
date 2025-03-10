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
        Schema::create('service', function (Blueprint $table) {
            $table->string('id_service', 255)->primary(); // Clé primaire de type string, 255
            
            $table->string('description_service')->nullable(); // Description
            $table->unsignedInteger('prix_service');  // Prix unitaire (positif uniquement)
            $table->unsignedInteger('total_service'); // Total (stock * prix), positif uniquement

            // Clé étrangère vers la table 'magasin'
            $table->string('id_magasin', 255);
            $table->foreign('id_magasin')->references('id_magasin')->on('magasin')->onDelete('cascade');

            // Clé étrangère vers la table 'user'
            $table->string('matricule', 255);
            $table->foreign('matricule')->references('matricule')->on('user')->onDelete('cascade');

            // Clé étrangère vers la table 'localisation'
            $table->string('id_localisation', 255);
            $table->foreign('id_localisation')->references('id_localisation')->on('localisation')->onDelete('cascade');

            // Ceci pour l'option de la categorie_service = "Electromenager" 
            $table->string('id_electromenager', 255)->nullable();     // Clé secondaire optionnelle en string(255)
            $table->foreign('id_electromenager')->references('id_electromenager')->on('electromenager')->onDelete('cascade');

            // Ceci pour l'option de la categorie_service = "Ordinateur" 
            //$table->string('id_ordinateur', 255)->nullable();        // Clé secondaire optionnelle en string(255)
            //$table->foreign('id_ordinateur')->references('id_ordinateur')->on('ordinateur')->onDelete('cascade');
            
            // Champs created_at et updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};



