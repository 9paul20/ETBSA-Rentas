<?php

namespace Database\Seeders\Equipments;

use App\Models\Equipments\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Status::factory()
        //     ->count(25)
        //     ->create();

        $DisponibilidadDisponible = Status::create([
            'disponibilidad' => 'Disponible',
            'descripcion' => 'El equipo está disponible para rentar.'
        ]);

        $DisponibilidadOcupado = Status::create([
            'disponibilidad' => 'Ocupado',
            'descripcion' => 'El equipo está siendo utilizado por un cliente.'
        ]);

        $DisponibilidadEnMantenimiento = Status::create([
            'disponibilidad' => 'En Mantenimiento',
            'descripcion' => 'El equipo no está disponible para renta porque está en proceso de mantenimiento o reparación.'
        ]);

        $DisponibilidadEnEspera = Status::create([
            'disponibilidad' => 'En Espera',
            'descripcion' => 'El equipo está reservado para un cliente en una fecha futura, pero aún no está siendo utilizado.'
        ]);

        $DisponibilidadFueraDeServicio = Status::create([
            'disponibilidad' => 'Fuera de servicio',
            'descripcion' => 'El equipo no está disponible para renta porque está dañado o fuera de servicio por algún otro motivo.'
        ]);

        $DisponibilidadEnTransito = Status::create([
            'disponibilidad' => 'En Tránsito',
            'descripcion' => 'El equipo está en camino hacia o desde una ubicación y no está disponible para renta en ese momento.'
        ]);
    }
}
