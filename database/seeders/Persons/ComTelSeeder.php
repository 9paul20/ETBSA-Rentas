<?php

namespace Database\Seeders\Persons;

use App\Models\Persons\ComTel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComTelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ComTel::factory()
        //     ->count(25)
        //     ->create();

        $ComTelTelcel = ComTel::create([
            'companiaTelefonica' => 'Telcel',
            'descripcion' => 'Es la compañía líder en México, y actualmente cubre el 95% de la población mexicana, lo que representa más de 76 millones de usuarios. Es parte del grupo América Móvil, propiedad de Carlos Slim. Ofrece planes de prepago y pospago, y una variedad de planes de datos que se ajustan a las necesidades de los usuarios.'
        ]);

        $ComTelATAndT = ComTel::create([
            'companiaTelefonica' => 'AT&T',
            'descripcion' => 'Es la segunda compañía de telefonía móvil más grande en México. En el 2021, compró al operador Unefon para mejorar su presencia en México, y ahora cubre alrededor del 22% de la población mexicana. Ofrece planes de prepago y pospago con datos ilimitados, llamadas y mensajes de texto en México, EE.UU. y Canadá.'
        ]);

        $ComTelAMovistar = ComTel::create([
            'companiaTelefonica' => 'Movistar',
            'descripcion' => 'Es la tercera compañía de telefonía móvil más grande en México, y cubre alrededor del 18% de la población mexicana. Ofrece planes de prepago y pospago, y tiene una variedad de planes que incluyen llamadas y mensajes de texto ilimitados y datos móviles.'
        ]);

        $ComTelUnefon = ComTel::create([
            'companiaTelefonica' => 'Unefon',
            'descripcion' => 'Es un operador móvil virtual (OMV) que opera bajo la red de AT&T. Ofrece planes de prepago y pospago, y tiene una variedad de planes que incluyen datos móviles, llamadas y mensajes de texto.'
        ]);

        $ComTelVirginMobile = ComTel::create([
            'companiaTelefonica' => 'Virgin Mobile',
            'descripcion' => 'Es un OMV que opera bajo la red de Movistar. Ofrece planes de prepago y pospago que incluyen llamadas y mensajes de texto ilimitados y datos móviles.'
        ]);

        $ComTelFreedompop = ComTel::create([
            'companiaTelefonica' => 'Freedompop',
            'descripcion' => 'Es un OMV que opera bajo la red de Telcel. Ofrece planes de prepago y pospago que incluyen datos móviles gratuitos, llamadas y mensajes de texto con ciertas limitaciones.'
        ]);

        $ComTelFlashMobile = ComTel::create([
            'companiaTelefonica' => 'Flash Mobile',
            'descripcion' => 'Es un OMV que opera bajo la red de Movistar. Ofrece planes de prepago y pospago que incluyen datos móviles, llamadas y mensajes de texto.'
        ]);

        $ComTelWeex = ComTel::create([
            'companiaTelefonica' => 'Weex',
            'descripcion' => 'Es un proveedor de telefonía móvil en México, también conocido como "Weex", es un startup mexicano que ofrece servicios de telefonía bajo el esquema de Operadora Móvil Virtual.'
        ]);

        $ComTelCierto = ComTel::create([
            'companiaTelefonica' => 'Cierto',
            'descripcion' => 'Cierto surge de la marca Ekofon como un nuevo operador móvil virtual en México. Su modelo se basa en el sistema de telefonía de prepago, por lo que no manejan contratos ni plazos forzosos.'
        ]);
    }
}
