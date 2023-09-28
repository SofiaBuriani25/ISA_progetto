<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DipendenteHomeController extends Controller
{
    public function index()
    {
        $user = Auth::guard('dipendenti')->user();
        return view('dipendente_home', ['user' => $user]); // Assicurati di avere una vista chiamata 'dipendente_home'
    }




    

}


