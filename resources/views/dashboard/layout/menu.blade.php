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
            <li class="menu-item {{ Request::is('dashboard/pengguna') ? 'active' : '' }}">
                <a href="{{ route('contributor.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Analytics">Pengguna</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('dashboard/halaman-utama') ? 'active' : '' }}">
                <a href="{{ route('home.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home"></i>
                    <div data-i18n="Analytics">Halaman Utama</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('dashboard/ekstrakurikuler') || Request::is('dashboard/galeri') ? 'open' : '' }}"
                style="">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                    <div data-i18n="Misc">Kegiatan</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Request::is('dashboard/ekstrakurikuler') ? 'active' : '' }}">
                        <a href="{{ route('extra.index') }}" class="menu-link">
                            <div>Ekstrakurikuler</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('dashboard/galeri') ? 'active' : '' }}">
                        <a href="{{ route('gallery.index') }}" class="menu-link">
                            <div>Galeri Kegiatan</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item {{ Request::is('dashboard/kejuruan') ? 'active' : '' }}">
                <a href="{{ route('major.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-car"></i>
                    <div data-i18n="Analytics">Kejuruan</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('dashboard/semua-artikel') || Request::is('dashboard/kategori-artikel') ? 'open' : '' }}"
                style="">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-news"></i>
                    <div data-i18n="Misc">Artikel</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Request::is('dashboard/semua-artikel') ? 'active' : '' }}">
                        <a href="{{ route('all-article.index') }}" class="menu-link">
                            <div>Semua Artikel</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('dashboard/kategori-artikel') ? 'active' : '' }}">
                        <a href="{{ route('category.index') }}" class="menu-link">
                            <div>Kategori Artikel</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item {{ Request::is('dashboard/media-sosial') ? 'active' : '' }}">
                <a href="{{ route('social-media.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-megaphone"></i>
                    <div data-i18n="Analytics">Media Sosial</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('dashboard/tentang') ? 'active' : '' }}">
                <a href="{{ route('about.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-info-circle"></i>
                    <div data-i18n="Analytics">Tentang Website</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('dashboard/konfigurasi') ? 'active' : '' }}">
                <a href="{{ route('configuration.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="Analytics">Konfigurasi</div>
                </a>
            </li>
        @endif
        @if (Auth::user()->level == 'contributor')
            <li class="menu-item {{ Request::is('dashboard/artikel') ? 'active' : '' }}">
                <a href="{{ route('article.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-news"></i>
                    <div data-i18n="Analytics">Artikel</div>
                </a>
            </li>
        @endif
        <style>
            .logout-item {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                text-align: center;
            }

            .logout-item button {
                margin-top: 10px;
                margin-bottom: 10px;
                flex-direction: row
            }

            .logout-item button:hover {
                color: #007bff;
            }
        </style>
        <li class="menu-item logout-item d-flex align-items-center">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-center btn btn-danger">
                    <i class="menu-icon tf-icons bx bx-log-out text-white"></i>
                    <div data-i18n="Analytics" class="text-white">Keluar</div>
                </button>
            </form>
        </li>
    </ul>
</aside>
