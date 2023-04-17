<?php

namespace App\Models\Persons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    protected $table = 't_nacionalidades';

    protected $primaryKey = 'clvNacionalidad';

    protected $fillable = [
        'clvNacionalidad',
        'nacionalidad',
        'descripcion',
    ];

    protected $hidden = [];

    public static function getRules($clvNacionalidad = null)
    {
        $rules = [
            'nacionalidad' => 'required|string|min:3|max:255|unique:t_nacionalidades,nacionalidad,' . $clvNacionalidad . ',clvNacionalidad',
            'descripcion' => 'string|max:255',
        ];
        return $rules;
    }
}