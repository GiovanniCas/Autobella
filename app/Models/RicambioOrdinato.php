<?php

namespace App\Models;

use App\Models\User;
use App\Models\Testata;
use App\Models\Ricambio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RicambioOrdinato extends Model
{
    use HasFactory;

    protected $table = 'ricambi_ordinati';

    protected $fillable = 
    [
        'ricambio_id',
        'testata_id',
        'nome_ricambio',
        'codice_ricambio',
        'quantita',
        'prezzo_unitario',
    ];

    public function ricambi(){
        return $this->belongsTo(Ricambio::class , 'ricambio_id');
    }

    public function testate(){
        return $this->belongsTo(Testata::class , 'testata_id');
    }

    public function users(){
        return $this->belongsTo(User::class , 'user_id');
    }

    
}
