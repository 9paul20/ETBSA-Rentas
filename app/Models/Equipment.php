<?php

namespace App\Models;

use App\Models\Equipment as ModelsEquipment;
use App\Models\Equipments\Category;
use App\Models\Equipments\Status;
use DB;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 't_equipos';

    protected $primaryKey = 'clvEquipo';

    protected $fillable = [
        'clvEquipo',
        'noSerieEquipo',
        'noSerieMotor',
        'noEconomico',
        'modelo',
        'clvDisponibilidad',
        'clvCategoria',
        'descripcion',
        'precioEquipo',
        'folioEquipo',
        'fechaAdquisicion',
        'fechaGarantiaExtendida',
        'porcentajeDepreciacionAnual',
    ];

    protected $hidden = [];

    public static function getRules($clvEquipo = null)
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
            'porcentajeDepreciacionAnual' => 'required|numeric|between:0,100.00',
        ];
        return $rules;
    }

    public function disponibilidad(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'clvDisponibilidad');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'clvCategoria');
    }

    public function fixedExpensesCatalogs(): BelongsToMany
    {
        return $this->belongsToMany(FixedExpenses\Catalog::class, 't_equipos_has_gastos_fijos', 'clvEquipo', 'clvGastoFijo')->withPivot('costoGastoFijo');
    }

    public function fixedExpenses(): HasMany
    {
        return $this->hasMany(FixedExpenses\FixedExpense::class, 'clvEquipo');
    }

    public function variablesExpenses(): HasMany
    {
        return $this->hasMany(VariablesExpenses\VariableExpense::class, 'clvEquipo');
    }

    protected function depreciacionMensualEquipo(): Attribute
    {
        $depreciacionMensualEquipo = round((($this['precioEquipo'] * 0.25) / 12), 2);
        return Attribute::make(
            get: fn () => $depreciacionMensualEquipo
        );
    }

    protected function sumGastosFijos(): Attribute
    {
        $sumGastosFijos = round($this->fixedExpenses->sum('costoGastoFijo'), 2);
        return Attribute::make(
            get: fn () => $sumGastosFijos
        );
    }

    protected function sumGastosVariables(): Attribute
    {
        $sumGastosVariables = round($this->variablesExpenses->sum('costoGastoVariable'), 2);
        return Attribute::make(
            get: fn () => $sumGastosVariables
        );
    }

    protected function costoBase(): Attribute
    {
        $costoBase = round($this['precioEquipo'] + $this->sum_gastos_fijos + $this->sum_gastos_variables, 2);
        return Attribute::make(
            get: fn () => $costoBase
        );
    }
}