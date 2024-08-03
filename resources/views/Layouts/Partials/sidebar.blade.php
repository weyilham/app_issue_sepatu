<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">Layanan Pengaduan</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">LP</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="/dashboard"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>

            @can('is_admin')
                <li class="menu-header">Data Master</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i><span>Data
                            Master</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="/users">Users</a></li>
                        <li><a class="nav-link" href="/sepatu">Data Sepatu</a></li>
                        <li><a class="nav-link" href="/artikel">Data Artikel</a></li>
                    </ul>
                </li>
            @endcan

            <li class="menu-header">Pengajuan</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-tasks"></i><span>Pengajuan
                    </span></a>
                <ul class="dropdown-menu">
                    @can('is_quality-control')
                        <li><a class="nav-link" href="/issue">Pengajuan Issue</a></li>
                    @endcan
                    @can('is_laboratorium')
                        <li><a class="nav-link" href="/improve">Improve</a></li>
                    @endcan
                </ul>
            </li>

            <li class="menu-header">Laporan</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i><span>Laporan
                    </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="/laporan/issue"><span>Laporan Sepatu
                                Issue</span></a>
                    <li><a class="nav-link" href="/laporan/improve"><span>Laporan Sepatu
                                Improve</span></a>
                </ul>
            </li>

        </ul>


    </aside>
</div>
