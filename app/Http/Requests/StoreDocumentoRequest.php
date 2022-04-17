<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'documentos.*' => ['required', 'file','max:5120','mimes:pdf'],
            'nomes.*' => ['required', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            'documentos.*.required' => 'O arquivo é obrigatório.',
            'documentos.*.max' => 'O tamanho máximo do arquivo é 5MB.',
            'documentos.*.mimes' => 'O arquivo só pode ser um PDF.',
            'nomes.*.required' => 'O nome do arquivo é obrigatório.',
            'nomes.*.max' => 'O tamanho máximo do nome do arquivo é de 255 caracteres.'
        ];
    }
}
