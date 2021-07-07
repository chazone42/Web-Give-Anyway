<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Give Anyway</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400;500&family=Taviraj:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
{{--    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">--}}

<!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('dropzone-5.7.0/dist/dropzone.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    {{-- <script src="{{ asset('dropzone-5.7.0/dist/dropzone.js') }}"></script> --}}
    @yield('styles')

</head>
<body>
@if(session('success_message'))
    <div class="alert alert-success">
        {{session('success_message')}}
    </div>
@endif
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="https://sv1.picz.in.th/images/2021/02/09/oTSl5l.png" alt="giveanyway.png" border="0"
                     height="60">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ 'หน้าแรก'}}</a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
                        </li>

                        <li class="nav-item" >
                                <a class="nav-link rounded" href="{{ route('register') }}" style="background-color: #f26d7d;
                                 color:white; padding: 3px 15px 3px 15px; margin-top:
                               5px">{{ __('สมัครสมาชิก') }}</a>
                        </li>
                        {{-- @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('สมัครสมาชิก') }}</a>
                            </li>
                        @endif --}}
                    @else
                    @if (!Session::get('enrolled'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('enrollform') }}">{{ __('ยืนยันตัวตน')}}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stepform') }}">{{ __('เสนอโครงการ')}}</a>
                        </li>
                    @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle rounded" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre id="user-dec"
                               style="background-color: #f26d7d; color:white; padding: 3px 15px 3px 15px; margin:
                               5px 0 0 8px;">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('myproject') }}">
                                    โครงการของฉัน
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('ออกจากระบบ') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="content bg-light pb-4">
        @yield('content')
    </main>

</div>
@include('sweetalert::alert')
@yield('scripts')

<footer>
    <div class="row shadow">
        <div class="footer-left pt-4 pr-5 pl-5 pb-5 w-50 bg-white ">
            <img src="https://sv1.picz.in.th/images/2021/02/09/oTSl5l.png" alt="giveanyway.png" class="d-block
            " height="60">
        </div>
        <div class="footer-right w-50 bg-white">
            <div class="footer-txt pt-4 pl-3">
                <p>
                    Give anyway <br> เพราะการให้ทำได้เสมอ
                </p>
            </div>
            <div class="footer-menu pt-4">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route('home') }}">{{ 'หน้าแรก'}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('stepform') }}">{{ __('เสนอโครงการ')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('enrollform') }}">{{ __('ยืนยันตัวตน')}}</a>
                    </li>
                </ul>
            </div>
            <div class="footer-contact pt-4 pl-3">
                <div class="btn-group">
                    <button type="button" class="btn-contact"><i class="fa fa-phone"></i></button>
                    <button type="button" class="btn-contact"><i class="fa fa-twitter"></i></button>
                    <button type="button" class="btn-contact"><i class="fa fa-facebook-f"></i></button>
                    <button type="button" class="btn-contact"><i class="fa fa-envelope"></i></button>
                </div>
            </div>
        </div>
    </div>


</footer>
</body>



<style>
    nav{
        font-family: 'Mitr', sans-serif;
    }
    #user-dec{

    }
    footer{
        font-family: 'Mitr', sans-serif;
    }
    .responsive {
        width: 10%;
        height: auto;
    }
    .footer-left{
        float: left;
    }
    .footer-right{
        float: right
    }
    .btn-contact{
        color: white;
        background-color: #ffd654;
        font-size: 16px;
        border: none;
        transition: 0.3s;
        padding: 25px;
    }
    .btn-contact:hover{
        background-color: #f26d7d;
    }
</style>


</html>
