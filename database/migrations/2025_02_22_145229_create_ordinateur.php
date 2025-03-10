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
        Schema::create('ordinateur', function (Blueprint $table) {
            $table->string('id_ordinateur', 255)->primary(); // Clé primaire de type string, 255

            $table->string('image_ordinateur')->nullable(); // Nullable pour les images
            $table->string('nom_ordinateur', 255);
            $table->string('processeur', 255);
            $table->string('disque', 255);
            $table->unsignedSmallInteger('ram');
            $table->string('core', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordinateur');
    }
};
