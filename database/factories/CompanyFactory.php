<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'company_code' => $this->faker->unique()->bothify('CMP#####'), // <-- add this
            'added_by' => 1,
            'status' => 1,
        ];
    }
}
