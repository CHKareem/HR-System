<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //    
        Commands\IncrementVacationCount::class,
        Commands\DecrementVacationCount::class,
        Commands\DecrementHourlyVacation::class,
        Commands\DecrementHourlyLate::class,
        Commands\ResetHourlyLate::class,
        Commands\ResetHourlyVacation::class,
        Commands\yearlyCheckVac::class,
        // Commands\dailyBackup::class,
        Commands\monthlyCheckNoPaymentCount::class,
        'App\Console\Commands\dailyBackup',
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


        $schedule->command('employees:decrement')->yearlyOn(1, 31, '15:45');
        $schedule->command('employees:increment')->monthlyOn(1, '08:30');
        $schedule->command('employees:resetHourlyVac')->yearlyOn(6, 31, '15:45');
        $schedule->command('employees:resetHourlyLate')->yearlyOn(6, 31, '15:44');
        $schedule->command('employees:resetHourlyVac')->yearlyOn(12, 31, '15:45');
        $schedule->command('employees:resetHourlyLate')->yearlyOn(12, 31, '15:44');
        $schedule->command('employees:yearlyCheckedVacCount')->yearlyOn(12, 30, '15:45');
        // $schedule->command('databases:dailyBackup')->dailyAt('15:15');

        $schedule->command('employees:noPaymentCountCheck')->dailyAt('12:17');

        $schedule->command('backup:run')->weeklyOn(1, '15:30');
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
