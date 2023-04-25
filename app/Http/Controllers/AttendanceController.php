<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportAttendance;
use App\Models\Attendee;
use App\Exports\ExportAttendance;


class AttendanceController extends Controller
{

        public function import_attendees(Request $request){

        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
           ]);

        Excel::import(new ImportAttendance,
                      $request->file('file')->store('files'));


         return back()->with('success', 'Excel Data Imported successfully.');
  }

        public function export_attendees(Request $request){
          return Excel::download(new ExportAttendance, 'Attendance.xlsx');
      }

}
