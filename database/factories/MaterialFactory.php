<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'material_name' => fake()->word,
            'material_quantity' => fake()->numberBetween(1, 10),
            'ticket_id' => function () {
                return (Ticket::factory())->create()->id;
            },
        ];
    }
}
