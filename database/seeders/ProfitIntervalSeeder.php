<?php

namespace Database\Seeders;

use App\Models\ProfitInterval;
use Illuminate\Database\Seeder;
use App\Models\TenantIdentity;

class ProfitIntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfitInterval::updateOrCreate([
            'profit_interval_name' => 'Monthly',
            'status' => 1
        ]);
        ProfitInterval::updateOrCreate([
            'profit_interval_name' => 'Quarterly',
            'status' => 1
        ]);
        ProfitInterval::updateOrCreate([
            'profit_interval_name' => 'Halfyearly',
            'status' => 1
        ]);
        ProfitInterval::updateOrCreate([
            'profit_interval_name' => 'Yearly',
            'status' => 1
        ]);
    }
}
