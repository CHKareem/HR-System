<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportPositionEmployee;
use App\Models\EmployeesPosition;
use App\Exports\ExportPositionEmployee;


class PositionEmployeeController extends Controller
{

    public function import_positions_employees(Request $request){

        $this->validate($request, [
            'file1'  => 'required|mimes:xls,xlsx'
           ]);


        Excel::import(new ImportPositionEmployee,
                      $request->file('file1')->store('files'));
        return back()->with('success', 'Excel Data Imported successfully.');
  }


        public function export_positions_employees(Request $request){
            return Excel::download(new ExportPositionEmployee, 'Positions-Employees.xlsx');
        }

}
