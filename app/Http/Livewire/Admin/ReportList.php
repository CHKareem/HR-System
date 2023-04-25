<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class ReportList extends Component
{
        // Pagination
        use WithPagination;
        protected $paginationTheme = 'bootstrap';
        public $showdivEmployee = false;
        public $searchEmployee = "";
        

    public function render()
    {
        return view('livewire.admin.report-list');
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
        $this->emit('empID', $recordEmployee->id);
        $this->empDetails = $recordEmployee;
        $this->showdivEmployee = false;
    }
}
