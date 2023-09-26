<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{
    use HasFactory;

    protected $table = 'prodotti';

    protected $fillable = [
        'id',
        'name',
        'tipo',
        'disponibilita',
        'scadenza',
        'prezzo',
        'descrizione',

        
    ];
}
