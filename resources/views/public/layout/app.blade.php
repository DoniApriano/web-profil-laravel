<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="/storage/icon/{{ $configuration->icon }}">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    @include('public.layout.css')


    <title>{{ $configuration->title }}</title>
</head>

<body>

    @include('public.layout.navbar')

    @yield('content')

    @include('public.layout.footer')

    @include('public.layout.js')
</body>

</html>
