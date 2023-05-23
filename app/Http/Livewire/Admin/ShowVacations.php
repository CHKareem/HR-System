<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Vacation;
use App\Models\Vacationtype;
use App\Models\EmployeesVacation;
use Livewire\WithPagination;

class ShowVacations extends Component
{

                // Pagination
                use WithPagination;
                public $EmployeesVacations = null;
                public $firstDate = Null;
                public $secondDate = Null;
                public $VacationName;
                public $VacationType;
                protected $paginationTheme = 'bootstrap';
                protected $listeners = ['empID'];


    public function render()
    {
        $vacationNames = Vacation::all();
        $vacationTypes = Vacationtype::all();

        if($this->VacationName != Null && $this->VacationType == Null){
            $employeesVacations =  EmployeesVacation::where([['employee_id', $this->EmployeesVacations], ['vacation_id', $this->VacationName]])->
            whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->paginate(5);
        }elseif($this->VacationType != Null && $this->VacationName == Null){
            $employeesVacations = EmployeesVacation::where([['employee_id', $this->EmployeesVacations], ['type_id', $this->VacationType]])->
            whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->paginate(5);;
        }elseif($this->VacationName != Null && $this->VacationType != Null){
            $employeesVacations =  EmployeesVacation::where([['employee_id', $this->EmployeesVacations], ['vacation_id', $this->VacationName], ['type_id', $this->VacationType]])->
            whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->paginate(5);
        }elseif($this->VacationName == Null && $this->VacationType == Null){
            $employeesVacations =  EmployeesVacation::where('employee_id', $this->EmployeesVacations)->
            whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->paginate(5);   
        }


        return view('livewire.admin.show-vacations', [
            'vacationNames' => $vacationNames,
            'vacationTypes' => $vacationTypes,
            'employeesVacations' => $employeesVacations,
        ]);
    }

    public function empID($empId)
    {
        $this->EmployeesVacations = $empId;
    }

}
