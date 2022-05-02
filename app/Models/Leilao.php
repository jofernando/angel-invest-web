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

    /**
     * Get all of the lances for the Leilao
     */
    public function lances()
    {
        return $this->hasMany(Lance::class)->orderBy('valor', 'DESC');
    }

    public function valor_corte()
    {
        if($this->lances->count() > $this->numero_ganhadores) {
            return $this->lances->get($this->numero_ganhadores - 1)->valor;
        } else {
            return $this->lances->last()->valor;
        }
    }
}
