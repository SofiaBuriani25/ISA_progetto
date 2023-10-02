<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ordine;

class OrdiniDipController extends Controller
{
    public function mostraTabella()
    {
        $ordini = Ordine::with('dipendenti','prodotto')->get();

        return view('storico_dipendenti', ['ordini' => $ordini]);
    }
}
