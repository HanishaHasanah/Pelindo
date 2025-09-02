<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Curah Cair</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home Page</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

<!-- Nav Item - Charts -->
            <li class="nav-item {{ request()->routeIs('dashboard_CK') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard_CK') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Dashboard Curah Kering</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item {{ request()->routeIs('Data_CK') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('Data_CK') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data Produksi</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item {{ request()->routeIs('analisis_CK') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('analisis_CK') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Analisis Produksi</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->