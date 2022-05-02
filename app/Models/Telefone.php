<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreTelefoneRequest;
use GuzzleHttp\Psr7\Request;

class Telefone extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'startup_id'];

    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }

    public function setAttributes($numero, Startup $startup)
    {
        $this->numero = $numero;
        $this->startup_id = $startup->id;
    }
}
