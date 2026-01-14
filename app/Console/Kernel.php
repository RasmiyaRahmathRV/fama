<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:expire-agreements')->daily();
        // $schedule->command('profit:update-monthly-pending')
        //     ->monthlyOn(1, '00:05')
        //     ->withoutOverlapping();
        $schedule->command('profit:update-monthly-pending')
            ->dailyAt('12:06')
            ->withoutOverlapping()
            ->before(function () {
                \Log::info('profit:update-monthly-pending command started');
            })
            ->after(function () {
                \Log::info('profit:update-monthly-pending command finished');
            });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
