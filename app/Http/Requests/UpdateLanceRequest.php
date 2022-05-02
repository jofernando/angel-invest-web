<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->tipo == 2;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $lance = $this->route('lance');
        $min = $lance->valor;
        $max = auth()->user()->investidor->carteira;
        return [
            'valor' => ['required', 'numeric', "min:$min", "max:$max"],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $valor_sem_ponto = str_replace('.', '', $this->valor);
        $valor_com_ponto = str_replace(',', '.', $valor_sem_ponto);
        $this->merge([
            'valor' => floatval($valor_com_ponto),
        ]);
    }
}
