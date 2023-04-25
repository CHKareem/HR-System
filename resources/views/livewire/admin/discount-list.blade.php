<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Discount</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Discount</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="modal-title">Filter Data Between Two Dates And Name And Type</h5>
                        </div>
                    </div>
                    <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div class="form-group col-md-3">
                        <label for="firstDate">First Date</label>
                        <input type="date" class="form-control" id="firstDate"
                        wire:change="inputFirstDate($event.target.value, {{$this->firstDate}})">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="secondDate">Second Date</label>
                        <input type="date" class="form-control" id="secondDate"
                        wire:change="inputSecondDate($event.target.value, {{$this->secondDate}})">
                    </div>

                   {{-- <div class="form-group col-md-3">
                        <label for="secondDate">Choose Vacation Name</label>
                        <select wire:model="VacationName" class="custom-select rounded-0" id="VacationName">
                        <option>Choose Vacation Name:</option>
                            @foreach ($vacationNames as $vacationName)
                                <option value="{{ $vacationName->id }}">{{ $vacationName->vacationName }}</option>
                            @endforeach
                        </select>
                    </div>--}}
{{--
                    <div class="form-group col-md-3">
                        <label for="secondDate">Choose Vacation Type</label>
                        <select wire:model="VacationType" class="custom-select rounded-0" id="VacationType">
                        <option>Choose Vacation Type:</option>
                            @foreach ($vacationTypes as $vacationType)
                                <option value="{{ $vacationType->id }}">{{ $vacationType->vacationType }}</option>
                            @endforeach
                        </select>
                    </div>
                    --}}

                        </div>

                    </div>

                    <div class="content">
        <div class="container-fluid">
        {{-- Boxes --}}
        <div class="row">
            <div class="col">
                <div class="small-box bg-success" style="border-radius:3em;">
                <div class="inner">
                    <h3 class="text-center"> {{ $daysDuration == 1 ? 0 : $daysDuration }} </h3>
                    <p class="text-center">Days For This Months</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="small-box bg-danger" style="border-radius:3em;">
                <div class="inner">
                    <h3 class="text-center"> {{ $weekendCount == 1 ? 0 : $weekendCount }} </h3>
                    <p class="text-center">Weekend Days For This Month</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="small-box bg-danger" style="border-radius:3em;">
                <div class="inner">
                    <h3 class="text-center"> {{ $holidayCount == 1 ? 0 : $holidayCount }} </h3>
                    <p class="text-center">holiday Days For This Month</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="small-box bg-success" style="border-radius:3em;">
                <div class="inner">
                    <h3 class="text-center"> {{ $daysDuration == 1 ? 0 : $daysDuration - ($holidayCount + $weekendCount )}} </h3>
                    <p class="text-center">Remaining Days For This Months</p>
                </div>
                </div>
            </div>
        </div>

</div>
</div>

                {{--    Days For This Months: {{ $daysDuration }} Weekend Days For This Month: {{ $weekendCount }}   holiday Days For This Month: {{ $holidayCount }} --}}<br><br><br>
                <div class="table-responsive">
                        <table class="table table-hover" width="100%">
                            <thead>
                            <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col">All Absences</th>
                                <!-- <th scope="col">No Paynent Or Health Discounts</th> -->
                                <th scope="col">Max Vacation Count</th>
                                <th scope="col">Daily Duration</th>
                                <th scope="col" class="text-white bg-danger">Daily Discount</th>
                                <th scope="col" class="text-white bg-danger">No Pay Discount</th>
                                <th scope="col" class="text-white bg-danger">Health Discount</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                        @foreach ($employeesVacations as $employeesVacation)
                        
