<?php

namespace App\Console\Commands;
use App\Models\Employee;
use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Carbon;


class DecrementHourlyLate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:decrementHourlyLate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'decrement the time for hour late accumolator for employees to zero every six and 12 month';

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
        $hourlyLateCounts = Employee::select('id', 'hourlyLate')->where('hourlyLate', '>=', '02:00:00.000')->get();
        foreach($hourlyLateCounts as $hourlyLateCount){
            $hourlyLateDecrement = Carbon::parse($hourlyLateCount->hourlyLate)->subHours(2);
                DB::table('employees')->where('id', $hourlyLateCount->id)->update(['hourlyLate' => $hourlyLateDecrement]);
             
        }
       
    }
}
