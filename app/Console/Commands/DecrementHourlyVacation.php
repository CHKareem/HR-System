<?php

namespace App\Console\Commands;
use App\Models\Employee;
use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Carbon;


class DecrementHourlyVacation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:decrementHourlyVac';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'decrement the time for hour vacation accumolator for employees to zero every six and 12 month';

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
       $hourlyVacCounts = Employee::select('id', 'hourlyVac')->where('hourlyVac', '>=', '07:00:00.000')->get();
       foreach($hourlyVacCounts as $hourlyVacCount){
           $hourlyVacDecrement = Carbon::parse($hourlyVacCount->hourlyVac)->subHours(7);
               DB::table('employees')->where('id', $hourlyVacCount->id)->update(['hourlyVac' => $hourlyVacDecrement]);
               DB::table('employees_vacations')->where([['employee_id', $hourlyVacCount->id], ['vacation_id', 2], ['type_id', 1]])->update(['isCheck' => 1]);
       }
    }
}
