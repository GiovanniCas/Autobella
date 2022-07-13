<?php

namespace App\Http\Controllers;

use App\Models\Ricambio;
use App\Models\Fornitore;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function vistaRicambi(){
        $ricambi = Ricambio::all();
        return view('ricambiLista' , compact('ricambi'));
    }

   
}
