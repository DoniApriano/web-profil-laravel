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
                            <li class="active"><a href="index.html">Beranda</a></li>
                            <li class="has-children">
                                <a >Profil</a>
                                <ul class="dropdown">
                                    <li><a href="">Sambutan Kepala Sekolah</a></li>
                                    <li><a href="">Profil Sekolah</a></li>
                                    <li><a href="">Sejarah Sekolah</a></li>
                                    <li><a href="">Kompetensi Keahlian</a></li>
                                    <li><a href="">Ekstrakurikuler</a></li>
                                </ul>
                            </li>
                            <li><a href="blog.html">Informasi & Artikel</a></li>
                            <li><a href="services.html">Tentang</a></li>
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
