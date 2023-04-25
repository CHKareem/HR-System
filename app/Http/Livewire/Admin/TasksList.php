<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Dailytask;
use App\Models\Hourlytask;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TasksList extends Component
{
    // Pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Objects
    public $employee;

    public $employeeId = null;
    public $employeeFullName = null;

    public $dailyTaskInfo=[];
    public $dailyTaskFrom = null;
    public $dailyTaskTo = null;
    public $dailyTaskDuration = null;

    public $hourlyTaskInfo=[];
    public $hourlyTaskFrom = null;
    public $hourlyTaskTo = null;
    public $hourlyTaskDuration = null;

    public $employeeTaskInfo = [];
    public $showEditTaskForm = false;

    // Render
    public function render()
    {
        $employees = Employee::paginate(10);

        $dailytasks = DB::table('dailytasks')
            ->join('employees', 'employees.id', '=', 'dailytasks.employeeId')
            ->get();

        $hourlytasks = DB::table('hourlytasks')
            ->join('employees', 'employees.id', '=', 'hourlytasks.employeeId')
            ->get();

        $dailytasks = $dailytasks->countBy('employeeId');
        $hourlytasks = $hourlytasks->countBy('employeeId');

        return view('livewire.admin.tasks-list', [
            'employees' => $employees, 'dailytasks' => $dailytasks, 'hourlytasks' => $hourlytasks,
        ]);
    }

    // Find employee fullname
    public function updatedEmployeeId($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $this->employeeFullName = $employee->fullName;
    }

    // Insert from for daily task
    public function updateddailyTaskFrom($dailyTaskFrom)
    {
        $this->dailyTaskFrom = $dailyTaskFrom;
    }
    // Insert to for daily task
    public function updateddailyTaskTo($dailyTaskTo)
    {
        $this->dailyTaskTo = $dailyTaskTo;
        $this->dailyTaskDuration = Carbon::parse($this->dailyTaskFrom)->diff(Carbon::parse($this->dailyTaskTo))->days + 1;
    }

    // Insert from for hourly task
    public function updatedhourlyTaskFrom($hourlyTaskFrom)
    {
        $this->hourlyTaskFrom = $hourlyTaskFrom;
    }
    // Insert to for hourly task
    public function updatedhourlyTaskTo($hourlyTaskTo)
    {
        $this->hourlyTaskTo = $hourlyTaskTo;
        $this->hourlyTaskDuration = Carbon::parse($this->hourlyTaskFrom)->diff(Carbon::parse($this->hourlyTaskTo));
        $this->hourlyTaskDuration = $this->hourlyTaskDuration->h . " : " . $this->hourlyTaskDuration->i;
    }

    // Show new daily task
    public function show_new_daily_task_form()
    {
        $this->dailyTaskInfo = [];
        $this->employeeFullName = "....... ....... .......";
        $this->dailyTaskDuration = ".......";

        $this->showEditTaskForm = false;
        $this->dispatchBrowserEvent('show_new_daily_task_form');
    }

    // New daily task
    public function new_daily_task()
    {

        $validatedData =  Validator::make($this->dailyTaskInfo, [
            'employeeId' => 'required',
            'requestDate' => 'required',
            'from' => 'required',
            'to' => 'required',
            'duration' => 'nullable',
            'isAuthorization' => 'required',
            'type' => 'required',
            'reason' => 'required',
        ])-> validate();

        $validatedData['duration'] = $this->dailyTaskDuration;

        Dailytask::create($validatedData);

        $this->dispatchBrowserEvent('hide_new_daily_task_form', ['message' => 'Task added successfully']);
    }

    // Show new hourly task
    public function show_new_hourly_task_form()
    {
        $this->hourlyTaskInfo = [];
        $this->employeeFullName = "....... ....... .......";
        $this->hourlyTaskDuration = "__ : __";

        $this->showEditTaskForm = false;
        $this->dispatchBrowserEvent('show_new_hourly_task_form');
    }

    // New hourly task
    public function new_hourly_task()
    {

        $validatedData =  Validator::make($this->hourlyTaskInfo, [
            'employeeId' => 'required',
            'requestDate' => 'required',
            'taskDate' => 'required',
            'from' => 'required',
            'to' => 'required',
            'duration' => 'nullable',
            'type' => 'required',
            'reason' => 'required',
        ])-> validate();

        $validatedData['duration'] = Carbon::parse($validatedData['from'])->diff(Carbon::parse($validatedData['to']));
        $validatedData['duration'] = $validatedData['duration']->h . ":" . $validatedData['duration']->i;

        Hourlytask::create($validatedData);

        $this->dispatchBrowserEvent('hide_new_hourly_task_form', ['message' => 'Task added successfully']);
    }

    // Show employee task
    public function show_employee_task_form($employeeId)
    {
        $this->employeeTaskInfo = [];

        $dailytasks = DB::table('dailytasks')
            ->join('employees', 'employees.id', '=', 'dailytasks.employeeId')
            ->where('employeeId', '=', $employeeId)->get();

        $hourlytasks = DB::table('hourlytasks')
            ->join('employees', 'employees.id', '=', 'hourlytasks.employeeId')
            ->where('employeeId', '=', $employeeId)->get();

        $this->dispatchBrowserEvent('show_employee_tasks_form');
    }
}
