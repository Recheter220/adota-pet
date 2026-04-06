<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'description' => fake()->paragraph(),
            'email' => fake()->email(),
            'website' => fake()->url(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'logo_path' => fake()->imageUrl(),
            'verified' => fake()->randomElement([0, 1]),
        ];
    }
}
