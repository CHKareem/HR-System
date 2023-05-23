<div>


<div class="row">
                <div class="col-lg-12">
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


@if($employeeDiscounts)
            @foreach($employeeDiscounts as $employeeDiscount)
          
            <div class="card text-center">
            <div class="card-header">
                <b><img class="fa-solid fa-door-open mr-2"></b>
            <b>{{$employeeDiscount->vacations->vacationName}} - {{$employeeDiscount->vacationtypes->vacationType}}</b>
  </div>
  <div class="card-body">
    <h5 class="card-title float-none">Employee Name: <b class="ml-2">{{$employeeDiscount->employees->fullName}}</b></h5>
    <p class="card-text">Vacation Date: <b class="ml-2">{{$employeeDiscount->vacationDate}}</b><br>
    Discount: <b class="ml-2">{{$employeeDiscount->discount}}</b><br>
    Vacation Duration: <b class="ml-2">{{$employeeDiscount->duration}}</b>
    </p>
  </div>
</div>

            @endforeach
    @endif

{{-- <a href="{{ route('previewPDF') }}" class="btnprn">preview</a> --}}
</div>
