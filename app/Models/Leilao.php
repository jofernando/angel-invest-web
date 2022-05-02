<?php

namespace App\Models;

use DateTime;
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
            if($this->lances->last()) {
                return $this->lances->last()->valor;
            } else {
                return $this->valor_minimo;
            }
        }
    }

    public function esta_no_periodo_de_lances()
    {
        $now = new DateTime();
        $startdate = new DateTime($this->data_inicio);
        $enddate = new DateTime($this->data_fim);
        return $now >= $startdate && $now <= $enddate;
    }
}
