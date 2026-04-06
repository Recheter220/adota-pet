<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => Organization::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'species' => fake()->randomElement(['dog', 'cat']),
            'gender' => fake()->randomElement(['m', 'f']),
            'breed' => fake()->word(),
            'color' => fake()->colorName(),
            'birthday' => fake()->date(max: '1 month ago'),
            'bio' => fake()->text(),
        ];
    }
}
