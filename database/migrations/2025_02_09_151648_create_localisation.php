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
        Schema::create('localisation', function (Blueprint $table) {
            $table->string('id_localisation', 255)->primary(); // Clé primaire de type string, 255
            
            $table->string('nom_localisation', 255); 
            $table->string('quartier_localisation', 255); 
            $table->string('ville_localisation', 255); 
            $table->string('pays_localisation', 255); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localisation');
    }
};
