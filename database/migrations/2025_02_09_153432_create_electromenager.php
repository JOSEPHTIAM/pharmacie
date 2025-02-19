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
        Schema::create('electromenager', function (Blueprint $table) {
            $table->string('id_electromenager', 255)->primary(); // Clé primaire de type string, 255

            $table->string('image_electromenager')->nullable(); // Nullable pour les images
            $table->string('nom_electromenager', 255);
            $table->unsignedSmallInteger('puissance_electromenager');
            $table->unsignedSmallInteger('tension_electromenager');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electromenager');
    }
};
