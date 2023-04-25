
  <div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Holidays</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Holidays</li>
            </ol>
            </div>
        </div>
        </div>
    </div>



    <div class="content">
        <div class="container-fluid">
        {{-- Boxes --}}

        <div class="row">
            <div class="col-lg-6 col-6" role="button" wire:click.prevent="show_official_holiday">
                <div class="small-box bg-success">
                <div class="inner">
                    <h3> {{ $officialHolidayCount }} </h3>
                    <p>All Holidays</p>
               </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                </div>
            </div>

            <div class="col-lg-6 col-6">
                <div class="small-box bg-danger">
                <div class="inner">
                       <h3> 
                       @foreach($centers as $center)@endforeach
                       {{ $center->weekends->count('pivot.weekend_id') }}
                     </h3>
                    <p>All Weekends</p>
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
        <form wire:submit.prevent="new_weekend" autocomplete="off">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">

                    <span>Add Weekends</span>
              </h5>
            </div>
            <div class="modal-body">
                <div class="form-row">

                        @php  $week_arr= [];  @endphp
                              
                               @foreach($center->weekends as $cent)
                               @if($cent !== '')
                               @php
                               array_push($week_arr, $cent->id);
                                
                               @endphp
                               @endif
                               @endforeach


                    <div class=" col-md-12">
                    <div wire:ignore class="form-group">
                    
                        
                        <label for="weekendId">Weekend</label>
                        <select wire:model.defer="perInfo.weekendId" class="select2_weekend custom-select rounded-0" id="weekendId" multiple="multiple">
                            @foreach ($weekends as $weekend)
                                <option value="{{ $weekend->id }}">{{ $weekend->dayName }}</option>
                            @endforeach
                        </select>
                    </div>
</div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                        <span>Save</span>
                </button>
            </div>
          </div>
        </form>
</div>
</div>
</div>
</div>
</div>


        <br><hr style="width: 90%;"><br>




        <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
        <form wire:submit.prevent="new_employee_vacation" autocomplete="off">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">

                    <span>Add Special Employees Vacations</span>
              </h5>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class=" col-md-12">
                    <div wire:ignore class="form-group">
                    
                    <label for="centerId">Centers</label>
                        <select wire:model.defer="perInfo.centerId" class="select2_center custom-select rounded-0" id="centerId" multiple="multiple">
                            @foreach ($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->centerName }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="employeeId">Employees</label>
                        <select wire:model.defer="perInfo.employeeId" class="select2_employee custom-select rounded-0" id="employeeId" multiple="multiple">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->fullName }}</option>
                            @endforeach
                        </select>

                        
<input id="chkall" type="checkbox" > <b>Select All</b>
<br>
                    </div>
</div>



<div class="form-group col-md-12">
                    
                    
                        
                        <label for="countId">Add Vacation Count</label>
                        <input type="number" wire:model.defer="perInfo.countId" id="countId" value="0" class="form-control @error('countId') is-invalid @enderror">
</div>
</div>

<br><hr style="width: 90%;"><br>

