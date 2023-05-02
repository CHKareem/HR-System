<div>

<div class="row">
                <div class="col-lg-12">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="modal-title">Filter Data Between</h5>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between">
                            <div class="form-group col-md-4">
                                <label for="firstDate">Start Date</label>
                                <input wire:model="firstDate" type="date" class="form-control" id="firstDate">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="secondDate">End Date</label>
                                <input wire:model="secondDate" type="date" class="form-control" id="secondDate">
                            </div>
                            <div class="form-group col-md-4">
                        <label for="selectedFilter">select Filter</label>
                        <select wire:model="selectedFilter" class="custom-select rounded-0" id="selectedFilter">
                            <option selected> </option>
                            <option value="logDate"> All Attendances </option>
                            <option value="logIn"> LogIn Not Exist </option>
                            <option value="logOut"> LogOut Not Exist </option>
                            <option value="logTime"> Full Absence </option>
                        </select>
                    </div>
                        </div>
                </div>
</div>

@if($employeesAttendances)
            @foreach($employeesAttendances as $employeesAttendance)
            <div class="card text-center">
            <div class="card-header">
                <b><img class="fas fa-solid fa-fingerprint mr-2"></b>
            <b>{{$employeesAttendance->logDate}}</b>
  </div>
  <div class="card-body">
    <h5 class="card-title float-none">Employee Name: <b class="ml-2">{{$employeesAttendance->employees->fullName}}</b></h5>
    <h5 class="card-title float-none">Login Time: <b class="ml-2">{{$employeesAttendance->logIn}}</b></h5>
    <h5 class="card-title float-none">Logout Time: <b class="ml-2">{{$employeesAttendance->logOut}}</b></h5>
    <h5 class="card-title float-none">Duration: <b class="ml-2">{{$employeesAttendance->duration}}</b></h5>

  </div>
</div>
            @endforeach
            {{ $employeesAttendances->links() }} 
    @endif

</div>
