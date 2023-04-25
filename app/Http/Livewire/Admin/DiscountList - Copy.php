<?php

namespace App\Http\Livewire\Admin;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Center;
use App\Models\Holiday;
use App\Models\EmployeesVacation;
use App\Models\Vacation;
use App\Models\Vacationtype;
use App\Models\Attendee;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use DatePeriod;
use DateInterval;
use DB;

class DiscountList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $employee;
    public $firstDate;
    public $secondDate;
    public $VacationName;
    public $VacationType;
    public $holidayCount = 0;
    public $weekendCount = 0;



    public function render()
    {
        $vacationNames = Vacation::all();
        $vacationTypes = Vacationtype::all();
        $employees = Employee::paginate(10);

        $daysDuration = (Carbon::parse($this->secondDate)->diffInDays(Carbon::parse($this->firstDate)))+1;
        $centers = Center::all();
        $holidays = Holiday::all();
    foreach($centers as $center){}
            
            foreach($center->weekends as $centweek){

                $weekendDate[] = $centweek->dayName;

                } 
            
                foreach($holidays as $holiday){
    
                    $holidayDate[] = $holiday->holidayDate;
    
                    } 
        $period = CarbonPeriod::create(Carbon::parse($this->firstDate), Carbon::parse($this->secondDate));
        $dates = $period->toArray();

        $this->weekendCount = 0;
        $this->holidayCount = 0;
        foreach($dates as $date){

            if(in_array(Carbon::parse($date)->format('l'),$weekendDate) && !in_array(Carbon::parse($date)->format('Y-m-d'),$holidayDate)){
                 $this->weekendCount++;
            }

            if(in_array(Carbon::parse($date)->format('Y-m-d'),$holidayDate)){
                 $this->holidayCount++;
            }
        }


        $employeesVacations = EmployeesVacation::select('discount', 'vacation_id', 'type_id', 'employee_id')->
        where([['vacation_id', $this->VacationName], ['type_id', $this->VacationType]])->
        whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->distinct('discount', 'vacation_id', 'type_id', 'employee_id')->paginate(5);
        return view('livewire.admin.discount-list', [
            'vacationNames' => $vacationNames,
            'vacationTypes' => $vacationTypes,
            'employeesVacations' => $employeesVacations,
            'employees' => $employees,
            'daysDuration' => $daysDuration,
            'weekendCount' =>  $this->weekendCount,
            'holidayCount' =>  $this->holidayCount,
        ]);
    }

    public function full_absence_number($empId){

        return Attendee::select('id', 'logDate', 'employee_id')->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->
        where([['logTime', null], ['employee_id', $empId]])->distinct('logDate', 'employee_id', 'id')->count();

    }

    public function no_login_absence_number($empId){

        return Attendee::select('id', 'logDate', 'employee_id')->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->
        where([['logIn', null], ['employee_id', $empId], ['logOut', '!=', null], ['duration', null]])->distinct('logDate', 'employee_id', 'id')->count();

    }

    public function no_logout_absence_number($empId){

        return Attendee::select('id', 'logDate', 'employee_id')->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->
        where([['logOut', null], ['employee_id', $empId], ['logIn', '!=', null],['duration', null]])->distinct('logDate', 'employee_id', 'id')->count();

    }

    public function round_hours_absence_number($empId){

        return EmployeesVacation::whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->
        where([['employee_id', $empId], ['reason', 'LIKE', 'more than %']])->distinct('employee_id', 'id')->count();

    }

    public function no_attendances_absence_number($empId){

        return EmployeesVacation::whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->
        where([['employee_id', $empId], ['reason', 'LIKE', 'No Attendance %']])->distinct('employee_id', 'id')->count();

    }

    public function authorized_absence_number($empId){

        return EmployeesVacation::whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->
        where([['employee_id', $empId], ['isAuthor', 1], ['vacation_id', 1], ['type_id', 1]])->distinct('employee_id', 'id')->count();

    }

    public function decrement_vacation_count($firstNumber, $secondNumber, $empId){
        if($firstNumber != 0){
                $subCount = $firstNumber - $secondNumber;
                $totalCount = 0;
                $discountCount = 0;
                if($subCount <= 0){
                    $totalCount = 0;
                    $discountCount = $subCount;
                }else{
                    $totalCount = $subCount;
                    $discountCount = 0;
                }

                
              //  DB::table('employees_vacations')->where('id', $empId)->update(['discount' => $subCount]);
                DB::table('employees')->where('id', $empId)->update(['vacationCount' => $totalCount]);
                DB::table('employees_vacations')->where([['employee_id', $empId], ['vacation_id', $this->VacationName], ['type_id', $this->VacationType]])->whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->update(['discount' => $discountCount]);


            }else{
                $subCount2 = $firstNumber - $secondNumber;
                DB::table('employees_vacations')->where([['employee_id', $empId], ['vacation_id', $this->VacationName], ['type_id', $this->VacationType]])->whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->update(['discount' => $subCount2]);
            }
               
        }

        public function get_duration_count($empId){
            return EmployeesVacation::whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->where([['employee_id', $empId], ['vacation_id', $this->VacationName], ['type_id', $this->VacationType], ['isCheck', 1]])->count();
        }

        public function get_duration_hourly_count($empId){
            return EmployeesVacation::where([['employee_id', $empId], ['vacation_id', $this->VacationName], ['type_id', $this->VacationType], ['isCheck', 1]])->distinct('isCheck')->count('duration');
        }

        public function get_max_vacation_count($empId){
            $vacCounts = Employee::where('id', $empId)->get('vacationCount');
            foreach($vacCounts as $vacCount){
                return $vacCount->vacationCount;
            }
        }
}
