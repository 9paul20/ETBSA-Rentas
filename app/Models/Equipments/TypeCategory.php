<?php

namespace App\Models\Equipments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCategory extends Model
{
    use HasFactory;

    protected $table = 't_tipo_categorias';

    protected $primaryKey = 'clvTipoCategoria';

    protected $fillable = [
        'clvTipoCategoria',
        'tipoCategoria',
        'descripcion',
        // 'clvTipoCategoria',
    ];

    protected $hidden = [];

    public static function getRules($clvTipoCategoria = null)
    {
        $rules = [
            'tipoCategoria' => 'required|string|min:3|max:255|unique:t_tipo_categorias,tipoCategoria,' . $clvTipoCategoria . ',clvTipoCategoria',
            'descripcion' => 'string|max:255',
            // 'clvTipoCategoria' => 'required|not_in:[]',
        ];
        return $rules;
    }
}
