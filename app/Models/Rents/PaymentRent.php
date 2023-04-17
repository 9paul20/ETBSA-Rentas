<?php

namespace App\Models\Rents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRent extends Model
{
    use HasFactory;

    protected $table = 't_pagos_rentas';

    protected $primaryKey = 'clvPagoRenta';

    protected $fillable = [
        'clvPagoRenta',
        'pagoRenta',
        'descripcion',
        'clvEstadoPagoRenta',
    ];

    protected $hidden = [];

    public static function getRules($clvPagoRenta = null)
    {
        $rules = [
            'pagoRenta' => 'required|string|min:3|max:255|unique:t_pagos_rentas,pagoRenta,' . $clvPagoRenta . ',clvPagoRenta',
            'descripcion' => 'string|max:255',
            'clvEstadoPagoRenta' => 'required|not_in:[]',
        ];
        return $rules;
    }

    public function estadoPagoRenta()
    {
        return $this->belongsTo(StatusPaymentRent::class, 'clvEstadoPagoRenta');
    }
}