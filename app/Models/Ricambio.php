<?php

namespace App\Models;

use App\Models\Categoria;
use App\Models\Fornitore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ricambio extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'fornitore_id',
        'codice_pezzo',
        'descrizione',
        'prezzo',
    ]; 

    public function categorie(){
        return $this->belongsTo(Categoria::class);
    }

    public function fornitori(){
        return $this->belongsTo(Fornitore::class);
    }
}
