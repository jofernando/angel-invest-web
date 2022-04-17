<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'rua',
        'bairro',
        'numero',
        'cidade',
        'estado',
        'complemento',
        'cep',

    ];

    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }
}
