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
        'nome',
        'cognome',
        'citta',
        'indirizzo',
        'cap',
        'email',
        'totale',
    ] ;

    public function ricambiOrdinati(){
        return $this->hasMany(RicambioOrdinato::class);
    }
}
