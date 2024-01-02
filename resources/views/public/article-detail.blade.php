@extends('public.layout.app')
@section('content')
    <div class="hero overlay inner-page">
        <img src="{{ asset('financing/images/blob.svg') }}" alt="" class="img-fluid blob">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    @php
                        use Nim4n\SimpleDate;
                    @endphp
                    <p data-aos="fade-up" class="meta">oleh {{ $article->user->name }} &bullet; pada
                        {{ SimpleDate::dayDate($article->created_at) }}
                    </p>
                    <h4 class="text-white mb-3" data-aos="fade-up" data-aos-delay="100">{{ $article->title }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container article">
            <div class="row justify-content-center align-items-stretch">
                <article class="col-lg-8 order-lg-2 px-lg-5 text-justify">
                    <img src="/storage/article/{{ $article->image }}" alt="Image" class="img-fluid rounded">
                    <p class="text-black">{!! $article->content !!}</p>
                    <div class="pt-5 categories_tags ">
                        <p>Kategori: {{ $article->category->name }}</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
