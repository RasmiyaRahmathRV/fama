<?php

namespace Tests\Unit;

use App\Models\Area;
use App\Models\Company;
use App\Models\Locality;
use App\Models\User;
use App\Services\LocalityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocalityServiceTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Company $company;
    protected Area $area;
    protected LocalityService $localityService;

    protected function setUp(): void
    {
        parent::setUp();

        // Create user + login
        $this->user = User::factory()->create();
        $this->actingAs($this->user);

        // Create company and area
        $this->company = Company::factory()->create();
        $this->area = Area::factory()->create([
            'company_id' => $this->company->id,
        ]);

        // Inject service
        $this->localityService = app(LocalityService::class);
    }

    /** @test */
    public function it_creates_a_new_locality()
    {
        $locality = $this->localityService->createOrRestore([
            'company_id' => $this->company->id,
            'area_id' => $this->area->id,
            'locality_name' => 'Test Locality',
        ]);

        $this->assertDatabaseHas('localities', [
            'id' => $locality->id,
            'locality_name' => 'Test Locality',
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_restores_soft_deleted_locality_if_same_name_is_added_again()
    {
        $locality = Locality::factory()->create([
            'company_id' => $this->company->id,
            'area_id' => $this->area->id,
            'locality_name' => 'Murakkabat',
        ]);

        // Soft delete
        $locality->delete();

        // Try to create with same name again
        $restoredLocality = $this->localityService->createOrRestore([
            'company_id' => $this->company->id,
            'area_id' => $this->area->id,
            'locality_name' => 'Murakkabat',
        ]);

        $this->assertEquals($locality->id, $restoredLocality->id);
        $this->assertNull($restoredLocality->deleted_at);

        $this->assertDatabaseHas('localities', [
            'id' => $restoredLocality->id,
            'locality_name' => 'Murakkabat',
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_validates_unique_locality_per_area()
    {
        Locality::factory()->create([
            'company_id' => $this->company->id,
            'area_id' => $this->area->id,
            'locality_name' => 'Deira',
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->localityService->createOrRestore([
            'company_id' => $this->company->id,
            'area_id' => $this->area->id,
            'locality_name' => 'Deira', // duplicate
        ]);
    }
}
