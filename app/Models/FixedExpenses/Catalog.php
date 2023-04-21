<?php

namespace App\Models\FixedExpenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Catalog extends Model
{
    use HasFactory;

    protected $table = 't_gastos_fijos';

    protected $primaryKey = 'clvGastoFijo';

    protected $fillable = [
        'clvGastoFijo',
        'gastoFijo',
        'descripcion',
    ];

    protected $hidden = [];

    public static function getRules($clvGastoFijo = null)
    {
        $rules = [
            'gastoFijo' => 'required|string|min:3|max:255|unique:t_gastos_fijos,gastoFijo,' . $clvGastoFijo . ',clvGastoFijo',
            'descripcion' => 'string|max:255',
        ];
        return $rules;
    }

    public function equipments(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 't_equipos_has_gastos_fijos', 'clvGastoFijo', 'clvEquipo');
    }
}
