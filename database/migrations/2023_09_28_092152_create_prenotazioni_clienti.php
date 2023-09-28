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
        Schema::create('prenotazioniClienti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('prodotto_id'); 
            $table->integer('quantita')->default(0); 

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('prodotto_id')->references('id')->on('prodotti');

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prenotazioni_clienti');
    }
};
