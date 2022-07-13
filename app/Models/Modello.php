<?php

namespace App\Models;

use App\Models\Marca;
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
        return $this->belongsTo(Marca::class);

    }
}
