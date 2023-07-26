
<?php

namespace App\Providers;
use App\Models\Employee;
use DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // $logCode = 102;
        // $logResult = substr($logCode, 0, 1);
        // $logResult1 = substr($logCode, 1, 2);
        //  if($logResult1 == 2){
        //     $logResult2 = true;
        // }else{
        //     $logResult2 = false;
        // }
        // dd($logResult, $logResult1, $logResult2);

        
        // $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".gz";
        // $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . storage_path() . "/app/backup/" . $filename;
        // $returnVar = NULL;
        // $output  = NULL;
        // exec($command, $output, $returnVar);

        // $date = Carbon::now()->format('Y');
        // $date1 = DB::table('employees')->where('id', 1)->first();
        // if(Carbon::parse($date1->startDate)->format('Y') == Carbon::now()->format('Y')){
        //     dd($date, Carbon::parse($date1->startDate)->format('Y'));
        // }
        // dd('fghfgfgh');

    //     $yearlyChecks = Employee::get(['id', 'startDate']);
    //     foreach($yearlyChecks as $yearlyCheck){
    //         $timeOfYear = Carbon::createFromFormat('Y-m-d', $yearlyCheck->startDate)->year;
    //         $time2 = Carbon::now()->year;
    //         dd($timeOfYear, $time2, $time2-$timeOfYear);
    //         DB::table('employees')->where('id', $yearlyCheck->id)->update(['workingYears' => Carbon::now()->diffInYears(Carbon::parse($timeOfYear))]);
    //    }

     $thisUrl = url()->current().'/';
     if (strpos($thisUrl,'/en/') && app()->getlocale() == 'en') {
         $newUrl  = str_replace('/en/', '/ar/', $thisUrl);
     }else{
         $newUrl  = str_replace('/ar/', '/en/', $thisUrl);
     }
     View::share('newUrl', $newUrl);
    }
}
