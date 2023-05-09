<?php

namespace App\Models\Rents;

use App\Models\Rent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentRent extends Model
{
    use HasFactory;

    protected $table = 't_pagos_rentas';

    protected $primaryKey = 'clvPagoRenta';

    protected $fillable = [
        'clvPagoRenta',
        'pagoRenta',
        'ivaRenta',
        'descripcion',
        'clvRenta',
        'clvEstadoPagoRenta',
    ];

    protected $hidden = [];

    public static function getRules($clvPagoRenta = null)
    {
        $rules = [
            'pagoRenta' => 'numeric|between:0,999999.99',
            'ivaRenta' => 'numeric|between:0,999999.99',
            'descripcion' => 'string|max:255',
            'clvRenta' => 'required|not_in:[]',
            'clvEstadoPagoRenta' => 'required|not_in:[]',
        ];
        return $rules;
    }

    public function estadoPagoRenta(): BelongsTo
    {
        return $this->belongsTo(StatusPaymentRent::class, 'clvEstadoPagoRenta');
    }

    public function rent(): BelongsTo
    {
        return $this->belongsTo(Rent::class, 'clvRenta');
    }
}
