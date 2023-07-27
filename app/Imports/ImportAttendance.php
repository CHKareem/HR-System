<?php

namespace App\Imports;

use App\Models\Attendee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Employee;
use App\Models\EmployeesVacation;
use App\Models\Center;
use App\Models\Holiday;
use DB;
use Illuminate\Support\Carbon;


class ImportAttendance implements ToModel, WithStartRow
{

    public $vacTypes = array();


        public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
    
    public function get_hourly_late_count($empId){
        $lateCounts = Employee::where('id', $empId)->get('hourlyLate');
        foreach($lateCounts as $lateCount){
            return $lateCount->hourlyLate;
        }
    }

    public function get_hourly_vac_count($empId){
        $vacCounts = Employee::where('id', $empId)->get('hourlyVac');
        foreach($vacCounts as $vacCount){
            return $vacCount->hourlyVac;
        }
    }

    public function get_weekend_days_with_vacation($empId, $vacDate){
        $vacationDates = EmployeesVacation::where([['employee_id', $empId], ['vacationDate', $vacDate]])->get();
        foreach($vacationDates as $vacationDate){
            if($vacationDate->type_id == 3 || $vacationDate->type_id == 4 || $vacationDate->type_id == 5 || $vacationDate->type_id == 6 
            || $vacationDate->type_id == 9 || $vacationDate->type_id == 11 || $vacationDate->type_id == 12 || $vacationDate->type_id == 13
            || $vacationDate->type_id == 19  || $vacationDate->type_id == 14 || $vacationDate->type_id == 15 || $vacationDate->type_id == 16
            || $vacationDate->type_id == 17 || ($vacationDate->type_id == 1 && $vacationDate->vacation_id == 1)){
            return $vacationDate->vacationDate;
            // return array_push($this->vacTypes, $vacationDate->vacationDate);
            }
          }
        }
    
        public function get_hourly_late_execuses($empId, $vacDate){
            $hourlyLateDates = EmployeesVacation::select('vacationDate', 'type_id')->where([['employee_id', $empId], ['vacationDate', $vacDate]])->get();
            foreach($hourlyLateDates as $hourlyLateDate){
                if($hourlyLateDate->type_id == 7 || $hourlyLateDate->type_id == 8 || $hourlyLateDate->type_id == 10 || $hourlyLateDate->type_id == 14 ||
                $hourlyLateDate->type_id == 15 || $hourlyLateDate->type_id == 16 || $hourlyLateDate->type_id == 17 || $hourlyLateDate->type_id == 18 ){
                return $hourlyLateDate->vacationDate;
                }
              }
            }


