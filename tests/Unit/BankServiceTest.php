<?php

namespace Tests\Unit;

use App\Models\Bank;
use App\Models\Company;
use App\Models\User;
use App\Services\BankService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class BankServiceTest extends TestCase
{
    use RefreshDatabase;

    protected BankService $service;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(BankService::class);

        // Create user + login
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_it_creates_a_new_bank()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $bank = $this->service->createOrRestore([
            'company_id' => $company->id,
            'bank_name' => 'Bank Test',
            'bank_short_code' => 'BT',
        ], $user->id);

        $this->assertDatabaseHas('banks', [
            'id' => $bank->id,
            'company_id' => $company->id,
            'bank_name' => 'Bank Test',
            'bank_short_code' => 'BT',
            'deleted_at' => null,
        ]);
    }

    public function test_it_throws_validation_exception_on_duplicate_active_bank()
    {
        $this->expectException(ValidationException::class);

        $company = Company::factory()->create();

        Bank::factory()->create([
            'company_id' => $company->id,
            'bank_name' => 'Bank Test',
            'bank_short_code' => 'BT',
        ]);

        $this->service->createOrRestore([
            'company_id' => $company->id,
            'bank_name' => 'Bank Test',
            'bank_short_code' => 'BT',
        ]);
    }

    public function test_it_restores_soft_deleted_bank()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();

        $deleted = Bank::factory()->create([
            'company_id' => $company->id,
            'bank_name' => 'Bank Test',
            'bank_short_code' => 'BT',
            'deleted_at' => now(),
        ]);

        $restored = $this->service->createOrRestore([
            'company_id' => $company->id,
            'bank_name' => 'Bank Test',
            'bank_short_code' => 'BT',
        ], $user->id);

        $this->assertNull($restored->deleted_at);
        $this->assertEquals($deleted->id, $restored->id);
    }
}
