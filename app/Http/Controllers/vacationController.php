<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportVacation;
use App\Models\EmployeesVacation;

class vacationController extends Controller
{
    
    public function import3(Request $request){

        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
           ]);


        Excel::import(new ImportVacation,
                      $request->file('file')->store('files'));


         return back()->with('success', 'Excel Data Imported successfully.');
  }

}
