<?php

namespace App\Http\Requests\Rents;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRent extends FormRequest
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
            'descripcion' => 'nullable|string|max:255',
            'clvEstadoRenta' => 'required|not_in:[]',
        ];
        return $rules;
    }
}