{{-- 
                        @if($employeesVacation->type_id == 1 || ($employeesVacation->type_id == 3 && $employeesVacation->type_id != 1) || ($employeesVacation->type_id == 4 && $employeesVacation->type_id != 1)) --}}
                        @if($employeesVacation->type_id == 1 || $employeesVacation->type_id != 1)

                        
                        
                        @if($employeesVacation->vacation_id == 1 && $employeesVacation->type_id == 1 && is_null($employeesVacation->discount))
                        {{ $this->decrement_vacation_count($employeesVacation->employees->vacationCount, $this->get_duration_count($employeesVacation->employee_id), $employeesVacation->employee_id) }}
                             @endif
                           
                             <tr>
                           <b style=" display: none;">  {{ $this->get_employee_id($employeesVacation->employee_id)}} </b>
                                 <td>{{ $employeesVacation->employees->fullName }}</td>

                                 <td> 
                                 <button wire:click.prevent="show_employee_absences({{$employeesVacation->employee_id}})" class="btn btn-success mr-2">
                                     <i class="fas fa-info-circle mr-2"></i> View Absences
                                 </button>
                                 </td>

                                 <!-- <td>
                                   
                                 <button wire:click.prevent="show_employee_noPayment_health({{$employeesVacation->employee_id}})" class="btn btn-success mr-2">
                                     <i class="fas fa-info-circle mr-2"></i> View Employee Absences
                                 </button>
                              
                                 </td> -->

                                 <td>{{ $this->get_max_vacation_count($employeesVacation->employee_id) }}</td>

                                 <td>{{ $this->get_duration_count($employeesVacation->employee_id) }}</td>

                                
                                 <td class="text-white bg-danger text-left">
                                 @if($employeesVacation->type_id == 1)
                                    
                                    <!-- <td class="text-white bg-danger text-left"> -->
                                    {{ $employeesVacation->discount }}

                                    @else
                                    --
                                    <!-- </td> -->
                                    @endif

                                    
                                    </td>

                                   


                                    <td class="text-white bg-danger text-left">
                                        @if($this->get_employee_noPayment_health($this->employeeId) == 3)
                                     
                                        With No Payment Discount
                                        
                                        @else
                                        --
                                        @endif
                                    </td>
                                  

                                    
                                    <td class="text-white bg-danger text-left">

                                        @if($this->get_employee_noPayment_health($this->employeeId) == 4)
                                        With Health Discount
                                        
                                        @else
                                        --
                                        @endif
                                    </td>
                                    
                                 
                             </tr>
                           
@endif

@endforeach

                   {{--      @if($employeesVacation->type_id == 3)
                         @if(is_null($employeesVacation->discount))
                        {{ $this->decrement_vacation_count(0, $this->get_duration_count($employeesVacation->employee_id), $employeesVacation->employee_id) }}
                             @endif
                             @endif--}}



{{--
                         @if($employeesVacation->vacation_id == 1 && $employeesVacation->type_id == 3)
                         @if(is_null($employeesVacation->discount))
                        {{ $this->decrement_vacation_count(0, $this->get_duration_count($employeesVacation->employee_id), $employeesVacation->employee_id) }}
                             @endif
                         <tr>
                                 <td>{{ $employeesVacation->employees->fullName }}</td>

                                 <td> -- </td>

                                 <td>{{ $this->get_max_vacation_count($employeesVacation->employee_id) }}</td>

                                 <td>{{ $this->get_duration_count($employeesVacation->employee_id) }}</td>

                                 @if(isset($employeesVacation->discount))
                                    <td class="text-white bg-danger text-left">
                                    {{ $employeesVacation->discount }}
                                    </td>

                                    @else
                                    <td class="text-white bg-danger text-left">
                             {{ 0 - $this->get_duration_count($employeesVacation->employee_id) }}
                            </td>
                                   @endif


                         </tr>
                         @endif



                         @if($employeesVacation->vacation_id == 1 && $employeesVacation->type_id == 4)
                         <tr>
                                 <td>{{ $employeesVacation->employees->fullName }}</td>

                                 <td> -- </td>

                                 <td>{{ $this->get_max_vacation_count($employeesVacation->employee_id) }}</td>

                                 <td>{{ $this->get_duration_count($employeesVacation->employee_id) }}</td>

                                    <td class="text-white bg-danger text-left">
                                    {{ $employeesVacation->discount }} % From Salary
                                    </td>

                         </tr>
                         @endif

--}}

{{--
                         @if($employeesVacation->vacation_id == 2 && $employeesVacation->type_id == 1)
                         @if(is_null($employeesVacation->discount))
                         @if($this->get_duration_count($employeesVacation->employee_id))
                        {{ $this->decrement_vacation_count($employeesVacation->employees->vacationCount, $this->get_duration_count($employeesVacation->employee_id), $employeesVacation->employee_id) }}
                             @endif
                             @endif
                         <tr>
                                 <td>{{ $employeesVacation->employees->fullName }}</td>

                                 <td>{{ $this->full_absence_number($employeesVacation->employee_id) }}</td>

                                 <td>{{ $this->get_max_vacation_count($employeesVacation->employee_id) }}</td>

                                 <td>{{ $this->get_duration_count($employeesVacation->employee_id) }}</td>

                         </tr>

                         @endif --}}



                       

                            </tbody>
                        </table>
