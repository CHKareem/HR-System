<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;
use DB;


class monthlyCheckNoPaymentCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:noPaymentCountCheck';

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
        // $noPaymentChecks = Employee::get(['id', 'noPaymentCount', 'notes']);
        // foreach($noPaymentChecks as $noPaymentCheck){
        //     if($noPaymentCheck->noPaymentCount > 30){
        //         $oldNote += nl2br(".\nUser Have Surpassed The Allowed Number Of No Payment Count"); 
        //  DB::table('employees')->where('id', $noPaymentCheck->id)->update([ 'notes' => $oldNote]);
        //     }
        // }

        // $noPaymentChecks = Employee::get(['id', 'noPaymentCount', 'notes']);
        // foreach($noPaymentChecks as $noPaymentCheck){
        //     if($noPaymentCheck->noPaymentCount > 30){
        //         $note = 'User Have Surpassed The Allowed Number Of No Payment Count';
        //         // $noPaymentCheck->notes += $note; 
        //  DB::table('employees')->where('id', $noPaymentCheck->id)->update([ 'notes' => $note]);
        //     }
        // }

        $noPaymentChecks = Employee::where('noPaymentCount' , '>', 30)->get(['id', 'noPaymentCount', 'notes']);
        foreach($noPaymentChecks as $noPaymentCheck){
            $oldNote = $noPaymentCheck->notes;
            $newNote = 'User Have Surpassed The Allowed Number Of No Payment Count';
            DB::table('employees')->where('id', $noPaymentCheck->id)->update(['notes' => $oldNote. "\n\n" .$newNote]);

        }
        
    }
}
