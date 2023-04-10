<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 't_personas';

    protected $primaryKey = 'clvPersona';

    protected $fillable = [
        'clvPersona',
        'nombrePersona',
        'apePaternoPersona',
        'apeMaternoPersona',
        'nacimiento',
        'telefono',
        'celular',
        'ocupacion',
        'informacion',
    ];

    protected $hidden = [];

    public static function getRules($id = null)
    {
        $rules = [
            'nombrePersona' => 'required|string|min:4|max:255',
            'apePaternoPersona' => 'required|string|min:4|max:255',
            'apeMaternoPersona' => 'required|string|min:4|max:255',
            'nacimiento' => 'required|date|date_format:Y-m-d',
            // 'telefono' => 'required|numeric|regex:/^\(\d{3}\)\s\d{3}\-\d{4}$/',
            'telefono' => 'required|numeric|min:10|unique:t_personas,telefono,' . $id,
            'celular' => 'required|numeric|min:10|unique:t_personas,celular,' . $id,
            'ocupacion' => 'string|max:255',
            'informacion' => 'string|max:255',
        ];
        return $rules;
    }
}