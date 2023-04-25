<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Vacations</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Vacations</li>
            </ol>
            </div>
        </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
        {{-- Boxes --}}
    <div class="row">
            <div class="col-lg-4 col-4" role="button" wire:click.prevent="show_vacation_name">
                <div class="small-box bg-success">
                <div class="inner">
                    <h3> {{ $officialVacationNameCount }} </h3>
                    <p>All Vacation Names</p>
               </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-4" role="button" wire:click.prevent="show_vacation_type">
                <div class="small-box bg-success">
                <div class="inner">
                    <h3> {{ $officialVacationTypeCount }} </h3>
                    <p>All Vacation Types</p>
               </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-4" role="button" wire:click.prevent="show_employees_vacations">
                <div class="small-box bg-success">
                <div class="inner">
                <h3>{{ $employeesVacationsCount }}</h3>
                    <p>All Employees Vacations</p>
                      </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                </div>
            </div>

        </div>

    <br><br>
        {{-- Main --}}

    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                <div class="card-header">
                <div class="d-flex justify-content-between">
                <div class="col-md-6">
                <form wire:submit.prevent="{{ $showEditVacationNameForm? 'edit_vacation_name' : 'new_vacation_name' }}" autocomplete="off">
                <h5 class="modal-title" id="exampleModalLabel">
                @if ($showEditVacationNameForm)
                    <span>Edit Vacation Name</span>
                @else
                    <span>Add New Vacation Name</span>
                @endif
