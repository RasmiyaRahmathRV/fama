<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\PaymentMode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMode>
 */
class PaymentModeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PaymentMode::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::factory(),
            'payment_mode_name' => $this->faker->name,
            'payment_mode_short_code' => $this->faker->name,
            'payment_mode_code' => $this->faker->unique()->bothify('PMD#####'),
            'added_by'      => 1,
            'status'        => 1, //
        ];
    }
}
