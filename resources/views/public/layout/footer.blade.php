<div class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget">
                    <h3>Tentang Website</h3>
                    <p>{{ $about->text }}</p>
                </div> <!-- /.widget -->
                <div class="widget">
                    <h3>Alamat</h3>
                    <address>{{ $configuration->address }}</address>
                    <ul class="list-unstyled links">
                        <li><a href="tel://{{ $configuration->phone_number }}">{{ $configuration->phone_number }}</a></li>
                        <li><a href="mailto:{{ $configuration->email }}">{{ $configuration->email }}</a></li>
                    </ul>
                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3>Navigation</h3>
                    <ul class="list-unstyled links mb-4">
                        <li><a href="#">Our Vision</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>

                    <h3>Sosial Media {{ $configuration->title }} </h3>
                    <ul class="list-unstyled social">
                        <li><a href="https://{{ $socialMedia->instagram }}"><span class="icon-instagram"></span></a></li>
                        <li><a href="https://{{ $socialMedia->facebook }}"><span class="icon-facebook"></span></a></li>
                        <li><a href="https://{{ $socialMedia->youtube }}"><span class="icon-youtube"></span></a></li>
                    </ul>
                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /.site-footer -->

{{-- <!-- Preloader -->
<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div> --}}
