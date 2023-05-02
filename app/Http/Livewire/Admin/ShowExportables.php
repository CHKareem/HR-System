<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Center;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Exports\ExportCustomEmployee;
use App\Exports\ExportCustomEmployeeCenter;
use App\Exports\ExportCustomEmployeePosition;
use App\Exports\ExportCustomEmployeeInfos;
use App\Exports\ExportCustomEmployeeDepartment;
use Maatwebsite\Excel\Facades\Excel;



class ShowExportables extends Component
{

    public $perInfo=[];


    public function render()
    {
        $centers = Center::all();
        
        $departments = Department::all();

        $employees = Employee::all();

        $positions = Position::all();

        return view('livewire.admin.show-exportables',[
            'centers' => $centers,
            'departments' => $departments,
            'employees' => $employees,
            'positions' => $positions,
        ]);
    }

    public function export_employees(){

        // return (new ExportCustomEmployee($this->perInfo['employeeId'], $this->perInfo['firstDate'], $this->perInfo['secondDate']))
        // ->download('CustomExportedEmployees.xlsx'); 
        if(!isset($this->perInfo['employeeId'])){
            $this->perInfo['employeeId'] = [];
        }
        if(!isset($this->perInfo['firstDate'])){
            $this->perInfo['firstDate'] = [];
        }
        if(!isset($this->perInfo['secondDate'])){
            $this->perInfo['secondDate'] = [];
        }
        return Excel::download(new ExportCustomEmployee([$this->perInfo['employeeId'], $this->perInfo['firstDate'], $this->perInfo['secondDate']]), 'CustomExportedEmployees.xlsx');
    }

    public function export_employees_centers(){
        // $validatedData =  Validator::make($this->perInfo, [
        //     'employeeId' => 'required',
        //     'firstDate' => 'required',
        //     'secondDate' => 'required',
        //     'centerId' => 'required',
        // ])-> validate();

        if(!isset($this->perInfo['employeeId'])){
            $this->perInfo['employeeId'] = [];
        }
        if(!isset($this->perInfo['firstDate'])){
            $this->perInfo['firstDate'] = [];
        }
        if(!isset($this->perInfo['secondDate'])){
            $this->perInfo['secondDate'] = [];
        }
        if(!isset($this->perInfo['centerId'])){
            $this->perInfo['centerId'] = [];
        }
        return Excel::download(new ExportCustomEmployeeCenter([$this->perInfo['employeeId'], $this->perInfo['firstDate'], $this->perInfo['secondDate'], $this->perInfo['centerId']]), 'CustomExportedEmployeesCenters.xlsx');
    }

    public function export_employees_departments(){
        // $validatedData =  Validator::make($this->perInfo, [
        //     'employeeId' => 'required',
        //     'firstDate' => 'required',
        //     'secondDate' => 'required',
        //     'departmentId' => 'required',
        // ])-> validate();

        if(!isset($this->perInfo['employeeId'])){
            $this->perInfo['employeeId'] = [];
        }
        if(!isset($this->perInfo['firstDate'])){
            $this->perInfo['firstDate'] = [];
        }
        if(!isset($this->perInfo['secondDate'])){
            $this->perInfo['secondDate'] = [];
        }
        if(!isset($this->perInfo['departmentId'])){
            $this->perInfo['departmentId'] = [];
        }
        return Excel::download(new ExportCustomEmployeeDepartment([$this->perInfo['employeeId'], $this->perInfo['firstDate'], $this->perInfo['secondDate'], $this->perInfo['departmentId']]), 'CustomExportedEmployeesDepartments.xlsx');
    }

    public function export_employees_positions(){
        // $validatedData =  Validator::make($this->perInfo, [
        //     'employeeId' => 'required',
        //     'firstDate' => 'required',
        //     'secondDate' => 'required',
        //     'positionId' => 'required',
        // ])-> validate();

        if(!isset($this->perInfo['employeeId'])){
            $this->perInfo['employeeId'] = [];
        }
        if(!isset($this->perInfo['firstDate'])){
            $this->perInfo['firstDate'] = [];
        }
        if(!isset($this->perInfo['secondDate'])){
            $this->perInfo['secondDate'] = [];
        }
        if(!isset($this->perInfo['positionId'])){
            $this->perInfo['positionId'] = [];
        }
        return Excel::download(new ExportCustomEmployeePosition([$this->perInfo['employeeId'], $this->perInfo['firstDate'], $this->perInfo['secondDate'], $this->perInfo['positionId']]), 'CustomExportedEmployeesPositions.xlsx');
    }

    public function export_employees_infos(){
        // $validatedData =  Validator::make($this->perInfo, [
        //     'employeeId' => 'required',
        //     'firstDate' => 'required',
        //     'secondDate' => 'required',
        //     'centerId' => 'required',
        //     'departmentId' => 'required',
        //     'positionId' => 'required',
        // ])-> validate();

        if(!isset($this->perInfo['employeeId'])){
            $this->perInfo['employeeId'] = [];
        }
        if(!isset($this->perInfo['firstDate'])){
            $this->perInfo['firstDate'] = [];
        }
        if(!isset($this->perInfo['secondDate'])){
            $this->perInfo['secondDate'] = [];
        }
        if(!isset($this->perInfo['positionId'])){
            $this->perInfo['positionId'] = [];
        }
        if(!isset($this->perInfo['departmentId'])){
            $this->perInfo['departmentId'] = [];
        }
        if(!isset($this->perInfo['centerId'])){
            $this->perInfo['centerId'] = [];
        }
        return Excel::download(new ExportCustomEmployeeInfos([$this->perInfo['employeeId'], $this->perInfo['firstDate'], $this->perInfo['secondDate'], $this->perInfo['departmentId'], $this->perInfo['centerId'], $this->perInfo['positionId']]), 'CustomExportedEmployeesInfos.xlsx');

    }


}
