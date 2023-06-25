<?php

namespace App\Http\Requests\Equipment;

use App\Models\Equipment;
use Illuminate\Foundation\Http\FormRequest;

class FormRequestEquipment extends FormRequest
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
        // $clvEquipo = $this->route('Equipment');
        $clvEquipo = $this->segment(count($this->segments()));
        // $clvEquipo = $this->segment(3);
        return [
            'noSerieEquipo' => 'required|string|min:4|max:255|unique:t_equipos,noSerieEquipo,' . $clvEquipo . ',clvEquipo',
            'noSerieMotor' => 'nullable|string|min:4|max:255|unique:t_equipos,noSerieMotor,' . $clvEquipo . ',clvEquipo',
            'noEconomico' => 'nullable|string|min:4|max:255|unique:t_equipos,noEconomico,' . $clvEquipo . ',clvEquipo',
            'modelo' => 'required|string|min:4|max:255',
            'clvDisponibilidad' => 'required|not_in:[]',
            'clvCategoria' => 'required|not_in:[]',
            'descripcion' => 'nullable|string',
            'precioEquipo' => 'required|numeric|between:0,99999999.99',
            'precioEquipoActual' => 'required|numeric|between:0,99999999.99',
            'precioActualVenta' => 'nullable|numeric|between:0,99999999.99',
            'folioEquipo' => 'nullable|string|min:6|max:20|unique:t_equipos,folioEquipo,' . $clvEquipo . ',clvEquipo',
            'fechaAdquisicion' => 'required|date|before_or_equal:' . now()->toDateString(),
            'fechaGarantiaExtendida' => 'nullable|date|before_or_equal:' . now()->toDateString(),
            'fechaVenta' => 'nullable|date|before_or_equal:' . now()->toDateString(),
            'porDeprAnual' => 'nullable|numeric|between:0,100.00',
        ];
    }
}