<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Attendee;
use Livewire\WithPagination;

class ShowAttendances extends Component
{
            // Pagination
            use WithPagination;
            public $EmployeesAttendances = null;
            public $firstDate = Null;
            public $secondDate = Null;
            public $selectedFilter;
            protected $paginationTheme = 'bootstrap';
            protected $listeners = ['empID'];
            public $ssdd;


    public function render()
    {
        // $employeesAttendances = Attendee::whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
        // ->where('employee_id', $this->EmployeesAttendances)
        // ->when($this->selectedFilter, function ($query) {
        //     $query->where([['employee_id', $this->EmployeesAttendances],[$this->selectedFilter, '!=', null]])
        //           ->orWhere([['employee_id', $this->EmployeesAttendances],[$this->selectedFilter, null]])
        //           ->orWhere([['employee_id', $this->EmployeesAttendances],[$this->selectedFilter, null]])
        //           ->orWhere([['employee_id', $this->EmployeesAttendances],[$this->selectedFilter, null]]);
        // })->paginate(5);
        // $employeesAttendances = Attendee::
        // when($this->selectedFilter, function ($query) {
        //     $query->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
        //     ->where([['employee_id', $this->EmployeesAttendances],[$this->selectedFilter, '!=', null]])
        //           ->orWhere([['employee_id', $this->EmployeesAttendances],[$this->selectedFilter, null]])
        //           ->orWhere([['employee_id', $this->EmployeesAttendances],[$this->selectedFilter, null]])
        //           ->orWhere([['employee_id', $this->EmployeesAttendances],[$this->selectedFilter, null]]);
        // })->paginate(5);

        // $employeesAttendances = $this->ssdd; 

        if($this->selectedFilter == 'logDate'){
            $employeesAttendances =  Attendee::whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->
            where([['employee_id', $this->EmployeesAttendances], [$this->selectedFilter, '!=', null]])->paginate(5);
        }else{
            $employeesAttendances =  Attendee::whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->
            where([['employee_id', $this->EmployeesAttendances], [$this->selectedFilter, null]])->paginate(5);
        }

        return view('livewire.admin.show-attendances',[
            'employeesAttendances' => $employeesAttendances,
        ]);
    }

    public function empID($empId)
    {
        $this->EmployeesAttendances = $empId;
    }

    // public function updatedSelectedFilter($value){
    //     // $this->getFilteredData($value);
    // }

    // public function getFilteredData($filteredData){
    //     if($filteredData == 'logDate'){
    //         $this->ssdd =  Attendee::whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->
    //         where([['employee_id', $this->EmployeesAttendances], [$filteredData, '!=', null]])->get();
    //     }else{
    //         $this->ssdd =  Attendee::whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->
    //         where([['employee_id', $this->EmployeesAttendances], [$filteredData, null]])->get();
    //     }

    //     // dd($this->ssdd);
    // }
}
