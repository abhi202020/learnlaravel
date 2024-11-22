<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Add your scheduled commands here if needed
        // Example: $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Automatically load custom commands from the specified directory
        $this->load(__DIR__.'/Commands');

        // Include any additional routes for console commands (if defined)
        require base_path('routes/console.php');
    }

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Register your custom commands here explicitly
        // Example: App\Console\Commands\LoginErply::class,
        \App\Console\Commands\LoginErply::class, // Add your command here
    ];
}
