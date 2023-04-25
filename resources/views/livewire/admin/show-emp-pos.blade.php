<div>
  




                <!-- Tabs navs -->
                <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link active" id="ex-with-icons-tab-1" data-toggle="tab" href="#ex-with-icons-tabs-1" role="tab"
                    aria-controls="ex-with-icons-tabs-1" aria-selected="true"><i class="fa fa-plus-circle mr-2 fa-fw me-2"></i>Add</a>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link" id="ex-with-icons-tab-2" data-toggle="tab" href="#ex-with-icons-tabs-2" role="tab"
                    aria-controls="ex-with-icons-tabs-2" aria-selected="false"><i class=" fa fa-edit mr-2 fa-fw me-2"></i>Edit</a>
                </li>
                <li class="nav-item" role="presentation" wire:ignore>
                    <a class="nav-link" id="ex-with-icons-tab-3" data-toggle="tab" href="#ex-with-icons-tabs-3" role="tab"
                    aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fa-solid fa-table mr-2 fa-fw me-2"></i>Import & Export</a>
                </li>
                </ul>
                <!-- Tabs navs -->
                
                <!-- Tabs content -->
                <div class="tab-content" id="ex-with-icons-content">
                 <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel" aria-labelledby="ex-with-icons-tab-1" wire:ignore.self>
                  <div class="form-row">
                    <div class="form-group col-md-6">
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

                    <div class="form-group col-md-6">
                        <label for="fullName">Position Name</label>
                        <div class="search-box">
                        <input wire:model="searchPosition" wire:keyup="searchResultPosition" type="text" class="form-control" id="fullName" placeholder="Enter Position Name">
                                                    <!-- Search result list -->
                                                    @if($showdivPosition)
                                <ul>
                                    @if(!empty($recordsPosition))
                                        @foreach($recordsPosition as $recordPosition)

                                            <li wire:click="fetchPositionDetail({{ $recordPosition->id }})">{{ $recordPosition->positionName}}</li>

                                        @endforeach
                                    @endif
                                </ul>
                            @endif

                            <div class="clear"></div>
                            <div>
                                @if(!empty($posDetails))
                                    <div>
                                        Name : {{ $posDetails->positionName }} <br>
                                    </div>
                                @endif
                            </div>
                          </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fullName">Department Name</label>
                        <div class="search-box">
                        <input wire:model="searchDepartment" wire:keyup="searchResultDepartment" type="text" class="form-control" id="fullName" placeholder="Enter Department Name">
                                                    <!-- Search result list -->
                                                    @if($showdivDepartment)
                                <ul>
                                    @if(!empty($recordsDepartment))
                                        @foreach($recordsDepartment as $recordDepartment)

                                            <li wire:click="fetchDepartmentDetail({{ $recordDepartment->id }})">{{ $recordDepartment->departmentName}}</li>

                                        @endforeach
                                    @endif
                                </ul>
                            @endif

                            <div class="clear"></div>
                            <div>
                                @if(!empty($depDetails))
                                    <div>
                                        Name : {{ $depDetails->departmentName }} <br>
                                    </div>
                                @endif
                            </div>
                          </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fullName">Center Name</label>
                        <div class="search-box">
                        <input wire:model="searchCenter" wire:keyup="searchResultCenter" type="text" class="form-control" id="fullName" placeholder="Enter Center Name">
                                                    <!-- Search result list -->
                                                    @if($showdivCenter)
                                <ul>
                                    @if(!empty($recordsCenter))
                                        @foreach($recordsCenter as $recordCenter)

                                            <li wire:click="fetchCenterDetail({{ $recordCenter->id }})">{{ $recordCenter->centerName}}</li>

                                        @endforeach
                                    @endif
                                </ul>
                            @endif

                            <div class="clear"></div>
                            <div>
                                @if(!empty($centDetails))
                                    <div>
                                        Name : {{ $centDetails->centerName }} <br>
                                    </div>
                                @endif
                            </div>
                          </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="startDate">Start Date</label>
                        <input wire:model="startDate" type="date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="endDate">End Date</label>
                        <input wire:model="endDate" type="date" class="form-control" id="endDate">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary" wire:click="new_employee_position"><i class="fa fa-save mr-1"></i>
                        <span>Save</span>
                </button>
            </div>
                </div>

                  <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2" wire:ignore.self>
                  <div class="form-row">
                  <div class="form-group col-lg-12">
                        <label for="employeeId1">Employee Name</label>
                        <div class="search-box">
                          <input wire:model="searchEdit" wire:keyup="searchResultEdit" type="text" class="form-control" id="employeeId1" placeholder="Enter Employee Name">
                        
                            <!-- Search result list -->
                            @if($showdivEdit)
                                <ul >
                                    @if(!empty($recordsEdit))
                                        @foreach($recordsEdit as $recordEdit)

                                            <li wire:click="fetchEmployeeDetailEdit({{ $recordEdit->id }})">{{ $recordEdit->fullName}}</li>

                                        @endforeach
                                    @endif
                                </ul>
                            @endif

                            <div class="clear"></div>
                            <div>
                                @if(!empty($empEditDetails))
                                    <div>
                                    Name : {{ $empEditDetails->fullName }} <br><br>
                                    </div>
                                @endif
                            </div>
        
                            </div>
                            </div>
                   </div>

                   <div class="form-row">
                            @if($getEmployeePositions !== Null)
                            @foreach($getEmployeePositions as $index => $getEmployeePosition)
                            <input type="text" class="form-control" wire:model="getEmployeePositions.{{ $index }}.id" hidden>
                            <div class="form-group col-lg-12">
                        <label >Position Name: </label>
                        <select wire:model="getEmployeePositions.{{ $index }}.position_id" class="custom-select rounded-0">
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->positionName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label >Department Name: </label>
                        <select wire:model="getEmployeePositions.{{ $index }}.department_id" class="custom-select rounded-0">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->departmentName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label >Center Name: </label>
                        <select wire:model="getEmployeePositions.{{ $index }}.center_id" class="custom-select rounded-0">
                            @foreach ($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->centerName }}</option>
                            @endforeach
                        </select>
                    </div>
                            <div class="form-group col-lg-6">
                                <label>Start Date</label>
                                <input type="date" class="form-control" wire:model="getEmployeePositions.{{ $index }}.startDate">
                                </div>
                                <div class="form-group col-lg-6">
                                <label for="editEndDate">End Date</label>
                                <input type="date" class="form-control" wire:model="getEmployeePositions.{{ $index }}.endDate">
                            </div>
                            <br><hr style="width:95%;height:1px;background: rgba(0,0,0,.2);" class="hr-style"><br>
                            @endforeach
                            
                            <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" wire:click="edit_employee_position"><i class="fa fa-save mr-1"></i>
                                <span>Save</span>
                        </button>
                    </div>
                            
                    @endif
</div>
                </div>
                <div class="tab-pane fade" id="ex-with-icons-tabs-3" role="tabpanel" aria-labelledby="ex-with-icons-tab-3" wire:ignore.self>

                            <div class="modal-dialog modal-lg" role="document">
        <form
        action="{{ route('import_positions_employees') }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf

            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="file1" class="drop-container">
  <span class="drop-title">Drop files here</span>
  or
  <input type="file" id="file1" name="file1" required>
</label>


                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                        <span>Import File</span>
                </button>
            </form>
            
                <form
                                action="{{ route('export_positions_employees') }}"
                                method="get"
                                enctype="multipart/form-data">
                                @csrf
                            <button class="btn btn-primary">
                                    <i class="fa-solid fa-table mr-2"></i> Export Employees Positions
                                </button>
                   </div>
                            </form>
            
            </div>
        </div>


                </div>
                </div>
                <!-- Tabs content -->
                </div>

          

</div>
