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
        'costoGastoVariable',
    ];

    protected $hidden = [
        'clvEquipo',
    ];

    public static function getRules($clvGastoVariable = null)
    {
        $rules = [
            'gastoVariable' => 'required|string|min:4|max:255',
            'descripcion' => 'required|string|min:4|max:255',
            'costoGastoVariable' => 'numeric|between:0,9999999999.99',
        ];
        return $rules;
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class, 'clvEquipo');
    }
}
