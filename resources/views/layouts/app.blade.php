<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>{{ getSetting() }}</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('frontend/css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{asset('frontend/css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>

    @yield('styles')

</head>
<body>
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <div id="logo-container" class="brand-logo">
                <div style="width: 64px;">
                    <img class="responsive-img materialboxed" data-caption="The Logo Of The Uni" style="height: 63px;" src="{{ asset('frontend/images/logo.png') }}">
                </div>
            </div>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{ url('/') }}">Home</a></li>
                @if (Auth::check())
                    <li><a href="{{ url('/books') }}">View All Books</a></li>
                    <li><a href="{{ route('user.profile') }}">Profile</a></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                @else
                    <li><a href="#login-modal">Login</a></li>
                    <li><a href="{{ url('register') }}">Register</a></li>
                    <li><a href="{{ route('admin.register.frontend') }}">Register Admin</a></li>
                    <li><a href="{{ route('staff.register') }}">Register Staff</a></li>
                @endif
            </ul>

            <ul id="nav-mobile" class="side-nav">
                @if (Auth::check())
                    <li><a href="{{ url('/books') }}">View All Books</a></li>
                    <li>
                        <a class='dropdown-button' href='#' data-activates='cats-mobile'>Categouries</a><!-- Dropdown Trigger -->
                        <ul id='cats-mobile' class='dropdown-content'>
                             @foreach (\App\Categoury::all() as $cat)
                                  <li><a href="{{ route('books.category.filter', ['cat_id' => $cat->id]) }}">{{ $cat->name }}</a></li>
                             @endforeach
                        </ul><!-- Dropdown Structure -->
                    </li>
                    <li><a href="{{ route('user.profile') }}">Profile</a></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                @else
                    <li><a href="#login-modal">Login</a></li>
                    <li><a href="{{ url('register') }}">Register</a></li>
                    <li><a href="{{ route('admin.register.frontend') }}">Register Admin</a></li>
                @endif
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>


    @yield('content')

    <footer class="page-footer teal" style="background-color:#444 !important;">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Library Bio</h5>
                    <p class="white-text text-lighten-4">{{ getSetting('siteDesc') }}</p>
                </div>
                <div class="col l3 s12">
                    <h5 class="white-text">Social Media</h5>
                    <ul>
                        <li><a class="white-text" href="{{ getSetting('facebook') }}">Facebook</a></li>
                    </ul>
                </div>
                <div class="col l3 s12">
                    <h5 class="white-text">Connect</h5>
                    <ul>
                        <li><a class="white-text" href="#">Site Name: {{ getSetting() }}</a></li>
                        <li><a class="white-text" href="#">Site Email: {{ getSetting('email') }}</a></li>
                        <li><a class="white-text" href="#">Site Phone: {{ getSetting('sitePhone') }}</a></li>
                        <li><a class="white-text" href="#">Site address: {{ getSetting('address') }}</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                {{ getSetting('copyright') }} &copy; all right recived
            </div>
        </div>
    </footer>

    @if (!Auth::check())
        <!-- Modal Structure -->
        <div id="login-modal" class="modal">
            <form method="POST" action="{{ url('/login') }}">
                <div class="modal-content">
                    <h4>Login Please</h4>
                    <div class="col s-12">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="student_id" type="text" name="student_id" class="validate" value="{{ old('student_id') }}">
                                <label for="student_id" data-success="right">Student Id</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" type="password" name="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="checkbox" name="remember" id="remember" />
                                <label for="remember">Remember Me</label>
                            </div>
                            <div class="input-field col s6" style="padding-top: 10px;">
                                <a href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="waves-effect waves-light btn">Login</button>
                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                </div>
            </form>
        </div>
    @endif

    <!--  Scripts-->
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/materialize.js')}}"></script>
    <script src="{{asset('frontend/js/init.js')}}"></script>
    <script src="{{asset('frontend/js/custom.js')}}"></script>

    @yield('scripts')

    @if (Session::has('message'))
       <script type="text/javascript">
            var $toastContent = $('<span>{{ Session::get('message') }}</span>');
            Materialize.toast($toastContent, 5000);
       </script>
    @endif
    @if (count($errors) > 0)
       @foreach ($errors->all() as $error)
            <script type="text/javascript">
                var $toastContent = $('<span>{{ $error }}</span>');
                Materialize.toast($toastContent, 20000);
            </script>
       @endforeach
    @endif
</body>
</html>
