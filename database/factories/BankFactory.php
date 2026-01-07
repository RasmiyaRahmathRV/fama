<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bank>
 */
class BankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Bank::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::factory(),
            'bank_name' => $this->faker->name,
            'bank_short_code' => $this->faker->name,
            'bank_code' => $this->faker->unique()->bothify('BNK#####'),
            'added_by'      => 1,
            'status'        => 1, //
        ];
    }
}
