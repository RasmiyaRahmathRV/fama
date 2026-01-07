<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Nationality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nationality>
 */
class NationalityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Nationality::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::factory(),
            'nationality_name' => $this->faker->name,
            'nationality_short_code' => $this->faker->name,
            'nationality_code' => $this->faker->unique()->bothify('NCT#####'),
            'added_by'      => 1,
            'status'        => 1, //
        ];
    }
}
