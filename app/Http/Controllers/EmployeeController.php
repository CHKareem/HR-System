<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportEmployee;
use App\Models\Employee;
use App\Exports\ExportEmployee;


class EmployeeController extends Controller
{

    public function import_employees(Request $request){

        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
           ]);


        Excel::import(new ImportEmployee,
                      $request->file('file')->store('files'));
        return back()->with('success', 'Excel Data Imported successfully.');
  }


        public function export_employees(Request $request){
            return Excel::download(new ExportEmployee, 'Employees.xlsx');
        }

}
