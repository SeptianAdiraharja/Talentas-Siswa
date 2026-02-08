<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logo2.jpeg') }}"
                alt="Logo PGRI"
                style="width: 40px;
                        height: 40px;
                        object-fit: cover;
                        border-radius: 50%;
                        border: 1px solid #ffffff;
                        padding: 2px;">
        </div>
        <div class="sidebar-brand-text mx-3">Talenta Siswa</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    @php
        $role = auth()->user()->role->name;
    @endphp

    <div class="sidebar-heading">
        Menu {{ ucfirst($role) }}
    </div>

    @if($role === 'kepala sekolah')
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Bantuan</div>
        <li class="nav-item {{ request()->routeIs('kepalasekolah.panduan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kepalasekolah.panduan') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Panduan Sistem</span>
            </a>
        </li>
    @endif

    @if($role === 'tu')
        <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Manajemen User</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('criteria.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('criteria.index') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Kriteria Talenta</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.periods') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.periods') }}">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Periode</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('ranking') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('ranking') }}">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Kelola Ranking & Laporan</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Bantuan</div>
        <li class="nav-item {{ request()->routeIs('admin.panduan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.panduan') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Panduan Sistem</span>
            </a>
        </li>
    @endif

    @if($role === 'guru')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('guru.students') }}">
                <i class="fas fa-fw fa-user-graduate"></i>
                <span>Data Siswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('guru.ranking') }}">
                <i class="fas fa-fw fa-trophy"></i>
                <span>Ranking</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Bantuan</div>
        <li class="nav-item {{ request()->routeIs('guru.panduan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('guru.panduan') }}">
                <i class="fas fa-fw fa-question-circle"></i>
                <span>Cara Penilaian</span>
            </a>
        </li>
    @endif

    @if($role === 'siswa')
        <li class="nav-item">
            <a href="{{ route('siswa.ranking') }}" class="nav-link">
                <i class="fas fa-chart-line"></i>
                <span>Ranking</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"href="{{ route('siswa.nilai') }}">
                <i class="fas fa-fw fa-star"></i>
                <span>Nilai Saya</span>
            </a>
        </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>