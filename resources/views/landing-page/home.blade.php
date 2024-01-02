@extends('landing-page.layout.app')
@section('content')
    <div class="hero overlay">
        <img src="financing/images/blob.svg" alt="" class="img-fluid blob">
        <div class="container">
            <div class="row align-items-center justify-content-between pt-5">
                <div class="col-lg-6 text-center text-lg-start pe-lg-5">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">{{ $home->primary_quote }}</h1>
                    <p class="text-white mb-5" data-aos="fade-up" data-aos-delay="100">{{ $home->secondary_quote }}</p>
                    <div class="align-items-center mb-5 mm" data-aos="fade-up" data-aos-delay="200">
                        <a href="contact.html" class="btn btn-outline-white-reverse">Hubungi Kami</a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="img-fluid text-center">
                        <img src="/storage/home/{{ $home->image }}" alt="Image" class="img-fluid rounded w-75">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section sec-services">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-5 mx-auto text-center" data-aos="fade-up">
                    <h2 class="heading text-primary">Kompetensi Keahlian</h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                @foreach ($majors as $major)
                    <div class="col-sm-6 col-lg-3 rounded" data-aos="fade-up">
                        <div class="service text-center">
                            <img src="/storage/major-image/{{ $major->image }}" class="img-fluid" alt=""
                                srcset="">
                            <div class="text-center">
                                <h3 class="mt-2 fs-6"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $major->name }}</h3>
                                <p><a href="#" class="btn btn-outline-primary py-2 px-3">Read more</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="section sec-news">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-7">
                    <h2 class="heading text-primary">Informasi & Artikel</h2>
                </div>
            </div>
            @php
                use Nim4n\SimpleDate;
            @endphp

            <div class="row">
                @foreach ($latestArticle as $la)
                    <div class="col-sm-6 col-md-4 col-lg-4 rounded">
                        <div class="card post-entry">
                            <a href="single.html"><img src="storage/article/{{ $la->image }}" class="card-img-top img-fluid" alt="Image"></a>
                            <div class="card-body">
                                <div><span class="text-uppercase font-weight-bold date">{{ SimpleDate::dayDate($la->created_at) }}</span></div>
                                <h5 class="card-title"><a href="single.html">{{ $la->title }}</a></h5>
                                <p>{!! Str::limit($la->content, 50, '...') !!}</p>
                                <div class="row">
                                    <div class="col-7">
                                        <p class="mt-5 mb-0">{{ $la->user->name }}</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="mt-5 mb-0"><a href="#">Read more</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
