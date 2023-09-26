<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DaOrdinareController extends Controller
{
    public function mostraDaOrdinare()
{
    $user = Auth::guard('dipendenti')->user();
    return view('daOrdinare', ['user' => $user]);
}
}
