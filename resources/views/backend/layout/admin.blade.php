<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard with Materialize</title>

    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet prefetch" href="{{asset('backend/css/material.css')}}">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/font/material-design-icons/Material-Design-Icons.woff'>
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">

    @yield('styles')

</head>
<body>


    @if (Auth::check())
        @if (Auth::user()->type > 1)
            @include('backend.includes.sidebar')

            @include('backend.includes.header')
        @endif
    @else
        <br>
    @endif


    <main>
        @yield('content')
    </main>




    {{-- The Quick Links --}}
    {{-- <div class="fixed-action-btn click-to-toggle" style="bottom: 45px; right: 24px;">
        <a class="btn-floating  pink waves-effect waves-light">
            <i class="large material-icons">add</i>
        </a>

        <ul>
            <li>
                <a class="btn-floating red"><i class="material-icons">note_add</i></a>
                <a href="" class="btn-floating fab-tip">Add a note</a>
            </li>

            <li>
                <a class="btn-floating yellow darken-1"><i class="material-icons">add_a_photo</i></a>
                <a href="" class="btn-floating fab-tip">Add a photo</a>
            </li>

            <li>
                <a class="btn-floating green"><i class="material-icons">alarm_add</i></a>
                <a href="" class="btn-floating fab-tip">Add an alarm</a>
            </li>

            <li>
                <a class="btn-floating blue"><i class="material-icons">vpn_key</i></a>
                <a href="" class="btn-floating fab-tip">Add a master password</a>
            </li>
        </ul>
    </div> --}}


    <script src="{{asset('backend/js/jquery.min.js')}}"></script>
    <script src="{{asset('backend/js/materialize.min.js')}}"></script>

    <script src="{{asset('backend/js/index.js')}}"></script>
    @yield('scripts')

</body>
</html>
