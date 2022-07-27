<?php

namespace App\Http\Controllers;

use App\Models\Testata;
use Illuminate\Http\Request;
use App\Models\RicambioOrdinato;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function storicoOrdini(){
        $ordini = Testata::where('user_id' , Auth::user()->id)->get();
        $ricambi_ordinati = []; 
        foreach($ordini as $ordine){
            $ricambi= RicambioOrdinato::where('testata_id' , $ordine->id)->get();
            foreach($ricambi as $ricambio){
                array_push($ricambi_ordinati , $ricambio);
            }
        }
        // dd($ricambi_ordinati);
        return view('storicoOrdini' , compact('ricambi_ordinati'));
    }
}
