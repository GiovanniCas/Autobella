<?php

namespace App\Http\Controllers\Backend;

use App\Models\Testata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdiniController extends Controller
{
    public function listaOrdini(){
        $ordini = Testata::where('stato' , '!=' , 0)->orderBy('data' , 'desc')->get();
        return view('listaOrdini' , compact('ordini'));
    }

    public function ordineSpedito(Testata $ordine){
        $ordine->stato = 2;
        $ordine->save();
        return redirect(route('listaOrdini'));
    }
}
