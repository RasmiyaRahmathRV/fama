<?php

namespace Tests\Unit;

use App\Models\Area;
use App\Models\Company;
use App\Models\Locality;
use App\Models\Property;
use App\Models\PropertySizeUnit;
use App\Models\PropertyType;
use App\Models\User;
use App\Services\PropertyService;
use Database\Seeders\LookupTablesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PropertyServiceTest extends TestCase
{
    use RefreshDatabase;

    protected PropertyService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(PropertyService::class);
        $this->seed(LookupTablesSeeder::class);
    }

    public function test_it_creates_a_new_property()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create();
        $area = Area::factory()->create(['company_id' => $company->id]);
        $locality = Locality::factory()->create(['company_id' => $company->id, 'area_id' => $area->id]);
        $propertyType = PropertyType::factory()->create(['company_id' => $company->id]);
        $unit = PropertySizeUnit::first();

        $property = $this->service->createOrRestore([
            'company_id' => $company->id,
            'area_id' => $area->id,
            'locality_id' => $locality->id,
            'property_type_id' => $propertyType->id,
            'property_size_unit' => $unit->id,
            'property_name' => 'Test Property',
            'plot_no' => '123-432',
        ], $user->id);

        $this->assertDatabaseHas('properties', [
            'id' => $property->id,
            'property_name' => 'Test Property',
            'deleted_at' => null,
        ]);
    }

    public function test_it_restores_soft_deleted_property()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create();
        $area = Area::factory()->create(['company_id' => $company->id]);
        $locality = Locality::factory()->create(['company_id' => $company->id, 'area_id' => $area->id]);
        $propertyType = PropertyType::factory()->create(['company_id' => $company->id]);
        $unit = PropertySizeUnit::first();

        $deleted = Property::factory()->create([
            'company_id' => $company->id,
            'area_id' => $area->id,
            'locality_id' => $locality->id,
            'property_type_id' => $propertyType->id,
            'property_size_unit' => $unit->id,
            'property_name' => 'Restorable Property',
            'plot_no' => '221-234',
            'deleted_at' => now(),
        ]);

        $restored = $this->service->createOrRestore([
            'company_id' => $company->id,
            'area_id' => $area->id,
            'locality_id' => $locality->id,
            'property_type_id' => $propertyType->id,
            'property_size_unit' => $unit->id,
            'property_name' => 'Restorable Property',
            'plot_no' => '123-213',
        ], $user->id);

        $this->assertNull($restored->deleted_at);
        $this->assertEquals($deleted->id, $restored->id);
    }

    public function test_it_throws_validation_exception_for_duplicate_property()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create();
        $area = Area::factory()->create(['company_id' => $company->id]);
        $locality = Locality::factory()->create(['company_id' => $company->id, 'area_id' => $area->id]);
        $propertyType = PropertyType::factory()->create(['company_id' => $company->id]);
        $unit = PropertySizeUnit::first();

        Property::factory()->create([
            'company_id' => $company->id,
            'area_id' => $area->id,
            'locality_id' => $locality->id,
            'property_type_id' => $propertyType->id,
            'property_size_unit' => $unit->id,
            'property_name' => 'Duplicate Property',
            'plot_no' => '123-213',
        ]);

        $this->service->createOrRestore([
            'company_id' => $company->id,
            'area_id' => $area->id,
            'locality_id' => $locality->id,
            'property_type_id' => $propertyType->id,
            'property_size_unit' => $unit->id,
            'property_name' => 'Duplicate Property',
            'plot_no' => '123-213',
        ], $user->id);
    }
}
