<?php

namespace App\Http\Requests\Rents;

use Illuminate\Foundation\Http\FormRequest;

class StoreRent extends FormRequest
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
            'clvEquipo' => 'required|not_in:[]',
            'clvCliente' => 'required|not_in:[]',
            'descripcion' => 'nullable|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'periodoRenta' => 'required|not_in:[]',
        ];
        return $rules;
    }
}