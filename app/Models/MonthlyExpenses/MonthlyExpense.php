<?php

namespace App\Models\MonthlyExpenses;

use App\Models\Equipment;
use App\Models\FixedExpenses\TypeFixedExpense;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyExpense extends Model
{
    use HasFactory;

    protected $table = 't_gastos_mensuales';

    protected $primaryKey = 'clvGastoMensual';

    protected $fillable = [
        'clvGastoMensual',
        'gastoMensual',
        'precioEquipo',
        'porGastoMensual',
        'costoMensual',
        'descripcion',
        'clvEquipo',
        'clvTipoGastoFijo',
    ];

    protected $hidden = [];

    public static function getRulesEquipment($clvGastoMensual = null)
    {
        $rules = [
            'gastoMensual' => 'required|string|min:4|max:255',
            'clvTipoGastoFijo' => 'not_in:[]',
            'precioEquipo' => 'nullable|numeric|between:0,99999999.99',
            'porGastoMensual' => 'nullable|numeric|between:0,100.00',
            'costoMensual' => 'required|numeric|between:0,99999999.99',
            'descripcion' => 'nullable|string',
            'clvEquipo' => 'int',
        ];
        return $rules;
    }

    public static function getRulesMontlyExpenses($clvGastoMensual = null)
    {
        $rules = [
            'clvEquipo' => 'not_in:[]',
            'clvTipoGastoFijo' => 'not_in:[]',
            'gastoMensual' => 'required|string|min:4|max:255',
            'precioEquipo' => 'nullable|numeric|between:0,99999999.99',
            'porGastoMensual' => 'nullable|numeric|between:0,100.00',
            'costoMensual' => 'required|numeric|between:0,99999999.99',
            'descripcion' => 'nullable|string',
        ];
        return $rules;
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class, 'clvEquipo');
    }

    public function typeFixedExpense(): BelongsTo
    {
        return $this->belongsTo(TypeFixedExpense::class, 'clvTipoGastoFijo');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            // $query->where('noSerieEquipo', 'like', '%' . $search . '%');
            // $query->orWhere('modelo', 'like', '%' . $search . '%');
            // $query->orWhereHas('disponibilidad', function ($query) use ($search) {
            //     $query->where('disponibilidad', 'like', '%' . $search . '%');
            // });
            // $query->orWhereHas('categoria', function ($query) use ($search) {
            //     $query->where('categoria', 'like', '%' . $search . '%');
            // });
        });
    }
}