<?php

namespace Database\Seeders;

use App\Models\Livro;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 2; $i++) {
            Livro::create([
                'titulo' => $faker->title(),
                'editora' => $faker->name(),
                'edicao' => $faker->year(),
                'ano_publicacao' => $faker->numerify(),
                'valor' => $faker->randomFloat(),
            ]);
        }
    }
}
