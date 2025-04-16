<?php

namespace Database\Factories;

use App\Models\Users_KFCP;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users_KFCP>
 */
class Users_KFCPFactory extends Factory
{
    protected $model = Users_KFCP::class;

    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_number' => $this->faker->unique()->numerify('##########'),
            'email' => $this->faker->unique()->safeEmail(),
            'fName' => $this->faker->firstName(),
            'lName' => $this->faker->lastName(),
            'department' => $this->faker->word(),
            'position' => $this->faker->jobTitle(),
            'password' => static::$password ??= Hash::make('password'),
            'is_authorized' => $this->faker->randomElement([NULL, 'authorized']), // adjust if users table exists
        ];
    }
}
