<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordine extends Model
{
    use HasFactory;

    protected $table = 'ordiniDipendenti';

    protected $fillable = [
        'id',
        'dipendenti_id',
        'prodotto_id',
    ];

    public function dipendenti()
    {
        return $this->belongsTo(Dipendente::class, 'dipendenti_id');
    }

    public function prodotto()
    {
        return $this->belongsTo(Prodotto::class, 'prodotto_id');
    }

}