<div class="form-row">
<div class="form-group col-md-6">
                  
                    
                        
                        <label for="vacationDate">Add Vacation Date</label>
                        <input type="date" wire:model.defer="perInfo.vacationDate" class="form-control @error('vacationDate') is-invalid @enderror dis" id="vacationDate">
                        @error('vacationDate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
</div>

<div class="form-group col-md-6">
                    
                    
                        
                        <label for="firstTime">Add Vacation Start time</label>
                        <input type="time" wire:model.defer="perInfo.firstTime" class="form-control @error('firstTime') is-invalid @enderror dis" id="firstTime">
                        @error('firstTime')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
</div>
<div class="form-group col-md-6">
                   
                    
                        
                        <label for="secondTime">Add Vacation End Time</label>
                        <input type="time" wire:model.defer="perInfo.secondTime" class="form-control @error('secondTime') is-invalid @enderror dis" id="secondTime">
                        @error('secondTime')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
</div>
<div class="form-group col-md-6">
               
                    
                        
                        <label for="reason">Add Vacation Reson</label>
                        <input type="text" wire:model.defer="perInfo.reason" class="form-control @error('reason') is-invalid @enderror dis" id="reason">
                        @error('reason')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
</div></div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                        <span>Save</span>
                </button>
            </div>
          </div>
        </form>
</div>
</div>
</div>
</div>
</div>


<br><hr style="width: 90%;"><br>



        <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
         <form wire:submit.prevent="{{ $showEditHolidayForm ? 'edit_holiday' : 'new_holiday' }}" autocomplete="off">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                @if ($showEditHolidayForm)
                    <span>Edit Holiday</span>
                @else
                    <span>Add new Holiday</span>
                @endif
              </h5>
            </div>
            <div class="modal-body">
                <div class="form-row">
                   @if(!$this->showEditHolidayForm)
                    <div class="form-group col-md-12">
                        <label for="holidayName">Holiday Name</label>
                        <input wire:model.defer="perInfo.holidayName" type="text" class="form-control @error('holidayName') is-invalid @enderror" id="holidayName">
                        @error('holidayName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="holidayFirstDate">Holiday From Date</label>
                        <input wire:model.defer="perInfo.holidayFirstDate" type="date" class="form-control @error('holidayFirstDate') is-invalid @enderror" id="holidayFirstDate">
                        @error('holidayFirstDate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="holidaySecondDate">Holiday To Date</label>
                        <input wire:model.defer="perInfo.holidaySecondDate" type="date" class="form-control @error('holidaySecondDate') is-invalid @enderror" id="holidaySecondDate">
                        @error('holidaySecondDate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @else
                    <div class="form-group col-md-6">
                        <label for="holidayName">Holiday Name</label>
                        <input wire:model.defer="perInfo.holidayName" type="text" class="form-control @error('holidayName') is-invalid @enderror" id="holidayName">
                        @error('holidayName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="holidayDate">Holiday Date</label>
                        <input wire:model.defer="perInfo.holidayDate" type="date" class="form-control @error('holidayDate') is-invalid @enderror" id="holidayDate">
                        @error('holidayDate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif
                    <div class="form-group col-md-12">
                        <label for="notes">Notes</label>
                        <textarea wire:model.defer="perInfo.note" type="text" class="form-control @error('note') is-invalid @enderror" id="note" placeholder="Notes" rows="5" cols="10"></textarea>
                        @error('note')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                    @if ($showEditHolidayForm)
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
</div>
</div>
</div>
        <br><br>
        @if($OfficialHoliday)
                                
                                <div class="table-responsive" >
                        <table class="table table-hover" width="100%">
                            <thead>
                            <tr>
                                <th scope="col">Holiday Name</th>
                                <th scope="col">Holiday Date</th>
                                <th scope="col">Holiday Notes</th>
                                <th scope="col">Options</th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($officialHolidays as $officialHoliday)

                                    <tr>
                                    <td>{{$officialHoliday->holidayName}}</td>  
                                    <td>{{$officialHoliday->holidayDate}}</td>  
                                    <td>{{$officialHoliday->note}}</td>   
                                    <td>
                                    <a wire:click.prevent="show_edit_holiday_form( {{ $officialHoliday }} )" href="" class="EditIcon" wire:ignore><i class="fa fa-edit mr-2"></i></a>
                                    <a wire:click.prevent="show_conformation_modal( {{ $officialHoliday->id }} )" href="" class="DeleteIcon"><i class="fa fa-trash text-danger"></i></a>
                                        </td> 
                                    </tr>
                                @endforeach
                                @endif
                            </table>
                    </div>

                    <div class="card-footer d-flex justify-content-centerid">
                        
                            @if($OfficialHoliday)
                            {{ $officialHolidays->links() }}
                            @endif

                    </div>

        </div>
        </div>

    {{-- Conformation model --}}
    <div wire:ignore.self class="modal fade" id="conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Holiday</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>Are You Sure You Want To Delete This Holiday ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="delete_holiday( {{ $holiday }} )" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
            </div>
          </div>
        </div>
    </div>
</div>




    @push('js')

<script>

$(document).ready(function(){

    let weekendData = [];
    let centerData = [];
    let employeeData = [];
    weekendData = <?php echo json_encode($week_arr) ?>

    $('.select2_weekend').select2({

    }).on('change', function(){
        @this.set('perInfo.weekendId', $(this).val());
    }); 


    $('.select2_employee').select2({

}).on('change', function(){
    @this.set('perInfo.employeeId', $(this).val());    
}); 


$('.select2_center').select2({

}).on('change', function(){
    @this.set('perInfo.centerId', $(this).val());    
}); 


$('.select2_employee').val(employeeData);
$('.select2_employee').trigger('change');


    $('.select2_weekend').val(weekendData);
    $('.select2_weekend').trigger('change');

    $('.select2_center').val(centerData);
    $('.select2_center').trigger('change');

    $("#chkall").click(function(){
        if($("#chkall").is(':checked')){
            $('.select2_employee').select2('destroy').find('option').prop('selected', 'selected').end().select2();
            $(".select2_employee").trigger("change");
        } else {
            $('.select2_employee').select2('destroy').find('option').prop('selected', false).end().select2();
            $(".select2_employee").trigger("change");
        }
    });

    $("#countId").on("input",function(){
        if($(this).val() != 0){
            $('.dis').attr('disabled',true);
        }if($(this).val() == 0){
            $('.dis').attr('disabled',false);
        }
    });


});


</script>

@endpush