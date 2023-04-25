<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;

class DashboardList extends Component
{
    public function render()
    {
        $employees = Employee::get();
        $positions = Position::get();

        return view('livewire.admin.dashboard-list', [
            'employees' => $employees, 'positions' => $positions,
        ]);
    }
}
