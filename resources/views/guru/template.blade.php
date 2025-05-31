@extends('head')
@section('page-name')
    @yield('page_name')
@endsection

@section('body')

    <body>
        <div class="container-fluid">
            <div class="row" style="height: 100vh;">
                <div class="col-1 bg-primary text-white d-flex flex-column p-1">
                    <nav class="nav flex-column">
                        <a class="nav-link text-white" href="/guru/{{ $user_id }}/chat">Chat</a>
                        <a class="nav-link text-white" href="/guru/{{ $user_id }}/permintaan">Permintaan</a>
                        <a class="nav-link text-white" href="/guru/{{ $user_id }}/profile">Profile</a>
                    </nav>
                </div>

                <div class="col-5 border p-3">
                    @yield('mid-content')
                </div>

                <div class="col-6 border p-1">
                    @yield('right-content')
                </div>
            </div>
        </div>
    @endsection
