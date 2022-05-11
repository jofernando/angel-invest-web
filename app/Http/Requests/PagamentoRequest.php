<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagamentoRequest extends FormRequest
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
            "valor"=>["required","min:0.01","max:100000000000"],
            "n_cartao"=>["required","max:20","min:16"],
            "nome"=>["required","max:255", "min:10"],
            "mes"=>["required","max:2","min:1"],
            "ano"=>["required","max:4","min:4"],
            "cvv"=>["required","min:3","max:3"]
        ];
    }
    public function messages()
    {
        return [
            'valor.required' => 'O valor é obrigatório.',
            'valor.max' => 'O valor máximo é 100 bilhões.',
            'valor.min' => 'O valor deve ser superior a um centavo.',
            'n_cartao.required' => 'O número do cartão é obrigatório.',
            'n_cartao.max' => 'Número do cartão deve conter 16 digítos.',
            'n_cartao.min' => 'Número do cartão deve conter 16 digítos.',
            'mes.required'=> 'Campo mês é obrigatório.',
            'ano.required'=> 'Campo ano é obrigatório.',
            'cvv.required' => 'O Código de segurança (CVV) é obrigatório.',
            'cvv.max' => 'O Código de segurança (CVV) deve conter 3 números.',
            'cvv.min' => 'O Código de segurança (CVV) deve conter 3 números.',
        ];
    }
    public function prepareForValidation()
    {
        $this->whenFilled('valor', function ($input) {
            $this->merge([
                'valor' => str_replace(['.', ','], ['', '.'], $input),
            ]);
        });
    }
}
