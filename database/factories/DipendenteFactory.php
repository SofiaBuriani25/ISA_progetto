<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DipendenteFactory extends Factory
{
    protected $model = \App\Models\Dipendente::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'cognome' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
        ];
    }
}
