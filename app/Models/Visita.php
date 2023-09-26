<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Visita extends Model
{
    use HasFactory;

    protected $table = 'visite';

    protected $fillable = [
        'id',
        'tipologia',
        'dataVisita',
        'medico',
        'prezzo',
        'user_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
