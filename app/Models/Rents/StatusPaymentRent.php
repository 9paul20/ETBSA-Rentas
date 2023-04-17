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
    ];

    protected $hidden = [];

    public static function getRules($clvEstadoPagoRenta = null)
    {
        $rules = [
            'estadoPagoRenta' => 'required|string|min:3|max:255|unique:t_estados_pagos_rentas,estadoPagoRenta,' . $clvEstadoPagoRenta . ',clvEstadoPagoRenta',
            'descripcion' => 'string|max:255',
        ];
        return $rules;
    }
}