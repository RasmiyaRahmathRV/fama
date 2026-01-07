<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use App\Models\Vendor;
use App\Services\VendorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class VendorServiceTest extends TestCase
{
    use RefreshDatabase;

    protected VendorService $service;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(VendorService::class);

        // Create user + login
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_it_creates_a_new_vendor()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $vendor = $this->service->createOrRestore([
            'company_id' => $company->id,
            'vendor_name' => 'Muhammed',
        ], $user->id);

        $this->assertDatabaseHas('vendors', [
            'id' => $vendor->id,
            'company_id' => $company->id,
            'vendor_name' => 'Muhammed',
            'deleted_at' => null,
        ]);
    }

    public function test_it_throws_validation_exception_on_duplicate_active_vendor()
    {
        $this->expectException(ValidationException::class);

        $company = Company::factory()->create();

        Vendor::factory()->create([
            'company_id' => $company->id,
            'vendor_name' => 'Muhammed',
        ]);

        $this->service->createOrRestore([
            'company_id' => $company->id,
            'vendor_name' => 'Muhammed',
        ]);
    }

    public function test_it_restores_soft_deleted_vendor()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $deleted = Vendor::factory()->create([
            'company_id' => $company->id,
            'vendor_name' => 'Muhammed',
            'deleted_at' => now(),
        ]);

        $restored = $this->service->createOrRestore([
            'company_id' => $company->id,
            'vendor_name' => 'Muhammed',
        ], $user->id);

        $this->assertNull($restored->deleted_at);
        $this->assertEquals($deleted->id, $restored->id);
    }
}
