<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leilao extends Model
{
    use HasFactory;

    public $fillable = [
        'valor_minimo',
        'data_inicio',
        'data_fim',
        'numero_ganhadores',
        'porcetagem_caminho',
        'proposta_id',
    ];
    
    /**
     * Relacionamento inverso para propsota
     *
     * @return Proposta $proposta : Proposta que está ligada ao leilão
     */
    public function proposta()
    {
        return $this->belongsTo(Proposta::class);
    }
}
