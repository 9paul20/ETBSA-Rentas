<?php

namespace Database\Seeders\Equipments;

use App\Models\Equipments\TypeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TypeCategory::factory()
        //     ->count(25)
        //     ->create();

        $TipoCategoriaIndustrial = TypeCategory::create([
            'tipoCategoria' => 'Industrial',
            'descripcion' => 'Esta categoría incluye equipos diseñados para aplicaciones industriales y comerciales, como maquinaria para la construcción, equipos de generación de energía, herramientas eléctricas y equipos de fabricación. Estos equipos suelen ser resistentes y duraderos, ya que están diseñados para soportar condiciones de trabajo extremas',
        ]);

        $TipoCategoriaAgricola = TypeCategory::create([
            'tipoCategoria' => 'Agrícola',
            'descripcion' => 'Los equipos agrícolas son aquellos diseñados para su uso en actividades agrícolas y ganaderas, como tractores, cosechadoras, sembradoras y equipos de ordeño. Estos equipos están diseñados para trabajar en entornos agrícolas y ganaderos, y suelen ser resistentes y duraderos, ya que están diseñados para soportar el uso intenso y las condiciones extremas de trabajo.',
        ]);

        $TipoCategoriaConstruccion = TypeCategory::create([
            'tipoCategoria' => 'Construcción',
            'descripcion' => 'Los equipos de construcción son aquellos utilizados en la construcción de edificios, carreteras y otras estructuras. Esto incluye maquinaria pesada, como excavadoras, cargadores frontales, grúas y retroexcavadoras, así como herramientas manuales, como martillos, sierras y taladros. Estos equipos están diseñados para soportar las duras condiciones de trabajo que se encuentran en los sitios de construcción.',
        ]);

        $TipoCategoriaTransporte = TypeCategory::create([
            'tipoCategoria' => 'Transporte',
            'descripcion' => 'Los equipos de transporte son aquellos utilizados para mover personas o mercancías de un lugar a otro, como automóviles, camiones, aviones, barcos y trenes. Estos equipos pueden ser utilizados en diferentes industrias, como el transporte de carga, el turismo y el transporte público.',
        ]);
    }
}
