<?php

namespace App\Models;

use App\Models\Modello;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marche'; 

    protected $fillable = [
        'nome',
    ];

    public function modelli(){
        return $this->hasMany(Modello::class);
    }
}
