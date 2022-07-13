<?php

namespace App\Models;

use App\Models\Ricambio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorie';
    
    protected $fillable = [
        'descrizione' ,
    ];

    public function ricambi()
    {
        return $this->hasMany(Ricambio::class);
    }

    // const CATEGORIA_MOTORE = 1;
    // const CATEGORIA_INTERNI = 2;
    // const CATEGORIA_AUTORADIO = 3;
}
