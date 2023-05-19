<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed; overflow-y: hidden; overflow-x: hidden;">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
      <img src="{{ asset ('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HR - System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    @lang('auth.dashTitle')
                    </p>
                </a>
            </li>
            <hr style="width:200px;background: rgb(111, 111, 111);">
            <li class="nav-item">
              <a href="{{ route('employees') }}" class="nav-link {{ request()->is('employees') ? 'active' : '' }} ">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                  @lang('auth.empTitle')
                  </p>
              </a>
          </li>
            <li class="nav-item">
                <a href="{{ route('attendees') }}" class="nav-link {{ request()->is('attendees') ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-solid fa-fingerprint"></i>
                    <p>
                    @lang('auth.attendTitle')
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('discount') }}" class="nav-link {{ request()->is('discount') ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-solid fa-sack-dollar"></i>
                    <p>
                    @lang('auth.disTitle')
                    </p>
                </a>
            </li>
            <hr style="width:200px;background: rgb(111, 111, 111);">
            <li class="nav-item">
              <a href="{{ route('centers') }}" class="nav-link {{ request()->is('centers') ? 'active' : '' }} ">
                  <i class="nav-icon fa-sharp fa-solid fa-building-columns"></i>
                  <p>
                  @lang('auth.cenTitle')
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('departments') }}" class="nav-link {{ request()->is('departments') ? 'active' : '' }} ">
                  <i class="nav-icon fa fa-building" aria-hidden="true"></i>
                  <p>
                  @lang('auth.depTitle')
                  </p>
              </a>
          </li>
            <li class="nav-item">
                <a href="{{ route('positions') }}" class="nav-link {{ request()->is('positions') ? 'active' : '' }} ">
                    <i class="nav-icon fa-solid fa-map-pin"></i>
                    <p>
                    @lang('auth.posTitle')
                    </p>
                </a>
            </li>
            <hr style="width:200px;background: rgb(111, 111, 111);">
            <li class="nav-item">
                <a href="{{ route('vacations') }}" class="nav-link {{ request()->is('vacations') ? 'active' : '' }} ">
                  <i class="fa-solid fa-door-open nav-icon"></i>
                  <p>
                  @lang('auth.vacTitle')
                  </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('holidays') }}" class="nav-link {{ request()->is('holidays') ? 'active' : '' }} ">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                    @lang('auth.holTitle')
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reports') }}" class="nav-link {{ request()->is('reports') ? 'active' : '' }} ">
                  <i class="fa fa-file-text nav-icon"></i>
                  <p>
                  @lang('auth.repTitle')
                  </p>
                </a>
            </li>
            <hr style="width:200px;background: rgb(111, 111, 111);">
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
