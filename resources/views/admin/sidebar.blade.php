<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <img src="{{ asset('img/logo.png') }}" class="img-fluid rounded-start" alt="...">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ URL::to('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ URL::to('admin/usermanagement') }}" >
            <i class="fas fa-fw fa-cog"></i>
            <span>User Management</span>
        </a>
       
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('room') }}" >
            <i class="fas fa-fw fa-wrench"></i>
            <span>Room</span>
        </a>
    
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ URL::to('admin/booking') }}" >
            <i class="fas fa-fw fa-wrench"></i>
            <span>Booking</span>
        </a>
    
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ URL::to('admin/reports') }}" >
            <i class="fas fa-fw fa-folder"></i>
            <span>Report</span>
        </a>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

 

 
</ul>