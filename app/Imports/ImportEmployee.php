<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Center;
use App\Models\Department;
use App\Models\Position;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Carbon;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;


class ImportEmployee implements ToModel, WithStartRow, WithValidation
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

    public function get_position_id($name){
        $positionId = DB::table('positions')->where('positionName', $name)->first();
        return $positionId->id;
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

        if(str_contains($row[9], 'M') || str_contains($row[9], 'F')){
             $gender = $row[9] == 'M' ? 1 : 0;
        }

        if(str_contains($row[9], '1') || str_contains($row[9], '0')){
             $gender = $row[9];
        }

        if(is_string($row[11])){
            $startDate = $row[11];
        }

        if(is_string($row[13])){
            if($row[13] == Null){
                $quitDate = Null;
            }else{
            $quitDate = $row[13];
            }
        }

        if(!is_string($row[11])){
            $startDate = $this->transformDate($row[11]);
        }

        if(!is_string($row[13])){
            if($row[13] == Null){
                $quitDate = Null;
            }else{
            $quitDate = $this->transformDate($row[13]);
            }
        }

        // if(is_string($row[13]) && strlen($row[13]) > 2){
        //     $departmentId = $this->get_department_id($row[13]);
        // }

        // if(is_string($row[14]) && strlen($row[14]) > 2){
        //     $centerId = $this->get_center_id($row[14]);
        // }

        // if(is_string($row[13]) && strlen($row[13]) < 2){
        //     $departmentId = $row[13];
        // }

        // if(is_string($row[14]) && strlen($row[14]) < 2){
        //     $centerId = $row[14];
        // }

        if(str_contains($row[21], 'Active') || str_contains($row[21], 'Not Active')){
            $active = $row[21] == 'Active' ? 1 : 0;
       }

       if(str_contains($row[21], '1') || str_contains($row[21], '0')){
            $active = $row[21];
       }

        return new Employee([
            'id' => $row[0],
            'fullName' => $row[1],
            'firstName' => $row[2],
            'lastName' => $row[3],
            'fatherName' => $row[4],
            'motherName' => $row[5],
            'birthAndPlace' => $row[6],
            'nationalNumber' => $row[7],
            'degree' => $row[8],
            'gender' => $gender,
            'mobile' => $row[10],
            'startDate' => $startDate,
            'address' => $row[12],
            // 'department_id' => $departmentId,
            // 'center_id' => $centerId,
            'quitDate' => $quitDate,
            'notes' => $row[14],
            'vacationCount' => $row[15],
            'hourlyLate' => $row[16],
            'hourlyVac' => $row[17],
            'noPaymentCount' => $row[18],
            'healthCount' => $row[19],
            'workingYears' => $row[20],
            'isActive' => $active,

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
                if(!is_int($value) && !is_string($value)){
                $onFailure('Column[1] This Value MUST BE INT OR TEXT');
                }
                if($value < 0){
                    $onFailure('Column[1] This Value MUST Have POSITIVE Numbers');
                }
            },

            '1' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                $onFailure('Column[2] This Value MUST BE TEXT');
                }
            },

            '2' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                $onFailure('Column[3] This Value MUST BE TEXT');
                }
            },

            '3' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                $onFailure('Column[4] This Value MUST BE TEXT');
                }
            },

            '4' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                $onFailure('Column[5] This Value MUST BE TEXT');
                }
            },

            '5' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                $onFailure('Column[6] This Value MUST BE TEXT');
                }
            },

            '6' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                $onFailure('Column[7] This Value MUST BE TEXT');
                }
            },

            '7' => function($attribute, $value, $onFailure) {
                if(!is_string($value)){
                $onFailure('Column[8] This Value MUST BE TEXT');
                }
                if(is_int($value)){
                    $onFailure('Column[8] This Value MUST Not Have Numbers');
                }
                if($value < 0){
                    $onFailure('Column[8] This Value MUST Have POSITIVE Numbers');
                }
                if(strlen($value) != 11){
                    $onFailure('Column[8] This Value MUST BE 11 CHARACTER');
                }
            },

            '8' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                $onFailure('Column[9] This Value MUST BE TEXT');
                }
            },

            '9' => function($attribute, $value, $onFailure) {
                if(!is_string($value) && !is_numeric($value)){
                $onFailure('Column[10] This Value MUST BE TEXT');
                }
                if(strlen($value) != 1){
                    $onFailure('Column[10] This Value MUST BE ONE CHARACTER');
                }

                if(!str_contains($value, 'M') && !str_contains($value, 'F') && !str_contains($value, '1') && !str_contains($value, '0')){
                    $onFailure('Column[10] This Value MUST BE "F" or "M" or "0" or "1" ');
                }
            },

            '10' => function($attribute, $value, $onFailure) {
                if(!is_string($value)){
                $onFailure('Column[11] This Value MUST BE TEXT');
                }
                if(is_int($value)){
                    $onFailure('Column[11] This Value MUST Not Have Numbers');
                }
                if($value < 0){
                    $onFailure('Column[8] This Value MUST Have POSITIVE Numbers');
                }
                if(strlen($value) != 10){
                    $onFailure('Column[11] This Value MUST BE 10 CHARACTER');
                }
            },

            '11' => function($attribute, $value, $onFailure) {
                if($this->validateDate($value) && !is_string($value)){
                    $onFailure('Column[12] This Value MUST BE DATE');
                    }
            },

            '12' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                $onFailure('Column[13] This Value MUST BE TEXT');
                }
            },


            // '13' => function($attribute, $value, $onFailure) {
            //     if(!is_string($value) && !is_numeric($value)){
            //     $onFailure('Column[14] This Value MUST BE TEXT OR INT');
            //     }
            //     if($value < 0){
            //         $onFailure('Column[14] This Value MUST Have POSITIVE Numbers');
            //     }
            // },

            // '14' => function($attribute, $value, $onFailure) {
            //     if(!is_string($value) && !is_numeric($value)){
            //     $onFailure('Column[15] This Value MUST BE TEXT OR INT');
            //     }
            //     if($value < 0){
            //         $onFailure('Column[15] This Value MUST Have POSITIVE Numbers');
            //     }
            // },

            '13' => function($attribute, $value, $onFailure) {
                if($this->validateDate($value) && !is_string($value)){
                    $onFailure('Column[16] This Value MUST BE DATE');
                    }
            },

            '14' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                $onFailure('Column[17] This Value MUST BE TEXT');
                }
            },

            '15' => function($attribute, $value, $onFailure) {
                if(!is_int($value) && !is_string($value)){
                    $onFailure('Column[18] This Value MUST BE INT');
                    }
                    if($value < 0){
                        $onFailure('Column[18] This Value MUST Have POSITIVE Numbers');
                    }
            },

            '16' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                    $onFailure('Column[19] This Value MUST BE TEXT');
                }
            },

            '17' => function($attribute, $value, $onFailure) {
                if(!is_string($value) || is_numeric($value)){
                    $onFailure('Column[20] This Value MUST BE TEXT');
                }
            },

            '18' => function($attribute, $value, $onFailure) {
                if(!is_int($value) && !is_string($value)){
                $onFailure('Column[21] This Value MUST BE INT OR TEXT');
                }
                if($value < 0){
                    $onFailure('Column[21] This Value MUST Have POSITIVE Numbers');
                }
            },

            '19' => function($attribute, $value, $onFailure) {
                if(!is_int($value) && !is_string($value)){
                $onFailure('Column[22] This Value MUST BE INT OR TEXT');
                }
                if($value < 0){
                    $onFailure('Column[22] This Value MUST Have POSITIVE Numbers');
                }
            },

            '20' => function($attribute, $value, $onFailure) {
                if(!is_int($value) && !is_string($value)){
                $onFailure('Column[23] This Value MUST BE INT OR TEXT');
                }
                if($value < 0){
                    $onFailure('Column[23] This Value MUST Have POSITIVE Numbers');
                }
            },

            '21' => function($attribute, $value, $onFailure) {
                if(!is_string($value) && is_numeric($value)){
                    $onFailure('Column[24] This Value MUST BE TEXT');
                    }
                    if(strlen($value) != 6 && strlen($value) != 10 && strlen($value) != 1){
                        $onFailure('Column[24] This Value MUST BE "Active" OR "Not Active" OR "1" OR "0" ');
                    }
            },

        ];
    }
    
}
