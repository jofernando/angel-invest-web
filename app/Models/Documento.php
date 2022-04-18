<?php

namespace App\Models;

use App\Http\Requests\StoreDocumentoRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'caminho', 'startup_id'];

    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }

    /**
     * Set atributes documento object
     *
     * @param Array $input : input with atributes documento
     *
     * @return void
     */
    public function setAttributes($nome, Startup $startup)
    {
        $this->nome = $nome;
        $this->startup_id = $startup->id;
    }

     /**
     * Salva arquivo documento
     *
     * @param Documento $documento : objeto de documento
     * @param file $file : arquivo que será salvo
     * @param string $diretorio : diretório atual para checar se existe algum arquivo ligado a documento
     * @param string $path : terminação do path a qual o arquivo será salvo. 'documento/'.$documento->id.$path
     * @return string $caminho : caminho que o arquivo foi salvo
     */

    public function salvarArquivo($file, $diretorio)
    {
        if ($file != null) {
            $this->deletarArquivo($diretorio);

            $path_completo = 'documentos/startups/'. $this->startup->id . '/';
            $nome_documento = $this->nome . $this->id . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('public/'.$path_completo, $file, $nome_documento);
            $novo_diretorio = $path_completo . $nome_documento;

            return $novo_diretorio;
        } else {
            return $diretorio;
        }
    }
    /**
     * Deleta um arquivo no diretorio especificado
     *
     * @param string $diretorio : diretório do arquivo que será deletado
     * @return void
     */

    public function deletarArquivo($diretorio)
    {
        if ($diretorio != null) {
            if (Storage::disk()->exists('public/'.$diretorio)) {
                Storage::delete('public/'.$diretorio);
            }
        }
    }
}
