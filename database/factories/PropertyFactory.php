<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Company;
use App\Models\Locality;
use App\Models\Property;
use App\Models\PropertySizeUnit;
use App\Models\PropertyType;
use Database\Seeders\LookupTablesSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Property::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::factory(),
            'area_id'    => Area::factory(),
            'locality_id'    => Locality::factory(),
            'property_type_id'    => PropertyType::factory(),
            'property_size_unit'    => PropertySizeUnit::inRandomOrder()->first()->id ?? 1,
            'property_name' => $this->faker->name,
            'property_code' => $this->faker->unique()->bothify('PRP#####'),
            'plot_no' => $this->faker->randomNumber(),
            'added_by'      => 1,
            'status'        => 1,
        ];
    }
}
