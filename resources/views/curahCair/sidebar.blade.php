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
    <li class="nav-item {{ request()->routeIs('curah.cair') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('curah.cair') }}">
            <i class="fas fa-fw fa-water"></i>
            <span>Dashboard Curah Cair</span></a>
    </li>


<!-- Data -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData"
        aria-expanded="true" aria-controls="collapseData">
        <i class="fas fa-fw fa-table"></i>
        <span>Data</span>
    </a>
    <div id="collapseData" class="collapse" aria-labelledby="headingData" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->routeIs('data.shipper') ? 'active' : '' }}"
                href="{{ route('data.shipper') }}">Shipper</a>
            <a class="collapse-item {{ request()->routeIs('data.commodity') ? 'active' : '' }}"
                href="{{ route('data.commodity') }}">Komoditas</a>
        </div>
    </div>
</li>

<!-- Analisis Produksi -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnalisis"
        aria-expanded="true" aria-controls="collapseAnalisis">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Analisis Produksi</span>
    </a>
    <div id="collapseAnalisis" class="collapse" aria-labelledby="headingAnalisis" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->routeIs('analisis.shipper') ? 'active' : '' }}"
                href="{{ route('analisis.shipper') }}">Shipper</a>
            <a class="collapse-item {{ request()->routeIs('analisis.komoditas') ? 'active' : '' }}"
                href="{{ route('analisis.komoditas') }}">Komoditas</a>
        </div>
    </div>
</li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->