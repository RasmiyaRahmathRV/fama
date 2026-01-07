<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Vendor::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::factory(),
            'vendor_name' => $this->faker->name,
            'vendor_code' => $this->faker->unique()->bothify('VND#####'),
            'added_by'      => 1,
            'status'        => 1,
        ];
    }
}
