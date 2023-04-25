<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Center;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;


class CentersList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $center;
    public $centerCount;
    public $perInfo=[];
    public $deleteCenterId = null;
    public $showEditCenterForm = false;


    public function render()
    {
        $centers = Center::paginate(10);
        return view('livewire.admin.centers-list', [
            'centers' => $centers
        ]);
    }

    public function newCenterForm()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'centerName' => 'required',
        ])-> validate();

        Center::create($validatedData);

        $this->perInfo=[];

        $this->dispatchBrowserEvent('success_center_form', ['message' => 'Center added successfully']);
    }

    public function show_conformation_model($id)
    {

        $this->deleteCenterId = $id;
        $this->dispatchBrowserEvent('show_conformation_model');
    }

    public function delete_center()
    {
        $id = Center::findOrFail($this->deleteCenterId);
        try {
            $id->delete();
            $this->dispatchBrowserEvent('hide_conformation_model', ['message' => 'Center deleted successfully']);
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->dispatchBrowserEvent('no_hide_conformation_model', ['message' => 'Cannot Delete With Employees Related To IT']);
        }
    }

    public function show_edit_center_form(Center $center)
    {
        $this->showEditCenterForm = true;
        $this->center = $center;
        $this->perInfo = $center->toArray();

        $this->dispatchBrowserEvent('show_center_form');
    }

    public function edit_center()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'centerName' => 'required',
        ])-> validate();

        $this->center->update($validatedData);

        $this->dispatchBrowserEvent('hide_center_form', ['message' => 'Center updated successfully']);

        $this->perInfo=[];

        $this->showEditCenterForm = false;
    }


}
