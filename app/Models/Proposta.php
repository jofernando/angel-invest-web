<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    use HasFactory;

    /**
     * Relacionamento inverso para startup
     * 
     * @return Startup $startup : startup relacionada a proposta
     */

    public function startup()
    {   
        $this->belongsTo(Startup::class);
    }
}
