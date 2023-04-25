<?php

namespace App\Console\Commands;
use DB;
use Illuminate\Console\Command;

class ResetHourlyVacation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:resetHourlyVac';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset the time for hour vacation accumolator for employees to zero every six and 12 month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return 0;
        DB::table('employees')->update(['hourlyVac' => '00:00:00.000']);
    }
}
