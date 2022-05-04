<?php

namespace Database\Seeders;

use App\Models\Idioma;
use Illuminate\Database\Seeder;


class IdiomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Idioma::factory()->create([
           'name' => 'Ingles'
        ]);

        Idioma::factory()->create([
            'name' => 'Frances'
        ]);

        Idioma::factory()->create([
            'name' => 'Aleman'
        ]);

        Idioma::factory()->create([
            'name' => 'Portugues'
        ]);

        Idioma::factory()->create([
            'name' => 'Italiano'
        ]);
    }
}
