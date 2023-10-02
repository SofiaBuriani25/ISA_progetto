<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenotazione extends Model
{
    use HasFactory;

    

    protected $table = 'prenotazioniClienti';

    protected $fillable = [
        'id',
        'user_id',
        'prodotto_id',
        'quantita',
        'pagato',
    ];

    

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function prodotto()
    {
        return $this->belongsTo(Prodotto::class, 'prodotto_id');
    }

}
