<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestVariableExpense extends FormRequest
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
            'gastoVariable' => 'required|string|min:4|max:255',
            'descripcion' => 'nullable|string|min:4|max:255',
            'fechaGastoVariable' => 'required|date|before_or_equal:' . now()->toDateString(),
            'costoGastoVariable' => 'numeric|between:0,9999999999.99',
        ];
        return $rules;
    }

    //Personalizar la redirección de url
    //TODO: aún no lo uso con servios de petición HTTP como AXIOS, por  lo que aún no se si redirije tanto a peticiones js (No deberia)
    protected function getRedirectUrl()
    {
        $clvGastoVariable = $this->segment(count($this->segments()));
        if ($this->getMethod() == "PUT")
            return $this->redirector->getUrlGenerator()->previous() . '#editModalVariableExpenses_' . $clvGastoVariable;
        return $this->redirector->getUrlGenerator()->previous() . '#createModalVariableExpenses';
    }
}