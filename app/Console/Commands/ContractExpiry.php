<?php

namespace App\Console\Commands;

use App\Models\Contract;
use App\Models\ContractStatusLogs;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ContractExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:contract-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change contract status if the end date is passed.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $contracts = Contract::where('contract_status', '!=', 8)
            ->whereHas('contract_detail', function ($query) use ($today) {
                $query->whereDate('end_date', '<=', $today);
            })
            ->get();

        foreach ($contracts as $contract) {

            ContractStatusLogs::create([
                'contract_id' => $contract->id,
                'old_status'   => $contract->contract_status,
                'new_status'   => 8,
                'changed_at'   => now(),
            ]);

            $contract->update(['contract_status' => 8]);
        }

        $this->info("Expired contracts updated:" . $contracts->count());
    }
}
