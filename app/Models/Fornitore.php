<?php

namespace App\Models;

use App\Models\Ricambio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fornitore extends Model
{
    use HasFactory;

    protected $table = 'fornitori';

    protected $fillable = [
        'ragione_sociale',
        'indirizzo',
        'comune',
        'cap',
        'provincia',
        'partita_iva',
    ];

    public function ricambi(){
        return $this->hasMany(Ricambio::class);
    }
}
