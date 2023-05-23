<div>
   
<div class="row">
<div class="col-lg-12">
<div class="d-flex justify-content-between">
                
<button wire:click.prevent="export_employees" class="btn btn-primary mr-2">
                                <i class="fa-solid fa-table mr-2 mr-2"></i> @lang('auth.expCusEmp')
                            </button>
                            
                           
                            <button wire:click.prevent="export_employees_centers" class="btn btn-primary mr-2">
                                <i class="fa-solid fa-table mr-2 mr-2"></i> @lang('auth.expCusEmpCen')
                            </button>
                            </div>
</div>
                          
</div>
<br>
<div class="row">
<div class="col-lg-12">
<div class="d-flex justify-content-between">      
               
                            <button wire:click.prevent="export_employees_departments" class="btn btn-primary mr-2">
                                <i class="fa-solid fa-table mr-2 mr-2"></i> @lang('auth.expCusEmpDep')
                            </button>
                           
                           
                            <button wire:click.prevent="export_employees_positions" class="btn btn-primary mr-2">
                                <i class="fa-solid fa-table mr-2 mr-2"></i> @lang('auth.expCusEmpPos')
                            </button>
                           
                            
                            <button wire:click.prevent="export_employees_infos" class="btn btn-primary mr-2">
                                <i class="fa-solid fa-table mr-2 mr-2"></i> @lang('auth.expCusEmpinfo')
                            </button>
                           
</div>
</div>                 
</div>


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
                                <input wire:model.defer="perInfo.firstDate" type="date" class="form-control" id="firstDate">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="secondDate">@lang('auth.secondDate')</label>
                                <input wire:model.defer="perInfo.secondDate" type="date" class="form-control" id="secondDate">
                            </div>
                        </div>
                </div>

</div>


                <div class="row">
                <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <div class="col-md-6">
                        <div wire:ignore class="form-group">
                    <label for="employeeId">@lang('auth.empTitle')</label>
                    <select wire:model.defer="perInfo.employeeId" class="select2_employee custom-select rounded-0" id="employeeId" multiple="multiple">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->fullName }}</option>
                        @endforeach
                    </select>
<input id="chkallEmployee" type="checkbox" > <b>@lang('auth.selectAll')</b>
<br>
                </div></div>

                <div class="col-md-6">
                    <div wire:ignore class="form-group">
                        <label for="centerId">@lang('auth.cenTitle')</label>
                        <select wire:model.defer="perInfo.centerId" class="select2_center custom-select rounded-0" id="centerId" multiple="multiple">
                            @foreach ($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->centerName }}</option>
                            @endforeach
                        </select>        
<input id="chkallCenter" type="checkbox" > <b>@lang('auth.selectAll')</b>
<br>
                    </div></div>
                        </div>
                </div>
</div>



<div class="row">
                <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                        <div wire:ignore class="form-group col-md-6">
                    <label for="departmentId">@lang('auth.depTitle')</label>
                    <select wire:model.defer="perInfo.departmentId" class="select2_department custom-select rounded-0" id="departmentId" multiple="multiple">
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->departmentName }}</option>
                        @endforeach
                    </select>
<input id="chkallDepartment" type="checkbox" > <b>@lang('auth.selectAll')</b>
<br>
                </div>

                    <div wire:ignore class="form-group col-md-6">
                        <label for="positionId">@lang('auth.posTitle')</label>
                        <select wire:model.defer="perInfo.positionId" class="select2_position custom-select rounded-0" id="positionId" multiple="multiple">
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->positionName }}</option>
                            @endforeach
                        </select>        
<input id="chkallPosition" type="checkbox" > <b>@lang('auth.selectAll')</b>
<br>
                    </div>
                        </div>
                </div>
</div>


</div>



@push('js3')

<script>

$(document).ready(function(){

    positionData = [];
    employeeData = [];
    centerData = [];
    departmentData = [];

    $('.select2_position').select2({

    }).on('change', function(){
        @this.set('perInfo.positionId', $(this).val());
    }); 

    $('.select2_department').select2({

}).on('change', function(){
    @this.set('perInfo.departmentId', $(this).val());
}); 


$('.select2_center').select2({

}).on('change', function(){
    @this.set('perInfo.centerId', $(this).val());
}); 

    $('.select2_employee').select2({

}).on('change', function(){
    @this.set('perInfo.employeeId', $(this).val());    
}); 


$('.select2_employee').val(employeeData);
$('.select2_employee').trigger('change');


    $('.select2_center').val(centerData);
    $('.select2_center').trigger('change');


    $('.select2_position').val(positionData);
    $('.select2_position').trigger('change');


    $('.select2_department').val(departmentData);
    $('.select2_department').trigger('change');


    $("#chkallEmployee").click(function(){
        if($("#chkallEmployee").is(':checked')){
            $('.select2_employee').select2('destroy').find('option').prop('selected', 'selected').end().select2();
            $(".select2_employee").trigger("change");
        } else {
            $('.select2_employee').select2('destroy').find('option').prop('selected', false).end().select2();
            $(".select2_employee").trigger("change");
        }
    });

    $("#chkallCenter").click(function(){
        if($("#chkallCenter").is(':checked')){
            $('.select2_center').select2('destroy').find('option').prop('selected', 'selected').end().select2();
            $(".select2_center").trigger("change");
        } else {
            $('.select2_center').select2('destroy').find('option').prop('selected', false).end().select2();
            $(".select2_center").trigger("change");
        }
    });

    $("#chkallDepartment").click(function(){
        if($("#chkallDepartment").is(':checked')){
            $('.select2_department').select2('destroy').find('option').prop('selected', 'selected').end().select2();
            $(".select2_department").trigger("change");
        } else {
            $('.select2_department').select2('destroy').find('option').prop('selected', false).end().select2();
            $(".select2_department").trigger("change");
        }
    });

    $("#chkallPosition").click(function(){
        if($("#chkallPosition").is(':checked')){
            $('.select2_position').select2('destroy').find('option').prop('selected', 'selected').end().select2();
            $(".select2_position").trigger("change");
        } else {
            $('.select2_position').select2('destroy').find('option').prop('selected', false).end().select2();
            $(".select2_position").trigger("change");
        }
    });

});


</script>

@endpush
