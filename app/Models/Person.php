<?php

namespace App\Models;

use App\Models\Persons\ComTel;
use App\Models\Persons\Nacionalidad;
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
        'clvComTel',
        'ocupacion',
        'clvNacionalidad',
        'informacion',
    ];

    protected $hidden = [];

    public static function getRules($clvPersona = null)
    {
        $rules = [
            'nombrePersona' => 'required|string|min:4|max:255',
            'apePaternoPersona' => 'required|string|min:4|max:255',
            'apeMaternoPersona' => 'required|string|min:4|max:255',
            'nacimiento' => 'required|date|date_format:Y-m-d',
            'telefono' => 'required|regex:/[0-9]{10}/|unique:t_personas,telefono,' . $clvPersona . ',clvPersona',
            'celular' => 'required|regex:/[0-9]{10}/|unique:t_personas,celular,' . $clvPersona . ',clvPersona',
            'clvComTel' => 'required|not_in:[]',
            'ocupacion' => 'string|max:255',
            'clvNacionalidad' => 'required|not_in:[]',
            'informacion' => 'string|max:255',
        ];
        return $rules;
    }

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'clvNacionalidad');
    }

    public function companiaTelefonica()
    {
        return $this->belongsTo(ComTel::class, 'clvComTel');
    }
}
