<?php

namespace Database\Factories;

use App\Models\ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ticket>
 */
class ticketFactory extends Factory
{

    protected $model = ticket::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-1 day', 'now');
        $updatedAt = (clone $createdAt)->modify('+' . rand(1, 60) . ' minutes');

        return [
            'ticket_id' => 'JT-' . strtoupper(Str::random(8)),
            'user_id' => $this->faker->randomElement(['KF2407013', 'KF2407012']), // adjust if users table exists
            'location' => $this->faker->city,
            'ticket_subj' => $this->faker->sentence(4),
            'ticket_description' => $this->faker->paragraph,
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High', 'Urgent']),
            'status' => $this->faker->randomElement(['pending', 'in-progress', 'resolved']),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
