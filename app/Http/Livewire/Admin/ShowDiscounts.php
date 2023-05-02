<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\EmployeesVacation;
use App\Models\Employee;
use Livewire\WithPagination;
// use Dompdf\Dompdf;
use PDF;
// use Barryvdh\Dompdf\Facade\pdf;


class ShowDiscounts extends Component
{
    use WithPagination;
    // public $employeeDiscounts = false;
    public $employeeId;
    public $firstDate = Null;
    public $secondDate = Null;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['empID'];


    public function render()
    {
        $employeeDiscounts = EmployeesVacation::whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->where([['employee_id', $this->employeeId], ['discount', '!=', Null]])->paginate(5);

        return view('livewire.admin.show-discounts',[
            'employeeDiscounts' => $employeeDiscounts, 
        ]);
        
    }

    // public function mount($id)
    // {
    //   $this->employeeId = Employee::find($id);
    // }

    public function empID($empId)
    {
        $this->employeeId = $empId;
        return $empId;
    }

    public function previewPDF()
    {
        // $users = $this->employeeDiscounts;
        // $dompdf = new DOMPDF();
        // $tt = $this->newID();
// $employeeDiscounts = EmployeesVacation::whereBetween('vacationDate' ,[$this->firstDate,$this->secondDate])->where([['employee_id', $this->employeeId], ['discount', '!=', Null]]);
dd($this->employeeId);
        // return view('livewire.admin.show-discounts')->with('employeeDiscounts', $this->employeeDiscounts)->layout('layouts.app');
        // $employeeDiscounts = EmployeesVacation::all();
        // dd($this->employeeId);
        // $employeeId = Employee::where('id', $this->listeners)->first();
        // $dompdf = PDF::loadView('livewire.admin.show-discounts', ['employeeDiscounts' => $employeeDiscounts, 'employeeId' => $employeeId]);
        // return $dompdf->stream();

        // return $pdf->stream();

    }

}
