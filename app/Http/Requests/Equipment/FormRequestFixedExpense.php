<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestFixedExpense extends FormRequest
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
        $clvGastoFijo = $this->segment(count($this->segments()));
        $rules = [
            'gastoFijo' => 'required|string|min:4|max:255',
            'costoGastoFijo' => 'required|numeric|between:0,99999999.99',
            'folioFactura' =>
            'nullable|string|max:20|unique:t_gastos_fijos,folioFactura,' . $clvGastoFijo . ',clvGastoFijo',
            'fechaGastoFijo' => 'required|date|before_or_equal:' . now()->toDateString(),
            'clvTipoGastoFijo' => 'required|not_in:[]',
            'clvEquipo' => 'int',
        ];
        return $rules;
    }

    //Personalizar la redirección de url
    //TODO: aún no lo uso con servios de petición HTTP como AXIOS, por  lo que aún no se si redirije tanto a peticiones js (No deberia)
    protected function getRedirectUrl()
    {
        $clvGastoFijo = $this->segment(count($this->segments()));
        if ($this->getMethod() == "PUT")
            return $this->redirector->getUrlGenerator()->previous() . '#editModalFixedExpenses_' . $clvGastoFijo;
        return $this->redirector->getUrlGenerator()->previous() . '#createModalFixedExpenses';
    }
}