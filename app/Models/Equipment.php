<?php

namespace App\Models;

use App\Models\Equipments\Category;
use App\Models\Equipments\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 't_equipos';

    protected $primaryKey = 'clvEquipo';

    protected $fillable = [
        'clvEquipo',
        'noSerie',
        'modelo',
        'clvDisponibilidad',
        'clvCategoria',
        'descripcion',
    ];

    protected $hidden = [];

    public static function getRules($clvEquipo = null)
    {
        $rules = [
            'noSerie' => 'required|string|min:4|max:255|unique:t_equipos,noSerie,' . $clvEquipo . ',clvEquipo',
            'modelo' => 'required|string|min:4|max:255',
            'clvDisponibilidad' => 'required|not_in:[]',
            'clvCategoria' => 'required|not_in:[]',
            'descripcion' => 'string|max:255',
        ];
        return $rules;
    }

    public function disponibilidad(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'clvDisponibilidad');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'clvCategoria');
    }
}