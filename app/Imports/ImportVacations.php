<?php

namespace App\Imports;

use App\Models\EmployeesVacation;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use DatePeriod;
use DateInterval;
use DB;
use Session;


class ImportVacation implements ToModel, WithStartRow, WithValidation
{
    public $empInfo;
    public $firstDate;
    public $durations;
    public $daysDurations;
    public $firstTime;
    public $secondTime;
    public $vacationID;

  public function transformDate($value, $format = 'Y-m-d')
{
    try {
        return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
    } catch (\ErrorException $e) {
        return \Carbon\Carbon::createFromFormat($format, $value);
    }
}

public function get_no_payment_count($empId){
    $noPaymentCounts = Employee::where('id', $empId)->get('noPaymentCount');
    foreach($noPaymentCounts as $noPaymentCount){
        return $noPaymentCount->noPaymentCount;
    }
}

public function get_employee_info($empId){
    $userInfos = Employee::where('id', $empId)->first();
    return $userInfos;

}

    public function model(array $row)
    {
   
     $s = $this->transformDate($row[2]);
     $e = $this->transformDate($row[3]);

     $period = CarbonPeriod::create($s, $e);
    //      foreach ($period as $date) {
    //     echo $date->format('Y-m-d');
    //  }
     
     $datess = $period->toArray();
 if($row[4] == null && $row[5] == null){
    $duration = $e->diffInDays($s);
    $duration = $duration + 1;
    $discount = null;
 }
 if($row[6] == 4){
    $discount = 30;
 }if($row[4] !== null && $row[5] !== null){
     
    $from = $row[4];

    $to = $row[5];
    
    $duration = Carbon::parse($from)->diff(Carbon::parse($to));
    $duration = $duration->h . ":" . $duration->i . ":" . $duration->s;
    $discount = null;
    
 }

    for($i=$s->copy(); $i <= $e; $i->addDays()){

        if($row[6] == 3){
            
            DB::table('employees')->where('id', $row[0])->increment('noPaymentCount', $duration);
            }

        if($row[6] == 4){
                
                DB::table('employees')->where('id', $row[0])->increment('healthCount', $duration);
                }
        EmployeesVacation::create([
            'employee_id' => $row[0],
            'vacation_id' => $row[1],
            'vacationDate' =>  $i,
            'type_id' => $row[6],
            'duration' => $duration,
            'reason' => $row[7],
            'discount' => $discount,
            'isAuthor' => $row[8] == 'Authorized' ? 1 : 0,
        ]);

}   

    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [

            '0' => function($attribute, $value, $onFailure) {
                    if(!is_int($value)){
                        $onFailure('Column[1] This Value MUST BE INT');
                    }
                    if($value < 0){
                        $onFailure('Column[1] This Value MUST Have POSITIVE Numbers');
                    }else{
                    $this->empInfo = $this->get_employee_info($value);
                    }
                },

                '1' => function($attribute, $value, $onFailure) {
                    if(!is_int($value)){
                        $onFailure('Column[1] This Value MUST BE INT');
                    }
                    if($value < 0){
                        $onFailure('Column[1] This Value MUST Have POSITIVE Numbers');
                    }
                    if(strlen((string)$value) > 2){
                    $onFailure('Column[1] This Value MUST NOT Have More Than 2 Characters');
                    }else{
                    $this->vacationID = $value;
                    }
                },

            '2' => function($attribute, $value, $onFailure) {
                    $this->firstDate = $this->transformDate($value);
                },

            '3' => function($attribute, $value, $onFailure) {
                    $this->durations = $this->transformDate($value)->diffInDays($this->firstDate);
                    $this->daysDurations = $this->durations + 1;
                },

                '4' => function($attribute, $value, $onFailure) {
                    $this->firstTime = $value;
                },

                '5' => function($attribute, $value, $onFailure) {
                    $this->secondTime = $value;
                },

            '6' => function($attribute, $value, $onFailure) {

               $durationTime =  Carbon::parse($this->firstTime)->diff(Carbon::parse($this->secondTime));
               $durationTime = $durationTime->h . ":" . $durationTime->i . ":" . $durationTime->s;
                
               
                $vacType = DB::table('vacationtypes')->where('id', $value)->first();
                $daysDurationErrorMessage = 'Duration for '. $vacType->vacationType .' is bigger than usual, your amount is '. $this->daysDurations;
                $managerialErrorMessage = 'Vacation Name is Wrong YOU SHOULD Put Daily With '. $vacType->vacationType;
                $hourlyErrorMessage = 'Vacation Name is Wrong YOU SHOULD Put Hourly With '. $vacType->vacationType;
                $vacationNameErrorMessage = 'Vacation Name is Wrong CHECK THE VALUE';
                $timeErrorMessage = 'You Have Either First Time or Second Time NULL';
                $timeNotNullErrorMessage = 'You Have First Time & Second Time NULL';
                $maleErrorMessage = 'The User is Male YOU CANNOT Insert '. $vacType->vacationType .' Vacation For Him';
                $paperBankDurationTimeErrorMessage = 'This'. $durationTime. ' is Bigger Than 3 Hours Bank or Papers SHOULD Be AT LEAST 3 Hours or Less';
                $managerialPermissionDurationTimeErrorMessage= 'This'. $durationTime. ' is Bigger Than 4 Hours Mangerial Permission SHOULD Be AT LEAST 4 Hours or Less';
                $vacationNameDaysTimesDurationErrorMessage = 'You Have Time & Date That is Wrong YOU SHOULD PUT ONE OF THEM';



                if($value == 1){
                    if($this->vacationID != 1 && $this->vacationID != 2){
                        $onFailure('Column[7] '. $vacationNameErrorMessage);
                    }
                  }

                if($value == 2){
                    if($this->vacationID != 2){
                        $onFailure('Column[7] '. $hourlyErrorMessage);
                    }
                    if($this->daysDurations > 1){
                        $onFailure('Column[7] '. $daysDurationErrorMessage);
                    }
                    if($this->firstTime == null || $this->secondTime == null){
                        $onFailure('Column[7] '. $timeErrorMessage);
                    }
                  }

                  if($value == 3){
                    if($this->vacationID != 1){
                        $onFailure('Column[7] '. $managerialErrorMessage);
                    }
                      if($this->daysDurations > 30){
                        $onFailure('Column[7] '. $daysDurationErrorMessage);
                      }else{
                        DB::table('employees')->where('id', $this->empInfo->id)->update([ 'noPaymentCount' => $this->daysDurations]); 
                      }
                    }

                    if($value == 4){
                        if($this->vacationID != 1){
                            $onFailure('Column[7] '. $managerialErrorMessage);
                        }
                        if($this->daysDurations < 15 && $this->daysDurations > 30){
                            $onFailure('Column[7] '. $daysDurationErrorMessage);
                        }
                      }

                    if($value == 5){
                        if($this->vacationID != 1){
                            $onFailure('Column[7] '. $managerialErrorMessage);
                        }
                        if($this->daysDurations > 7){
                            $onFailure('Column[7] '. $daysDurationErrorMessage);
                        }
                      }

                      if($value == 6){
                        if($this->vacationID != 1){
                            $onFailure('Column[7] '. $managerialErrorMessage);
                        }
                        if($this->daysDurations > 30){
                            $onFailure('Column[7] '. $daysDurationErrorMessage);
                        }
                      }

                      if($value == 7 || $value == 8){
                        if($this->vacationID != 2){
                            $onFailure('Column[7] '. $hourlyErrorMessage);
                        }
                        if($this->daysDurations > 1){
                            $onFailure('Column[7] '. $daysDurationErrorMessage);
                        }
                        if($this->firstTime == null || $this->secondTime == null){
                            $onFailure('Column[7] '. $timeErrorMessage);
                        }
                        if($durationTime > '3:0:0'){
                            $onFailure('Column[7] '. $paperBankDurationTimeErrorMessage);
                        }
                      }

                      if ($value == 9) {
                        if($this->vacationID != 1){
                            $onFailure('Column[7] '. $managerialErrorMessage);
                        }
                        if($this->empInfo->gender != 0){
                           $onFailure('Column[7] '. $maleErrorMessage);
                        }
                      }

                      if($value == 10){
                        if($this->vacationID != 2){
                            $onFailure('Column[7] '. $hourlyErrorMessage);
                        }
                        if($this->empInfo->gender != 0){
                            $onFailure('Column[7] '. $maleErrorMessage);
                         }
                         if($this->firstTime == null || $this->secondTime == null){
                            $onFailure('Column[7] '. $timeNotNullErrorMessage);
                        }
                        if($this->daysDurations > 180){
                            $onFailure('Column[7] '. $daysDurationErrorMessage);
                        }
                      }

                      if($value == 11){
                        if($this->vacationID != 1){
                            $onFailure('Column[7] '. $managerialErrorMessage);
                        }

                            if($this->daysDurations < 5 && $this->daysDurations > 30){
                                $onFailure('Column[7] '. $daysDurationErrorMessage);
                            }
                      }

                      if($value == 12){
                        if($this->vacationID != 1){
                            $onFailure('Column[7] '. $managerialErrorMessage);
                        }
                        if($this->daysDurations < 5 && $this->daysDurations > 30){
                            $onFailure('Column[7] '. $daysDurationErrorMessage);
                        }
                      }

                    if($value == 18){  
                        if($this->firstTime == null || $this->secondTime == null){
                            $onFailure('Column[7] '. $timeErrorMessage);
                        }
                        if($this->daysDurations > 1){
                            $onFailure('Column[7] '. $daysDurationErrorMessage);
                        }
                        if($this->vacationID != 2){
                            $onFailure('Column[7] '. $hourlyErrorMessage);
                        }
                        if($durationTime > '4:0:0'){
                                $onFailure('Column[7] '. $managerialPermissionDurationTimeErrorMessage);
                            }
                      }

                      if($value == 19){  
                        if($this->daysDurations > 30){
                            $onFailure('Column[7] '. $daysDurationErrorMessage);
                        }
                      }
              },
              '7' => function($attribute, $value, $onFailure) {

                if(!is_string($value) || is_numeric($value)){
                    $onFailure('Column[8] This Value MUST BE TEXT');
                    }

              },
              '8' => function($attribute, $value, $onFailure) {

                if(!is_string($value) || is_numeric($value)){
                    $onFailure('Column[9] This Value MUST BE TEXT');
                    }
                    if(strlen($value) != 10 && strlen($value) != 14){
                        $onFailure('Column[9] This Value MUST BE Authorized OR Not Authorized');
                    }

              },
           
        ];
    }
}
