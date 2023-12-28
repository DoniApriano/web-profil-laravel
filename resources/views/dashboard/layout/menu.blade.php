<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <h3 class="app-brand-text menu-text fw-bolder ms-2">Web Profil SMK</h3>
        </a>

        <a href="" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @if (Auth::user()->level == 'admin')
            <li class="menu-item {{ Request::is('pengguna') ? 'active' : '' }}">
                <a href="{{ route('contributor.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Analytics">Pengguna</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('konfigurasi') ? 'active' : '' }}">
                <a href="{{ route('configuration.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="Analytics">Konfigurasi</div>
                </a>
            </li>
        @endif
        @if (Auth::user()->level == 'contributor')
        @endif
    </ul>
</aside>
