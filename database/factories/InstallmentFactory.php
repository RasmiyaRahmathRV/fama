<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Installment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Installment>
 */
class InstallmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Installment::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::factory(),
            'installment_name' => $this->faker->name,
            'installment_code' => $this->faker->unique()->bothify('INS#####'),
            'added_by'      => 1,
            'status'        => 1, //
        ];
    }
}
