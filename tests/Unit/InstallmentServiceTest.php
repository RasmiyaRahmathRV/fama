<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Installment;
use App\Models\User;
use App\Services\InstallmentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class InstallmentServiceTest extends TestCase
{
    use RefreshDatabase;

    protected InstallmentService $service;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(InstallmentService::class);

        // Create user + login
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_it_creates_a_new_installment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $installment = $this->service->createOrRestore([
            'company_id' => $company->id,
            'installment_name' => '12',
        ], $user->id);

        $this->assertDatabaseHas('installments', [
            'id' => $installment->id,
            'company_id' => $company->id,
            'installment_name' => '12',
            'deleted_at' => null,
        ]);
    }

    public function test_it_throws_validation_exception_on_duplicate_active_installment()
    {
        $this->expectException(ValidationException::class);

        $company = Company::factory()->create();

        Installment::factory()->create([
            'company_id' => $company->id,
            'installment_name' => '1',
        ]);

        $this->service->createOrRestore([
            'company_id' => $company->id,
            'installment_name' => '1',
        ]);
    }

    public function test_it_restores_soft_deleted_installment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $deleted = Installment::factory()->create([
            'company_id' => $company->id,
            'installment_name' => '4',
            'deleted_at' => now(),
        ]);

        $restored = $this->service->createOrRestore([
            'company_id' => $company->id,
            'installment_name' => '4',
        ], $user->id);

        $this->assertNull($restored->deleted_at);
        $this->assertEquals($deleted->id, $restored->id);
    }
}
