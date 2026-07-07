<?php

namespace Database\Seeders;

use App\Models\Cards;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::firstOrCreate(['name' => 'Pokemon']);
        $baseUrl = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork';

        $pokemons = [
            ['id' => 1,   'name' => 'Bulbasaur'],
            ['id' => 4,   'name' => 'Charmander'],
            ['id' => 7,   'name' => 'Squirtle'],
            ['id' => 25,  'name' => 'Pikachu'],
            ['id' => 39,  'name' => 'Jigglypuff'],
            ['id' => 52,  'name' => 'Meowth'],
            ['id' => 54,  'name' => 'Psyduck'],
            ['id' => 58,  'name' => 'Growlithe'],
            ['id' => 63,  'name' => 'Abra'],
            ['id' => 66,  'name' => 'Machop'],
            ['id' => 74,  'name' => 'Geodude'],
            ['id' => 77,  'name' => 'Ponyta'],
            ['id' => 79,  'name' => 'Slowpoke'],
            ['id' => 92,  'name' => 'Gastly'],
            ['id' => 95,  'name' => 'Onix'],
            ['id' => 104, 'name' => 'Cubone'],
            ['id' => 109, 'name' => 'Koffing'],
            ['id' => 113, 'name' => 'Chansey'],
            ['id' => 116, 'name' => 'Horsea'],
            ['id' => 129, 'name' => 'Magikarp'],
            ['id' => 131, 'name' => 'Lapras'],
            ['id' => 133, 'name' => 'Eevee'],
            ['id' => 143, 'name' => 'Snorlax'],
            ['id' => 147, 'name' => 'Dratini'],
            ['id' => 150, 'name' => 'Mewtwo'],
            ['id' => 151, 'name' => 'Mew'],
            ['id' => 172, 'name' => 'Pichu'],
            ['id' => 175, 'name' => 'Togepi'],
            ['id' => 196, 'name' => 'Espeon'],
            ['id' => 197, 'name' => 'Umbreon'],
        ];

        foreach ($pokemons as $pokemon) {
            Cards::create([
                'name' => $pokemon['name'],
                'url' => "{$baseUrl}/{$pokemon['id']}.png",
                'category_id' => $category->id,
            ]);
        }
    }
}
