<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\Framework\Constraint\IsTrue;

class LeilaoRequest extends FormRequest
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
            'produto_do_leilão' => 'required|integer',
            'valor_mínimo' => 'required|digits_between:0.01,10000000000.00',
            'número_de_garanhadores' => 'required|integer|min:1',
            'data_de_início' => 'required|date',
            'data_de_fim' => 'required|date|after:data_de_início',
            'termo_de_porcentagem_do_produto' => 'nullable|file|max:5120|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'valor_mínimo.digits_between' => 'O campo valor minímo deve ser pelo menos :min.',
        ];
    }
}
