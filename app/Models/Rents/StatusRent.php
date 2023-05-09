<?php

namespace App\Models\Rents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatusRent extends Model
{
    use HasFactory;

    protected $table = 't_estados_rentas';

    protected $primaryKey = 'clvEstadoRenta';

    protected $fillable = [
        'clvEstadoRenta',
        'estadoRenta',
        'descripcion',
        'textColor',
        'bgColorPrimary',
        'bgColorSecondary',
    ];

    protected $hidden = [];

    public static function getRules($clvEstadoRenta = null)
    {
        $rules = [
            'estadoRenta' => 'required|string|min:3|max:255|unique:t_estados_rentas,estadoRenta,' . $clvEstadoRenta . ',clvEstadoRenta',
            'descripcion' => 'nullable|string|max:255',
            'textColor' => 'required|string|min:11|max:16',
            'bgColorPrimary' => 'required|string|min:9|max:16',
            'bgColorSecondary' => 'required|string|min:9|max:16',
        ];
        return $rules;
    }
}
