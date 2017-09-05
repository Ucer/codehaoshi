<?php

namespace App\Console;

use App\Console\Commands\BindAdmin;
use App\Console\Commands\CodehaoshiInstall;
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
        CodehaoshiInstall::class,
        BindAdmin::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//         $schedule->command('inspire')
//                  ->hourly();
//        $schedule->command('backup:clean')->daily()->everyMinute();
        $schedule->command('backup:run --only-db')->daily();
        $schedule->command('backup:run')->weekly();
  //      $schedule->command('backup:run --only-db')->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