</h5><br>
<div class="d-flex justify-content-between">
<div class="col-6">
                        <input wire:model.defer="perInfo.vacationName" type="text" class="form-control @error('vacationName') is-invalid @enderror" id="vacationName" placeholder="Vacation Name">
                        @error('vacationName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        </div> 
                        <div class="col">
                        <button class="btn btn-primary">
                                <i class="fa fa-plus-circle mr-2"></i> 
                                @if ($showEditVacationNameForm)
                        <span>Save Changes</span>
                    @else
                        <span>Save</span>
                    @endif
                            </button>        
</div>
</div>
                </form></div>


                <div class="col-md-6">
                <form wire:submit.prevent="{{ $showEditVacationTypeForm? 'edit_vacation_type' : 'new_vacation_type' }}" autocomplete="off">
                <h5 class="modal-title" id="exampleModalLabel">
                @if ($showEditVacationTypeForm)
                    <span>Edit Vacation Type</span>
                @else
                    <span>Add New Vacation Type</span>
                @endif
</h5><br>
<div class="d-flex justify-content-between">
<div class="col-6">
                        <input wire:model.defer="perInfo.vacationType" type="text" class="form-control @error('vacationType') is-invalid @enderror" id="vacationType" placeholder="Vacation Type">
                        @error('vacationType')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        </div> 
                        <div class="col">
                        <button class="btn btn-primary">
                                <i class="fa fa-plus-circle mr-2"></i> 
                                @if ($showEditVacationTypeForm)
                        <span>Save Changes</span>
                    @else
                        <span>Save</span>
                    @endif
                            </button>        
</div>
</div>
                </form></div></div>
                    </div>
</div>
</div>
</div>

<div class="d-flex justify-content-between">

                                
                        <div class="col-md-6"> 
                        <div class="table-responsive">
                        <table class="table table-hover" width="100%">
                            <thead>
                            <tr>
                            <th scope="col">Vacation Name</th>
                            <th scope="col">Options</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($vacations as $vacation)
                                    <tr>
                                        <td>{{ $vacation->vacationName }}</td>
                                        <td>
                                            <a wire:click.prevent="show_edit_vacation_name_form( {{ $vacation }} )" href="" class="EditIcon"><i class="fa fa-edit mr-2"></i></a>
                                            <a wire:click.prevent="show_conformation_modal( {{ $vacation->id }} )" href="" class="DeleteIcon"><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="card-footer d-flex justify-content-centerid">
                        
                        {{ $vacations->links() }}
    
                        </div>
                        </div>
                    </div>

                                <div class="col-md-6"> 
                        <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Vacation Type</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($vacationTypes as $vacationType)
                                    <tr>
                                        <td>{{ $vacationType->vacationType }}</td>
                                        <td>
                                            <a wire:click.prevent="show_edit_vacation_type_form( {{ $vacationType }} )" href="" class="EditIcon"><i class="fa fa-edit mr-2"></i></a>
                                            <a wire:click.prevent="show_conformation_modal_type( {{ $vacationType->id }} )" href="" class="DeleteIcon"><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                            <div class="card-footer d-flex justify-content-centerid">
    
                        {{ $vacationTypes->links() }}
    
                        </div>
</div>
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

                    <h5 class="modal-title">Filter Data Between Two Dates</h5>
                     <br>

                        <div class="d-flex justify-content-between">

                        <div class="form-group col-md-3 col-3">
                        <label for="firstDate">First Date</label>
                        <input wire:model="firstDate" type="date" class="form-control" id="firstDate">
                    </div>

                    <div class="form-group col-md-3 col-3">
                        <label for="secondDate">Second Date</label>
                        <input wire:model="secondDate" type="date" class="form-control" id="secondDate">
                    </div>

                    <div class="form-group col-md-3 col-3">
                    <label for="employeeId">Employee Name</label>
                        <div class="search-box">
                          <input wire:model="searchEmployee" wire:keyup="searchResult" type="text" class="form-control" id="employeeId" placeholder="Enter Employee Name">
                        
                            <!-- Search result list -->
                            @if($showdivEmployee)
                                <ul>
                                    @if(!empty($recordsEmployee))
                                        @foreach($recordsEmployee as $recordEmployee)

                                            <li wire:click="fetchEmployeeDetail({{ $recordEmployee->id }})">{{ $recordEmployee->fullName}}</li>

                                        @endforeach
                                    @endif
                                </ul>
                            @endif

                            <div class="clear"></div>
                            <div>
                                @if(!empty($empDetails))
                                    <div>
                                        Name : {{ $empDetails->fullName }} <br>
                                    </div>
                                @endif
                            </div>
                          </div>
                    </div>

                    <div class="form-group col-md-3 col-3">
                        <br>
                        <button wire:click.prevent="show_vacation_form" class="btn btn-primary">
                                <i class="fa fa-plus-circle mr-2"></i> Import Vacation Log
                            </button>
                    </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="col-md-12"> 
                        <div class="table-responsive">
                        <table class="table table-hover" width="100%">
                            <thead>
                            <tr>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Vacation Name</th>
                            <th scope="col">Vacation Date</th>
                            <th scope="col">Vacation Type</th>
                            <th scope="col">Vacation Duration</th>
                            <th scope="col">Vacation Reason</th>
                            <th scope="col">Vacation Authorised</th>
                            <th scope="col">Options</th>

                            </tr>
                            </thead>
                            <tbody>

                            @if($this->searchEmployee)

                            @foreach ($employeesVacationsForUsers as $employeesVacationsForUser)
                                    <tr>
                                        <td>{{ $employeesVacationsForUser->employees->fullName }}</td>
                                        <td>{{ $employeesVacationsForUser->vacations->vacationName }}</td>
                                        <td>{{ $employeesVacationsForUser->vacationDate }}</td>
                                        <td>{{ $employeesVacationsForUser->vacationtypes->vacationType }}</td>
                                        <td>{{ $employeesVacationsForUser->duration }}</td>
                                        <td>{{ $employeesVacationsForUser->reason }}</td>
                                        <td>{{ $employeesVacationsForUser->isAuthor? 'Authorized' : 'Not Authorized' }}</td>
                                        <td>
                                            <a wire:click.prevent="show_edit_employee_vacation_form( {{ $employeesVacationsForUser }} )" href="" class="EditIcon"><i class="fa fa-edit mr-2"></i></a>
                                            <a wire:click.prevent="show_conformation_modal_employees_vacations( {{ $employeesVacationsForUser->id }} )" href="" class="DeleteIcon"><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            @endif


                            @if(!$this->searchEmployee)

                            @foreach ($employeesVacations as $employeesVacation)
                                    <tr>
                                        <td>{{ $employeesVacation->employees->fullName }}</td>
                                        <td>{{ $employeesVacation->vacations->vacationName }}</td>
                                        <td>{{ $employeesVacation->vacationDate }}</td>
                                        <td>{{ $employeesVacation->vacationtypes->vacationType }}</td>
                                        <td>{{ $employeesVacation->duration }}</td>
                                        <td>{{ $employeesVacation->reason }}</td>
                                        <td>{{ $employeesVacation->isAuthor? 'Authorized' : 'Not Authorized' }}</td>
                                        <td>
                                            <a wire:click.prevent="show_edit_employee_vacation_form( {{ $employeesVacation }} )" href="" class="EditIcon"><i class="fa fa-edit mr-2"></i></a>
                                            <a wire:click.prevent="show_conformation_modal_employees_vacations( {{ $employeesVacation->id }} )" href="" class="DeleteIcon"><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            @endif

                            </table>
                            <div class="card-footer d-flex justify-content-centerid">
                        
                            @if(!$this->searchEmployee)
                        {{ $employeesVacations->links() }}
                        @endif

                        @if($this->searchEmployee)
                        {{ $employeesVacationsForUsers->links() }}
                        @endif


                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>



</div>

</div>



{{-- Conformation model --}}
    <div wire:ignore.self class="modal fade" id="conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Vacation Name</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>Are You Sure You Want To Delete This Vacation Name ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="delete_vacation_name( {{ $vacation }} )" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
            </div>
          </div>
        </div>
    </div>


<!-- confirmation modal -->
    <div wire:ignore.self class="modal fade" id="conformation-model-type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelType" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelType">Delete Vacation Type</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>Are You Sure You Want To Delete This Vacation Type ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="delete_vacation_type( {{ $vacationType }} )" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
            </div>
          </div>
        </div>
    </div>

    <!-- confirmation modal -->
    <div wire:ignore.self class="modal fade" id="conformation-model-vacations" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelVacations" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelVacations">Delete Vacation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>Are You Sure You Want To Delete This Vacation ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="delete_employees_vacations( {{ $employeesVacation }} )" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
            </div>
          </div>
        </div>
    </div>



         <!-- import vacation form  -->
         <div wire:ignore.self class="modal fade" id="vacation-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form
        action="{{ route('import3') }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                    <span>Add Excel File</span>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">

                        <label for="file" class="drop-container">
  <span class="drop-title">Drop files here</span>
  or
  <input type="file" id="file" name="file" required>
</label>


                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                   
                        <span>Import File</span>

                </button>
            </div>
          </div>
        </form>
        </div>
    </div> 



    {{-- Employee Vacation form --}}
    <div wire:ignore.self class="modal fade" id="employee-vacation-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelEmployeeVacation" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form wire:submit.prevent="edit_employee_vacation" autocomplete="off">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelEmployeeVacation">
                    <span>Edit Employee Vacation</span>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="employeeId">ID</label>
                        <input wire:model.defer="perInfo.employee_id" type="text" class="form-control @error('employeeId') is-invalid @enderror" id="employeeId" disabled>
                        @error('employeeId')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                     <div class="form-group col-md-6">
                        <label for="employeeName">Full Name</label>
                        @if($FullName !== Null)
                       
                        <input value="{{ $FullName->employees->fullName }}" type="text" class="form-control" id="employeeName" disabled>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="vacationId">Vacation name</label>
                        <select wire:model.defer="perInfo.vacation_id" type="text" class="custom-select rounded-0 @error('vacationId') is-invalid @enderror" id="vacationId">
                        <option selected>Choose Vacation Name:</option>
                            @foreach ($vacationNamesAll as $vacationName)
                                <option value="{{ $vacationName->id }}">{{ $vacationName->vacationName }}</option>
                            @endforeach
                        </select>
                        @error('vacationId')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="vacationDate">Vacation Date</label>
                        <input wire:model.defer="perInfo.vacationDate" type="date" class="form-control @error('vacationDate') is-invalid @enderror" id="vacationDate" placeholder="Enter Vacation Date">
                        @error('vacationDate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="typeId">Vacation Type</label>
                        <select wire:model.defer="perInfo.type_id" type="text" class="custom-select rounded-0 @error('typeId') is-invalid @enderror" id="typeId">
                        <option selected>Choose Vacation Type:</option>
                            @foreach ($vacationTypesAll as $vacationType)
                                <option value="{{ $vacationType->id }}">{{ $vacationType->vacationType }}</option>
                            @endforeach
                        </select>
                        @error('typeId')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="duration">Vacation Duration</label>
                        <input wire:model.defer="perInfo.duration" type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" placeholder="Enter Vacation Duration">
                        @error('duration')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="isAuth">Vacation Authorized</label>
                        <input wire:model.defer="perInfo.isAuthor" type="text" class="form-control @error('isAuth') is-invalid @enderror" id="isAuth" placeholder="is Authorized ({0} Not Author OR {1} is Author)">
                        @error('isAuth')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="reason">Vacation Reason</label>
                        <input wire:model.defer="perInfo.reason" type="text" class="form-control @error('reason') is-invalid @enderror" id="reason" placeholder="Enter Vacation Reason">
                        @error('reason')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                        <span>Save Changes</span>
                </button>
            </div>
          </div>
        </form>
        </div>
    </div>




    @if(count($errors) > 0)
                        
						@foreach($errors->all() as $error)
  
						<!-- Error Modal HTML -->
  <div id="errorModal" class="modal fade">
	  <div class="modal-dialog modal-error">
		  <div class="modal-content">
			  <div class="modal-header">
				  <div class="icon-box">
					  <i class="material-icons fa fa-times" aria-hidden="true"></i>
				  </div>	
			  </div>
              <h4 class="modal-title">ERROR</h4>
			  <div class="modal-body">
				  <p class="text-center">{{$error}}</p>
			  </div>
			  <div class="modal-footer">
				  <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
			  </div>
		  </div>
	  </div>
  </div>     
  
  
						@endforeach
  
					@endif
  
  
					@if($message = Session::get('success'))
						  
  
					<!-- Confirm Modal HTML -->
  <div id="confirmModal" class="modal fade">
	  <div class="modal-dialog modal-confirm">
		  <div class="modal-content">
			  <div class="modal-header">
				  <div class="icon-box">
					  <i class="material-icons fa fa-check" aria-hidden="true"></i>
				  </div>				
			  </div>
              <h4 class="modal-title">Success</h4>	
			  <div class="modal-body">
				  <p class="text-center">{{$message}}</p>
			  </div>
			  <div class="modal-footer">
				  <button class="btn btn-success btn-block" data-dismiss="modal" id="button">OK</button>
			  </div>
		  </div>
	  </div>
  
  
  
  @endif 