    public function model(array $column)
    {

        $CheckIn = '09:00';
        $CheckOut = '15:30';

        $centers = Center::all();
        $holidays = Holiday::all();
    foreach($centers as $center){}
            
            foreach($center->weekends as $centweek){

                $weekendDate[] = $centweek->dayName;

                } 
            
                foreach($holidays as $holiday){
    
                    $holidayDate[] = $holiday->holidayDate;
    
                    } 

                  
if($column[2] == null){

    $employeeIsActive = DB::table('employees')->where('id', $column[0])->first();

    if($employeeIsActive->isActive != 0){
       if((in_array(Carbon::parse($column[1])->format('l'),$weekendDate) && !in_array(Carbon::parse($column[1])->format('Y-m-d'),$holidayDate)) || (!in_array(Carbon::parse($column[1])->format('l'),$weekendDate) && !in_array(Carbon::parse($column[1])->format('Y-m-d'),$holidayDate))){

                        // $vacationDates = EmployeesVacation::where('employee_id', $column[0])->whereDate('vacationDate', '=', Carbon::parse($column[1])->format('Y-m-d'))->first();
        
                        $vacationDates = EmployeesVacation::whereDate('vacationDate', '=', $this->get_weekend_days_with_vacation($column[0], Carbon::parse($column[1])->format('Y-m-d')))->first();

            if($vacationDates == null && !in_array(Carbon::parse($column[1])->format('l'),$weekendDate)){
               
                    DB::table('employees_vacations')->insert([
        'employee_id' => $column[0],
        'vacation_id' => 1,
        'vacationDate' => Carbon::parse($column[1]),
        'type_id' => 1,
        'duration' => 1,
        'reason' => 'No Attendance Log For This Day',
        'isAuthor' => 0,
        'discount' => Null,
        'isCheck' => 1
    ]);

  }

if(!in_array(Carbon::parse($column[1])->format('l'),$weekendDate) && !in_array(Carbon::parse($column[1])->format('Y-m-d'),$holidayDate)){
Attendee::create([
    'employee_id' => $column[0],
    'logDate' => Carbon::parse($column[1]),
    'logTime' => null,
    'logIn' => null,
    'logOut' => null,
    'duration' => null,
]);
        }
        
      }
    }  
  }

if( $column[2] != null ){

       if(!in_array(Carbon::parse($column[1])->format('l'),$weekendDate) && !in_array(Carbon::parse($column[1])->format('Y-m-d'),$holidayDate)){
        
           
                $login = substr($column[2], 0, 5);

                $logout = substr($column[2], -5);

                if( $logout == $login ){
                    $logout = null;
                }

                if($logout == null || $login == null){
                    DB::table('employees_vacations')->insert([
                        'employee_id' => $column[0],
                        'vacation_id' => 1,
                        'vacationDate' => Carbon::parse($column[1]),
                        'type_id' => 1,
                        'duration' => 1,
                        'reason' => 'No Login or Logout Time',
                        'isAuthor' => 0,
                        'discount' => Null,
                        'isCheck' => 1
                    ]);
                    return new Attendee([
                        'employee_id' => $column[0],
                        'logDate' => Carbon::parse($column[1]),
                        'logTime' => $column[2],
                        'logIn' => $login,
                        'logOut' => $logout,
                        'duration' => null,
                    ]);
                }
                if($logout != null){                // if($login == null || $logout == null){
                //     DB::table('employees_vacations')->insert([
                //         'employee_id' => $column[0],
                //         'vacation_id' => 1,
                //         'vacationDate' => Carbon::parse($column[1]),
                //         'type_id' => 1,
                //         'duration' => 1,
                //         'reason' => 'No Login or Logout Time',
                //         'isAuthor' => 0,
                //         'discount' => Null,
                //         'isCheck' => 1
                //     ]);
                // }

                if($login <= '09:05' && $logout >= '15:25'){
                    $duration = Carbon::parse($login)->diff(Carbon::parse($logout));
                    $duration = $duration->h . ":" . $duration->i;
                }

                if($login >= '09:05' && $login <= '09:29'){
                    // dd($this->get_hourly_late_execuses($column[0], $column[1]) != Carbon::parse($column[1])->format('Y-m-d'));
                    if($this->get_hourly_late_execuses($column[0], $column[1]) != Carbon::parse($column[1])->format('Y-m-d')){
                    $loginLate = Carbon::parse($login)->diff(Carbon::parse($CheckIn));
                    $loginLateMin = $loginLate->i;
                    $loginLate = '0:' . $loginLateMin;
                    $userId = DB::table('employees')->where('id', $column[0])->first();
                    $totalLate = Carbon::parse($userId->hourlyLate)->addMinutes($loginLateMin);
                    DB::table('employees')->where('id', $column[0])->update(['hourlyLate' => $totalLate]);
                    if($this->get_hourly_late_count($column[0]) >= '02:00:00.000'){
                    DB::table('employees_vacations')->insert([
                        'employee_id' => $column[0],
                        'vacation_id' => 1,
                        'vacationDate' => Carbon::parse($column[1]),
                        'type_id' => 1,
                        'duration' => 1,
                        'reason' => 'more than 2 hours late',
                        'isAuthor' => 0,
                        'discount' => Null,
                        'isCheck' => 1,
                    ]);
                    $hourlyLateCounts = Employee::select('hourlyLate')->where('id', $column[0])->get();
                    foreach($hourlyLateCounts as $hourlyLateCount){
                    $hourlyLateDecrement = Carbon::parse($hourlyLateCount->hourlyLate)->subHours(2);
                    DB::table('employees')->where('id', $column[0])->update(['hourlyLate' => $hourlyLateDecrement]);
                    }
                  }else{
                    DB::table('employees_vacations')->insert([
                        'employee_id' => $column[0],
                        'vacation_id' => 2,
                        'vacationDate' => Carbon::parse($column[1]),
                        'type_id' => 2,
                        'duration' => $loginLate,
                        'reason' => ' Hourly Late ',
                        'isAuthor' => 0,
                        'discount' => Null,
                        'isCheck' => 0,
                    ]);
                  }
                }

                if(Carbon::parse($this->get_hourly_late_execuses($column[0], $column[1])) == Carbon::parse($column[1])){
                    $loginLate = Carbon::parse($login)->diff(Carbon::parse($CheckIn));
                    $loginLateMin = $loginLate->i;
                    $loginLate = "0:" . $loginLateMin;
                    $userId = DB::table('employees_vacations')->where([['employee_id', $column[0]], ['type_id', 7]])->orWhere([['employee_id', $column[0]], ['type_id', 8]])->
                    whereDate('vacationDate', '=', Carbon::parse($column[1])->format('Y-m-d'))->first();
                    // dd($userId);
                    // dd($userId->duration != $loginLate, $userId->duration, $loginLate, Carbon::parse($loginLate)->diff($userId->duration));
                    if($userId->duration != $loginLate){
                        $moreTimeTook = Carbon::parse($loginLate)->diff($userId->duration);
                        $moreTimeTookMin = $moreTimeTook->i;
                        $moreTimeTook = "0:" . $moreTimeTookMin;
                        $user = DB::table('employees')->where('id', $column[0])->first();
                        $totalLate = Carbon::parse($user->hourlyLate)->addMinutes($moreTimeTookMin);
                        // dd($totalLate);
                        DB::table('employees')->where('id', $column[0])->update(['hourlyLate' => $totalLate]);
                        if($this->get_hourly_late_count($column[0]) >= '02:00:00.000'){
                            DB::table('employees_vacations')->insert([
                                'employee_id' => $column[0],
                                'vacation_id' => 1,
                                'vacationDate' => Carbon::parse($column[1]),
                                'type_id' => 1,
                                'duration' => 1,
                                'reason' => 'more than 2 hours late',
                                'isAuthor' => 0,
                                'discount' => Null,
                                'isCheck' => 1,
                            ]);
                            $hourlyLateCounts = Employee::select('hourlyLate')->where('id', $column[0])->get();
                            foreach($hourlyLateCounts as $hourlyLateCount){
                            $hourlyLateDecrement = Carbon::parse($hourlyLateCount->hourlyLate)->subHours(2);
                            DB::table('employees')->where('id', $column[0])->update(['hourlyLate' => $hourlyLateDecrement]);
                            }
                        }else{
                            DB::table('employees_vacations')->insert([
                                'employee_id' => $column[0],
                                'vacation_id' => 2,
                                'vacationDate' => Carbon::parse($column[1]),
                                'type_id' => 2,
                                'duration' => $moreTimeTook,
                                'reason' => ' Extended Late Vacation',
                                'isAuthor' => 0,
                                'discount' => Null,
                                'isCheck' => 0,
                            ]);
                        }
                }
            }
     }

                if($logout < '15:25' && $login < '12:05'){
                        if($this->get_hourly_late_execuses($column[0], $column[1]) != Carbon::parse($column[1])){
                    $logoutLate = Carbon::parse($logout)->diff(Carbon::parse($CheckOut));
                    $logoutHour = $logoutLate->h;
                    $logoutMin = $logoutLate->i;
                    $logoutLate = $logoutHour . ":" . $logoutMin;
                    $userId = DB::table('employees')->where('id', $column[0])->first();
                    $totalLate = Carbon::parse($userId->hourlyVac)->addHours($logoutHour)->addMinutes($logoutMin);
                    DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $totalLate]);
                    if($this->get_hourly_vac_count($column[0]) >= '07:00:00.000'){
                    DB::table('employees_vacations')->insert([
                        'employee_id' => $column[0],
                        'vacation_id' => 1,
                        'vacationDate' => Carbon::parse($column[1]),
                        'type_id' => 1,
                        'duration' => 1,
                        'reason' => 'more than 7 hours late',
                        'isAuthor' => 0,
                        'discount' => Null,
                        'isCheck' => 1,
                    ]);
                    $hourlyVacCounts = Employee::select('hourlyVac')->where('id', $column[0])->get();
                    foreach($hourlyVacCounts as $hourlyVacCount){
                    $hourlyVacDecrement = Carbon::parse($hourlyVacCount->hourlyVac)->subHours(7);
                    DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $hourlyVacDecrement]);
                    }
                  }else{
                    DB::table('employees_vacations')->insert([
                        'employee_id' => $column[0],
                        'vacation_id' => 2,
                        'vacationDate' => Carbon::parse($column[1]),
                        'type_id' => 1,
                        'duration' => $logoutLate,
                        'reason' => ' Hourly Vacation ',
                        'isAuthor' => 0,
                        'discount' => Null,
                        'isCheck' => 0,
                    ]);
                  }
                }

                if(Carbon::parse($this->get_hourly_late_execuses($column[0], $column[1])) == Carbon::parse($column[1])){
                    $loginLate = Carbon::parse($login)->diff(Carbon::parse($CheckIn));
                    $loginHour = $loginLate->h;
                    $loginMin = $loginLate->i;
                    $loginLate = $loginHour . ":" . $loginMin;
                    $userId = DB::table('employees_vacations')->where('employee_id', $column[0])->whereDate('vacationDate', '=', Carbon::parse($column[1])->format('Y-m-d'))->first();
                    if($userId->duration != $loginLate){
                        $moreTimeTook = Carbon::parse($loginLate)->diff(Carbon::parse($userId->duration)->format('h:i:s'));
                        $moreTimeTookHour = $moreTimeTook->h;
                        $moreTimeTookMin = $moreTimeTook->i;
                        $moreTimeTook = $moreTimeTookHour . ":" . $moreTimeTookMin;
                        $user = DB::table('employees')->where('id', $column[0])->first();
                        $totalLate = Carbon::parse($user->hourlyVac)->addHours($moreTimeTookHour)->addMinutes($moreTimeTookMin);
                        DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $totalLate]);
                        if($this->get_hourly_vac_count($column[0]) >= '07:00:00.000'){
                            DB::table('employees_vacations')->insert([
                                'employee_id' => $column[0],
                                'vacation_id' => 1,
                                'vacationDate' => Carbon::parse($column[1]),
                                'type_id' => 1,
                                'duration' => 1,
                                'reason' => 'more than 7 hours late',
                                'isAuthor' => 0,
                                'discount' => Null,
                                'isCheck' => 1,
                            ]);
                            $hourlyVacCounts = Employee::select('hourlyVac')->where('id', $column[0])->get();
                            foreach($hourlyVacCounts as $hourlyVacCount){
                            $hourlyVacDecrement = Carbon::parse($hourlyVacCount->hourlyVac)->subHours(7);
                            DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $hourlyVacDecrement]);
                            }
                        }else{
                            DB::table('employees_vacations')->insert([
                                'employee_id' => $column[0],
                                'vacation_id' => 2,
                                'vacationDate' => Carbon::parse($column[1]),
                                'type_id' => 1,
                                'duration' => $moreTimeTook,
                                'reason' => ' Extended Hourly Vacation',
                                'isAuthor' => 0,
                                'discount' => Null,
                                'isCheck' => 0,
                            ]);
                        }
                        // DB::table('employees_vacations')->insert([
                        //     'employee_id' => $column[0],
                        //     'vacation_id' => 2,
                        //     'vacationDate' => Carbon::parse($column[1]),
                        //     'type_id' => 1,
                        //     'duration' => $moreTimeTook,
                        //     'reason' => ' Extended Hourly Vacation',
                        //     'isAuthor' => 0,
                        //     'discount' => Null,
                        //     'isCheck' => 0,
                        // ]);
                    }
                }
                
              }

                if($login > '09:29' && $login < '12:05'){
                        if(Carbon::parse($this->get_hourly_late_execuses($column[0], $column[1])) != Carbon::parse($column[1])){
                        $loginLate = Carbon::parse($login)->diff(Carbon::parse($CheckIn));
                        $loginHour = $loginLate->h;
                        $loginMin = $loginLate->i;
                        $loginLate = $loginHour . ":" . $loginMin;
                        $userId = DB::table('employees')->where('id', $column[0])->first();
                        $totalLate = Carbon::parse($userId->hourlyVac)->addHours($loginHour)->addMinutes($loginMin);
                        // dd($loginLate, $loginHour, $loginMin, $totalLate);
                        DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $totalLate]);
                        if($this->get_hourly_vac_count($column[0]) >= '07:00:00.000'){
                        DB::table('employees_vacations')->insert([
                            'employee_id' => $column[0],
                            'vacation_id' => 1,
                            'vacationDate' => Carbon::parse($column[1]),
                            'type_id' => 1,
                            'duration' => 1,
                            'reason' => 'more than 7 hours late',
                            'isAuthor' => 0,
                            'discount' => Null,
                            'isCheck' => 1,
                        ]);
                        $hourlyVacCounts = Employee::select('hourlyVac')->where('id', $column[0])->get();
                        foreach($hourlyVacCounts as $hourlyVacCount){
                        $hourlyVacDecrement = Carbon::parse($hourlyVacCount->hourlyVac)->subHours(7);
                        DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $hourlyVacDecrement]);
                        }
                    }else{
                        DB::table('employees_vacations')->insert([
                            'employee_id' => $column[0],
                            'vacation_id' => 2,
                            'vacationDate' => Carbon::parse($column[1]),
                            'type_id' => 1,
                            'duration' => $loginLate,
                            'reason' => ' Hourly Vacation',
                            'isAuthor' => 0,
                            'discount' => Null,
                            'isCheck' => 0,
                        ]);
                    }
                }
                if(Carbon::parse($this->get_hourly_late_execuses($column[0], $column[1])) == Carbon::parse($column[1])){
                    $loginLate = Carbon::parse($login)->diff(Carbon::parse($CheckIn));
                    $loginHour = $loginLate->h;
                    $loginMin = $loginLate->i;
                    $loginLate = $loginHour . ":" . $loginMin;
                    $userId = DB::table('employees_vacations')->where('employee_id', $column[0])->whereDate('vacationDate', '=', Carbon::parse($column[1])->format('Y-m-d'))->first();
                    if($userId->duration != $loginLate){
                        $moreTimeTook = Carbon::parse($loginLate)->diff(Carbon::parse($userId->duration)->format('h:i:s'));
                        $moreTimeTookHour = $moreTimeTook->h;
                        $moreTimeTookMin = $moreTimeTook->i;
                        $moreTimeTook = $moreTimeTookHour . ":" . $moreTimeTookMin;
                        $user = DB::table('employees')->where('id', $column[0])->first();
                        $totalLate = Carbon::parse($user->hourlyVac)->addHours($moreTimeTookHour)->addMinutes($moreTimeTookMin);
                        DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $totalLate]);
                        if($this->get_hourly_vac_count($column[0]) >= '07:00:00.000'){
                            DB::table('employees_vacations')->insert([
                                'employee_id' => $column[0],
                                'vacation_id' => 1,
                                'vacationDate' => Carbon::parse($column[1]),
                                'type_id' => 1,
                                'duration' => 1,
                                'reason' => 'more than 7 hours late',
                                'isAuthor' => 0,
                                'discount' => Null,
                                'isCheck' => 1,
                            ]);
                            $hourlyVacCounts = Employee::select('hourlyVac')->where('id', $column[0])->get();
                            foreach($hourlyVacCounts as $hourlyVacCount){
                            $hourlyVacDecrement = Carbon::parse($hourlyVacCount->hourlyVac)->subHours(7);
                            DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $hourlyVacDecrement]);
                            }
                        }else{
                            DB::table('employees_vacations')->insert([
                                'employee_id' => $column[0],
                                'vacation_id' => 2,
                                'vacationDate' => Carbon::parse($column[1]),
                                'type_id' => 1,
                                'duration' => $moreTimeTook,
                                'reason' => ' Extended Hourly Vacation',
                                'isAuthor' => 0,
                                'discount' => Null,
                                'isCheck' => 0,
                            ]);
                        }
                    }
                }
            }

                if(($login > '12:04' && $logout < '15:25') || ($login > '12:04' && $logout >= '15:25')){

                    if(Carbon::parse($this->get_hourly_late_execuses($column[0], $column[1])) == Carbon::parse($column[1])){
                    $loginLate = Carbon::parse($login)->diff(Carbon::parse($CheckIn));
                    $loginHour = $loginLate->h;
                    $loginMin = $loginLate->i;
                    $loginLate = $loginHour . ":" . $loginMin;
                    $userId = DB::table('employees_vacations')->where('employee_id', $column[0])->whereDate('vacationDate', '=', Carbon::parse($column[1])->format('Y-m-d'))->first();
                    if($userId->duration != $loginLate){
                        $moreTimeTook = Carbon::parse($loginLate)->diff(Carbon::parse($userId->duration)->format('h:i:s'));
                        $moreTimeTookHour = $moreTimeTook->h;
                        $moreTimeTookMin = $moreTimeTook->i;
                        $moreTimeTook = $moreTimeTookHour . ":" . $moreTimeTookMin;
                        $user = DB::table('employees')->where('id', $column[0])->first();
                        $totalLate = Carbon::parse($user->hourlyVac)->addHours($moreTimeTookHour)->addMinutes($moreTimeTookMin);
                        DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $totalLate]);
                        if($this->get_hourly_vac_count($column[0]) >= '07:00:00.000'){
                            DB::table('employees_vacations')->insert([
                                'employee_id' => $column[0],
                                'vacation_id' => 1,
                                'vacationDate' => Carbon::parse($column[1]),
                                'type_id' => 1,
                                'duration' => 1,
                                'reason' => 'more than 7 hours late',
                                'isAuthor' => 0,
                                'discount' => Null,
                                'isCheck' => 1,
                            ]);
                            $hourlyVacCounts = Employee::select('hourlyVac')->where('id', $column[0])->get();
                            foreach($hourlyVacCounts as $hourlyVacCount){
                            $hourlyVacDecrement = Carbon::parse($hourlyVacCount->hourlyVac)->subHours(7);
                            DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $hourlyVacDecrement]);
                            }
                        }else{
                            DB::table('employees_vacations')->insert([
                                'employee_id' => $column[0],
                                'vacation_id' => 2,
                                'vacationDate' => Carbon::parse($column[1]),
                                'type_id' => 1,
                                'duration' => $moreTimeTook,
                                'reason' => ' Extended Hourly Vacation',
                                'isAuthor' => 0,
                                'discount' => Null,
                                'isCheck' => 0,
                            ]);
                        }
                    }
                }
                    if(Carbon::parse($this->get_hourly_late_execuses($column[0], $column[1])) != Carbon::parse($column[1])){
                    DB::table('employees_vacations')->insert([
                        'employee_id' => $column[0],
                        'vacation_id' => 1,
                        'vacationDate' => Carbon::parse($column[1]),
                        'type_id' => 1,
                        'duration' => 1,
                        'reason' => 'More than 3 hours late',
                        'isAuthor' => 0,
                        'discount' => Null,
                        'isCheck' => 1
                    ]);
                }
        }
                $duration = Carbon::parse($login)->diff(Carbon::parse($logout));
                $duration = $duration->h . ":" . $duration->i;
            }

            return new Attendee([
                'employee_id' => $column[0],
                'logDate' => Carbon::parse($column[1]),
                'logTime' => $column[2],
                'logIn' => $login,
                'logOut' => $logout,
                'duration' => $duration,
            ]);
}
       }
    
    }

     
    public function startRow(): int
    {
        return 2;
    }
}
