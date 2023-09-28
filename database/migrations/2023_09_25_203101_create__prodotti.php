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
        Schema::create('prodotti', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tipo');
            $table->integer('disponibilita')->default(0); 
            $table->date('scadenza')->default('2023-12-31');
            $table->decimal('prezzo', 8, 2)->default(0.00);
            $table->string('descrizione')->nullable();
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_prodotti');
    }
};
