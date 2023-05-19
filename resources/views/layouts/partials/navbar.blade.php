<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- User -->
        <li class="user-panel d-flex">
            <div class="image">
                <img src="{{ asset ('backend/dist/img/user-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="nav-link info d-flex justify-content-center align-items-center">
                <span class="d-block userIcon">{{ Auth::user()->username }}</span>
            </div>
        </li>

        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="" role="button">
            <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
            <form class="form-inline">
                <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
                </div>
            </form>
            </div>
        </li>


        <!-- Language Dropdown Menu -->

        <li class="nav-item langIcon">
        <div class="dropdown">
  <button class="btn dropdown-toggle" id="dropdownMenuButton"  type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <i class="fa fa-language"></i>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{url('en')}}">@lang('auth.english')</a>
    <a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}" href="{{url('ar')}}">@lang('auth.arabic')</a>
  </div>
</div>
        </li>

        {{-- Logout --}}
        <li class="nav-item logoutIcon">
            <a class="nav-link" data-widget="logout" href="logout" role="button"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="me-50" data-feather="log-out"></i><i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
            </form>
        </li>
    </ul>
</nav>
