<?php

use Illuminate\Database\Seeder;

class GustosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gustos = [
            [
                'nombre' => 'Hamburguesas',
                'icono' => 'pizza'
            ],
            [
                'nombre' => 'Salchipapas',
                'icono' => 'pizza'
            ],
            [
                'nombre' => 'Pizza',
                'icono' => 'pizza'
            ],
            [
                'nombre' => 'Piqueo Marino',
                'icono' => 'pizza'
            ],
            [
                'nombre' => 'Criollo',
                'icono' => 'pizza'
            ],
            [
                'nombre' => 'Organico',
                'icono' => 'pizza'
            ],
            [
                'nombre' => 'Carnes',
                'icono' => 'pizza'
            ],
            [
                'nombre' => 'Alitas',
                'icono' => 'pizza'
            ],
            [
                'nombre' => 'Tacos y Enchiladas',
                'icono' => 'pizza'
            ],
            [
                'nombre' => 'Postres',
                'icono' => 'pizza'
            ],
        ];

        foreach ($gustos as $gusto){
            \App\Gusto::create($gusto);
        }
    }
}
