<?php

namespace Database\Seeders;

use App\Models\ProfitInterval;
use App\Models\ReferralCommissionFrequency;
use Illuminate\Database\Seeder;
use App\Models\TenantIdentity;

class ReferralCommissionFrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReferralCommissionFrequency::updateOrCreate([
            'commission_frequency_name' => 'Single',
            'status' => 1
        ]);
        ReferralCommissionFrequency::updateOrCreate([
            'commission_frequency_name' => 'Twice',
            'status' => 1
        ]);
        ReferralCommissionFrequency::updateOrCreate([
            'commission_frequency_name' => 'Multiple',
            'status' => 1
        ]);
    }
}
