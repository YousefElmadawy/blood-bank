<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Blood Bank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar sidebar-collapse">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
                <small> <a href="{{ route('dashboard') }}" class="d-block">{{ Auth::user()->email }}</a></small>
            </div>
            <div class="info">

            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('donations.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>
                            Donations

                        </p>
                    </a>

                </li>




                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="fas fa-file-signature"></i>
                        <p>
                            Categories

                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Posts

                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="{{ route('governorates.index') }}" class="nav-link">
                        <i class="fas fa-city"></i>
                        <p>
                            Governorates

                        </p>
                    </a>
                    {{-- <ul class="nav nav-treeview"> --}}

                    {{-- <li class="nav-item">
                <a href="{{ route('governorates.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Governorates</p>
                </a>
              </li> --}}
                    {{-- </ul> --}}
                </li>

                <li class="nav-item">
                    <a href="{{ route('cities.index') }}" class="nav-link">
                        <i class="fas fa-city"></i>
                        <p>
                            Cities
                            {{-- <i class="fas fa-angle-left right"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="fas fa-user-tag"></i>
                        <p>
                            Roles
                            {{-- <i class="fas fa-angle-left right"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}" class="nav-link">
                        <i class="fas fa-wrench"></i>
                        <p>
                            Permissions
                            {{-- <i class="fas fa-angle-left right"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>
                            Users
                            {{-- <i class="fas fa-angle-left right"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('settings.index') }}" class="nav-link">
                        <i class="fas fa-user-cog"></i>
                        <p>
                            Settings
                            {{-- <i class="fas fa-angle-left right"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact-us.index') }}" class="nav-link">
                        <i class="fas fa-phone"></i>
                        <p>
                            Contacts

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('password.request') }}" class="nav-link">
                        <i class="fas fa-unlock-alt"></i>
                        <p>
                            Change Password
                            {{-- <i class="fas fa-angle-left right"></i> --}}
                        </p>
                    </a>
                </li>

                {{-- 
                <li class="nav-item">
                    <a href="../widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}











            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
