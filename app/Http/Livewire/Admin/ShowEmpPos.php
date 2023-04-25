<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Center;
use App\Models\Department;
use App\Models\EmployeesPosition;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use DB;

class ShowEmpPos extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $rules =[
        'getEmployeePositions.*.position_id' => 'required',
        'getEmployeePositions.*.center_id' => 'required',
        'getEmployeePositions.*.department_id' => 'required',
        'getEmployeePositions.*.startDate' => 'required',
        'getEmployeePositions.*.endDate' => 'nullable',
    ];

    
    public $showdivEmployee = false;
    public $showdivEdit = false;
    public $showdivPosition = false;
    public $showdivDepartment = false;
    public $showdivCenter = false;
    public $searchEmployee = "";
    public $recordsEmployee;
    public $searchEdit = "";
    public $recordsEdit;
    public $empDetails;
    public $empEditDetails;
    public $searchPosition = "";
    public $recordsPosition;
    public $getEmployeePositions = Null;
    public $searchDepartment = "";
    public $recordsDepartment;
    public $searchCenter = "";
    public $recordsCenter;
    public $posDetails;
    public $depDetails;
    public $centDetails;
    public $startDate;
    public $endDate;


    public function render()
    {
        $positions = Position::get();
        $centers = Center::get();
        $departments = Department::get();
        return view('livewire.admin.show-emp-pos', [
            'positions' => $positions,
            'centers' => $centers,
            'departments' => $departments,
        ]);
    }

    
    // Fetch records
    public function searchResult(){

        if(!empty($this->searchEmployee)){

            $this->recordsEmployee = Employee::where('fullName','like','%'.$this->searchEmployee.'%')
                      ->limit(5)
                      ->get();          
            $this->showdivEmployee = true;
        }else{
            $this->showdivEmployee = false;
        }

    }

    public function searchResultEdit(){

        if(!empty($this->searchEdit)){

            $this->recordsEdit = Employee::where('fullName','like','%'.$this->searchEdit.'%')
                      ->limit(5)
                      ->get();         
            $this->showdivEdit = true;
        }else{
            $this->showdivEdit = false;
        }

    }

    public function searchResultPosition(){

        if(!empty($this->searchPosition)){

            $this->recordsPosition = Position::where('positionName','like','%'.$this->searchPosition.'%')
                      ->limit(5)
                      ->get();         
            $this->showdivPosition = true;
        }else{
            $this->showdivPosition = false;
        }

    }

    public function searchResultDepartment(){

        if(!empty($this->searchDepartment)){

            $this->recordsDepartment = Department::where('departmentName','like','%'.$this->searchDepartment.'%')
                      ->limit(5)
                      ->get();         
            $this->showdivDepartment = true;
        }else{
            $this->showdivDepartment = false;
        }

    }

    public function searchResultCenter(){

        if(!empty($this->searchCenter)){

            $this->recordsCenter = Center::where('centerName','like','%'.$this->searchCenter.'%')
                      ->limit(5)
                      ->get();         
            $this->showdivCenter = true;
        }else{
            $this->showdivCenter = false;
        }

    }

    // Fetch record by ID
    public function fetchEmployeeDetail($id = 0){

        $recordEmployee = Employee::select('*')
                    ->where('id',$id)
                    ->first();

        $this->searchEmployee = $recordEmployee->id;
        $this->empDetails = $recordEmployee;
        $this->showdivEmployee = false;
    }

    public function fetchEmployeeDetailEdit($id = 0){

        $recordEdit = Employee::select('*')
        ->where('id',$id)
        ->first();

        $this->searchEdit = $recordEdit->id;
        $this->empEditDetails = $recordEdit;
        $this->showdivEdit = false;
        $this->getEmployeePositions = DB::table('employees_positions')->select('*')->where('employee_id', $this->searchEdit)->get();

    }

    public function fetchPositionDetail($id = 0){

        $recordPosition = Position::select('*')
        ->where('id',$id)
        ->first();

        $this->searchPosition = $recordPosition->id;
        $this->posDetails = $recordPosition;
        $this->showdivPosition = false;
    }

    public function fetchDepartmentDetail($id = 0){

        $recordDepartment = Department::select('*')
        ->where('id',$id)
        ->first();

        $this->searchDepartment = $recordDepartment->id;
        $this->depDetails = $recordDepartment;
        $this->showdivDepartment = false;
    }

    public function fetchCenterDetail($id = 0){

        $recordCenter = Center::select('*')
        ->where('id',$id)
        ->first();

        $this->searchCenter = $recordCenter->id;
        $this->centDetails = $recordCenter;
        $this->showdivCenter = false;
    }
    
    // New Employees Positions
    public function new_employee_position(){
        EmployeesPosition::create([
        'employee_id' => $this->searchEmployee, 
        'position_id' => $this->searchPosition, 
        'center_id' => $this->searchCenter,
        'department_id' => $this->searchDepartment,
        'startDate' => $this->startDate, 
        'endDate' => $this->endDate]);

        $this->dispatchBrowserEvent('show_success_message', ['message' => 'Position For The Employee Added Successfully']);
    }

    public function edit_employee_position(){
        $this->validate();

        foreach($this->getEmployeePositions as $getEmployeePosition){
            EmployeesPosition::where([['employee_id', $this->searchEdit],['id', $getEmployeePosition['id']]])->update($getEmployeePosition);
        }

        $this->dispatchBrowserEvent('show_update_message', ['message' => 'Position For The Employee Updated Successfully']);

    }


}
