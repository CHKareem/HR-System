<?php

namespace App\Imports;

use App\Models\EmployeesPosition;
use App\Models\Position;
use App\Models\Department;
use App\Models\Center;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Carbon;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;


class ImportPositionEmployee implements ToModel, WithStartRow, WithValidation
{

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function validateDate($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public function get_position_id($positionName){
        $positionId = DB::table('positions')->where('positionName', $positionName)->first();
        return $positionId->id;
    }

    public function get_employee_id($employeeFullName){
        $empId = DB::table('employees')->where('fullName', $employeeFullName)->first();
        return $empId->id;
    }

    public function get_center_id($name){
        $centerId = Center::where('centerName', $name)->first();
        return $centerId->id;
    }

    public function get_department_id($name){
        $departmentId = Department::where('departmentName', $name)->first();
        return $departmentId->id;
    }


    public function model(array $row)
    {

        if($row[5] !== Null){
            if(is_string($row[5])){
                $endDate = $row[5];
            }
    
            if(!is_string($row[5])){
                $endDate = $this->transformDate($row[5]);
            }
        }else{
            $endDate = Null;
        }

        if(is_string($row[0]) && !is_numeric($row[0])){
            $employeeId = $this->get_employee_id($row[0]);
        }

        if(is_string($row[0]) && is_numeric($row[0])){
            $employeeId = $row[0];
        }

        if(is_string($row[1]) && strlen($row[1]) > 2){
            $positionId = $this->get_position_id($row[1]);
        }

        if(is_string($row[1]) && strlen($row[1]) < 2){
            $positionId = $row[1];
        }

        if(is_string($row[2]) && strlen($row[2]) > 2){
            $departmentId = $this->get_department_id($row[2]);
        }

        if(is_string($row[3]) && strlen($row[3]) > 2){
            $centerId = $this->get_center_id($row[3]);
        }

        if(is_string($row[2]) && strlen($row[2]) < 2){
            $departmentId = $row[2];
        }

        if(is_string($row[3]) && strlen($row[3]) < 2){
            $centerId = $row[3];
        }

        if(is_string($row[4])){
            $startDate = $row[4];
        }

        if(!is_string($row[4])){
            $startDate = $this->transformDate($row[4]);
        }

        return new EmployeesPosition([
            'employee_id' => $employeeId,
            'position_id' =>  $positionId,
            'department_id' => $departmentId,
            'center_id' => $centerId,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
     
    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [

            '0' => function($attribute, $value, $onFailure) {
                if(!is_string($value) && !is_numeric($value)){
                    $onFailure('Column[1] This Value MUST BE TEXT OR INT');
                    }
                    if(is_numeric($value) && $value < 0){
                        $onFailure('Column[1] This Value MUST Have POSITIVE Numbers');
                    }
            },

            '1' => function($attribute, $value, $onFailure) {
                if(!is_string($value) && !is_numeric($value)){
                $onFailure('Column[2] This Value MUST BE TEXT OR INT');
                }
                if(is_numeric($value) && $value < 0){
                    $onFailure('Column[2] This Value MUST Have POSITIVE Numbers');
                }
            },

            '2' => function($attribute, $value, $onFailure) {
                if(!is_string($value) && !is_numeric($value)){
                $onFailure('Column[3] This Value MUST BE TEXT OR INT');
                }
                if(is_numeric($value) && $value < 0){
                    $onFailure('Column[3] This Value MUST Have POSITIVE Numbers');
                }
            },

            '3' => function($attribute, $value, $onFailure) {
                if(!is_string($value) && !is_numeric($value)){
                $onFailure('Column[4] This Value MUST BE TEXT OR INT');
                }
                if(is_numeric($value) && $value < 0){
                    $onFailure('Column[4] This Value MUST Have POSITIVE Numbers');
                }
            },

            '4' => function($attribute, $value, $onFailure) {
                if($this->validateDate($value) && !is_string($value)){
                $onFailure('Column[5] This Value MUST BE DATE');
                }
            },


            '5' => function($attribute, $value, $onFailure) {
                if($this->validateDate($value) && !is_string($value)){
                $onFailure('Column[6] This Value MUST BE DATE');
                }
            },

        ];
    }
    
}
