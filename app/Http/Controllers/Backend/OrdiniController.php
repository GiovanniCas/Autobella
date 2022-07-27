<?php

namespace App\Http\Controllers\Backend;

use App\Models\Testata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class OrdiniController extends Controller
{
    public function listaOrdini(){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 

        $ordini = Testata::where('stato' , '!=' , 0)->orderBy('data' , 'desc')->get();
        
        return view('listaOrdiniGestore.listaOrdini' , compact('ordini'));
    }

    public function ordineSpedito(Testata $ordine){

        if (Gate::denies('Gestore')) {
            abort(403);            
        } 
       
        $ordine->stato = 2;
        $ordine->save();
        return redirect(route('listaOrdini'));
    }
}
