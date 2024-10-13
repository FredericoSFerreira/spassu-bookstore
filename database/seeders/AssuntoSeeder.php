<?php

namespace Database\Seeders;

use App\Models\Assunto;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++) {
            Assunto::create([
                'descricao' => $faker->text($maxNbChars = 20),
            ]);
        }
    }
}
