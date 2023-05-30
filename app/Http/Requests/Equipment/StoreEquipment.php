<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipment extends FormRequest
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
    public function rules($clvEquipo = null): array
    {
        $rules = [
            'noSerieEquipo' => 'required|string|min:4|max:255|unique:t_equipos,noSerieEquipo,' . $clvEquipo . ',clvEquipo',
            'noSerieMotor' => 'string|min:4|max:255|unique:t_equipos,noSerieMotor,' . $clvEquipo . ',clvEquipo',
            'noEconomico' => 'required|string|min:4|max:255|unique:t_equipos,noEconomico,' . $clvEquipo . ',clvEquipo',
            'modelo' => 'required|string|min:4|max:255',
            'clvDisponibilidad' => 'required|not_in:[]',
            'clvCategoria' => 'required|not_in:[]',
            'descripcion' => 'string',
            'precioEquipo' => 'required|numeric|between:0,99999999.99',
            'folioEquipo' => 'required|string|min:6|max:20|unique:t_equipos,folioEquipo,' . $clvEquipo . ',clvEquipo',
            'fechaAdquisicion' => 'required|date|before_or_equal:' . now()->toDateString(),
            'fechaGarantiaExtendida' => 'date|before_or_equal:' . now()->toDateString(),
            'porDeprAnual' => 'required|numeric|between:0,100.00',
        ];
        return $rules;
    }
}