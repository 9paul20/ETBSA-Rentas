<?php

namespace App\Models\Persons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComTel extends Model
{
    use HasFactory;

    protected $table = 't_comtel';

    protected $primaryKey = 'clvComTel';

    protected $fillable = [
        'clvComTel',
        'companiaTelefonica',
        'descripcion',
    ];

    protected $hidden = [];

    public static function getRules($clvComTel = null)
    {
        $rules = [
            'companiaTelefonica' => 'required|string|min:3|max:255|unique:t_comtel,companiaTelefonica,' . $clvComTel . ',clvComTel',
            'descripcion' => 'string|max:255',
        ];
        return $rules;
    }
}
