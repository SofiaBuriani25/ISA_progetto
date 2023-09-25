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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cognome')->notnull();
            $table->date('dataNascita')->default('2000-01-01');
            $table->string('sesso',1)->notnull();
            $table->string('citta')->notnull();
            $table->string('indirizzo')->nullable();
            $table->string('cap',5)->notnull();
            $table->string('telefono')->notnull();
            $table->string('codicefiscale',16)->notnull();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
