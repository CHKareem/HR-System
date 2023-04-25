<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed; overflow-y: hidden; overflow-x: hidden;">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
      <img src="{{ asset ('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Human Resource - Sys</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset ('backend/dist/img/user-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info d-flex justify-content-center align-items-center">
          <a class="d-block">Amr Alsaleh</a>
          <a href="logout" class="fa-solid fa-arrow-right-from-bracket ml-3"></a>
        </div>
      </div> --}}

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    Dashboard
                    {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>
            <hr style="width:200px;background: rgb(111, 111, 111);">
            <li class="nav-item">
              <a href="{{ route('employees') }}" class="nav-link {{ request()->is('employees') ? 'active' : '' }} ">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                  Employees
                  </p>
              </a>
          </li>
            <li class="nav-item">
                <a href="{{ route('attendees') }}" class="nav-link {{ request()->is('attendees') ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-solid fa-fingerprint"></i>
                    <p>
                    Attendees
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('discount') }}" class="nav-link {{ request()->is('discount') ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-solid fa-sack-dollar"></i>
                    <p>
                    Discount
                    </p>
                </a>
            </li>
            <hr style="width:200px;background: rgb(111, 111, 111);">
            <li class="nav-item">
              <a href="{{ route('centers') }}" class="nav-link {{ request()->is('centers') ? 'active' : '' }} ">
                  <i class="nav-icon fa-sharp fa-solid fa-building-columns"></i>
                  <p>
                  Centers
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('departments') }}" class="nav-link {{ request()->is('departments') ? 'active' : '' }} ">
                  <i class="nav-icon fa fa-building" aria-hidden="true"></i>
                  <p>
                  Departments
                  </p>
              </a>
          </li>
            <li class="nav-item">
                <a href="{{ route('positions') }}" class="nav-link {{ request()->is('positions') ? 'active' : '' }} ">
                    <i class="nav-icon fa-solid fa-map-pin"></i>
                    <p>
                    Positions
                    </p>
                </a>
            </li>
            <hr style="width:200px;background: rgb(111, 111, 111);">
            <li class="nav-item">
                <a href="{{ route('vacations') }}" class="nav-link {{ request()->is('vacations') ? 'active' : '' }} ">
                  <i class="fa-solid fa-door-open nav-icon"></i>
                  <p>Vacations</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('holidays') }}" class="nav-link {{ request()->is('holidays') ? 'active' : '' }} ">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                    Holidays
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reports') }}" class="nav-link {{ request()->is('reports') ? 'active' : '' }} ">
                  <i class="fa fa-file-text nav-icon"></i>
                  <p>Reports</p>
                </a>
            </li>
            <hr style="width:200px;background: rgb(111, 111, 111);">
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
