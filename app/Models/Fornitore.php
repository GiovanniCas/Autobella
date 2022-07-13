<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornitore extends Model
{
    use HasFactory;

    protected $fillable = [
        'ragione_sociale',
        'partita_iva',
    ];
}
