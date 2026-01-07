<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Nationality;
use App\Models\User;
use App\Services\NationalityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class NationalityServiceTest extends TestCase
{
    use RefreshDatabase;

    protected NationalityService $service;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(NationalityService::class);

        // Create user + login
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_it_creates_a_new_nationality()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $paymentMode = $this->service->createOrRestore([
            'company_id' => $company->id,
            'nationality_name' => 'Test Country',
            'nationality_short_code' => 'TC',
        ], $user->id);

        $this->assertDatabaseHas('nationalities', [
            'id' => $paymentMode->id,
            'company_id' => $company->id,
            'nationality_name' => 'Test Country',
            'nationality_short_code' => 'TC',
            'deleted_at' => null,
        ]);
    }

    public function test_it_throws_validation_exception_on_duplicate_active_nationality()
    {
        $this->expectException(ValidationException::class);

        $company = Company::factory()->create();

        Nationality::factory()->create([
            'company_id' => $company->id,
            'nationality_name' => 'Test Country',
            'nationality_short_code' => 'TC',
        ]);

        $this->service->createOrRestore([
            'company_id' => $company->id,
            'nationality_name' => 'Test Country',
            'nationality_short_code' => 'TC',
        ]);
    }

    public function test_it_restores_soft_deleted_nationality()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $deleted = Nationality::factory()->create([
            'company_id' => $company->id,
            'nationality_name' => 'Bank Test',
            'nationality_short_code' => 'BT',
            'deleted_at' => now(),
        ]);

        $restored = $this->service->createOrRestore([
            'company_id' => $company->id,
            'nationality_name' => 'Bank Test',
            'nationality_short_code' => 'BT',
        ], $user->id);

        $this->assertNull($restored->deleted_at);
        $this->assertEquals($deleted->id, $restored->id);
    }
}
