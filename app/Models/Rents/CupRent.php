<?php

namespace App\Models\Rents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CupRent extends Model
{
    use HasFactory;

    protected $table = 't_tazas_rentas';

    protected $primaryKey = 'clvTazaRenta';

    protected $fillable = [
        'clvTazaRenta',
        'tazaRenta',
        'rentaUnMes',
        'rentaDosMeses',
        'rentaTresMeses',
        'ivaUnMes',
        'ivaDosMeses',
        'ivaTresMeses',
        'descripcion',
    ];

    protected $hidden = [];

    public static function getRules($clvTazaRenta = null)
    {
        $rules = [
            'tazaRenta' => 'required|string|min:3|max:255|unique:t_tazas_rentas,tazaRenta,' . $clvTazaRenta . ',clvTazaRenta',
            'rentaUnMes' => 'numeric|between:0,999999.99',
            'rentaDosMeses' => 'numeric|between:0,999999.99',
            'rentaTresMeses' => 'numeric|between:0,999999.99',
            'ivaUnMes' => 'numeric|between:0,999999.99',
            'ivaDosMeses' => 'numeric|between:0,999999.99',
            'ivaTresMeses' => 'numeric|between:0,999999.99',
            'descripcion' => 'string|max:255',
        ];
        return $rules;
    }
}