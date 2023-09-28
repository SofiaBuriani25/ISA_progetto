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
        Schema::create('visite', function (Blueprint $table) {
            $table->id();
            $table->string('tipologia');
            $table->dateTime('dataVisita');
            $table->string('medico');
            $table->decimal('prezzo', 8, 2);
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->timestamps();


            // Definizione della chiave esterna
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visita');
    }
};
