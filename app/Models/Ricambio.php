<?php

namespace App\Models;

use App\Models\Modello;
use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ricambio extends Model
{
    use HasFactory;
    
    protected $table = 'ricambi';
    
    protected $fillable = [
        'categoria_id',
        'fornitore_id',
        'codice_pezzo',
        'descrizione',
        'prezzo',
    ]; 

    public function categorie(){
        return $this->belongsTo(Categoria::class , 'categoria_id');
    }

    public function fornitori(){
        return $this->belongsTo(Fornitore::class , 'fornitore_id');
    }

    public function modelli(){
        return $this->belongsToMany(Modello::class );// , 'modello_ricambio'
    }
}
