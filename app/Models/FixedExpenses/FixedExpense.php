<?php

namespace App\Models\FixedExpenses;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FixedExpense extends Model
{
    use HasFactory;

    protected $table = 't_gastos_fijos';

    protected $primaryKey = 'clvGastoFijo';

    protected $fillable = [
        'clvGastoFijo',
        'gastoFijo',
        'costoGastoFijo',
        'folioFactura',
        'fechaGastoFijo',
        'clvTipoGastoFijo',
        'clvEquipo',
    ];

    protected $hidden = [
        // 'clvEquipo',
    ];

    //Reglas de validación para el controlador de equipos
    public static function getRulesEquipment($clvGastoFijo = null)
    {
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

    //Reglas de validación para el controlador de Gastos Fijos
    public static function getRulesFixedExpense($clvGastoFijo = null)
    {
        $rules = [
            'gastoFijo' => 'required|string|min:4|max:255',
            'costoGastoFijo' => 'required|numeric|between:0,99999999.99',
            'folioFactura' =>
            'nullable|string|max:20|unique:t_gastos_fijos,folioFactura,' . $clvGastoFijo . ',clvGastoFijo',
            'fechaGastoFijo' => 'required|date|before_or_equal:' . now()->toDateString(),
            'clvTipoGastoFijo' => 'required|not_in:[]',
            'clvEquipo' => 'required|not_in:[]',
        ];
        return $rules;
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class, 'clvEquipo');
    }

    public function TypeFixedExpense(): BelongsTo
    {
        return $this->belongsTo(TypeFixedExpense::class, 'clvTipoGastoFijo');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('folioFactura', 'like', '%' . $search . '%');
            $query->orWhere('gastoFijo', 'like', '%' . $search . '%');
            $query->orWhereHas('TypeFixedExpense', function ($query) use ($search) {
                $query->where('tipoGastoFijo', 'like', '%' . $search . '%');
            });
            $query->orWhereHas('equipment', function ($query) use ($search) {
                $query->where('noSerieEquipo', 'like', '%' . $search . '%');
            });
            $query->orWhereHas('equipment', function ($query) use ($search) {
                $query->where('modelo', 'like', '%' . $search . '%');
            });
        });
    }
}
