<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use DB;


class DecrementVacationCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:decrement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'decrements the value of vacation count for every employee to zero each end of first month every year';

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
        $yearlyChecks = Employee::get(['id', 'workingYears']);
        foreach($yearlyChecks as $yearlyCheck){
            if($yearlyCheck->workingYears == 6){
                DB::table('employees')->where('id', $yearlyCheck->id)->update(['vacationCount' => 2]);
            }
            if($yearlyCheck->workingYears == 5){
                    DB::table('employees')->where('id', $yearlyCheck->id)->update(['vacationCount' => 2]);
        }
            if($yearlyCheck->workingYears == 4){
                    DB::table('employees')->where('id', $yearlyCheck->id)->update(['vacationCount' => 2]);
            }
            if($yearlyCheck->workingYears == 3){
                    DB::table('employees')->where('id', $yearlyCheck->id)->update(['vacationCount' => 1]);
            }

        }

    }
}
