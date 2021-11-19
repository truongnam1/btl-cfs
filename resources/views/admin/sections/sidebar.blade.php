<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin-dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Quản lý website CFS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{url()->current() == route('admin-dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin-dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý
    </div>

    <!-- Nav Item - Tables -->
    @can('manage.user.view-manage')
    <li class="nav-item {{url()->current() == route('manage-user') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('manage-user')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Người dùng</span>
        </a>
    </li>
    @endcan


    <!-- phân quyền -->
    @canany(['manage.role.view-manage','manage.permission.view-manage'])
    <li class="nav-item {{url()->current() == route('role-roleList') || url()->current() == route('role-permission') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Phân quyền</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Phân quyền:</h6>

                @can('manage.role.view-manage')
                <a class="collapse-item" href="{{route('role-roleList')}}">Vai trò</a>
                @endcan

                @can('manage.permission.view-manage')
                <a class="collapse-item" href="{{route('role-permission')}}">Quyền hạn</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan

    @can('manage.posts-report.view-manage')
    <li class="nav-item {{url()->current() == route('admin-reportPost') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin-reportPost')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Báo cáo</span></a>
    </li>
    @endcan

    @can('manage.tag.view-manage')
    <li class="nav-item {{url()->current() == route('admin-tag') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('admin-tag')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Nhãn</span></a>
    </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card d-none d-lg-flex">
           <img class="sidebar-card-illustration mb-2" src="{{ asset('storage/images/undraw_rocket.svg')}}" alt="...">
           <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
           <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
       </div> -->

</ul>
<!-- End of Sidebar -->