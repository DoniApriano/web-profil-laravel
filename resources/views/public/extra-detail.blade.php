@extends('public.layout.app')
@section('content')
    <div class="hero overlay inner-page pt-5 ">
        <img src="{{ asset('financing/images/blob.svg') }}" alt="" class="img-fluid blob">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">{{ $extra->name }}</h1>
                    <img class="img-fluid pb-5 rounded-3" width="200" data-aos="fade-up" src="/storage/extra-image/{{ $extra->image }}" alt="" srcset="">
                </div>
            </div>
        </div>
    </div>
    <div class="section ">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
                    <h2 class="heading text-primary">Deskripsi</h2>
                    <p class="fs-5 text-black">{{ $extra->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
