<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'cognome' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password123'), 
            'dataNascita' => '2000-01-01', 
            'sesso' => $this->faker->randomElement(['M', 'F']), 
            'citta' => $this->faker->city,
            'indirizzo' => $this->faker->optional()->streetAddress, // Indirizzo facoltativo
            'cap' => substr($this->faker->postcode, 0, 5),
            'telefono' => $this->faker->phoneNumber,
            'codicefiscale' => strtoupper($this->faker->bothify('??????##########')),   
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
