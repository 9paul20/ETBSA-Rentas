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
        'clvPagoRenta',
        'clvEstadoRenta',
    ];

    protected $hidden = [];

    public static function getRules($id = null)
    {
        $rules = [
            'clvEquipo' => 'required|int',
            'clvCliente' => 'required|int',
            'modelo' => 'required|string|min:4|max:255',
            'descripcion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|string',
            'clvPagoRenta' => 'required|string',
            'fecha_fin' => 'required|string',
            'clvPagoRenta' => 'required|int',
            'clvEstadoRenta' => 'required|int',
        ];
        return $rules;
    }
}