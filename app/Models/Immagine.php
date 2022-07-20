<?php

namespace App\Models;

use App\Models\Ricambio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Immagine extends Model
{
    use HasFactory;

    protected $table = 'immagini';

    protected $fillable = 
    [
        'ricambio_id',
        'nome',
    ];

    

    public function ricambi(){
        return $this->belongsTo(Ricambio::class , 'ricambio_id');
    }
}
