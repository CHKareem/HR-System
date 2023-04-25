<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Attendees</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Attendees</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            {{-- Boxes --}}
            <div class="row">
                <div class="col-4" role="button" wire:click="show_all_attendees">
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3> {{ $attendCount }} </h3>
                        <p>All Employees Attendees: <b>{{ $firstDate }}</b> - <b>{{ $secondDate }}</b></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    </div>
                </div>
                <div class="col-4" role="button" wire:click="show_good_attendees">
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3> {{ $goodAttendeesCount }} </h3>
                        <p>Good Employees Attendees: <b>{{ $firstDate }}</b> - <b>{{ $secondDate }}</b></p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-thumbs-up"></i>
                    </div>
                    </div>
                </div>
                <div class="col-4" role="button" wire:click="show_bad_attendees">
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3> {{ $badAttendeesCount }} </h3>
                        <p>Bad Employees Attendees: <b>{{ $firstDate }}</b> - <b>{{ $secondDate }}</b></p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-thumbs-down"></i>
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
                                <h5 class="modal-title">Filter Data Between</h5>
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
                </div>
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <button wire:click.prevent="show_attendees_form" class="btn btn-primary">
                                    <i class="fa-solid fa-table mr-2"></i> Import Fingerprints From Excel
                                </button>

                                <form
                                action="{{ route('export_attendees') }}"
                                method="get"
                                enctype="multipart/form-data">
                                @csrf
                                <button class="btn btn-primary">
                                    <i class="fa-solid fa-table mr-2"></i> Export Fingerprints To Excel
                                </button>
                               </form>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Login</th>
                                    <th scope="col">Logout</th>
                                    <th scope="col">Duration</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($isAttendees)
                                    @foreach ($attendees as $attendee)
                                        <tr>
                                            <td>{{$attendee->employee_id}}</td>
                                            <td>{{$attendee->fullName}}</td>
                                            <td>{{$attendee->logDate}}</td>
                                            <td>{{$attendee->logIn}}</td>
                                            <td>{{$attendee->logOut}}</td>
                                            <td>{{$attendee->duration}}</td>
                                        </tr>
                                    @endforeach
                                    @endif

                                    @if($isGoodAttendees)
                                    @foreach ($goodAttendees as $goodAttendee)
                                        <tr>
                                            <td>{{$goodAttendee->employee_id}}</td>
                                            <td>{{$goodAttendee->fullName}}</td>
                                            <td>{{$goodAttendee->logDate}}</td>
                                            <td>{{$goodAttendee->logIn}}</td>
                                            <td>{{$goodAttendee->logOut}}</td>
                                            <td>{{$goodAttendee->duration}}</td>
                                        </tr>
                                    @endforeach
                                    @endif

                                    @if($isBadAttendees)
                                    @foreach ($badAttendees as $badAttendee)
                                        <tr>
                                            <td>{{$badAttendee->employee_id}}</td>
                                            <td>{{$badAttendee->fullName}}</td>
                                            <td>{{$badAttendee->logDate}}</td>
                                            <td>{{$badAttendee->logIn}}</td>
                                            <td>{{$badAttendee->logOut}}</td>
                                            <td>{{$badAttendee->duration}}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-centerid">
                            @if($isAttendees)
                            {{ $attendees->links() }}
                            @endif
                            @if($isBadAttendees)
                            {{ $badAttendees->links() }}
                            @endif
                            @if($isGoodAttendees)
                            {{ $goodAttendees->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendees form  -->
        <div wire:ignore.self class="modal fade" id="attendees-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form
                    action="{{ route('import_attendees') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                    <span>Import Attendees</span>
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

    {{-- Employer form --}}
    {{-- <div wire:ignore.self class="modal fade" id="employer-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="id">ID</label>
                        <input wire:model.defer="perInfo.id" type="text" class="form-control @error('id') is-invalid @enderror" id="id" placeholder="Automatically generate" disabled>
                        @error('id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fullname">Full name</label>
                        <input wire:model.defer="perInfo.fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" placeholder="Enter full name">
                        @error('fullname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="birthdate">Birth date</label>
                        <input wire:model.defer="perInfo.birthdate" type="text" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" placeholder="YYYY-MM-DD">
                        @error('birthdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nationalnumber">National Number</label>
                        <input wire:model.defer="perInfo.nationalnumber" type="text" class="form-control @error('nationalnumber') is-invalid @enderror" id="nationalnumber" placeholder="02000000000">
                        @error('nationalnumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div><div class="form-group col-md-4">
                        <label for="phonenumber">Phone Number</label>
                        <input wire:model.defer="perInfo.phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" id="phonenumber" placeholder="0900 000 000">
                        @error('phonenumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="startdate">Start date</label>
                        <input wire:model.defer="perInfo.startdate" type="text" class="form-control @error('startdate') is-invalid @enderror" id="startdate" placeholder="YYYY-MM-DD">
                        @error('startdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="positionid">Position</label>
                        <select wire:model.defer="perInfo.positionid" class="custom-select rounded-0 @error('positionid') is-invalid @enderror" id="positionid">
                            <option selected>Choose Position ID</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                          </select>
                          @error('positionid')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="departmentid">Department</label>
                        <select wire:model.defer="perInfo.departmentid" class="custom-select rounded-0 @error('departmentid') is-invalid @enderror" id="departmentid">
                            <option selected>Choose Department ID</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                          </select>
                          @error('departmentid')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="centerid">Center</label>
                        <select wire:model.defer="perInfo.centerid" class="custom-select rounded-0 @error('centerid') is-invalid @enderror" id="centerid">
                            <option selected>Choose Center ID</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                          </select>
                          @error('centerid')
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
    </div> --}}

    {{-- Conformation model --}}
    {{-- <div wire:ignore.self class="modal fade" id="conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete employer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this employer?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="delete_position( {{ $position }} )" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
            </div>
          </div>
        </div>
    </div> --}}

</div>
