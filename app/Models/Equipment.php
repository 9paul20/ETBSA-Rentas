<?php

namespace App\Models;

use App\Models\Equipments\Category;
use App\Models\Equipments\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'fechaAdquisicion',
    ];

    protected $hidden = [];

    public static function getRules($clvEquipo = null)
    {
        $rules = [
            'noSerieEquipo' => 'required|string|min:4|max:255|unique:t_equipos,noSerieEquipo,' . $clvEquipo . ',clvEquipo',
            'noSerieMotor' => 'required|string|min:4|max:255|unique:t_equipos,noSerieMotor,' . $clvEquipo . ',clvEquipo',
            'noEconomico' => 'required|string|min:4|max:255|unique:t_equipos,noEconomico,' . $clvEquipo . ',clvEquipo',
            'modelo' => 'required|string|min:4|max:255',
            'clvDisponibilidad' => 'required|not_in:[]',
            'clvCategoria' => 'required|not_in:[]',
            'descripcion' => 'string',
            'precioEquipo' => 'required|numeric|between:0,99999999.99',
            'fechaAdquisicion' => 'required|date|before_or_equal:' . now()->toDateString(),
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
}
