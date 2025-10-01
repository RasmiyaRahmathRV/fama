<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\PaymentMode;
use App\Models\User;
use App\Services\PaymentModeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PaymentModeServiceTest extends TestCase
{
    use RefreshDatabase;

    protected PaymentModeService $service;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(PaymentModeService::class);

        // Create user + login
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_it_creates_a_new_payment_mode()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $paymentMode = $this->service->createOrRestore([
            'company_id' => $company->id,
            'payment_mode_name' => 'Bank transfer',
            'payment_mode_short_code' => 'BT',
        ], $user->id);

        $this->assertDatabaseHas('payment_modes', [
            'id' => $paymentMode->id,
            'company_id' => $company->id,
            'payment_mode_name' => 'Bank transfer',
            'payment_mode_short_code' => 'BT',
            'deleted_at' => null,
        ]);
    }

    public function test_it_throws_validation_exception_on_duplicate_active_payment_mode()
    {
        $this->expectException(ValidationException::class);

        $company = Company::factory()->create();

        PaymentMode::factory()->create([
            'company_id' => $company->id,
            'payment_mode_name' => 'Bank Test',
            'payment_mode_short_code' => 'BT',
        ]);

        $this->service->createOrRestore([
            'company_id' => $company->id,
            'payment_mode_name' => 'Bank Test',
            'payment_mode_short_code' => 'BT',
        ]);
    }

    public function test_it_restores_soft_deleted_payment_mode()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $deleted = PaymentMode::factory()->create([
            'company_id' => $company->id,
            'payment_mode_name' => 'Bank Test',
            'payment_mode_short_code' => 'BT',
            'deleted_at' => now(),
        ]);

        $restored = $this->service->createOrRestore([
            'company_id' => $company->id,
            'payment_mode_name' => 'Bank Test',
            'payment_mode_short_code' => 'BT',
        ], $user->id);

        $this->assertNull($restored->deleted_at);
        $this->assertEquals($deleted->id, $restored->id);
    }
}
