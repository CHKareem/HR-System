<div>


<div class="row">
                <div class="col-lg-12">
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


@if($employeeDiscounts)
            @foreach($employeeDiscounts as $employeeDiscount)
          
            <div class="card text-center">
            <div class="card-header">
                <b><img class="fa-solid fa-door-open mr-2"></b>
            <b>{{$employeeDiscount->vacations->vacationName}} - {{$employeeDiscount->vacationtypes->vacationType}}</b>
  </div>
  <div class="card-body">
    <h5 class="card-title float-none">@lang('auth.employeeName'): <b class="ml-2">{{$employeeDiscount->employees->fullName}}</b></h5>
    <p class="card-text">@lang('auth.vacationDate'): <b class="ml-2">{{$employeeDiscount->vacationDate}}</b><br>
    @lang('auth.discount'): <b class="ml-2">{{$employeeDiscount->discount}}</b><br>
    @lang('auth.duration'): <b class="ml-2">{{$employeeDiscount->duration}}</b>
    </p>
  </div>
</div>

            @endforeach
    @endif

{{-- <a href="{{ route('previewPDF') }}" class="btnprn">preview</a> --}}
</div>
