<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\EmployeesPosition;
use Livewire\WithPagination;

class ShowPositions extends Component

{
        // Pagination
        use WithPagination;
        public $employeePositions = false;
        protected $paginationTheme = 'bootstrap';
        protected $listeners = ['empID'];


    public function render()
    {
        return view('livewire.admin.show-positions');
    }

    public function empID($empId)
    {
        $this->get_employee_positions($empId);
    }

    public function get_employee_positions($empId){

        $this->employeePositions = EmployeesPosition::where('employee_id', $empId)->get();

    }
}
