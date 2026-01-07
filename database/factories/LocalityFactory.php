<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Company;
use App\Models\Locality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Locality>
 */
class LocalityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Locality::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::factory(),
            'area_id'       => Area::factory(),
            'locality_name' => $this->faker->streetName,
            'locality_code' => $this->faker->unique()->bothify('LOC#####'),
            'added_by'      => 1,
            'status'        => 1,
        ];
    }
}
