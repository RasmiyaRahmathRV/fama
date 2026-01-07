<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\PropertyType;
use App\Models\User;
use App\Services\PropertyTypeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PropertyTypeServiceTest extends TestCase
{
    use RefreshDatabase;

    protected PropertyTypeService $service;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(PropertyTypeService::class);

        // Create user + login
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_it_creates_a_new_property_type()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $propertyType = $this->service->createOrRestore([
            'company_id' => $company->id,
            'property_type' => 'Residential',
        ], $user->id);

        $this->assertDatabaseHas('property_types', [
            'id' => $propertyType->id,
            'company_id' => $company->id,
            'property_type' => 'Residential',
            'deleted_at' => null,
        ]);
    }

    public function test_it_throws_validation_exception_on_duplicate_active_property_type()
    {
        $this->expectException(ValidationException::class);

        $company = Company::factory()->create();

        PropertyType::factory()->create([
            'company_id' => $company->id,
            'property_type' => 'Residential',
        ]);

        $this->service->createOrRestore([
            'company_id' => $company->id,
            'property_type' => 'Residential',
        ]);
    }

    public function test_it_restores_soft_deleted_property_type()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $deleted = PropertyType::factory()->create([
            'company_id' => $company->id,
            'property_type' => 'Residential',
            'deleted_at' => now(),
        ]);

        $restored = $this->service->createOrRestore([
            'company_id' => $company->id,
            'property_type' => 'Residential',
        ], $user->id);

        $this->assertNull($restored->deleted_at);
        $this->assertEquals($deleted->id, $restored->id);
    }
}
