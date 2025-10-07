<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MexicoCountryAndStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear México
        $mexico = Country::firstOrCreate([
            'name' => 'México',
            'abbreviation' => 'MX',
        ]);

        // Estados de México con abreviaturas
        $states = [
            ['name' => 'Aguascalientes', 'abbreviation' => 'AGS'],
            ['name' => 'Baja California', 'abbreviation' => 'BC'],
            ['name' => 'Baja California Sur', 'abbreviation' => 'BCS'],
            ['name' => 'Campeche', 'abbreviation' => 'CAMP'],
            ['name' => 'Chiapas', 'abbreviation' => 'CHIS'],
            ['name' => 'Chihuahua', 'abbreviation' => 'CHIH'],
            ['name' => 'Coahuila', 'abbreviation' => 'COAH'],
            ['name' => 'Colima', 'abbreviation' => 'COL'],
            ['name' => 'Ciudad de México', 'abbreviation' => 'CDMX'],
            ['name' => 'Durango', 'abbreviation' => 'DGO'],
            ['name' => 'Guanajuato', 'abbreviation' => 'GTO'],
            ['name' => 'Guerrero', 'abbreviation' => 'GRO'],
            ['name' => 'Hidalgo', 'abbreviation' => 'HGO'],
            ['name' => 'Jalisco', 'abbreviation' => 'JAL'],
            ['name' => 'México', 'abbreviation' => 'MEX'],
            ['name' => 'Michoacán', 'abbreviation' => 'MICH'],
            ['name' => 'Morelos', 'abbreviation' => 'MOR'],
            ['name' => 'Nayarit', 'abbreviation' => 'NAY'],
            ['name' => 'Nuevo León', 'abbreviation' => 'NL'],
            ['name' => 'Oaxaca', 'abbreviation' => 'OAX'],
            ['name' => 'Puebla', 'abbreviation' => 'PUE'],
            ['name' => 'Querétaro', 'abbreviation' => 'QRO'],
            ['name' => 'Quintana Roo', 'abbreviation' => 'QROO'],
            ['name' => 'San Luis Potosí', 'abbreviation' => 'SLP'],
            ['name' => 'Sinaloa', 'abbreviation' => 'SIN'],
            ['name' => 'Sonora', 'abbreviation' => 'SON'],
            ['name' => 'Tabasco', 'abbreviation' => 'TAB'],
            ['name' => 'Tamaulipas', 'abbreviation' => 'TAMPS'],
            ['name' => 'Tlaxcala', 'abbreviation' => 'TLAX'],
            ['name' => 'Veracruz', 'abbreviation' => 'VER'],
            ['name' => 'Yucatán', 'abbreviation' => 'YUC'],
            ['name' => 'Zacatecas', 'abbreviation' => 'ZAC'],
        ];

        foreach ($states as $state) {
            State::firstOrCreate([
                'name' => $state['name'],
                'abbreviation' => $state['abbreviation'],
                'country_id' => $mexico->id,
            ]);
        }
    }
}
