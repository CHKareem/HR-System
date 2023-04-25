<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Livewire\Admin\DashboardList;
use App\Http\Livewire\Admin\AttendeesList;
use App\Http\Livewire\Admin\DiscountList;
use App\Http\Livewire\Admin\EmployeesList;
use App\Http\Livewire\Admin\PositionsList;
use App\Http\Livewire\Admin\VacationsList;
use App\Http\Livewire\Admin\TasksList;
use App\Http\Livewire\Admin\CentersList;
use App\Http\Livewire\Admin\DepartmentsList;
use App\Http\Livewire\Admin\HolidaysList;
use App\Http\Livewire\Admin\ReportList;
use App\Http\Controllers\attendanceController;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\vacationController;
use App\Http\Controllers\PositionEmployeeController;
use App\Http\Livewire\Admin\ShowDiscounts;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', AdminController::class)->name('dashboard');

    Route::get('dashboard', DashboardList::class)->name('dashboard');

    Route::get('attendees', AttendeesList::class)->name('attendees');
    Route::post('/import_attendees',[AttendanceController::class,'import_attendees'])->name('import_attendees');
    Route::get('/export_attendees',[AttendanceController::class,'export_attendees'])->name('export_attendees');

    Route::get('discount', DiscountList::class)->name('discount');
    Route::get('reports', ReportList::class)->name('reports');

    Route::get('employees', EmployeesList::class)->name('employees');
    Route::post('/import_employees',[EmployeeController::class,'import_employees'])->name('import_employees');
    Route::get('/export_employees',[EmployeeController::class,'export_employees'])->name('export_employees');


    Route::get('centers', CentersList::class)->name('centers');
    Route::get('departments', DepartmentsList::class)->name('departments');
    Route::get('positions', PositionsList::class)->name('positions');

    Route::get('vacations', VacationsList::class)->name('vacations');
    Route::get('tasks', TasksList::class)->name('tasks');

    Route::get('holidays', HolidaysList::class)->name('holidays');
    Route::post('/import3',[vacationController::class,
    'import3'])->name('import3');

    Route::post('/import_positions_employees',[PositionEmployeeController::class,
    'import_positions_employees'])->name('import_positions_employees');
    Route::get('/export_positions_employees',[PositionEmployeeController::class,'export_positions_employees'])->name('export_positions_employees');

Route::get('/exportPDF',[ShowDiscounts::class,
'exportPDF'])->name('exportPDF');
Route::get('/previewPDF',[ShowDiscounts::class,
'previewPDF'])->name('previewPDF');
});

require __DIR__.'/auth.php';

