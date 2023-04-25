<?php

namespace App\Http\Livewire\Admin;

use App\Models\Center;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use App\Models\EmployeesPosition;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use DB;


class EmployeesList extends Component
{
    // Pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    // Objects
    public $employee;
    public $earlyPoses;
    public $allEmployees = true;
    public $noPaymentVacationCount = false;
    public $healthVacationCount = false;
    public $unlinkEmployees = false;
    public $getEmployeeInfos = null;
    public $perInfo=[];
    public $showEditEmployerForm = false;
    public $showPositionEmployerForm = false;
    public $deleteEmployeeId = null;
    public $unlinkEmployeeId = null;
    public $linkEmployeeId = null;

    // Render
    public function render()
    {
        $employees = Employee::get();
        $employeesNoPaymentVacationCounts = Employee::where('noPaymentCount', '>', 30)->paginate(5);
        $employeesHealthVacationCounts = Employee::where('healthCount', '>', 15)->paginate(5);
        $employeesUnlinked = Employee::where('isActive', '=', 0)->paginate(5);
        $isActiveCount = Employee::where('isActive','=', 1)->count();
        $isInActiveCount = Employee::where('isActive','=', 0)->count();

        return view('livewire.admin.employees-list', [
            'employees' => $employees,
            'employeesUnlinked' => $employeesUnlinked,
            'isActiveCount' => $isActiveCount, 'isInActiveCount' => $isInActiveCount,
            'employeesNoPaymentVacationCounts' => $employeesNoPaymentVacationCounts,
            'employeesHealthVacationCounts' => $employeesHealthVacationCounts,
        ]);
    }

    // Show import form
    public function show_import_form()
    {
        $this->dispatchBrowserEvent('show_import_form');
    }

    // Show new form
    public function show_new_employer_form()
    {
        $this->getEmployeeInfos = null;
        $this->perInfo = [];
        $this->showEditEmployerForm = false;

        $this->dispatchBrowserEvent('show_employer_form');
    }

    public function show_new_position_employer_form()
    {
        $this->perInfo = [];
        $this->showPositionEmployerForm = true;
        $this->dispatchBrowserEvent('show_position_employer_form');
    }
    
