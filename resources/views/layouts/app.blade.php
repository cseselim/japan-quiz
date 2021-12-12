<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Quiz', 'Quiz') }}</title>
    <link rel="icon" href="{{ asset('')}}admin/images/sjs-favicon.png" type="image/gif" sizes="16x16">
    <link href="{{ asset('admin/css/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <!--begin::admin custom css-->
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <!--end::admin custom css-->
    <style type="text/css">
        .has-error .form-control {
            border-color: #a94442;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        }
        .has-error .checkbox, .has-error .checkbox-inline, .has-error .control-label, .has-error .help-block, .has-error .radio, .has-error .radio-inline, .has-error.checkbox label, .has-error.checkbox-inline label, .has-error.radio label, .has-error.radio-inline label {
            color: #a94442;
            font-size: 14px;
        }
        .server_site_error{
            color: #a94442;
            font-size: 14px;
        }
    </style>
    
    <script type="text/javascript" src="{{ asset('admin/js/jquery-3.2.1.min.js') }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/sweetalert2.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid container_padding">
                @guest
                <a style="font-size: 25px;font-weight: 700;" class="navbar-brand" href="{{ url('/') }}">
                    Quiz
                </a>
                @else
                    <a style="font-size: 25px;font-weight: 700;" class="navbar-brand" href="{{ url('/home') }}">
                        Quiz
                    </a>
                @endguest
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    <ul class="navbar-nav m-auto">
                        @guest
                            
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('lessonlist.list') }}">Lesson</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('question.list') }}">Question List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('word.list')}}">Word List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Quiz Feedback</a>
                        </li>
                        @endguest
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 main_area">
            @yield('content')
        </main>
    </div>

        <script src="{{ asset('admin/js/datatables.min.js') }}"></script>        
        <script type="text/javascript" src="{{ asset('admin/js/formValidation.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('admin/js/formfieldvalidation.js') }}"></script>
        <script type="text/javascript" src="{{ asset('admin/js/bootstrap.formvalidation.min.js') }}"></script>
</body>
</html>