</div>

                    <div class="card-footer d-flex justify-content-centerid">

                  {{--  {{ $employeesVacations->links() }} --}}

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>



    {{-- Employee Absences form --}}
    <div wire:ignore.self class="modal fade" id="employee-absences-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                    <span>Employee Absences</span>
              </h5>
              <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             <div class="modal-body">
                

             <div class="container">

    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false">     
                <span class="title"> Full Absences </span>
                <span class="badge badge-danger">{{ $this->full_absence_number($this->emp) }}</span>
                <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                  @foreach($fullAbsences as $fullAbsence)
                  <span class="badge badge-pill badge-dark">{{ $fullAbsence->logDate }}</span>
                  @endforeach
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false">     
                <span class="title"> Part Absences </span>
                <span class="badge badge-danger">{{ $this->no_logout_absence_number($this->emp) + $this->no_login_absence_number($this->emp) }}</span>
                <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                   @foreach($partVacations as $partVacation)
                   <span class="badge badge-pill badge-dark"> {{ $partVacation->vacationDate}}</span>
                   @endforeach
            </div>
        </div>
</div>
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false">     
                <span class="title"> Rounded Hours </span>
                <span class="badge badge-success">{{ $this->round_hours_absence_number($this->emp) }}</span>
                <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    @foreach($roundedVacations as $roundedVacation)
                    <span class="badge badge-pill badge-dark">{{ $roundedVacation->vacationDate }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false">     
                <span class="title"> No Attendances </span>
                <span class="badge badge-danger">{{ $this->no_attendances_absence_number($this->emp) }}</span>
                <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div id="collapseFour" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    @foreach($noAttendances as $noAttendance)
                    <span class="badge badge-pill badge-dark">{{ $noAttendance->vacationDate}}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false">     
                <span class="title"> Authorized Vacations </span>
                <span class="badge badge-success">{{ $this->authorized_absence_number($this->emp) }}</span>
                <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div id="collapseFive" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    @foreach($vacations as $vacation)
                    <span class="badge badge-pill badge-dark">{{ $vacation->vacationDate }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false">     
                <span class="title"> No Payment Absences </span>
                <span class="badge badge-danger">{{ $this->no_payment_absence_number($this->emp) }}</span>
                @if($this->no_payment_discount($this->emp) != null)
                <span class="badge  badge-pill badge-dark"> Discount {{ $this->no_payment_discount($this->emp)->discount }}</span>
                @endif
                <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div id="collapseSix" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                @foreach($noPaymentVacations as $noPaymentVacation)
                  <span class="badge badge-pill badge-dark">{{ $noPaymentVacation->vacationDate }}</span>
                  @endforeach
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false">     
                <span class="title"> Health Absences </span>
                <span class="badge badge-danger">{{ $this->health_absence_number($this->emp) }}</span>
                @if($this->health_discount($this->emp) != null)
                <span class="badge  badge-pill badge-dark"> Discount {{ $this->health_discount($this->emp)->discount }} % From Salary </span>
                @endif
                <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div id="collapseSeven" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                @foreach($healthVacations as $healthVacation)
                   <span class="badge badge-pill badge-dark"> {{ $healthVacation->vacationDate}}</span>
                   @endforeach
            </div>
        </div>
</div>
    </div>
</div>


            </div>
          </div>
        </div>
    </div>






    {{-- Employee No Payment Health form
    <div wire:ignore.self class="modal fade" id="employee-noPayment-health-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                    <span>Employee Absences</span>
              </h5>
              <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             <div class="modal-body">
                

             <div class="container">

    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false">     
                <span class="title"> No Payment Absences </span>
                <span class="badge badge-danger">{{ $this->no_payment_absence_number($this->employeeId) }}</span>

                <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                @foreach($noPaymentVacations as $noPaymentVacation)
                  <span class="badge badge-pill badge-dark">{{ $noPaymentVacation->vacationDate }}</span>
                  @endforeach
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false">     
                <span class="title"> Health Absences </span>
                <span class="badge badge-danger">{{ $this->health_absence_number($this->employeeId) }}</span>

                <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                @foreach($healthVacations as $healthVacation)
                   <span class="badge badge-pill badge-dark"> {{ $healthVacation->vacationDate}}</span>
                   @endforeach
            </div>
        </div>
</div>
    </div>
</div>


            </div>
          </div>
        </div>
    </div> --}}





</div>
