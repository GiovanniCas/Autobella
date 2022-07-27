<?php

namespace App\Models;

use App\Models\Modello;
use App\Models\Immagine;
use App\Models\Categoria;
use App\Models\Fornitore;
use App\Models\RicambioOrdinato;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ricambio extends Model
{
    use HasFactory;
    
    protected $table = 'ricambi';
    
    protected $fillable = [
        'categoria_id',
        'fornitore_id',
        'nome',
        'codice_pezzo',
        'descrizione',
        'prezzo',
    ]; 

    const STATO_ABILITATO = 1;
    const STATO_DISABILITATO =2;

    public function categorie(){
        return $this->belongsTo(Categoria::class , 'categoria_id');
    }

    public function fornitori(){
        return $this->belongsTo(Fornitore::class , 'fornitore_id');
    }

    public function modelli(){
        return $this->belongsToMany(Modello::class );// , 'modello_ricambio'
    }

    public function ricambiOrdinati(){
        return $this->hasMany(RicambioOrdinato::class);
    }

    public function immagini(){
        return $this->hasMany(Immagine::class);
    }

    public function trovaImmagine(){
        
        return $this->immagini()->where('ricambio_id' , $this->id)->first();
        //dd($immagini);
        
    }
}
