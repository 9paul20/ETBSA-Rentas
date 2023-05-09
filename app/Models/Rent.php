<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'clvEstadoRenta',
    ];

    protected $hidden = [];

    //*Todas las relaciones ELOQUENT de rentas
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class, 'clvEquipo');
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'clvCliente');
    }

    public function statusRent(): BelongsTo
    {
        return $this->belongsTo(Rents\StatusRent::class, 'clvEstadoRenta');
    }

    public function PaymentsRents(): HasMany
    {
        return $this->hasMany(Rents\PaymentRent::class, 'clvRenta');
    }

    //*Atributos de rentas
    // public function sumPaymentsRents(): Attribute
    // {
    //     $sumPaymentsRents = $this->PaymentsRents()
    //         ->selectRaw('SUM(pagoRenta) as sumPagosRenta, SUM(ivaRenta) as sumIVARenta, SUM(pagoRenta + ivaRenta) as total')
    //         ->first();

    //     return Attribute::make(
    //         get: fn () => $sumPaymentsRents
    //     );
    // }
}