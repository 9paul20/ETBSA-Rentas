<?php

namespace App\Models\FixedExpenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TypeFixedExpense extends Model
{
    use HasFactory;

    protected $table = 't_tipos_gastos_fijos';

    protected $primaryKey = 'clvTipoGastoFijo';

    protected $fillable = [
        'clvTipoGastoFijo',
        'tipoGastoFijo',
        'descripcion',
    ];

    protected $hidden = [];

    public static function getRules($clvTipoGastoFijo = null)
    {
        $rules = [
            'tipoGastoFijo' => 'required|string|min:3|max:255|unique:t_tipos_gastos_fijos,tipoGastoFijo,' . $clvTipoGastoFijo . ',clvTipoGastoFijo',
            'descripcion' => 'string|max:255',
        ];
        return $rules;
    }
}
