<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Weekend;
use App\Models\Center;
use App\Models\Holiday;
use App\Models\Employee;
use App\Models\EmployeesVacation;
use App\Models\EmployeesPosition;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use DB;


class HolidaysList extends Component
{

    use WithPagination;
    public $OfficialHoliday = false;
    protected $paginationTheme = 'bootstrap';
    public $holiday;
    public $perInfo=[];
    public $showEditHolidayForm = false;
    public $deleteHolidayId = null;
    public $weekend;
    public $showEditWeekendForm = false;
    public $deleteWeekendId = null;
    // public $employeesCenter = null;


    public function render()
    {

        
        // $officialHolidayCount = Holiday::all()->unique('holidayName')->count();
        $officialHolidayCount = Holiday::all()->count();
        
        $officialHolidays = Holiday::paginate(10);

        $centers = Center::all();
        
        $weekends = Weekend::all();

        $employees = Employee::all();

        // if(isset($this->perInfo['centerId'])){
        //     foreach($this->perInfo['centerId'] as $empCenter){
        // $this->employeesCenter = EmployeesPosition::where([['center_id', $empCenter], ['endDate', null]])->get();
        //     }

        // }

        return view('livewire.admin.holidays-list', [
            'officialHolidayCount' => $officialHolidayCount,
            'officialHolidays' => $officialHolidays,
            'OfficialHoliday' => $this->OfficialHoliday,
            'centers' => $centers,
            'weekends' => $weekends,
            'employees' => $employees,
            // 'employeesCenter' => $employeesCenter,
        ]);
    }

    public function show_official_holiday(){

         $this->OfficialHoliday = true;
    }

    public function new_holiday()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'holidayName' => 'required',
            'holidayFirstDate' => 'required',
            'holidaySecondDate' => 'required',
            'note' => 'required',
        ])-> validate();

        for($i=Carbon::parse($validatedData['holidayFirstDate'])->copy(); $i <= Carbon::parse($validatedData['holidaySecondDate']); $i->addDays()){
        $validatedData['holidayDate'] = $i;
        
        $centerHoliday = Holiday::create($validatedData);
        $centerHoliday->centers()->sync(Center::all());
    }

        $centerHoliday->centers()->sync(Center::all());

        $this->dispatchBrowserEvent('hide_holiday_form', ['message' => 'Holiday added successfully']);
    }

    public function new_weekend()
    {
              foreach(Center::get('id') as $showWeek){
                  $showWeek->weekends()->sync($this->perInfo['weekendId']);
              }

              
        $this->dispatchBrowserEvent('hide_holiday_form', ['message' => 'Weekend added successfully']);
    }

    public function new_employee_vacation(){
        
            if($this->perInfo['countId'] != 0){

                if($this->perInfo['centerId'] != null){
                    foreach($this->perInfo['centerId'] as $empCenter){
              $employeesCenter = EmployeesPosition::where([['center_id', $empCenter], ['endDate', null]])->get('employee_id');
            }

                    foreach($employeesCenter as $vacCountCenter){
                        DB::table('employees')->where('id', $vacCountCenter->employee_id)->increment('vacationCount', $this->perInfo['countId']);
             }
                }

                if($this->perInfo['centerId'] == null){
                foreach($this->perInfo['employeeId'] as $vacCountEmp){
        DB::table('employees')->where('id', $vacCountEmp)->increment('vacationCount', $this->perInfo['countId']);
                }
            }
            $this->dispatchBrowserEvent('hide_holiday_form', ['message' => 'Employee(s) Vacation Count added successfully']);
            
        }else{
            $validatedData =  Validator::make($this->perInfo, [
                'firstTime' => 'required',
                'secondTime' => 'required',
                'vacationDate' => 'required',
                'reason' => 'required',
            ])-> validate();
            $time1 = (string)$this->perInfo['firstTime'];
            $time2 = (string)$this->perInfo['secondTime'];
            $time = Carbon::parse($time2)->diff(Carbon::parse($time1));
            $time = $time->h. ':'. $time->i;
// dd($time);
                if($time > '4:00'){ 
                    $this->dispatchBrowserEvent('error_holiday_form', ['message' => 'Sorry The Time Should Be Equal Or Under 4 Hours']);
                }if($time <= '4:00'){
                    if($this->perInfo['centerId'] != null){
                        foreach($this->perInfo['centerId'] as $empCenter){
                  $employeesCenter = EmployeesPosition::where([['center_id', $empCenter], ['endDate', null]])->get('employee_id');
                }
    
                        foreach($employeesCenter as $vacCountCenter){
                            DB::table('employees_vacations')->insert(['employee_id' => $vacCountCenter->employee_id, 'vacation_id' => 2, 'vacationDate' => Carbon::parse($this->perInfo['vacationDate'])->format('Y-m-d'), 'type_id' => 18, 'duration' => (string)$time, 'reason' => $this->perInfo['reason'], 'isAuthor' => 1]);  
                 }
                    }
    
                    if($this->perInfo['centerId'] == null){
                    foreach($this->perInfo['employeeId'] as $vacCountEmp){
                DB::table('employees_vacations')->insert(['employee_id' => $vacCountEmp, 'vacation_id' => 2, 'vacationDate' => Carbon::parse($this->perInfo['vacationDate'])->format('Y-m-d'), 'type_id' => 18, 'duration' => (string)$time, 'reason' => $this->perInfo['reason'], 'isAuthor' => 1]);     
                    }
                }
                    $this->dispatchBrowserEvent('hide_holiday_form', ['message' => 'Employee Vacation added successfully']);
                }
        }

    }


    public function show_edit_holiday_form(Holiday $holiday)
    {
        $this->showEditHolidayForm = true;
        $this->holiday = $holiday;
        $this->perInfo = $holiday->toArray();

        $this->dispatchBrowserEvent('show_holiday_form');
    }

    public function edit_holiday()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'holidayName' => 'required',
            'holidayDate' => 'required',
            'note' => 'required',
        ])-> validate();
        
        $this->holiday->update($validatedData);
        $this->showEditHolidayForm = false;
        $this->dispatchBrowserEvent('hide_holiday_form', ['message' => 'Holiday updated successfully']);
    }

    public function show_conformation_modal($id)
    {
        $this->deleteHolidayId = $id;
        
        $this->dispatchBrowserEvent('show_conformation_model');
    }

    public function delete_holiday()
    {
        $holiday = Holiday::findOrFail($this->deleteHolidayId);

        $holiday->delete();

        $holiday->centers()->detach(Center::all());

        $this->dispatchBrowserEvent('hide_conformation_model', ['message' => 'Holiday deleted successfully']);
    }

    public function mount(){
        $this->perInfo['countId']=0;
  }
  
}