    // New employer
    public function new_employer()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'id' => 'required|unique:employees',
            'nationalNumber' => 'required|unique:employees',
            'firstName' => 'required',
            'fatherName' => 'required',
            'lastName' => 'required',
            'motherName' => 'required',
            'degree' => 'nullable',
            'address' => 'nullable',
            'mobile' => 'required|unique:employees',
            'birthAndPlace' => 'required',
            'gender' => 'required',
            'startDate' => 'required',
            'quitDate' => 'nullable',
            'isActive' => 'required',
            'notes' => 'nullable',
            // 'department_id' => 'required',
            // 'center_id' => 'required',
        ])-> validate();

        $validatedData['firstName'] = ucfirst($validatedData['firstName']);
        $validatedData['fatherName'] = ucfirst($validatedData['fatherName']);
        $validatedData['lastName'] = ucfirst($validatedData['lastName']);
        $validatedData['motherName'] = ucfirst($validatedData['motherName']);

        $validatedData['fullName'] = $validatedData['firstName']  . ' ' . $validatedData['fatherName'] . ' ' .  $validatedData['lastName'];

        $validatedData['vacationCount'] = 1;

        Employee::create($validatedData);

        $this->dispatchBrowserEvent('hide_employer_form', ['message' => 'Employee added successfully']);
    }

    // Show edit form
    public function show_edit_employer_form(Employee $employee)
    {
        $this->earlyPoses = null;
        $this->getEmployeeInfos = null;
        $this->showEditEmployerForm = true;
        $this->employee = $employee;
        $this->perInfo = $employee->toArray();

        $this->dispatchBrowserEvent('show_employer_form');
    }

    // Edit employer
    public function edit_employer()
    {

        $validatedData =  Validator::make($this->perInfo, [
            'id' => 'required',
            'nationalNumber' => 'required',
            'firstName' => 'required',
            'fatherName' => 'required',
            'lastName' => 'required',
            'motherName' => 'required',
            'degree' => 'nullable',
            'address' => 'nullable',
            'mobile' => 'required',
            'birthAndPlace' => 'required',
            'gender' => 'required',
            'startDate' => 'required',
            'quitDate' => 'nullable',
            'isActive' => 'required',
            'notes' => 'nullable',
            // 'department_id' => 'required',
            // 'center_id' => 'required',
        ])-> validate();

        $validatedData['firstName'] = ucfirst($validatedData['firstName']);
        $validatedData['fatherName'] = ucfirst($validatedData['fatherName']);
        $validatedData['lastName'] = ucfirst($validatedData['lastName']);
        $validatedData['motherName'] = ucfirst($validatedData['motherName']);

        $validatedData['fullName'] = $validatedData['firstName']  . ' ' . $validatedData['fatherName'] . ' ' .  $validatedData['lastName'];

        $this->employee->update($validatedData);

        $this->dispatchBrowserEvent('hide_employer_form', ['message' => 'Employee updated successfully']);
    }

    // Unlink conformation
    public function show_unlink_conformation_model($employeeId)
    {
        $this->linkEmployeeId = $employeeId;
        $this->dispatchBrowserEvent('show_unlink_conformation_model');
    }

    // Unlink
    public function unlink_employee()
    {
        $employee = Employee::findOrFail($this->linkEmployeeId);
        $updated = Employee::where('id' , '=', $employee->id)->update(['isActive' => 0]);

        $this->dispatchBrowserEvent('hide_unlink_conformation_model', ['message' => 'Employee unlink successfully']);
    }

    // Relink conformation
    public function show_relink_conformation_model($employeeId)
    {
        $this->linkEmployeeId = $employeeId;
        $this->dispatchBrowserEvent('show_relink_conformation_model');
    }

    // Relink
    public function relink_employee()
    {
        $employee = Employee::findOrFail($this->linkEmployeeId);

        $updated = Employee::where('id' , '=', $employee->id)->update(['isActive' => 1]);
        $this->dispatchBrowserEvent('hide_relink_conformation_model', ['message' => 'Employee relink successfully']);
    }


    // Delete conformation
    public function show_delete_conformation_model($employeeId)
    {
        $this->deleteEmployeeId = $employeeId;
        $this->dispatchBrowserEvent('show_delete_conformation_model');
    }

    // Info conformation
    public function show_info_conformation_model(Employee $employee)
    {
        $this->earlyPoses = null;
        $this->getEmployeeInfos = null;
        // $this->getEmployeeInfos = Employee::where('id', $employee->id)->get();
        $this->emit('empID', $employee->id);
        $this->dispatchBrowserEvent('show_info_conformation_model');

    }

    // Delete
    public function delete_employee()
    {
        $employee = Employee::findOrFail($this->deleteEmployeeId);
        try {
            $employee->delete();
            $this->dispatchBrowserEvent('hide_conformation_model', ['message' => 'Employee deleted successfully']);
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->dispatchBrowserEvent('no_hide_conformation_model', ['message' => 'Cannot Delete With Data Related To IT']);
        }
    }

    public function show_all_employees()
    {
        $this->allEmployees = true;
        $this->healthVacationCount = false;
        $this->noPaymentVacationCount = false;
        $this->unlinkEmployees = false;
    }

    public function show_no_payment_vacation_employees()
    {
        $this->noPaymentVacationCount = true;
        $this->healthVacationCount = false;
        $this->allEmployees = false;
        $this->unlinkEmployees = false;
    }

    public function show_health_vacation_employees()
    {
        $this->healthVacationCount = true;
        $this->noPaymentVacationCount = false;
        $this->allEmployees = false;
        $this->unlinkEmployees = false;
    }

    public function show_unlink_employees()
    {
        $this->healthVacationCount = false;
        $this->noPaymentVacationCount = false;
        $this->allEmployees = false;
        $this->unlinkEmployees = true;
    }

}
