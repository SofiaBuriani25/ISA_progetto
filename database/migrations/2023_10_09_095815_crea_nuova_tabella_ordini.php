<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('ordiniDipendenti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dipendenti_id'); 
            $table->unsignedBigInteger('prodotto_id'); 
            $table->integer('quantita'); 
            $table->timestamps();

            $table->foreign('dipendenti_id')->references('id')->on('dipendenti');
            $table->foreign('prodotto_id')->references('id')->on('prodotti');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('ordini_dipendenti');
    }
};
