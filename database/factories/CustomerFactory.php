<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerFactory extends Factory
{
    use HasFactory;

    protected $casts = [
        'birthdate' => 'date',
    ];

    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'name' => fake()->name,
            'document' => fake()?->cpf,
            'birthdate' => now()->subYears(25)->format('Y-m-d'),
            'email' => fake()->unique()->safeEmail,
            'mobile' => '(11) 9'.fake()->cellphone,
        ];
    }
}
