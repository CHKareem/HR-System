<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">@lang('auth.attendTitle')</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">@lang('auth.dashTitle')</a></li>
                <li class="breadcrumb-item active">@lang('auth.attendTitle')</li>
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
                        <p>@lang('auth.allEmpsAttend'): <b>{{ $firstDate }}</b> - <b>{{ $secondDate }}</b></p>
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
                        <p>@lang('auth.allGoodEmps'): <b>{{ $firstDate }}</b> - <b>{{ $secondDate }}</b></p>
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
                        <p>@lang('auth.allBadEmps'): <b>{{ $firstDate }}</b> - <b>{{ $secondDate }}</b></p>
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
                                <h5 class="modal-title">@lang('auth.filterDate')</h5>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between">
                            <div class="form-group col-md-6">
                                <label for="firstDate">@lang('auth.firstDate')</label>
                                <input wire:model="firstDate" type="date" class="form-control" id="firstDate">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="secondDate">@lang('auth.secondDate')</label>
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
                                    <i class="fa-solid fa-table mr-2"></i>@lang('auth.fingerImport')
                                </button>

                                <form
                                action="{{ route('export_attendees') }}"
                                method="get"
                                enctype="multipart/form-data">
                                @csrf
                                <button class="btn btn-primary">
                                    <i class="fa-solid fa-table mr-2"></i>@lang('auth.fingerExport')
                                </button>
                               </form>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('auth.id')</th>
                                    <th scope="col">@lang('auth.fullName')</th>
                                    <th scope="col">@lang('auth.date')</th>
                                    <th scope="col">@lang('auth.loginFinger')</th>
                                    <th scope="col">@lang('auth.logoutFinger')</th>
                                    <th scope="col">@lang('auth.duration')</th>
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
                                    <span>@lang('auth.attendImport')</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col">

                                    <label for="file" class="drop-container">
  <span class="drop-title">@lang('auth.drop')</span>
  @lang('auth.or')
  <input type="file" id="file" name="file" required>
</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                                    <span>@lang('auth.importFile')</span>
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
                            <h4 class="modal-title">@lang('auth.sorry')</h4>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">{{$error}}</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-block" data-dismiss="modal">@lang('auth.ok')</button>
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
                            <h4 class="modal-title">@lang('auth.success')</h4>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">{{$message}}</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success btn-block" data-dismiss="modal" id="button">@lang('auth.ok')</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

</div>
