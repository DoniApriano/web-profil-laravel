<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <div class="row g-0 align-items-center">
                    <div class="col-2">
                        <a href="{{ route('index') }}"
                            class="logo m-0 float-start fs-5">{{ $configuration->title }}<span
                                class="text-primary">.</span></a>
                    </div>
                    <div class="col-9 text-end">
                        <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('index') }}">Beranda</a></li>
                            <li class="has-children">
                                <a >Profil</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('public-welcome.index') }}">Sambutan Kepala Sekolah</a></li>
                                    <li><a href="{{ route('public-profile.index') }}">Profil Sekolah</a></li>
                                    <li><a href="{{ route('public-history.index') }}">Sejarah Sekolah</a></li>
                                    <li><a href="{{ route('public-major.index') }}">Kompetensi Keahlian</a></li>
                                    <li><a href="{{ route('public-extra.index') }}">Ekstrakurikuler</a></li>
                                </ul>
                            </li>
                            <li class="{{ Request::is('artikel') ? 'active' : '' }}"><a href="{{ route('public-article.index') }}">Informasi & Artikel</a></li>
                            <li class="{{ Request::is('tentang') ? 'active' : '' }}"><a href="{{ route('public-about.index') }}">Tentang</a></li>
                        </ul>
                    </div>
                    <div class="col-1 text-end">
                        <a href="#"
                            class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
