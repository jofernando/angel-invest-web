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
            'rua'            => 'required|string|max:255',
            'bairro'         => 'required|string|max:255',
            'numero'         => 'required|string|max:255',
            'cidade'         => 'required|string|max:255',
            'estado'         => 'required|string|max:255',
            'cep'            => 'required|formato_cep|string|max:255',
            'complemento'    => 'nullable|string|max:10000',
        ];
    }
}
