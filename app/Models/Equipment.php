<?php

namespace App\Models;

use App\Models\Equipments\Category;
use App\Models\Equipments\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'porDeprAnual',
    ];

    protected $hidden = [];

    // public static function getRules($clvEquipo = null)
    // {
    //     $rules = [
    //         'noSerieEquipo' => 'required|string|min:4|max:255|unique:t_equipos,noSerieEquipo,' . $clvEquipo . ',clvEquipo',
    //         'noSerieMotor' => 'string|min:4|max:255|unique:t_equipos,noSerieMotor,' . $clvEquipo . ',clvEquipo',
    //         'noEconomico' => 'required|string|min:4|max:255|unique:t_equipos,noEconomico,' . $clvEquipo . ',clvEquipo',
    //         'modelo' => 'required|string|min:4|max:255',
    //         'clvDisponibilidad' => 'required|not_in:[]',
    //         'clvCategoria' => 'required|not_in:[]',
    //         'descripcion' => 'string',
    //         'precioEquipo' => 'required|numeric|between:0,99999999.99',
    //         'folioEquipo' => 'required|string|min:6|max:20|unique:t_equipos,folioEquipo,' . $clvEquipo . ',clvEquipo',
    //         'fechaAdquisicion' => 'required|date|before_or_equal:' . now()->toDateString(),
    //         'fechaGarantiaExtendida' => 'date|before_or_equal:' . now()->toDateString(),
    //         'porDeprAnual' => 'required|numeric|between:0,100.00',
    //     ];
    //     return $rules;
    // }

    public function disponibilidad(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'clvDisponibilidad');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'clvCategoria');
    }

    public function fixedExpenses(): HasMany
    {
        return $this->hasMany(FixedExpenses\FixedExpense::class, 'clvEquipo');
    }

    public function variablesExpenses(): HasMany
    {
        return $this->hasMany(VariablesExpenses\VariableExpense::class, 'clvEquipo');
    }

    public function monthlyExpenses(): HasMany
    {
        return $this->hasMany(MonthlyExpenses\MonthlyExpense::class, 'clvEquipo');
    }

    //*Funciones de los Atributos Principales del Equipo
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

    protected function sumGastosMensuales(): Attribute
    {
        $sumGastosMensuales = round($this->monthlyExpenses->sum('costoMensual'), 2);
        return Attribute::make(
            get: fn () => $sumGastosMensuales
        );
    }

    protected function costoBase(): Attribute
    {
        $costoBase = round($this['precioEquipo'] + $this->sumGastosFijos + $this->sumGastosVariables, 2);
        return Attribute::make(
            get: fn () => $costoBase
        );
    }

    protected function antiguedadEquipo(): Attribute
    {
        if (isset($this['fechaAdquisicion'])) {
            $fechaCompra = Carbon::createFromFormat('Y-m-d', $this['fechaAdquisicion']);
            $fechaActual = Carbon::now();

            // $antiguedadAnios = $fechaCompra->diffInYears($fechaActual);
            // $antiguedadMeses = $fechaCompra->diffInMonths($fechaActual) % 12;
            $antiguedadMeses = $fechaCompra->diffInMonths($fechaActual);
            $antiguedadDias = $fechaCompra->diffInDays($fechaActual) % 30;

            // if ($antiguedadAnios > 0)
            //     $antiguedadEquipo =  "$antiguedadAnios Año(s), $antiguedadMeses Mes(es), $antiguedadDias Dia(s)";
            if ($antiguedadMeses > 0)
                $antiguedadEquipo =  "$antiguedadMeses Mes(es), $antiguedadDias Dia(s)";
            else
                $antiguedadEquipo =  "$antiguedadDias Dia(s)";
            return Attribute::make(
                get: fn () => $antiguedadEquipo
            );
        } else {
            $antiguedadEquipo = null;
            return Attribute::make(
                get: fn () =>
                $antiguedadEquipo
            );
        }
    }

    //TODO-> Tiempo residual del equipo
    protected function tiempoAmortizacionAnios(): Attribute
    {
        if (isset($this['porDeprAnual']) || $this['porDeprAnual'] > 0)
            $tiempoAmortizacionAnios = 100 / $this['porDeprAnual'];
        else
            $tiempoAmortizacionAnios = 0;
        return Attribute::make(
            get: fn () => $tiempoAmortizacionAnios
        );
    }

    protected function tiempoAmortizacionMeses(): Attribute
    {
        $tiempoAmortizacionMeses = $this->tiempoAmortizacionAnios * 12;
        return Attribute::make(
            get: fn () => $tiempoAmortizacionMeses
        );
    }

    protected function tiempoAmortizacionDias(): Attribute
    {
        $tiempoAmortizacionDias = $this->tiempoAmortizacionAnios * 365;
        return Attribute::make(
            get: fn () => $tiempoAmortizacionDias
        );
    }

    //*Depreciación Por Días
    protected function depreciacionPorDias(): Attribute
    {
        $depreciacionPorDias = round(($this['precioEquipo'] * ($this['porDeprAnual'] / 100) / 365), 2);
        return Attribute::make(
            get: fn () => $depreciacionPorDias
        );
    }

    protected function depreciacionAcumuladaPorDias(): Attribute
    {
        $diferenciaDias = Carbon::now()->diffInDays($this['fechaAdquisicion']);
        $depreciacionAcumuladaPorDias = round($this->depreciacion_por_dias * $diferenciaDias, 2);
        if ($depreciacionAcumuladaPorDias > $this['precioEquipo'])
            $depreciacionAcumuladaPorDias = $this['precioEquipo'];
        return Attribute::make(
            get: fn () => $depreciacionAcumuladaPorDias
        );
    }

    //Costo Bruto Diario
    protected function precioActualPorDepreciacionDiaria(): Attribute
    {
        if ($this->depreciacion_acumulada_por_dias < $this['precioEquipo'])
            $precioActualPorDepreciacionDiaria = round($this['precioEquipo'] - $this->depreciacion_acumulada_por_dias, 2);
        else
            $precioActualPorDepreciacionDiaria = 0;
        return Attribute::make(
            get: fn () => $precioActualPorDepreciacionDiaria
        );
    }

    //Costo Neto Diario
    protected function costoNetoDiario(): Attribute
    {
        $CostoNetoDiario = round($this->costoBase - $this->depreciacion_acumulada_por_dias, 2);
        return Attribute::make(
            get: fn () => $CostoNetoDiario
        );
    }

    //*Depreciación Por Meses
    protected function depreciacionPorMeses(): Attribute
    {
        $depreciacionPorMeses = round(($this['precioEquipo'] * ($this['porDeprAnual'] / 100) / 12), 2);
        return Attribute::make(
            get: fn () => $depreciacionPorMeses
        );
    }

    protected function depreciacionAcumuladaPorMeses(): Attribute
    {
        $diferenciaMeses = Carbon::now()->diffInMonths($this['fechaAdquisicion']);
        $depreciacionAcumuladaPorMeses = round($this->depreciacion_por_meses * $diferenciaMeses, 2);
        if ($depreciacionAcumuladaPorMeses > $this['precioEquipo'])
            $depreciacionAcumuladaPorMeses = $this['precioEquipo'];
        return Attribute::make(
            get: fn () => $depreciacionAcumuladaPorMeses
        );
    }

    //Costo Bruto Mensual
    protected function precioActualPorDepreciacionMensual(): Attribute
    {
        if ($this->depreciacion_acumulada_por_meses < $this['precioEquipo'])
            $precioActualPorDepreciacionMensual = round($this['precioEquipo'] - $this->depreciacion_acumulada_por_meses, 2);
        else
            $precioActualPorDepreciacionMensual = 0;
        return Attribute::make(
            get: fn () => $precioActualPorDepreciacionMensual
        );
    }

    //Costo Neto Mensual
    protected function costoNetoMensual(): Attribute
    {
        $CostoNetoMensual = round($this->costoBase - $this->depreciacion_acumulada_por_meses, 2);
        return Attribute::make(
            get: fn () => $CostoNetoMensual
        );
    }

    //*Depreciación Por Año
    protected function depreciacionPorAnios(): Attribute
    {
        $depreciacionPorAnios = round(($this['precioEquipo'] * ($this['porDeprAnual'] / 100)), 2);
        return Attribute::make(
            get: fn () => $depreciacionPorAnios
        );
    }

    protected function depreciacionAcumuladaPorAnios(): Attribute
    {
        $diferenciaAnios = Carbon::now()->diffInYears($this['fechaAdquisicion']);
        $depreciacionAcumuladaPorAnios = round($this->depreciacion_por_anios * $diferenciaAnios, 2);
        if ($depreciacionAcumuladaPorAnios > $this['precioEquipo'])
            $depreciacionAcumuladaPorAnios = $this['precioEquipo'];
        return Attribute::make(
            get: fn () => $depreciacionAcumuladaPorAnios
        );
    }

    //Costo Bruto Anual
    protected function precioActualPorDepreciacionAnual(): Attribute
    {
        if ($this->depreciacion_acumulada_por_anios < $this['precioEquipo'])
            $precioActualPorDepreciacionAnual = round($this['precioEquipo'] - $this->depreciacion_acumulada_por_anios, 2);
        else
            $precioActualPorDepreciacionAnual = 0;
        return Attribute::make(
            get: fn () => $precioActualPorDepreciacionAnual
        );
    }

    //Costo Neto Anual
    protected function costoNetoAnual(): Attribute
    {
        $CostoNetoAnual = round($this->costoBase - $this->depreciacion_acumulada_por_anios, 2);
        return Attribute::make(
            get: fn () => $CostoNetoAnual
        );
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('noSerieEquipo', 'like', '%' . $search . '%');
            $query->orWhere('modelo', 'like', '%' . $search . '%');
            $query->orWhereHas('disponibilidad', function ($query) use ($search) {
                $query->where('disponibilidad', 'like', '%' . $search . '%');
            });
            $query->orWhereHas('categoria', function ($query) use ($search) {
                $query->where('categoria', 'like', '%' . $search . '%');
            });
        });
    }
}