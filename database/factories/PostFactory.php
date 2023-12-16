<?php

namespace Database\Factories;

use App\Constant;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'requirements' => fake()->text,
            'description' => fake()->text,
            'benefit' => fake()->text,
            'quantity' => rand(3, 5),
            'position' => fake()->text,
            'workplace' => fake()->text,
            'experience' => rand(1,5) . ' năm',
            'working' => fake()->text,
            'major' => Constant::MAJOR_IT,
            'approved_date' => Carbon::now(),
            'created_at' => Carbon::now()
        ];
    }
}
