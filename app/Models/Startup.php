<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Startup extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'email',
        'cnpj',
        'logo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }


    /**
     * Relacionamento n propostas
     *
     * @return Collection $propostas : propostas relacionadas à startup
     */
    public function propostas()
    {
        return $this->hasMany(Proposta::class);
    }
}
