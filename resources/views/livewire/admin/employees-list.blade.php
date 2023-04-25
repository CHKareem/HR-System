<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Employees</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Employees</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
        {{-- Boxes --}}
        <div class="row">

            <div class="col" wire:click="show_all_employees" role="button">
                <div class="small-box bg-info">
                <div class="inner">
                    <h3> {{ $employees->count() }} </h3>
                    <p>All Employees</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                </div>
            </div>

            <div class="col" wire:click="show_no_payment_vacation_employees" role="button">
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3> {{ $employeesNoPaymentVacationCounts->total() }} </h3>
                    <p>Excluded No Pay Vacation</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                </div>
            </div>

            <div class="col" wire:click="show_health_vacation_employees" role="button">
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3> {{ $employeesHealthVacationCounts->total() }} </h3>
                    <p>Excluded Health Vacation</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="small-box bg-success">
                <div class="inner">
                    <h3> {{ $isActiveCount }} </h3>
                    <p>Active Employees</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-link"></i>
                </div>
                </div>
            </div>
            <div class="col" wire:click="show_unlink_employees" role="button">
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3> {{ $isInActiveCount }} </h3>
                    <p>Inactive Employees</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-link-slash"></i>
                </div>
                </div>
            </div>
        </div>
        {{-- Main --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <button wire:click.prevent="show_new_employer_form" class="btn btn-primary mr-2">
                                <i class="fa fa-plus-circle mr-2"></i> Add Employee
                            </button>
                            <button wire:click.prevent="show_new_position_employer_form" class="btn btn-primary mr-2">
                                <i class="fa fa-plus-circle mr-2"></i> Add Employee Position
                            </button>
                            <button wire:click.prevent="show_import_form" class="btn btn-primary">
                                <i class="fa-solid fa-table mr-2"></i> Import Employees
                            </button>
                              <form
                                action="{{ route('export_employees') }}"
                                method="get"
                                enctype="multipart/form-data">
                                @csrf
                            <button class="btn btn-primary">
                                    <i class="fa-solid fa-table mr-2"></i> Export Employees
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive" wire:ignore>
                        <table class="table table-hover" id="myTable" width="100%">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Full name</th>
                                <th scope="col">National number</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($this->allEmployees)
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->fullName }}</td>
                                        <td>{{ $employee->nationalNumber }}</td>
                                        <td>+963-{{ @$employee->mobile }}</td>
                                        <td>
                                            <a wire:click.prevent="show_edit_employer_form( {{ $employee }} )" href="" class="EditIcon"><i class="fa fa-edit mr-2"></i></a>
                                            @if ($employee->isActive == 1)
                                                <a wire:click.prevent="show_unlink_conformation_model( {{ $employee->id }} )" href="" class="UnlinkIcon"><i class="fa-solid fa-link-slash text-warning mr-2"></i></a>
                                            @else
                                                <a wire:click.prevent="show_relink_conformation_model( {{ $employee->id }} )" href="" class="RelinkIcon"><i class="fa-solid fa-link text-success mr-2"></i></a>
                                            @endif
                                            <a wire:click.prevent="show_info_conformation_model( {{ $employee }} )" href="" class="InfoIcon"><i class="fas fa-info-circle text-primary mr-2"></i></a>
                                            <a wire:click.prevent="show_delete_conformation_model( {{ $employee->id }} )" href="" class="DeleteIcon"><i class="fa fa-trash text-danger mr-2"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-centerId">

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    {{-- Employer form --}}
    <div wire:ignore.self class="modal fade" id="employer-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form wire:submit.prevent="{{ $showEditEmployerForm ? 'edit_employer' : 'new_employer' }}" autocomplete="off">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                @if ($showEditEmployerForm)
                    <span>Edit employer</span>
                @else
                    <span>Add new employer</span>
                @endif
              </h5>
              <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="id">ID</label>
                        <input wire:model.defer="perInfo.id" type="text" class="form-control @error('id') is-invalid @enderror" id="id" placeholder="Enter Employee Code">
                        @error('id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-9">
                        <label for="fullName">Full name</label>
                        <input wire:model.defer="perInfo.fullName" type="text" class="form-control @error('fullName') is-invalid @enderror" id="fullName" placeholder="" disabled>
                        @error('fullName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="firstName">First name</label>
                        <input wire:model.defer="perInfo.firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" placeholder="Enter first name">
                        @error('firstName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fatherName">Father name</label>
                        <input wire:model.defer="perInfo.fatherName" type="text" class="form-control @error('fatherName') is-invalid @enderror" id="fatherName" placeholder="Enter father name">
                        @error('fatherName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="lastName">Last name</label>
                        <input wire:model.defer="perInfo.lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" placeholder="Enter last name">
                        @error('lastName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="motherName">Mother name</label>
                        <input wire:model.defer="perInfo.motherName" type="text" class="form-control @error('motherName') is-invalid @enderror" id="motherName" placeholder="Enter mother name">
                        @error('motherName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nationalNumber">National Number</label>
                        <input wire:model.defer="perInfo.nationalNumber" type="text" class="form-control @error('nationalNumber') is-invalid @enderror" id="nationalNumber" placeholder="02000000000">
                        @error('nationalNumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div><div class="form-group col-md-3">
                        <label for="mobile">Mobile</label>
                        <input wire:model.defer="perInfo.mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="0900000000">
                        @error('mobile')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- <div class="form-group col-md-3">
                        <label for="birthdate">Birth date</label>
                        <div class="input-group date" id="birthdate" data-target-input="nearest">
                            <input wire:model.defer="perInfo.birthdate" type="text" class="form-control @error('birthdate') is-invalid @enderror datetimepicker-input" id="birthdate" data-target="#birthdate" placeholder="YYYY-MM-DD"/>
                            <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            @error('birthdate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div> --}}
                    {{-- <div class="form-group col-md-3">
                        <label for="birthdate">Birth date</label>
                        <input wire:model.defer="perInfo.birthdate" type="text" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" placeholder="YYYY-MM-DD">
                        @error('birthdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}
                    <div class="form-group col-md-3">
                        <label for="birthAndPlace">Birth & Place</label>
                        <input wire:model.defer="perInfo.birthAndPlace" type="text" class="form-control @error('birthAndPlace') is-invalid @enderror" id="birthAndPlace" placeholder="YYYY-Place">
                        @error('birthAndPlace')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                    <div class="form-group col-md-3">
                        <label for="gender">Gender</label>
                        <select wire:model.defer="perInfo.gender" class="custom-select rounded-0 @error('gender') is-invalid @enderror" id="gender">
                            <option selected>Choose Gender:</option>
                            <option value="1"> Male </option>
                            <option value="0"> Female </option>
                        </select>
                          @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="birthdate">Degree</label>
                        <input wire:model.defer="perInfo.degree" type="text" class="form-control @error('degree') is-invalid @enderror" id="degree" placeholder="Degree">
                        @error('degree')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="startDate">Start date</label>
                        <input wire:model.defer="perInfo.startDate" type="date" class="form-control @error('startDate') is-invalid @enderror" id="startDate" placeholder="YYYY-MM-DD">
                        @error('startDate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="quitDate">Quit date</label>
                        <input wire:model.defer="perInfo.quitDate" type="date" class="form-control @error('quitDate') is-invalid @enderror" id="quitDate" placeholder="YYYY-MM-DD">
                        @error('quitDate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                   {{-- <div class="form-group col-md-3">
                        <label for="isActive">Is Active</label>
                        <select wire:model.defer="perInfo.isActive" class="custom-select rounded-0 @error('isActive') is-invalid @enderror" id="isActive">
                            <option selected>Is Active?</option>
                            <option value="1"> Active </option>
                            <option value="0"> Inactive </option>
                        </select>
                          @error('isActive')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>--}}
                    {{-- <div class="form-group col-md-3">
                        <label for="center_id">Center</label>
                        <select wire:model.defer="perInfo.center_id" class="custom-select rounded-0 @error('center_id') is-invalid @enderror" id="center_id">
                            <option selected>Choose Center:</option>
                            @foreach ($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->centerName }}</option>
                            @endforeach
                        </select>
                          @error('center_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}
                    {{-- <div class="form-group col-md-3">
                        <label for="department_id">Department</label>
                        <select wire:model.defer="perInfo.department_id" class="custom-select rounded-0 @error('department_id') is-invalid @enderror" id="department_id">
                            <option selected>Choose Department:</option>
                            @foreach ($departments as $department)
                                <option value="{{ @$department->id }}">{{ @$department->departmentName }}</option>
                            @endforeach
                        </select>
                          @error('department_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}
                   {{-- <div class="form-group col-md-3">
                        <label for="position_id">Position</label>
                        <select wire:model.defer="perInfo.position_id" class="custom-select rounded-0 @error('position_id') is-invalid @enderror" id="position_id">
                            <option selected>Choose Position:</option>
                            @foreach ($positions as $position)
                                <option value="{{ @$position->id }}">{{ @$position->positionName }}</option>
                            @endforeach
                        </select>
                          @error('position_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>--}}
                    <div class="form-group col-3">
                        <label for="address">Address</label>
                        <input wire:model.defer="perInfo.address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Martini">
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{--<div wire:ignore class="col-md-12">
                    <div wire:ignore class="form-group">
                        <label for="earlyPosition_id">Early Position</label>
                        <select wire:model.defer="perInfo.earlyPosition_id" class="select2_early_pos custom-select rounded-0" id="earlyPosition_id" multiple="multiple">
                            <option selected>Choose Position:</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->positionName }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>--}}
                    <div class="form-group col-md-3">
                        <label for="isActive">Is Active</label>
                        <select wire:model.defer="perInfo.isActive" class="custom-select rounded-0 @error('isActive') is-invalid @enderror" id="isActive">
                            <option selected>Is Active?</option>
                            <option value="1"> Active </option>
                            <option value="0"> Inactive </option>
                        </select>
                          @error('isActive')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!-- <hr style="width: 80%; height: .1em;"> -->
                    <div class="form-group col-12">
                        <label for="notes">Notes</label>
                        <textarea wire:model.defer="perInfo.notes" type="text" class="form-control @error('notes') is-invalid @enderror" id="notes" placeholder="Notes" rows="4"></textarea>
                        @error('notes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                    @if ($showEditEmployerForm)
                        <span>Save Changes</span>
                    @else
                        <span>Save</span>
                    @endif
                </button>
            </div>
          </div>
        </form>
        </div>
    </div>

    {{-- Import form --}}
    <div wire:ignore.self class="modal fade" id="import-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form
        action="{{ route('import_employees') }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <span>Import Employees</span>
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

    {{-- Unlink conformation model --}}
    <div wire:ignore.self class="modal fade" id="unlink-conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unlink employer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to Unlink this employer?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="unlink_employee( {{ $employee }} )" type="button" class="btn btn-warning"><i class="fa-solid fa-link-slash mr-1"></i>Unlink</button>
            </div>
            </div>
        </div>
    </div>

    {{-- Relink conformation model --}}
    <div wire:ignore.self class="modal fade" id="relink-conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Relink employer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to Relink this employer?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="relink_employee( {{ $employee }} )" type="button" class="btn btn-warning"><i class="fa-solid fa-link-slash mr-1"></i>Relink</button>
            </div>
            </div>
        </div>
    </div>

    {{-- Delete Conformation model --}}
    <div wire:ignore.self class="modal fade" id="delete-conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete employer</h5>
              <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this employer?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="delete_employee( {{ $employee }} )" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
            </div>
          </div>
        </div>
    </div>

    {{-- Info Conformation model --}}
    <div wire:ignore.self class="modal fade" style="width:100%; height:100%;" id="info-conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">employee's Information</h5>
              <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
      <livewire:admin.show-emp-info />
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>


    
    {{-- Position Employer form --}}
    <div wire:ignore.self class="modal fade" id="position-employer-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                    <span>Employees Positions</span>
              </h5>
              <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             <div class="modal-body">
                

              <livewire:admin.show-emp-pos />

            </div>
          </div>
        </div>
    </div>

    
    {{-- Error Modal HTML --}}
	@if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div id="errorModal" class="modal fade">
            <div class="modal-dialog modal-error">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="icon-box">
                    <i class="material-icons fa fa-times" aria-hidden="true"></i>
                    </div>
                    <h4 class="modal-title">Sorry</h4>
                    </div>
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

    {{-- Confirm Modal HTML --}}
    @if($message = Session::get('success'))
    <div id="confirmModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                    <i class="material-icons fa fa-check" aria-hidden="true"></i>
                    </div>
                    <h4 class="modal-title">Success</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">{{$message}}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal" id="button">OK</button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>



