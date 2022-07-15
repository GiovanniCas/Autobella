<?php

namespace App\Models;

use App\Models\Marca;
use App\Models\Ricambio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modello extends Model
{
    use HasFactory;

    protected $table = 'modelli';

    protected $fillable = [
        'marca_id',
        'nome',
        'anno_produzione',
        'anno_ritiro',
    ];

    public function marche(){
        return $this->belongsTo(Marca::class , 'marca_id');

    }

    public function ricambi(){
        return $this->belongsToMany(Ricambio::class );
    }
}
