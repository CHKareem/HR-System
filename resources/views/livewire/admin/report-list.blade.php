<div>



    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">@lang('auth.repTitle')</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">@lang('auth.dashTitle')</a></li>
                <li class="breadcrumb-item active">@lang('auth.repTitle')</li>
            </ol>
            </div>    
        </div>
        </div>
    </div>

    {{-- Main --}}
    <div class="content">
        <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
                <div class="card card-primary card-outline">
                <div class="card-header">
                <div class="col-md-12 col-12">
                        <label for="employeeId">@lang('auth.employeeName')</label>
                        <div class="search-box">
                          <input wire:model="searchEmployee" wire:keyup="searchResult" type="text" class="form-control" id="employeeId" placeholder="@lang('auth.enterEmpName')">
                        
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
                      </div>


<div class="card-body">
                <!-- Tabs navs -->
                <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link active" id="ex-with-icons-tab-1" data-toggle="tab" href="#ex-with-icons-tabs-1" role="tab"
                    aria-controls="ex-with-icons-tabs-1" aria-selected="true"><i class="fa-solid fa-door-open mr-2 fa-fw me-2"></i>@lang('auth.vacTitle')</a>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link" id="ex-with-icons-tab-2" data-toggle="tab" href="#ex-with-icons-tabs-2" role="tab"
                    aria-controls="ex-with-icons-tabs-2" aria-selected="false"><i class="fa-solid fa-map-pin mr-2 fa-fw me-2"></i>@lang('auth.posTitle')</a>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link" id="ex-with-icons-tab-3" data-toggle="tab" href="#ex-with-icons-tabs-3" role="tab"
                    aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fas fa-solid fa-fingerprint mr-2 fa-fw me-2"></i>@lang('auth.attendTitle')</a>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link" id="ex-with-icons-tab-4" data-toggle="tab" href="#ex-with-icons-tabs-4" role="tab"
                    aria-controls="ex-with-icons-tabs-4" aria-selected="false"><i class="fa-solid fa fa-check mr-2 fa-fw me-2"></i>@lang('auth.evalTitle')</a>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link" id="ex-with-icons-tab-5" data-toggle="tab" href="#ex-with-icons-tabs-5" role="tab"
                    aria-controls="ex-with-icons-tabs-5" aria-selected="false"><i class="fas fa-file-contract mr-2 fa-fw me-2"></i>@lang('auth.contractTitle')</a>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link" id="ex-with-icons-tab-6" data-toggle="tab" href="#ex-with-icons-tabs-6" role="tab"
                    aria-controls="ex-with-icons-tabs-6" aria-selected="false"><i class="far fa-address-card mr-2 fa-fw me-2"></i>@lang('auth.infoTitle')</a>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link" id="ex-with-icons-tab-7" data-toggle="tab" href="#ex-with-icons-tabs-7" role="tab"
                    aria-controls="ex-with-icons-tabs-7" aria-selected="false"><i class="fas fa-exclamation-triangle mr-2 fa-fw me-2"></i>@lang('auth.warnPenTitle')</a>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link" id="ex-with-icons-tab-8" data-toggle="tab" href="#ex-with-icons-tabs-8" role="tab"
                    aria-controls="ex-with-icons-tabs-8" aria-selected="false"><i class="fas fa-money-check-alt mr-2 fa-fw me-2"></i>@lang('auth.disTitle')</a>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link" id="ex-with-icons-tab-9" data-toggle="tab" href="#ex-with-icons-tabs-9" role="tab"
                    aria-controls="ex-with-icons-tabs-9" aria-selected="false"><i class="fas fa-money-check-alt mr-2 fa-fw me-2"></i>@lang('auth.exportTitle')</a>
                </li>
                </ul>
                <!-- Tabs navs -->

                                <!-- Tabs content -->
            <div class="tab-content" id="ex-with-icons-content">
                 <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel" aria-labelledby="ex-with-icons-tab-1" wire:ignore.self><livewire:admin.show-vacations /></div>

                 <div class="tab-pane fade show" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2" wire:ignore.self><livewire:admin.show-positions /></div>

                 <div class="tab-pane fade show" id="ex-with-icons-tabs-3" role="tabpanel" aria-labelledby="ex-with-icons-tab-3" wire:ignore.self><livewire:admin.show-attendances /></div>

                 <div class="tab-pane fade show" id="ex-with-icons-tabs-4" role="tabpanel" aria-labelledby="ex-with-icons-tab-4" wire:ignore.self>d</div>

                 <div class="tab-pane fade show" id="ex-with-icons-tabs-5" role="tabpanel" aria-labelledby="ex-with-icons-tab-5" wire:ignore.self>e</div>

                 <div class="tab-pane fade show" id="ex-with-icons-tabs-6" role="tabpanel" aria-labelledby="ex-with-icons-tab-6" wire:ignore.self>f</div>

                 <div class="tab-pane fade show" id="ex-with-icons-tabs-7" role="tabpanel" aria-labelledby="ex-with-icons-tab-7" wire:ignore.self>g</div>

                 <div class="tab-pane fade show" id="ex-with-icons-tabs-8" role="tabpanel" aria-labelledby="ex-with-icons-tab-8" wire:ignore.self><livewire:admin.show-discounts /></div>

                 <div class="tab-pane fade show" id="ex-with-icons-tabs-9" role="tabpanel" aria-labelledby="ex-with-icons-tab-9" wire:ignore.self><livewire:admin.show-exportables /></div>
</div>

            </div>
</div>

                </div>
</div> 
            </div>     
        </div>
    </div>






</div>
