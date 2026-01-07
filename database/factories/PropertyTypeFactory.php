<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyType>
 */
class PropertyTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PropertyType::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::factory(),
            'property_type' => $this->faker->name,
            'property_type_code' => $this->faker->unique()->bothify('PTY#####'),
            'added_by'      => 1,
            'status'        => 1,
        ];
    }
}
