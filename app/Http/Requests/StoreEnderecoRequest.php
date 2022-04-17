<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnderecoRequest extends FormRequest
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
            'rua'            => 'required|max:255',
            'bairro'         => 'required|max:255',
            'numero'         => 'required|max:255',
            'cidade'         => 'required|max:255',
            'estado'         => 'required|max:255',
            'cep'            => 'required|max:255',
            'complemento'    => 'required|max:10000',
        ];
    }
}
