<?php

namespace Database\Seeders\Equipments;

use App\Models\Equipments\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory()
        //     ->count(25)
        //     ->create();

        $CategoriaMaquinariaPesada = Category::create([
            'categoria' => 'Maquinaria Industrial',
            'clvTipoCategoria' => '1',
            'descripcion' => 'Incluye equipos grandes y pesados utilizados en la construcción, minería y otras industrias similares. Ejemplos de maquinaria pesada incluyen excavadoras, grúas, tractores de oruga, cargadoras y retroexcavadoras.',
        ]);

        $CategoriaVehículos = Category::create([
            'categoria' => 'Vehículos',
            'clvTipoCategoria' => '4',
            'descripcion' => 'Incluye todo tipo de vehículos utilizados para el transporte de personas o bienes, como automóviles, camiones, autobuses y motocicletas.',
        ]);

        $CategoriaEquipoAgricultura = Category::create([
            'categoria' => 'Equipo de Agricultura',
            'clvTipoCategoria' => '2',
            'descripcion' => 'Incluye todo tipo de equipos utilizados en la agricultura, como tractores, cosechadoras, sembradoras, aspersores y cultivadoras.',
        ]);

        $CategoriaEquipoSeguridad = Category::create([
            'categoria' => 'Equipo de Seguridad',
            'clvTipoCategoria' => '1',
            'descripcion' => 'Incluye todo tipo de equipos utilizados para la seguridad en el lugar de trabajo, como cascos, guantes, gafas protectoras, arneses y chalecos reflectantes.',
        ]);
    }
}
