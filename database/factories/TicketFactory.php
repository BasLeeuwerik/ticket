<?php

namespace Database\Factories;

use App\Http\Enums\TicketStatusType;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date_time' => fake()->dateTimeBetween('-1 week', 'now'),
            'end_date_time' => fake()->dateTimeBetween('now', '+1 week'),
            'comment' => fake()->sentence,
            'status' => fake()->randomElement(TicketStatusType::cases())->value,
            'image_url' => fake()->imageUrl(),
            'user_id' => function () {
                return (User::factory())->create()->id;
            }, 
        ];
    }
}
