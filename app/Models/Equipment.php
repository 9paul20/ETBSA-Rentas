<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 't_equipos';

    protected $primaryKey = 'clvEquipo';

    protected $fillable = [
        'clvEquipo',
        'noSerie',
        'modelo',
        'descripcion',
    ];

    protected $hidden = [];

    public static function getRules($id = null)
    {
        $rules = [
            'noSerie' => 'required|string|min:4|max:255|unique:t_equipos,noSerie,' . $id,
            'modelo' => 'required|string|min:4|max:255',
            'descripcion' => 'string|max:255',
        ];
        return $rules;
    }
}