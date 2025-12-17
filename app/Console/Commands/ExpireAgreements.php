<?php

namespace App\Console\Commands;

use App\Models\Agreement;
use App\Models\AgreementStatusLogs;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireAgreements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-agreements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark agreements as expired if end date has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $agreements = Agreement::where('agreement_status', 0)
            ->whereDate('end_date', '<=', $today)
            ->get();

        foreach ($agreements as $agreement) {

            AgreementStatusLogs::create([
                'agreement_id' => $agreement->id,
                'old_status'   => $agreement->agreement_status,
                'new_status'   => 2,
                'changed_at'   => now(),
            ]);

            $agreement->update(['agreement_status' => 2]);
        }

        $this->info("Expired agreements updated:" . $agreements->count());
    }
}
