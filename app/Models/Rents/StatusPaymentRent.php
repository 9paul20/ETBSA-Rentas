<?php

namespace App\Models\Rents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPaymentRent extends Model
{
    use HasFactory;

    protected $table = 't_estados_pagos_rentas';

    protected $primaryKey = 'clvEstadoPagoRenta';

    protected $fillable = [
        'clvEstadoPagoRenta',
        'estadoPagoRenta',
        'descripcion',
        'textColor',
        'bgColorPrimary',
        'bgColorSecondary',
    ];

    protected $hidden = [];

    public static function getRules($clvEstadoPagoRenta = null)
    {
        $rules = [
            'estadoPagoRenta' => 'required|string|min:3|max:255|unique:t_estados_pagos_rentas,estadoPagoRenta,' . $clvEstadoPagoRenta . ',clvEstadoPagoRenta',
            'descripcion' => 'string|max:255',
            'textColor' => 'required|string|min:11|max:16',
            'bgColorPrimary' => 'required|string|min:9|max:16',
            'bgColorSecondary' => 'required|string|min:9|max:16',
        ];
        return $rules;
    }
}
