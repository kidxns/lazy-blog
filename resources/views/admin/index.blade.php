@extends('layouts.app')
@section('main')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fab fa-dev"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Lazy Dev</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Route::current()->getName() === 'dashboard.index' ? "active" : '' }}">
                <a class="nav-link" href="admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Main
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ Route::current()->getName()==='posts.index' ? "active" : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-blog"></i>
                    <span>Blog</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/admin/posts">List</a>
                        <a class="collapse-item" href="/admin/posts/create">Create new blog</a>

                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ Route::current()->getName() === 'categories.index' ? "active" : '' }}">
                <a class="nav-link collapsed" href="/admin/categories">
                    <i class="fas fa-stream"></i>
                    <span>Categories</span>
                </a>
            </li>

            <li class="nav-item {{ Route::current()->getName() === 'comments.index' ? "active" : '' }}">
                <a class="nav-link collapsed" href="/admin/comments">
                    <i class="fas fa-comments"></i>
                    <span>Comments</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manager
            </div>
            <li class="nav-item {{ Route::current()->getName() === 'users.index' ? "active" : '' }}">
                <a class="nav-link collapsed" href="/admin/users">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>


            <li class="nav-item {{ Route::current()->getName() === 'setting.index' ? "active" : '' }}">
                <a class="nav-link collapsed" href="/admin/setting">
                    <i class="fas fa-cogs"></i>
                    <span>Setting</span>
                </a>
            </li>


            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="javascript:() => false">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <i class="fas fa-sign-out-alt"></i>
                        <input class="bnt bnt-logout fz-14" type="submit" value="{{ __('Logout') }}">
                    </form>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small ip-search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <span class="h6 text-capitalize">
                                        Hello {{ Auth::user()->name ?? '' }}
                                    </span><br />
                                    @foreach (Auth::user()->roles as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" value="{{ $role -> id }}" checked>
                                        <label class="form-check-label fz-13">
                                            {{ $role -> name }}
                                        </label>
                                    </div>
                                    @endforeach



                                </span>
                                <img class="img-profile rounded-circle" src="/img/logo.jpg" />
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="breadcrumb">
                        {{ Breadcrumbs::render() }}
                    </div>



                    @yield('content')
                    <div class="include">
                        @include('admin.components.toast')
                        @include('admin.components.confirm')
                        @include('admin.components.sucess')
                        @include('admin.components.error')
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    @endsection
