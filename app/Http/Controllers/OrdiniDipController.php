<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ordine;

class OrdiniDipController extends Controller
{
    public function mostraTabella()
    {
        $ordiniDipendenti = Ordine::all();

        return view('storico_dipendenti', ['ordiniDipendenti' => $ordiniDipendenti]);
    }
}
