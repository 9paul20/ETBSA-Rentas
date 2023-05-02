<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Equipment::factory()
        //     ->count(30)
        //     ->create();

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractor5045D = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor 5045D',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Incluye equipos grandes y pesados utilizados en la construcción, minería y otras industrias similares. Ejemplos de maquinaria pesada incluyen excavadoras, grúas, tractores de oruga, cargadoras y retroexcavadoras.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractor5065E_5075E = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor 5065E/5075E',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Estos tractores son ideales para trabajos agrícolas más grandes. Ambos modelos cuentan con un motor diésel John Deere de 4 cilindros y 4.5 L de capacidad, con una transmisión sincronizada con 9 velocidades hacia adelante y 3 hacia atrás. El sistema hidráulico tiene capacidad para levantar hasta 2410 kg. El modelo 5075E tiene una potencia ligeramente mayor que el 5065E.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractor5082E = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor 5082E',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Este tractor tiene un motor diésel John Deere de 4 cilindros y 4.5 L de capacidad, con una transmisión PowerReverser con 12 velocidades hacia adelante y 12 hacia atrás. También cuenta con un sistema hidráulico de alta capacidad para levantar hasta 2410 kg. Este modelo es ideal para trabajos agrícolas y ganaderos más grandes.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractor5090E = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor 5090E',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Este modelo cuenta con un motor diésel John Deere de 4 cilindros y 4.5 L de capacidad, con una transmisión PowrQuad Plus con 16 velocidades hacia adelante y 16 hacia atrás. También tiene un sistema hidráulico con capacidad para levantar hasta 2810 kg. Es un tractor ideal para trabajos agrícolas y ganaderos de mediano a grande tamaño.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractor5076EF = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor 5076EF',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Este tractor cuenta con un motor diésel John Deere de 3 cilindros y 2.9 L de capacidad, con una transmisión sincronizada con 9 velocidades hacia adelante y 3 hacia atrás. También cuenta con un sistema hidráulico con capacidad para levantar hasta 1600 kg. Este modelo es ideal para trabajos agrícolas básicos y para pequeñas propiedades.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractor5090EH = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor 5090EH',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Este tractor tiene un motor diésel John Deere de 4 cilindros y 4.5 L de capacidad, con una transmisión PowerReverser con 12 velocidades hacia adelante y 12 hacia atrás. También cuenta con un sistema hidráulico de alta capacidad para levantar hasta 2810 kg. Este modelo es ideal para trabajos agrícolas y ganaderos de mediano a grande tamaño, y cuenta con un diseño que facilita el acceso a lugares estrechos.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractorSerie6E = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor Serie 6E',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Este tractor tiene un motor diésel John Deere de 4 cilindros y 4.5 L de capacidad, con una transmisión PowerReverser con 12 velocidades hacia adelante y 12 hacia atrás. También cuenta con un sistema hidráulico de alta capacidad para levantar hasta 2810 kg. Este modelo es ideal para trabajos agrícolas y ganaderos de mediano a grande tamaño, y cuenta con un diseño que facilita el acceso a lugares estrechos.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractor5075GL = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor 5075GL',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Este tractor está diseñado para trabajos pesados en terrenos difíciles. Cuenta con una capacidad de levantamiento de 2.6 toneladas y una transmisión sincronizada de 9 marchas hacia adelante y 3 hacia atrás. Además, cuenta con una cabina cómoda y segura para el operador.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractor5085M = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor 5085M',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Este tractor es ideal para trabajos agrícolas y ganaderos, gracias a su motor PowerTech de 4 cilindros y su sistema de enfriamiento por líquido. Además, cuenta con una transmisión PowerReverser de 12 marchas hacia adelante y 12 hacia atrás, lo que le permite trabajar en una amplia variedad de terrenos.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractor6110M = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor 6110M',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Este tractor es perfecto para trabajos de cultivo en terrenos medianos y grandes. Cuenta con un motor PowerTech PSS de 4 cilindros y una transmisión PowrQuad Plus de 16 marchas hacia adelante y 16 hacia atrás. Además, su cabina cuenta con asientos cómodos y una excelente visibilidad.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);

        $fechaAdquisicion = fake()->dateTimeBetween('-15 year', 'now');
        $EquipoTractor8320R = Equipment::create([
            'noSerieEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noSerieMotor' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'noEconomico' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'modelo' => 'Tractor 8320R',
            'clvDisponibilidad' => '1',
            'clvCategoria' => '3',
            'descripcion' => 'Este tractor de alta potencia está diseñado para trabajos de campo exigentes. Cuenta con un motor PowerTech PSX de 6 cilindros y una transmisión PowerShift de 16 marchas hacia adelante y 5 hacia atrás. Además, cuenta con tecnología avanzada como el sistema CommandView III, que proporciona una excelente visibilidad y comodidad para el operador.',
            'precioEquipo' => fake()->randomFloat(2, 1000000, 2500000),
            'folioEquipo' => fake()->unique()->regexify('[A-Za-z0-9]{8,20}'),
            'fechaAdquisicion' => $fechaAdquisicion,
            'fechaGarantiaExtendida' => fake()->dateTimeBetween($fechaAdquisicion, 'now'),
            'porDeprAnual' => 25.00,
        ]);
    }
}