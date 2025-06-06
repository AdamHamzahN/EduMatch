<!DOCTYPE html>
<html lang="en">
@php
    $viteResources = ['resources/css/app.css', 'resources/js/app.js', 'resources/sass/app.scss'];
    $extraResources = trim(View::yieldContent('resource'));

    if (!empty($extraResources)) {
        $extraResources = explode(',', $extraResources);
        $viteResources = array_merge($viteResources, array_map('trim', $extraResources));
    }
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <title>EduMatch | @yield('page-name') </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
    @vite($viteResources)
</head>

@yield('body')

</html>
