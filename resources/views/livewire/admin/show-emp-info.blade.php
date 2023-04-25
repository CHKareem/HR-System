<div>
    


@if($getEmployeeInfos != null)
            @foreach($getEmployeeInfos as $getEmployeeInfo)
            <div class="form-row" style="margin-top: 1em;">

<div class="form-group col-md-2">
<img src="{{ asset ('backend/dist/img/001-user.svg') }}" alt="User" class="user-icon">
        </div>
        <div class="form-group col-md-2"></div>
        <div class="form-group col-md-8">
        <center>
            <output style="font-size:25px; font-weight:bold;">{{$getEmployeeInfo->fullName}}</output>
            </center>
         </div>
                    </div>

                    <hr style="width:95%;height:1px;background: rgba(0,0,0,.2);" class="hr-style">

            <div class="form-row">

<br>
            <div class="form-group col-md-4">
                        <label for="ID">ID</label><br>
                        <output id="ID">{{$getEmployeeInfo->id}}</output>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="firstName">First Name</label><br>
                        <output id="firstName">{{$getEmployeeInfo->firstName}}</output>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="lastName">Last Name</label><br>
                        <output id="lastName">{{$getEmployeeInfo->lastName}}</output>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="fatherName">Father Name</label><br>
                        <output id="fatherName">{{$getEmployeeInfo->fatherName}}</output>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="motherName">Mother Name</label><br>
                        <output id="motherName">{{$getEmployeeInfo->motherName}}</output>
                    </div>

        <div class="form-group col-md-4">
            <label for="birthAndPlace">Birth & Place</label><br>
            <output id="birthAndPlace">{{$getEmployeeInfo->birthAndPlace}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="nationalNumber">National Number</label><br>
            <output id="nationalNumber">{{$getEmployeeInfo->nationalNumber}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="gender">Gender</label><br>
            <output id="gender">
            {{$getEmployeeInfo->gender ? 'Male' : 'Female'}}
            </output>
        </div>

        <div class="form-group col-md-4">
            <label for="degree">Degree</label><br>
            <output id="degree">{{$getEmployeeInfo->degree}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="mobile">Mobile</label><br>
            <output id="mobile">{{$getEmployeeInfo->mobile}}</output>
        </div>

        {{--<div class="form-group col-md-4">
            <label for="positionId">Position</label><br>
            <output id="positionId">

                {{$getEmployeeInfo->employeePosition->positionName}}
                  </output>
        </div>--}}

        <div class="form-group col-md-4">
            <label for="address">Address</label><br>
            <output id="address">{{$getEmployeeInfo->address}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="startDate">Started Date</label><br>
            <output id="startDate">{{$getEmployeeInfo->startDate}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="quitDate">Quited Date</label><br>
            <output id="quitDate">@if($getEmployeeInfo->quitDate != null)
                {{$getEmployeeInfo->quitDate}}@endif</output>
        </div>

        {{--<div class="form-group col-md-4">
            <label for="earlyPositionId">Early position</label><br>
            <output id="earlyPositionId">{{$getEmployeeInfo->employeeEarlyPosition->positionName}}</output>
        </div>--}}

                <div class="form-group col-md-4">
            <label for="earlyPositionId">position</label><br>
            @if($getPositionName != null)
            <output>{{$getemployeePositionWithoutEndDate->positionName}}</output>
            @endif
            @if($getPositionName == null)
            <output>No Specific Position Is Set</output>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label for="isYearChecked">Years Been Working</label><br>
            <output id="isYearChecked">{{$getEmployeeInfo->workingYears}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="departmentId">Department</label><br>
           {{-- <output id="departmentId">{{$getEmployeeInfo->employeeDepartment->departmentName}}</output>--}}
           @if($getPositionName != null)
            <output>{{$getemployeeDepartmentWithoutEndDate->departmentName}}</output>
            @endif
            @if($getPositionName == null)
            <output>No Specific Department Is Set</output>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label for="centerId">Center</label><br>
           {{-- <output id="centerId">{{$getEmployeeInfo->employeeCenter->centerName}}</output>--}}
           @if($getPositionName != null)
            <output>{{$getemployeeCenterWithoutEndDate->centerName}}</output>
            @endif
            @if($getPositionName == null)
            <output>No Specific Center Is Set</output>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label for="vacationCount">Vacation Count</label><br>
            <output id="vactaionCount">{{$getEmployeeInfo->vacationCount}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="hourlyLate">Late Hours</label><br>
            <output id="hourlyLate">{{$getEmployeeInfo->hourlyLate}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="hourlyVac">Vacation Hours</label><br>
            <output id="hourlyVac">{{$getEmployeeInfo->hourlyVac}}</output>
        </div>

        </div>

        <div class="form-row">

        <div class="form-group col-md-12">
            <label for="notes">Notes</label><br>
            <center>
            <output id="notes">
                {{$getEmployeeInfo->notes}}
            </output>
            </center>
        </div>

        </div>
        @endforeach
@endif



</div>
