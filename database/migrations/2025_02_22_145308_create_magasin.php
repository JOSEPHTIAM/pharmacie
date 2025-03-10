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
        Schema::create('magasin', function (Blueprint $table) {
            $table->string('id_magasin', 255)->primary(); // Clé primaire de type string, 255
            
            $table->unsignedSmallInteger('stock_magasin'); // Quantité en stock
            
            // Champs created_at et updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magasin');
    }
};
