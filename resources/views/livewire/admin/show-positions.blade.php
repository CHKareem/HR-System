<div>
    @if($employeePositions)
            @foreach($employeePositions as $employeePosition)
            <div class="card text-center">
            <div class="card-header">
                <b><img class="fa-solid fa-map-pin mr-2"></b>
            <b>{{$employeePosition->positions->positionName}}</b>
  </div>
  <div class="card-body">
    <h5 class="card-title float-none">Employee Name: <b class="ml-2">{{$employeePosition->employees->fullName}}</b></h5>
    <p class="card-text">Start Date: <b class="ml-2">{{$employeePosition->startDate}}</b><br>
    @if($employeePosition->endDate)
    End Date: <b class="ml-2">{{$employeePosition->endDate}}</b>
    @else
    End Date: <b class="ml-2">Currently Working In This Position</b>
    @endif
    </p>
  </div>
</div>
            @endforeach
    @endif
</div>
