<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelloCompatibile extends Model
{
    use HasFactory;

    protected $table = 'modello_ricambio' ;

    protected $fillable = [
        'ricambio_id',
        'modello_id',
    ];
}
