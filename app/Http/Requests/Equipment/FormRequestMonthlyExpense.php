<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestMonthlyExpense extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'gastoMensual' => 'required|string|min:4|max:255',
            'clvTipoGastoFijo' => 'not_in:[]',
            'indiceValorFijo' => 'int',
            'precioEquipo' => 'nullable|numeric|between:0,99999999.99',
            'porGastoMensual' => 'nullable|numeric|between:0,100.00',
            'costoMensual' => 'required|numeric|between:0,99999999.99',
            'descripcion' => 'nullable|string',
            'clvEquipo' => 'int',
        ];
        return $rules;
    }

    //Personalizar la redirección de url
    //TODO: aún no lo uso con servios de petición HTTP como AXIOS, por  lo que aún no se si redirije tanto a peticiones js (No deberia)
    protected function getRedirectUrl()
    {
        $clvGastoMensual = $this->segment(count($this->segments()));
        if ($this->getMethod() == "PUT")
            return $this->redirector->getUrlGenerator()->previous() . '#editModalMonthlyExpenses_' . $clvGastoMensual;
        return $this->redirector->getUrlGenerator()->previous() . '#createModalMonthlyExpenses';
    }
}