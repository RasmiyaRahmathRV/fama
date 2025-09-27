<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\AreaService;
use App\Models\Area;
use App\Models\Company;
use App\Models\User;
use Tests\TestCase;

class AreaServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    protected $areaService;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->areaService = app(AreaService::class);

        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function it_can_create_a_new_area()
    {
        $company = Company::factory()->create();

        $data = [
            'company_id' => $company->id,
            'area_name' => 'Deira',
        ];

        $area = $this->areaService->createOrRestore($data);

        $this->assertDatabaseHas('areas', [
            'company_id' => $company->id,
            'area_name' => 'Deira',
            'deleted_at' => null,
        ]);

        $this->assertInstanceOf(Area::class, $area);
    }

    /** @test */
    public function it_restores_soft_deleted_area_if_same_name_added()
    {
        $company = Company::factory()->create();

        // Soft-deleted area
        $area = Area::factory()->create([
            'company_id' => $company->id,
            'area_name' => 'Bur Dubai',
        ]);
        $area->delete();

        $data = [
            'company_id' => $company->id,
            'area_name' => 'Bur Dubai',
        ];

        $restoredArea = $this->areaService->createOrRestore($data);

        $this->assertDatabaseHas('areas', [
            'company_id' => $company->id,
            'area_name' => 'Bur Dubai',
            'deleted_at' => null, // should be restored
        ]);

        $this->assertEquals($area->id, $restoredArea->id); // same record restored
    }

    /** @test */
    public function it_throws_validation_error_for_duplicate_active_area()
    {
        $company = Company::factory()->create();

        Area::factory()->create([
            'company_id' => $company->id,
            'area_name' => 'Al Quoz',
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Attempt to add duplicate (active) area
        $this->areaService->createOrRestore([
            'company_id' => $company->id,
            'area_name' => 'Al Quoz',
        ]);
    }
}
