<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use App\Models\Center;
use App\Models\EmployeesPosition;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;


class ShowEmpInfo extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $getemployeePositionWithoutEndDate = null;
    public $getemployeeDepartmentWithoutEndDate = null;
    public $getemployeeCenterWithoutEndDate = null;
    public $getPositionName = null;
    public $getEmployeeInfos = null;
    public $employeeId = null;
    protected $listeners = ['empID'];


    public function render()
    {
        return view('livewire.admin.show-emp-info');
    }

    public function empID($empId){
        $this->employeeId = $empId;
        $this->getEmployeeInfos = Employee::where('id', $empId)->get();
        $getPositionNames = EmployeesPosition::where([['endDate', Null], ['employee_id',  $empId]])->first();
        $this->getPositionName = $getPositionNames;
        if($getPositionNames !== null){
        $this->getemployeePositionWithoutEndDate = Position::where('id', $getPositionNames->position_id)->first();
        $this->getemployeeDepartmentWithoutEndDate = Department::where('id', $getPositionNames->department_id)->first();
        $this->getemployeeCenterWithoutEndDate = Center::where('id', $getPositionNames->center_id)->first();
    }
  }
}
