<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Carbon;

class firstMonthCheckHours extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:checkHours';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $hoursChecks = Employee::get(['hourlyLate, hourlyVac']);
        foreach($hoursChecks as $hoursCheck){
            if($hoursCheck->hourlyLate >= '01:00:00.000'){
                DB::table('employees')->update(['hourlyLate' => '00:00:00.000']);
            }

            if($hoursCheck->hourlyVac >= '06:00:00.000'){
                DB::table('employees')->update(['hourlyVac' => '00:00:00.000']);
            }
        }
    }
}
