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
        'clvEquipo',
    ];

    public static function getRules($clvGastoFijo = null)
    {
        $rules = [
            'gastoFijo' => 'required|string|min:4|max:255',
            'costoGastoFijo' => 'required|numeric|between:0,99999999.99',
            'folioFactura' => 'required|string|min:4|max:255',
            'fechaGastoFijo' => 'required|date|before_or_equal:' . now()->toDateString(),
            'clvTipoGastoFijo' => 'required|not_in:[]',
            'clvEquipo' => 'int',
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
}