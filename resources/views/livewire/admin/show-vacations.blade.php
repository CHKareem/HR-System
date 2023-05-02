<div>

<div class="row">
                <div class="col-lg-12">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="modal-title">Filter Data</h5>
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


                <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <div class="form-group col-md-6">
                        <label for="selectedFilter">select Filter</label>
                        <select wire:model="selectedFilter" class="custom-select rounded-0" id="selectedFilter">
                            <option selected> </option>
                            <option value="logDate"> All Attendances </option>
                            <option value="logIn"> LogIn Not Exist </option>
                            <option value="logOut"> LogOut Not Exist </option>
                            <option value="logTime"> Full Absence </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="selectedFilter">select Filter</label>
                        <select wire:model="selectedFilter" class="custom-select rounded-0" id="selectedFilter">
                            <option selected> </option>
                            <option value="logDate"> All Attendances </option>
                            <option value="logIn"> LogIn Not Exist </option>
                            <option value="logOut"> LogOut Not Exist </option>
                            <option value="logTime"> Full Absence </option>
                        </select>
                    </div>
                        </div>
                </div>
</div>


</div>
