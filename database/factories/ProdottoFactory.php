<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Prodotto;

class ProdottoFactory extends Factory
{
    protected $model = \App\Models\Prodotto::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'tipo' => $this->faker->word,
            'disponibilita' => $this->faker->numberBetween(1, 100),
            'scadenza' => $this->faker->date,
            'prezzo' => $this->faker->randomFloat(2, 1, 100),
            'descrizione' => $this->faker->sentence,
            
        ];
    }
}
