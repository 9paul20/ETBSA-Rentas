<?php

namespace Database\Seeders\Persons;

use App\Models\Persons\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nationality::factory()
        //     ->count(25)
        //     ->create();
        $NacionalidadMexinaca = Nationality::create([
            'nacionalidad' => 'Mexicana',
            'descripcion' => 'La nacionalidad mexicana se refiere a los ciudadanos de México, un país ubicado en América del Norte. México es conocido por su rica cultura, comida, historia y sus hermosos paisajes.'
        ]);

        $NacionalidadEstadounidense = Nationality::create([
            'nacionalidad' => 'Estadounidense',
            'descripcion' => 'La nacionalidad estadounidense se refiere a los ciudadanos de los Estados Unidos, un país ubicado en América del Norte. Los Estados Unidos son conocidos por su poder económico y militar, su cultura pop y tecnología avanzada.'
        ]);

        $NacionalidadCanadiense = Nationality::create([
            'nacionalidad' => 'Canadiense',
            'descripcion' => 'La nacionalidad canadiense se refiere a los ciudadanos de Canadá, un país ubicado en América del Norte. Canadá es conocido por su belleza natural, su sistema de salud y educación público, y su compromiso con la diversidad y la inclusión.'
        ]);

        $NacionalidadEspañola = Nationality::create([
            'nacionalidad' => 'Española',
            'descripcion' => 'La nacionalidad española se refiere a los ciudadanos de España, un país ubicado en Europa. España es conocida por su rica historia, cultura y arte, así como por su gastronomía y sus playas.'
        ]);

        $NacionalidadArgentina = Nationality::create([
            'nacionalidad' => 'Argentina',
            'descripcion' => 'La nacionalidad argentina se refiere a los ciudadanos de Argentina, un país ubicado en América del Sur. Argentina es conocida por su pasión por el fútbol, su música y su carne asada, así como por sus impresionantes paisajes naturales.'
        ]);

        $NacionalidadBrasileña = Nationality::create([
            'nacionalidad' => 'Brasileña',
            'descripcion' => 'La nacionalidad brasileña se refiere a los ciudadanos de Brasil, un país ubicado en América del Sur. Brasil es conocido por sus selvas tropicales, sus playas, su música y su carnaval, así como por ser el hogar del fútbol y la samba.'
        ]);

        $NacionalidadFrancesa = Nationality::create([
            'nacionalidad' => 'Francesa',
            'descripcion' => 'La nacionalidad francesa se refiere a los ciudadanos de Francia, un país ubicado en Europa. Francia es conocida por su moda, su gastronomía, su cultura y su arte, así como por su importante papel en la historia de la política y la filosofía.'
        ]);

        $NacionalidadItaliana = Nationality::create([
            'nacionalidad' => 'Italiana',
            'descripcion' => 'La nacionalidad italiana se refiere a los ciudadanos de Italia, un país ubicado en Europa. Italia es conocida por su deliciosa comida, su rica historia y cultura, su moda y su arquitectura impresionante.'
        ]);
    }
}
