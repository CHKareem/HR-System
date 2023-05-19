<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">@lang('auth.depTitle')</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">@lang('auth.dashTitle')</a></li>
                <li class="breadcrumb-item active">@lang('auth.depTitle')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
        {{-- Boxes --}}
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="small-box bg-info">
                <div class="inner">
                    <h3> {{ $departments->total() }} </h3>

                    <p>@lang('auth.allDep')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-building"></i>
                </div>
                </div>
            </div>
        </div>

        {{-- Main --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                <div class="card-header">
                <form wire:submit.prevent="{{ $showEditDepartmentForm? 'edit_department' : 'newDepartmentForm' }}" autocomplete="off">
                <h5 class="modal-title" id="exampleModalLabel">
                @if ($showEditDepartmentForm)
                    <span>@lang('auth.editDep')</span>
                @else
                    <span>@lang('auth.addNewDep')</span>
                @endif
</h5><br>
<div class="d-flex justify-content-between">
<div class="col-10">
                        <input wire:model.defer="perInfo.departmentName" type="text" class="form-control @error('departmentName') is-invalid @enderror" id="departmentName" placeholder="@lang('auth.departmentName')">
                        @error('departmentName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        </div>
                        <div class="col">
                        <button class="btn btn-primary">
                                <i class="fa fa-plus-circle mr-2"></i>
                                @if ($showEditDepartmentForm)
                        <span>@lang('auth.saveChanges')</span>
                    @else
                        <span>@lang('auth.save')</span>
                    @endif
                            </button>
</div>
</div>
                </form>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">@lang('auth.dep')</th>
                                <th scope="col">@lang('auth.options')</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ $department->departmentName }}</td>

                                        <td>
                                            <a wire:click.prevent="show_edit_department_form({{ $department }})" href="" class="EditIcon"><i class="fa fa-edit mr-2"></i></a>
                                            <a wire:click.prevent="show_conformation_model( {{ $department->id }} )" href="" class="DeleteIcon"><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer d-flex justify-content-centerid">
                         {{ $departments->links() }}
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
              <h5 class="modal-title" id="exampleModalLabel">@lang('auth.deleteDep')</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>@lang('auth.deleteDepMsg')</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>@lang('auth.cancel')</button>
                <button wire:click.prevent="delete_department( {{ $department }} )" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>@lang('auth.delete')</button>
            </div>
          </div>
        </div>
    </div>
</div>

