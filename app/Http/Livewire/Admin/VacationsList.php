<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
use App\Models\Vacation;
use App\Models\Vacationtype;
use App\Models\EmployeesVacation;
use Illuminate\Support\Facades\Validator;


class VacationsList extends Component
{

    use WithPagination;
    public $employeeVacationVariable;
    public $FullName;
    public $vacation;
    public $vacationType;
    public $employeesVacation;
    public $firstDate;
    public $secondDate;
    public $perInfo=[];
    public $showEditEmployeeVacationForm = false;
    protected $paginationTheme = 'bootstrap';
    public $showEditVacationTypeForm = false;
    public $showEditVacationNameForm = false;
    public $VacationType = false;
    public $VacationName = false;
    public $EmployeesVacations = false;
    public $deleteVacationTypeId = null;
    public $deleteVacationNameId = null;
    public $deleteEmployeesVacationsId = null;
    public $showdivEmployee = false;
    public $searchEmployee = "";
    public $recordsEmployee;


    public function render()
    {
        $employees = Employee::all();
        $vacations = Vacation::paginate(5);
        $vacationTypes = Vacationtype::paginate(5);
        $vacationNamesAll = Vacation::all();
        $vacationTypesAll = Vacationtype::all();
        $officialVacationNameCount = Vacation::all()->unique('vacationName')->count();
        $officialVacationTypeCount = Vacationtype::all()->unique('vacationType')->count();
        $employeesVacations = EmployeesVacation::whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->paginate(5);
        $employeesVacationsForUsers = EmployeesVacation::whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->where('employee_id', $this->searchEmployee)->paginate(5);
        $employeesVacationsCount = EmployeesVacation::whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->count();


        return view('livewire.admin.vacations-list', [
            'employees' => $employees,
            'vacations' => $vacations,
            'vacationTypes' => $vacationTypes,
            'vacationNamesAll' => $vacationNamesAll,
            'vacationTypesAll' => $vacationTypesAll,
            'officialVacationNameCount' => $officialVacationNameCount,
            'officialVacationTypeCount' => $officialVacationTypeCount,
            'VacationType' => $this->VacationType,
            'VacationName' => $this->VacationName,
            'EmployeesVacations' => $this->EmployeesVacations,
            'employeesVacations' => $employeesVacations,
            'employeesVacationsForUsers' => $employeesVacationsForUsers,
            'employeesVacationsCount' => $employeesVacationsCount,
        ]);
    }

    public function show_vacation_type(){
        $this->VacationType= true;
        $this->VacationName= false;
        $this->EmployeesVacations = false;
   }

    public function show_vacation_name(){
        $this->VacationName= true;
        $this->VacationType= false;
        $this->EmployeesVacations = false;
   }

