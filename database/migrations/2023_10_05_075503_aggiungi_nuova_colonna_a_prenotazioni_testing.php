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
        if (config('database.default') === 'testing') {
            Schema::connection('testing')->table('prenotazioniClienti', function (Blueprint $table) {
                $table->boolean('pagato')->default(false); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       //
        
    }
};
