<div>
    @if($employeePositions)
            @foreach($employeePositions as $employeePosition)
            <div class="card text-center">
            <div class="card-header">
                <b><img class="fa-solid fa-map-pin mr-2"></b>
            <b>{{$employeePosition->positions->positionName}}</b>
  </div>
  <div class="card-body">
    <h5 class="card-title float-none">@lang('auth.employeeName'): <b class="ml-2">{{$employeePosition->employees->fullName}}</b></h5>
    <p class="card-text">@lang('auth.startDate'): <b class="ml-2">{{$employeePosition->startDate}}</b><br>
    @if($employeePosition->endDate)
    @lang('auth.endDate'): <b class="ml-2">{{$employeePosition->endDate}}</b>
    @else
    @lang('auth.endDate'): <b class="ml-2">Currently Working In This Position</b>
    @endif
    </p>
  </div>
</div>
            @endforeach
    @endif
</div>
