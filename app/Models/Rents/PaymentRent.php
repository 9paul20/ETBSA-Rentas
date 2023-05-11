<?php

namespace App\Models\Rents;

use App\Models\Rent;
use Carbon\Carbon;
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
        'fecha_inicio',
        'fecha_fin',
        'clvRenta',
        'clvEstadoPagoRenta',
    ];

    protected $hidden = [];

    public static function getRules($clvPagoRenta = null)
    {
        $rules = [
            'pagoRenta' => 'numeric|between:0,999999.99',
            'ivaRenta' => 'numeric|between:0,999999.99',
            'clvRenta' => 'required|not_in:[]',
            'clvEstadoPagoRenta' => 'required|not_in:[]',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'descripcion' => 'string|max:255',
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

    public static function boot()
    {
        parent::boot();

        $estadoPagoRentaPendienteDePago = null;
        $estadoPagoRentaEnMora = null;

        static::retrieved(function ($paymentRent) use (&$estadoPagoRentaPendienteDePago, &$estadoPagoRentaEnMora) {
            if (!$estadoPagoRentaPendienteDePago) {
                $estadoPagoRentaPendienteDePago = StatusPaymentRent::where('estadoPagoRenta', 'Pendiente de pago')->firstOrFail();
            }
            if (!$estadoPagoRentaEnMora) {
                $estadoPagoRentaEnMora = StatusPaymentRent::where('estadoPagoRenta', 'En Mora')->firstOrFail();
            }

            if (
                $paymentRent->estadoPagoRenta == $estadoPagoRentaPendienteDePago && $paymentRent->fecha_fin < Carbon::now()->format('Y-m-d')
            ) {
                $paymentRent->estadoPagoRenta()->associate($estadoPagoRentaEnMora);
                $paymentRent->save();
            } elseif (
                $paymentRent->estadoPagoRenta == $estadoPagoRentaEnMora && $paymentRent->fecha_fin >
                Carbon::now()->format('Y-m-d')
            ) {
                $paymentRent->estadoPagoRenta()->associate($estadoPagoRentaPendienteDePago);
                $paymentRent->save();
            }
        });
    }
}