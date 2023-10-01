<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Prodotto;


class ProdottoFactory extends Factory
{
    protected $model = Prodotto::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'tipo' => $this->faker->word,
            'scadenza' => $this->faker->date,
            'disponibilita' => $this->faker->numberBetween(1, 100),
            'prezzo' => $this->faker->randomFloat(2, 1, 100),
            'descrizione' => $this->faker->paragraph,
        ];
    }
}
