<?php

namespace App\Models;

use App\Models\Ricambio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fornitore extends Model
{
    use HasFactory;

    protected $fillable = [
        'ragione_sociale',
        'partita_iva',
    ];

    public function ricambi(){
        return $this->belongsTo(Ricambio::class);
    }
}
