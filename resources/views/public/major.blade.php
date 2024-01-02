@extends('public.layout.app')
@section('content')
    <div class="hero overlay inner-page">
        <img src="financing/images/blob.svg" alt="" class="img-fluid blob">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">Kompetensi Keahlian</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section sec-services">
        <div class="container">
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
                                <p><a href="{{ route('public-major.show',$major->slug) }}" class="btn btn-outline-primary py-2 px-3">Selengkapnya</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
