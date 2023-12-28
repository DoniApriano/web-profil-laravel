@extends('dashboard.layout.app')
@section('content')
    <div class="">
        <h1>{{ Auth::user()->username }}</h1>
    </div>
@endsection
