<div>

<div class="row">
                <div class="col-lg-12">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="modal-title">Filter Data</h5>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between">
                            <div class="form-group col-md-6">
                                <label for="firstDate">Start Date</label>
                                <input wire:model="firstDate" type="date" class="form-control" id="firstDate">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="secondDate">End Date</label>
                                <input wire:model="secondDate" type="date" class="form-control" id="secondDate">
                            </div>
                        </div>
                </div>


                <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <div class="form-group col-md-6">
                        <label for="vacationName">select Filter</label>
                        <select wire:model="VacationName" class="custom-select rounded-0" id="vacationName">
                            <option selected> </option>
                            @foreach ($vacationNames as $vacationName)
                                <option value="{{ $vacationName->id }}">{{ $vacationName->vacationName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="VacationType">select Filter</label>
                        <select wire:model="VacationType" class="custom-select rounded-0" id="vacationType">
                            <option selected> </option>
                            @foreach ($vacationTypes as $vacationType)
                                <option value="{{ $vacationType->id }}">{{ $vacationType->vacationType }}</option>
                            @endforeach
                        </select>
                    </div>
                        </div>
                </div>
</div>


@if($employeesVacations)
            @foreach($employeesVacations as $employeesVacation)
            <div class="card text-center">
            <div class="card-header">
                <b><img class="fa-solid fa-door-open mr-2"></b>
            <b>{{$employeesVacation->vacationDate}}</b>
  </div>
  <div class="card-body">
    <h5 class="card-title float-none">Employee Name: <b class="ml-2">{{$employeesVacation->employees->fullName}}</b></h5>
    <h5 class="card-title float-none">Vacation Name: <b class="ml-2">{{$employeesVacation->vacations->vacationName}}</b></h5>
    <h5 class="card-title float-none">Vacation Type: <b class="ml-2">{{$employeesVacation->vacationtypes->vacationType}}</b></h5>
    <h5 class="card-title float-none">Duration: <b class="ml-2">{{$employeesVacation->duration}}</b></h5>
    <h5 class="card-title float-none">Reason: <b class="ml-2">{{$employeesVacation->reason}}</b></h5>
    <h5 class="card-title float-none">Authorized: <b class="ml-2">{{$employeesVacation->isAuthor ? 'Authorized' : 'Not Authorized' }}</b></h5>
  </div>
</div>
            @endforeach
            {{ $employeesVacations->links() }} 
    @endif

</div>
