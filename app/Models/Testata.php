<?php

namespace App\Models;

use App\Models\RicambioOrdinato;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testata extends Model
{
    use HasFactory;

    protected $table = 'testata_ordini';

    protected $fillable =
    [
        'user_id',
        'nome',
        'cognome',
        'citta',
        'indirizzo',
        'cap',
        'email',
        'totale',
    ] ;

    const ORDINE_IN_PREPARAZIONE = 1;
    const ORDINE_SPEDITO = 2;

    public function ricambiOrdinati(){
        return $this->hasMany(RicambioOrdinato::class);
    }
}