   public function show_employees_vacations(){
    $this->VacationName= false;
    $this->VacationType= false;
    $this->EmployeesVacations = true;
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

        // Fetch record by ID
        public function fetchEmployeeDetail($id = 0){

            $recordEmployee = Employee::select('*')
                        ->where('id',$id)
                        ->first();
    
            $this->searchEmployee = $recordEmployee->id;
            $this->empDetails = $recordEmployee;
            $this->showdivEmployee = false;
        }


public function show_conformation_modal_employees_vacations($id)
{
    $this->deleteEmployeesVacationsId = $id;
    
    $this->dispatchBrowserEvent('show_conformation_model_employees_vacations');
}

public function delete_employees_vacations(){

    $employeesVacations = EmployeesVacation::findOrFail($this->deleteEmployeesVacationsId);

    $employeesVacations->delete();

    $this->dispatchBrowserEvent('hide_conformation_model_employees_vacations', ['message' => 'Vacation deleted successfully']);
}

public function show_edit_employee_vacation_form(EmployeesVacation $employeeVacation){

    $this->showEditEmployeeVacationForm = true;
    $this->employeeVacationVariable = $employeeVacation;
    $this->perInfo = $employeeVacation->toArray();
    $this->dispatchBrowserEvent('show_employee_vacation_form');
    $this->FullName = EmployeesVacation::where('id',$this->employeeVacationVariable->id)->first();
}

public function edit_employee_vacation()
{

    $validatedData =  Validator::make($this->perInfo, [
        'employee_id' => 'required',
        'vacation_id' => 'required',
        'vacationDate' => 'required',
        'type_id' => 'required',
        'duration' => 'required',
        'reason' => 'required',
        'isAuthor' => 'required',
    ])-> validate();

    $this->employeeVacationVariable->where('id', $this->employeeVacationVariable->id)->update($validatedData);

    $this->dispatchBrowserEvent('hide_employee_vacation_form', ['message' => 'Vacation For Employee Updated Successfully']);
}


    public function show_vacation_form()
    {
        $this->dispatchBrowserEvent('show_vacation_form');
    }

    public function new_vacation_name()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'vacationName' => 'required',
        ])-> validate();

        Vacation::create($validatedData);

        $this->perInfo=[];

        $this->dispatchBrowserEvent('hide_holiday_form', ['message' => 'Vacation Name added successfully']);
    }

    public function show_edit_vacation_name_form(Vacation $vacation)
    {
        $this->showEditVacationNameForm = true;
        $this->vacation = $vacation;
        $this->perInfo = $vacation->toArray();

        $this->dispatchBrowserEvent('show_vacation_name_form');
    }

    public function edit_vacation_name()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'vacationName' => 'required',
        ])-> validate();
        
        $this->vacation->update($validatedData);

        $this->perInfo=[];

        $this->dispatchBrowserEvent('hide_holiday_form', ['message' => 'Vacation Name updated successfully']);
       
        $this->showEditVacationNameForm = false;
    }

    public function show_conformation_modal($id)
    {
        $this->deleteVacationNameId = $id;
        
        $this->dispatchBrowserEvent('show_conformation_model');
    }

    public function delete_vacation_name()
    {
        $vacation = Vacation::findOrFail($this->deleteVacationNameId);

        try {
            $vacation->delete();
            $this->dispatchBrowserEvent('hide_conformation_model', ['message' => 'Vacation Name deleted successfully']);
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->dispatchBrowserEvent('no_hide_conformation_model', ['message' => 'Cannot Delete With Employees Related To IT']);
        }
    }



    public function new_vacation_type()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'vacationType' => 'required',
        ])-> validate();

        Vacationtype::create($validatedData);

        $this->perInfo=[];

        $this->dispatchBrowserEvent('hide_holiday_form', ['message' => 'Vacation Type added successfully']);
    }

    public function show_edit_vacation_type_form(Vacationtype $vacationType)
    {
        $this->showEditVacationTypeForm = true;
        $this->vacationType = $vacationType;
        $this->perInfo = $vacationType->toArray();

        $this->dispatchBrowserEvent('show_vacation_type_form');
    }

    public function edit_vacation_type()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'vacationType' => 'required',
        ])-> validate();
        
        $this->vacationType->update($validatedData);

        $this->perInfo=[];

        $this->dispatchBrowserEvent('hide_holiday_form', ['message' => 'Vacation Type updated successfully']);
       
        $this->showEditVacationTypeForm = false;
    }

    public function show_conformation_modal_type($id)
    {
        $this->deleteVacationTypeId = $id;
        
        $this->dispatchBrowserEvent('show_conformation_model_type');
    }

    public function delete_vacation_type()
    {
        $vacationType = Vacationtype::findOrFail($this->deleteVacationTypeId);

        try {
            $vacationType->delete();
            $this->dispatchBrowserEvent('hide_conformation_model', ['message' => 'Vacation Type deleted successfully']);
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->dispatchBrowserEvent('no_hide_conformation_model', ['message' => 'Cannot Delete With Employees Related To IT']);
        }
    }

}
