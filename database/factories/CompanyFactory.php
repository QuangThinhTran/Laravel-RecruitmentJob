<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'staff' => rand(1,100),
            'headquarters' => fake()->text(20),
            'taxcode' => Str::random(10),
            'website' => fake()->domainName
        ];
    }
}
