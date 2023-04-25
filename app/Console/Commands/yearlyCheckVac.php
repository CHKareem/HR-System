<?php

namespace App\Console\Commands;
use App\Models\Employee;
use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Carbon;


class yearlyCheckVac extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:yearlyCheckedVacCount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'every year check the employee years to increment vacations through the year';

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
        $yearlyChecks = Employee::get(['id', 'startDate']);
        foreach($yearlyChecks as $yearlyCheck){
            $timeOfYear = Carbon::createFromFormat('Y-m-d', $yearlyCheck->startDate)->year;
            $thisYear = Carbon::now()->year;
            DB::table('employees')->where('id', $yearlyCheck->id)->update(['workingYears' => $thisYear-$timeOfYear]);
            // DB::table('employees')->where('id', $yearlyCheck->id)->update(['workingYears' => Carbon::now()->diffInYears(Carbon::parse($timeOfYear))]);
       }
    }
}
