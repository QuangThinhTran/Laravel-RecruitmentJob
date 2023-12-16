<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->firstName(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'phone' => fake()->unique()->phoneNumber(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(60),
            'img_avatar' => 'avatar.jpg'
        ];
    }
}
