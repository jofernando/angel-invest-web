<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lance extends Model
{
    use HasFactory;

    /**
     * Get the leilao that owns the Lance
     *
     * @return \App\Models\Leilao
     */
    public function leilao()
    {
        return $this->belongsTo(Leilao::class);
    }

    /**
     * Get the investidor that owns the Lance
     *
     * @return \App\Models\Investidor
     */
    public function investidor()
    {
        return $this->belongsTo(Investidor::class);
    }
}
