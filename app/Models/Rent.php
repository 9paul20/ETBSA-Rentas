<?php

namespace App\Models;

use App\Models\Equipments\Status;
use App\Models\Rents\StatusRent;
use Carbon\Carbon;
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

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

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

    public static function boot()
    {
        parent::boot();

        $estadoRentaEnRenta = null;
        $estadoRentaEnMora = null;

        static::retrieved(function ($rent) use (&$estadoRentaEnRenta, &$estadoRentaEnMora) {
            if (!$estadoRentaEnRenta) {
                $estadoRentaEnRenta = StatusRent::where('estadoRenta', 'En Renta')->firstOrFail();
            }

            if (!$estadoRentaEnMora) {
                $estadoRentaEnMora = StatusRent::where('estadoRenta', 'En Mora')->firstOrFail();
            }

            if ($rent->statusRent == $estadoRentaEnRenta && $rent->fecha_fin < Carbon::now()->format('Y-m-d')) {
                $rent->statusRent()->associate($estadoRentaEnMora);
                $rent->save();
            } elseif ($rent->statusRent == $estadoRentaEnMora && $rent->fecha_fin > Carbon::now()->format('Y-m-d')) {
                $rent->statusRent()->associate($estadoRentaEnRenta);
                $rent->save();
            }
        });

        static::deleting(function ($rent) {
            // Obtener el estado "Disponible"
            $estadoEquipoDisponible = Status::where('disponibilidad', 'Disponible')->firstOrFail();
            // Actualizar el estado del equipo
            $rent->equipment->update([
                'clvDisponibilidad' => $estadoEquipoDisponible->clvDisponibilidad
            ]);
            // Guardar el equipo automáticamente
            $rent->equipment->save();
            //Eliminar renta y pagos de renta relacionados
            $rent->PaymentsRents()->delete();
        });
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