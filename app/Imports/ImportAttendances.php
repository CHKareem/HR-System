<?php

namespace App\Imports;

use App\Models\Attendee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Carbon;
use App\Models\Employee;
use App\Models\EmployeesVacation;
use App\Models\Center;
use App\Models\Holiday;
use DB;


class ImportAttendance implements ToModel, WithStartRow
{

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
        $vacationDates = EmployeesVacation::select('vacationDate', 'type_id')->where([['employee_id', $empId], ['vacationDate', $vacDate]])->get();
        foreach($vacationDates as $vacationDate){
            if($vacationDate->type_id == 3 || $vacationDate->type_id == 4 || $vacationDate->type_id == 5 || $vacationDate->type_id == 6 
            || $vacationDate->type_id == 9 || $vacationDate->type_id == 11 || $vacationDate->type_id == 12 || $vacationDate->type_id == 13
            || $vacationDate->type_id == 14 || $vacationDate->type_id == 15|| $vacationDate->type_id == 16 || $vacationDate->type_id == 17
            || $vacationDate->type_id == 19){
            return $vacationDate->vacationDate;
            }
          }
        }
    
        public function get_hourly_late_execuses($empId, $vacDate){
            $lateTypes = array();
            $hourlyLateDates = EmployeesVacation::select('vacationDate', 'type_id')->where([['employee_id', $empId], ['vacationDate', $vacDate]])->get();
            foreach($hourlyLateDates as $hourlyLateDate){
                if($hourlyLateDate->type_id != 7 && $hourlyLateDate->type_id != 8 && $hourlyLateDate->type_id != 10 & $hourlyLateDate->type_id != 18 ){
                return array_push($lateTypes, $hourlyLateDate->type_id);
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
                 
       if(!in_array(Carbon::parse($column[1])->format('l'),$weekendDate) && !in_array(Carbon::parse($column[1])->format('Y-m-d'),$holidayDate)){
        
            if( $column[2] != "" ){
                $login = substr($column[2], 0, 5);

                $logout = substr($column[2], -5);
                if( $logout == $login ){
                    $logout = null;
                }

                if($login <= '09:05' && $logout >= '15:25'){
                    $duration = Carbon::parse($login)->diff(Carbon::parse($logout));
                    $duration = $duration->h . ":" . $duration->i;
                }

                if($login > '09:05' && $login <= '09:25'){
                    $loginLate = Carbon::parse($login)->diff(Carbon::parse($CheckIn));
                    $loginLate = $loginLate->i;
                    $userId = DB::table('employees')->where('id', $column[0])->first();
                    $totalLate = Carbon::parse($userId->hourlyLate)->startOfMinute()->add($loginLate, 'minutes');
                    DB::table('employees')->where('id', $column[0])->update(['hourlyLate' => $totalLate]);
                    if($this->get_hourly_late_count($column[0]) >= '02:00:00.000'){
                    DB::table('employees_vacations')->insert([
                        'employee_id' => $column[0],
                        'vacation_id' => 2,
                        'vacationDate' => $column[1],
                        'type_id' => 2,
                        'duration' => 1,
                        'reason' => 'more than 2 hours late',
                        'isAuthor' => Null,
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
                        'vacationDate' => $column[1],
                        'type_id' => 2,
                        'duration' => 0,
                        'reason' => '',
                        'isAuthor' => Null,
                        'discount' => Null,
                        'isCheck' => 0,
                    ]);
                  }
                }

                if($logout < '15:25'){
                    if(in_array($this->get_hourly_late_execuses($column[0], $column[1]), $lateTypes)){
                    $logoutLate = Carbon::parse($logout)->diff(Carbon::parse($CheckOut));
                    $logoutHour = $logoutLate->h;
                    $logoutMin = $logoutLate->i;
                    $userId = DB::table('employees')->where('id', $column[0])->first();
                    $totalLate = Carbon::parse($userId->hourlyVac)->addHours($logoutHour)->addMinutes($logoutMin);
                    DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $totalLate]);
                    if($this->get_hourly_vac_count($column[0]) >= '07:00:00.000'){
                    DB::table('employees_vacations')->insert([
                        'employee_id' => $column[0],
                        'vacation_id' => 2,
                        'vacationDate' => $column[1],
                        'type_id' => 1,
                        'duration' => 1,
                        'reason' => 'more than 7 hours late',
                        'isAuthor' => Null,
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
                        'vacationDate' => $column[1],
                        'type_id' => 1,
                        'duration' => 0,
                        'reason' => '',
                        'isAuthor' => Null,
                        'discount' => Null,
                        'isCheck' => 0,
                    ]);
                  }
                }
              }

                if($login > '09:25' && $login <= '12:10'){
                    if(in_array($this->get_hourly_late_execuses($column[0], $column[1]), $lateTypes)){
                        $loginLate = Carbon::parse($login)->diff(Carbon::parse($CheckIn));
                        $loginHour = $loginLate->h;
                        $loginMin = $loginLate->i;
                        $userId = DB::table('employees')->where('id', $column[0])->first();
                        $totalLate = Carbon::parse($userId->hourlyVac)->addHours($loginHour)->addMinutes($loginMin);
                        DB::table('employees')->where('id', $column[0])->update(['hourlyVac' => $totalLate]);
                        if($this->get_hourly_vac_count($column[0]) >= '07:00:00.000'){
                        DB::table('employees_vacations')->insert([
                            'employee_id' => $column[0],
                            'vacation_id' => 2,
                            'vacationDate' => $column[1],
                            'type_id' => 1,
                            'duration' => 1,
                            'reason' => 'more than 7 hours late',
                            'isAuthor' => Null,
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
                            'vacationDate' => $column[1],
                            'type_id' => 1,
                            'duration' => 0,
                            'reason' => '',
                            'isAuthor' => Null,
                            'discount' => Null,
                            'isCheck' => 0,
                        ]);
                    }
                }
            }

                if($login > '12:10'){
                    DB::table('employees_vacations')->insert([
                        'employee_id' => $column[0],
                        'vacation_id' => 2,
                        'vacationDate' => $column[1],
                        'type_id' => 1,
                        'duration' => 1,
                        'reason' => 'More than 3 hours late',
                        'isAuthor' => Null,
                        'discount' => Null,
                        'isCheck' => 1
                    ]);
                }

                if($login == null || $logout == null){
                    DB::table('employees_vacations')->insert([
                        'employee_id' => $column[0],
                        'vacation_id' => 1,
                        'vacationDate' => $column[1],
                        'type_id' => 1,
                        'duration' => 1,
                        'reason' => 'No Login or Logout Time',
                        'isAuthor' => Null,
                        'discount' => Null,
                        'isCheck' => 1
                    ]);
                }
                $duration = Carbon::parse($login)->diff(Carbon::parse($logout));
                $duration = $duration->h . ":" . $duration->i;
            }else{
                $column[2] = null;
                $login = null;
                $logout = null;
                $duration = null;
                DB::table('employees_vacations')->insert([
                    'employee_id' => $column[0],
                    'vacation_id' => 1,
                    // 'requestDate' => $column[1],
                    'vacationDate' => $column[1],
                    'type_id' => 1,
                    'duration' => 1,
                    'reason' => 'No Attendance Log For This Day',
                    'isAuthor' => Null,
                    'discount' => Null,
                    'isCheck' => 1
                ]);
            }

            return new Attendee([
                'employee_id' => $column[0],
                'logDate' => $column[1],
                'logTime' => $column[2],
                'logIn' => $login,
                'logOut' => $logout,
                'duration' => $duration,
            ]);
       }

    //  elseif(in_array(Carbon::parse($this->get_weekend_days_with_vacation($column[0], $column[1]))->format('l'),$weekendDate)  && in_array(Carbon::parse($column[1])->format('Y-m-d'),$holidayDate)){
        if(in_array(Carbon::parse($this->get_weekend_days_with_vacation($column[0], $column[1]))->format('l'),$weekendDate)  && in_array(Carbon::parse($this->get_weekend_days_with_vacation($column[0], $column[1]))->format('Y-m-d'),$holidayDate)){
        return new Attendee([
            'employee_id' => $column[0],
            'logDate' => $column[1],
            'logTime' => null,
            'logIn' => null,
            'logOut' => null,
            'duration' => null,
        ]);
    }
    
    }

     
    public function startRow(): int
    {
        return 2;
    }
}
