<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investidor extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the Investidor
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the lances for the Investidor
     */
    public function lances()
    {
        return $this->hasMany(Lance::class);
    }

    public function leiloes()
    {
        return $this->lances->map(function ($lance) {
            return $lance->leilao;
        });
    }
}
