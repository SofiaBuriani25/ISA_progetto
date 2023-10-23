<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Prenotazione;
use App\Models\User;
use App\Models\Prodotto;

class PrenotazioneFactory extends Factory
{
    protected $model = Prenotazione::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'prodotto_id' => Prodotto::factory(),
            'quantita' => $this->faker->numberBetween(1, 10),
            'pagato' => $this->faker->boolean(50), // 50% di probabilità di essere pagato
        ];
    }
}
