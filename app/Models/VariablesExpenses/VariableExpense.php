<?php

namespace App\Models\VariablesExpenses;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariableExpense extends Model
{
    use HasFactory;

    protected $table = 't_gastos_variables';

    protected $primaryKey = 'clvGastoVariable';

    protected $fillable = [
        'clvGastoVariable',
        'gastoVariable',
        'descripcion',
        'fechaGastoVariable',
        'costoGastoVariable',
        'clvEquipo',
    ];

    protected $hidden = [];

    public static function getRulesEquipment($clvGastoVariable = null)
    {
        $rules = [
            'gastoVariable' => 'required|string|min:4|max:255',
            'descripcion' => 'nullable|string|min:4|max:255',
            'fechaGastoVariable' => 'required|date|before_or_equal:' . now()->toDateString(),
            'costoGastoVariable' => 'numeric|between:0,9999999999.99',
        ];
        return $rules;
    }

    public static function getRulesVariableExpense($clvGastoVariable = null)
    {
        $rules = [
            'gastoVariable' => 'required|string|min:4|max:255',
            'descripcion' => 'nullable|string|min:4|max:255',
            'fechaGastoVariable' => 'required|date|before_or_equal:' . now()->toDateString(),
            'costoGastoVariable' => 'numeric|between:0,9999999999.99',
            'clvEquipo' => 'required|not_in:[]',
        ];
        return $rules;
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class, 'clvEquipo');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('gastoVariable', 'like', '%' . $search . '%');
            $query->orWhere('descripcion', 'like', '%' . $search . '%');
            $query->orWhereHas('equipment', function ($query) use ($search) {
                $query->where('noSerieEquipo', 'like', '%' . $search . '%');
            });
            $query->orWhereHas('equipment', function ($query) use ($search) {
                $query->where('modelo', 'like', '%' . $search . '%');
            });
        });
    }
}