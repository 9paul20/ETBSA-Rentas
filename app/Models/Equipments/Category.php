<?php

namespace App\Models\Equipments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 't_categorias';

    protected $primaryKey = 'clvCategoria';

    protected $fillable = [
        'clvCategoria',
        'categoria',
        'descripcion',
        'clvTipoCategoria',
    ];

    protected $hidden = [];

    public static function getRules($clvCategoria = null)
    {
        $rules = [
            'categoria' => 'required|string|min:3|max:255|unique:t_categorias,categoria,' . $clvCategoria . ',clvCategoria',
            'descripcion' => 'string|max:255',
            'clvTipoCategoria' => 'required|not_in:[]',
        ];
        return $rules;
    }
}
