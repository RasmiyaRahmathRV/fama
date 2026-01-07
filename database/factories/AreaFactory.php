<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Area::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(), // automatically creates a company if needed
            'area_name' => $this->faker->unique()->city,
            'area_code' => $this->faker->unique()->bothify('ARE#####'), // <-- add this
            'added_by' => 1,
            'status' => 1
        ];
    }
}
