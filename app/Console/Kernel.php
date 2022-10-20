<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
    protected function schedule(Schedule $schedule) {
        try {

            // do this to check if there booktrip without location every 6 minutes
            // this for restart
            $schedule->command('queue:restart')->everyFifteenMinutes();
            $schedule->command('queue:work --daemon')->everyMinute()->withoutOverlapping();
            $schedule->command('queue:work --daemon')->cron('*/12 * * * *');
            $schedule->command('queue:work --daemon')->cron('*/16 * * * *')->withoutOverlapping();
            $schedule->command('queue:work --daemon')->cron('*/17 * * * *')->withoutOverlapping();
            $schedule->command('queue:work --daemon')->cron('*/18 * * * *')->withoutOverlapping();
            $schedule->command('queue:work --daemon')->cron('*/7 * * * *')->withoutOverlapping();
            $schedule->command('queue:work --daemon')->cron('*/19 * * * *')->withoutOverlapping();

            //Prune stale entries from the Telescope database
            $schedule->command('telescope:prune')->cron('0/10 * * * *');            //->dailyAt('01:30');
            //@todo unlock services that closed or not opened yet for rides daily


        } catch (\Exception $e) {
            Log::critical('Exception in running schedule'.$e->getMessage().$e->getCode());
        }
        Log::info('queue worked from schedule at '.now()->toDateTimeString());
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
