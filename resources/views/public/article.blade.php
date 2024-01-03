@extends('public.layout.app')
@section('content')
    <div class="hero overlay inner-page">
        <img src="financing/images/blob.svg" alt="" class="img-fluid blob">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">Informasi & Artikel</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section sec-news">
        <div class="container">
            @php
                use Nim4n\SimpleDate;
            @endphp

            <div class="row d-flex justify-content-center">
                @foreach ($articles as $la)
                    <div class="col-sm-6 col-md-4 col-lg-4 p-2 rounded" data-aos="fade-up">
                        <div class="card post-entry">
                            <img src="storage/article/{{ $la->image }}" height="240" class="card-img-top"
                                alt="Image">
                            <div class="card-body">
                                <div><span
                                        class="text-uppercase font-weight-bold date">{{ SimpleDate::dayDate($la->created_at) }}</span>
                                </div>
                                <h5 class="card-title "
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><a
                                        href="{{ route('public-article.show', $la->slug) }}">{{ $la->title }}</a></h5>
                                <p>{!! Str::limit($la->content, 50, '...') !!}</p>
                                <div class="row">
                                    <div class="col-7">
                                        <p class="mt-5 mb-0">{{ $la->user->name }}</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="mt-5 mb-0"><a href="{{ route('public-article.show', $la->slug) }}">Lihat
                                                Detail</a></p>
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
