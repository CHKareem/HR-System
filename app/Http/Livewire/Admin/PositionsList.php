<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Position;
use App\Models\Employee;
use App\Models\EmployeesPosition;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PositionsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $positionVacancyCount = 0;
    public $positionVacancys;
    public $position;
    public $perInfo=[];
    public $deletePositionId = null;
    public $showEditPositionForm = false;

    public function render()
    {

        $positions = Position::paginate(10);
        $vacancys = Position::where('numberOfVacancies', '<', $this->positionVacancyCount)->count();

        return view('livewire.admin.positions-list', [
            /* 'results' => $results, */ 'positions' => $positions,
            'vacancys' => $vacancys,
        ]);
    }

    public function show_employees_position($id){
        $this->positionVacancys = EmployeesPosition::where([['position_id',$id], ['endDate', Null]])->get();;
        $this->dispatchBrowserEvent('show_info_employees_position_model');
    }

    public function get_all_position_count_vacancy($id){
        $this->positionVacancyCount = EmployeesPosition::where([['position_id',$id], ['endDate', Null]])->count();
    }

    public function newPositionForm()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'positionName' => 'required',
            'numberOfVacancies' => 'required',
        ])-> validate();

        Position::create($validatedData);

        $this->perInfo=[];

        $this->dispatchBrowserEvent('success_postiion_form', ['message' => 'Position added successfully']);
    }

    public function show_edit_position_form(Position $position)
    {
        $this->showEditPositionForm = true;
        $this->position = $position;
        $this->perInfo = $position->toArray();

        $this->dispatchBrowserEvent('show_position_form');
    }

    public function edit_position()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'positionName' => 'required',
            'numberOfVacancies' => 'required',
        ])-> validate();

        $this->position->update($validatedData);

        $this->dispatchBrowserEvent('hide_position_form', ['message' => 'Position updated successfully']);

        $this->perInfo=[];

        $this->showEditPositionForm = false;
    }

    public function show_conformation_model($id)
    {

        $this->deletePositionId = $id;
        $this->dispatchBrowserEvent('show_conformation_model');

    }

    public function delete_position()
    {
        $id = Position::findOrFail($this->deletePositionId);
        try {
            $id->delete();
            $this->dispatchBrowserEvent('hide_conformation_model', ['message' => 'Position deleted successfully']);
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->dispatchBrowserEvent('no_hide_conformation_model', ['message' => 'Cannot Delete With Employees Related To IT']);
        }
        
    }
}
