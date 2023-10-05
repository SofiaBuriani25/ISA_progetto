<?php

namespace Database\Factories;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visita>
 */
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Visita;
use Carbon\Carbon;

class VisitaFactory extends Factory
{
    protected $model = Visita::class;

    public function definition()
    {
        return [
            'tipologia' => $this->faker->word, // Genera una parola casuale
            'dataVisita' => Carbon::now()->addDays($this->faker->numberBetween(15, 100)), // Data futura tra 1 e 30 giorni
            'medico' => $this->faker->name, // Genera un nome casuale
            'prezzo' => $this->faker->randomFloat(2, 50, 200), // Prezzo casuale tra 50 e 200 con 2 decimali
            'user_id' => null, // Utente inizialmente non associato
        ];
    }
}
