@extends('public.layout.app')
@section('content')
    <div class="hero overlay inner-page">
        <img src="{{ asset('financing/images/blob.svg') }}" alt="" class="img-fluid blob">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">{{ $welcomeText->title }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="section ">
        <div class="container">
            <div class="row mb-5">
                <div class="text-center p-5" data-aos="fade-up">
                    <img src="/storage/welcome-image/{{ $welcomeText->image }}"  class="img-fluid" alt="" srcset="">
                </div>
                <div class="col-lg-12 mx-auto text-justify" data-aos="fade-up">
                    <p class="fs-5 text-black">{!! $welcomeText->text !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
