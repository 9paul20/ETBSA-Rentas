<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $table = 't_rentas';

    protected $primaryKey = 'clvRenta';

    protected $fillable = [
        'clvRenta',
        'clvEquipo',
        'clvCliente',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'clvEstadoRenta',
    ];

    protected $hidden = [];

    public static function getRules($clvRenta = null)
    {
        $rules = [
            'clvEquipo' => 'required|not_in:[]',
            'clvCliente' => 'required|not_in:[]',
            'descripcion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'clvEstadoRenta' => 'required|not_in:[]',
        ];
        return $rules;
    }

    public function equipo()
    {
        return $this->belongsTo(Equipment::class, 'clvEquipo');
    }

    public function cliente()
    {
        return $this->belongsTo(Person::class, 'clvCliente');
    }

    public function pagoRenta()
    {
        return $this->belongsTo(Rents\PaymentRent::class, 'clvPagoRenta');
    }

    public function estadoRenta()
    {
        return $this->belongsTo(Rents\StatusRent::class, 'clvEstadoRenta');
    }
}