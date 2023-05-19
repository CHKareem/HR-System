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
                        <label for="ID">@lang('auth.id')</label><br>
                        <output id="ID">{{$getEmployeeInfo->id}}</output>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="firstName">@lang('auth.firstName')</label><br>
                        <output id="firstName">{{$getEmployeeInfo->firstName}}</output>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="lastName">@lang('auth.lastName')</label><br>
                        <output id="lastName">{{$getEmployeeInfo->lastName}}</output>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="fatherName">@lang('auth.fatherName')</label><br>
                        <output id="fatherName">{{$getEmployeeInfo->fatherName}}</output>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="motherName">@lang('auth.motherName')</label><br>
                        <output id="motherName">{{$getEmployeeInfo->motherName}}</output>
                    </div>

        <div class="form-group col-md-4">
            <label for="birthAndPlace">@lang('auth.birthAndPlace')</label><br>
            <output id="birthAndPlace">{{$getEmployeeInfo->birthAndPlace}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="nationalNumber">@lang('auth.nationalNumber')</label><br>
            <output id="nationalNumber">{{$getEmployeeInfo->nationalNumber}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="gender">@lang('auth.gender')</label><br>
            <output id="gender">
            {{$getEmployeeInfo->gender ? 'Male' : 'Female'}}
            </output>
        </div>

        <div class="form-group col-md-4">
            <label for="degree">@lang('auth.degree')</label><br>
            <output id="degree">{{$getEmployeeInfo->degree}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="mobile">@lang('auth.mobile')</label><br>
            <output id="mobile">{{$getEmployeeInfo->mobile}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="address">@lang('auth.address')</label><br>
            <output id="address">{{$getEmployeeInfo->address}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="startDate">@lang('auth.startDate')</label><br>
            <output id="startDate">{{$getEmployeeInfo->startDate}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="quitDate">@lang('auth.quitDate')</label><br>
            <output id="quitDate">@if($getEmployeeInfo->quitDate != null)
                {{$getEmployeeInfo->quitDate}}@endif</output>
        </div>

                <div class="form-group col-md-4">
            <label for="earlyPositionId">@lang('auth.positionName')</label><br>
            @if($getPositionName != null)
            <output>{{$getemployeePositionWithoutEndDate->positionName}}</output>
            @endif
            @if($getPositionName == null)
            <output>@lang('auth.noPos')</output>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label for="isYearChecked">@lang('auth.workingYears')</label><br>
            <output id="isYearChecked">{{$getEmployeeInfo->workingYears}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="departmentId">@lang('auth.departmentName')</label><br>
           {{-- <output id="departmentId">{{$getEmployeeInfo->employeeDepartment->departmentName}}</output>--}}
           @if($getPositionName != null)
            <output>{{$getemployeeDepartmentWithoutEndDate->departmentName}}</output>
            @endif
            @if($getPositionName == null)
            <output>@lang('auth.noDep')</output>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label for="centerId">@lang('auth.centerName')</label><br>
           {{-- <output id="centerId">{{$getEmployeeInfo->employeeCenter->centerName}}</output>--}}
           @if($getPositionName != null)
            <output>{{$getemployeeCenterWithoutEndDate->centerName}}</output>
            @endif
            @if($getPositionName == null)
            <output>@lang('auth.noCen')</output>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label for="vacationCount">@lang('auth.vacationCount')</label><br>
            <output id="vactaionCount">{{$getEmployeeInfo->vacationCount}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="hourlyLate">@lang('auth.lateHours')</label><br>
            <output id="hourlyLate">{{$getEmployeeInfo->hourlyLate}}</output>
        </div>

        <div class="form-group col-md-4">
            <label for="hourlyVac">@lang('auth.vacationHours')</label><br>
            <output id="hourlyVac">{{$getEmployeeInfo->hourlyVac}}</output>
        </div>

        </div>

        <div class="form-row">

        <div class="form-group col-md-12">
            <label for="notes">@lang('auth.notes')</label><br>
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
