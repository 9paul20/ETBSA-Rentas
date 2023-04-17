<?php

namespace App\Models\Rents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusRent extends Model
{
    use HasFactory;

    protected $table = 't_estados_rentas';

    protected $primaryKey = 'clvEstadoRenta';

    protected $fillable = [
        'clvEstadoRenta',
        'estadoRenta',
        'descripcion',
        'clvTazaRenta',
    ];

    protected $hidden = [];

    public static function getRules($clvEstadoRenta = null)
    {
        $rules = [
            'estadoRenta' => 'required|string|min:3|max:255|unique:t_estados_rentas,estadoRenta,' . $clvEstadoRenta . ',clvEstadoRenta',
            'descripcion' => 'string|max:255',
            'clvTazaRenta' => 'required|not_in:[]',
        ];
        return $rules;
    }

    public function tazaRenta()
    {
        return $this->belongsTo(CupRent::class, 'clvTazaRenta');
    }
}