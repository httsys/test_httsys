<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // Belt-and-suspenders for auctions — MarketplaceListing::finalizeIfEnded()
        // already runs lazily when a listing page is viewed, so this is only
        // needed if the host has Laravel's scheduler cron entry set up
        // (`* * * * * php artisan schedule:run`). If it isn't, auctions
        // still settle correctly, just whenever someone next looks.
        $schedule->command('marketplace:finalize-auctions')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
