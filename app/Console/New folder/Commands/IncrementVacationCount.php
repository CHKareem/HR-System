<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use DB;


class IncrementVacationCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'increments the value of vacation count for every employee each month';

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
        //return 0;
        $yearlyChecks = Employee::get(['id', 'workingYears']);
        foreach($yearlyChecks as $yearlyCheck){
            if($yearlyCheck->workingYears >= 11){
                DB::table('employees')->where('id', $yearlyCheck->id)->increment('vacationCount', 0);
            }
            if($yearlyCheck->workingYears == 6 &&  $yearlyCheck->workingYears <= 10){
                if(Carbon::now()->month == 7){
                    DB::table('employees')->where('id', $yearlyCheck->id)->increment('vacationCount', 5);
                    }else{
                    DB::table('employees')->where('id', $yearlyCheck->id)->increment('vacationCount', 2);
                    }
            }
            if($yearlyCheck->workingYears == 5){
                if(Carbon::now()->month == 7){
                    DB::table('employees')->where('id', $yearlyCheck->id)->increment('vacationCount', 4);
                    }elseif(Carbon::now()->month >= 8){
                    DB::table('employees')->where('id', $yearlyCheck->id)->increment('vacationCount', 1);
                    }else{
                    DB::table('employees')->where('id', $yearlyCheck->id)->increment('vacationCount', 2);
                    }
            }
            if($yearlyCheck->workingYears <=4){
                if(Carbon::now()->month == 7){
                DB::table('employees')->where('id', $yearlyCheck->id)->increment('vacationCount', 3);
                }else{
                DB::table('employees')->where('id', $yearlyCheck->id)->increment('vacationCount', 1);
                }
            }

        }
    }
}
