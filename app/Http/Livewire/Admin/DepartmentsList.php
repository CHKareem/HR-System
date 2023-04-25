<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;


class DepartmentsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $department;
    public $perInfo=[];
    public $deleteDepartmentId = null;
    public $showEditDepartmentForm = false;


    public function render()
    {
        $departments = Department::paginate(10);
        return view('livewire.admin.departments-list', [
            'departments' => $departments
        ]);
    }

    public function newDepartmentForm()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'departmentName' => 'required',
        ])-> validate();

        Department::create($validatedData);

        $this->dispatchBrowserEvent('success_department_form', ['message' => 'Department added successfully']);

        $this->perInfo=[];
    }

    public function show_conformation_model($id)
    {

        $this->deleteDepartmentId = $id;
        $this->dispatchBrowserEvent('show_conformation_model');
    }

    public function delete_department()
    {
        $id = Department::findOrFail($this->deleteDepartmentId);
        try {
            $id->delete();
            $this->dispatchBrowserEvent('hide_conformation_model', ['message' => 'Department deleted successfully']);
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->dispatchBrowserEvent('no_hide_conformation_model', ['message' => 'Cannot Delete With Employees Related To IT']);
        }
    }

    public function show_edit_department_form(Department $department)
    {
        $this->showEditDepartmentForm = true;
        $this->department = $department;
        $this->perInfo = $department->toArray();

        $this->dispatchBrowserEvent('show_department_form');
    }

    public function edit_department()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'departmentName' => 'required',
        ])-> validate();

        $this->department->update($validatedData);

        $this->dispatchBrowserEvent('hide_department_form', ['message' => 'Department updated successfully']);

        $this->perInfo=[];

        $this->showEditDepartmentForm = false;
    }

}
