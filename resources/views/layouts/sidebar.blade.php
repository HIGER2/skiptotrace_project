<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="home" class="brand-link">
    <img src="{{asset('auth/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"> SkipToTrace</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="login-image">
        <i class="nav-icon fas fa-user-circle"></i>
      </div>
      <div class="info">
        <a href="javaScript:" class="d-block">{{ Auth::user()->name }} </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
  <!--  <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>-->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('singleSkip')}}" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>Single Skip</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('skipList')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Skip a List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('csvList')}}" class="nav-link">
            <i class="nav-icon fa fa-list"></i>
            <p>My Lists</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript:" class="nav-link">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>
              Billing
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('billing_history')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Billing History</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('addCard')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Card</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('manage_cards')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Cards</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="javascript:" class="nav-link">
            <i class="nav-icon fa fa-credit-card"></i>
            <p>
              Credits
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('add_credits')}}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Add Credits</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="javascript:" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('change_password')}}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Change Password</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>{{ __('Logout') }}</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
