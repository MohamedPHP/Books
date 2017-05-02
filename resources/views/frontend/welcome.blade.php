@extends('layouts.app')


@section('styles')
    @if (!Auth::check())
        <link rel="stylesheet" href="{{asset('frontend/css/remodal.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/css/remodal-default-theme.css')}}">
    @endif
@endsection


@section('content')
    <div id="index-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="container">
                <br><br>
                <h1 class="header center teal-text text-lighten-2">Library</h1>
                <div class="row center">
                    {{-- {{ urlencode() }} --}}
                </div>
                <div class="row center">
                    @if (!Auth::check())
                        <a href="#login-modal" class="btn-large waves-effect waves-light teal lighten-1">Browse Books</a>
                    @else
                        <a href="{{ url('/books') }}" class="btn-large waves-effect waves-light teal lighten-1">Browse Books</a>
                    @endif
                </div>
                <br><br>

            </div>
        </div>
        <div class="parallax"><img src="{{asset('frontend/images/3.jpeg')}}" alt="Unsplashed background img 1"></div>
    </div>


    <div class="container">
        <div class="section">
            <!--   Icon Section   -->
            <div class="row">
                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
                        <h5 class="center">{{getSetting('Advantage_1_name')}}</h5>

                        <p class="light">{{ getSetting('Advantage_1_desc') }}</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center brown-text"><i class="material-icons">group</i></h2>
                        <h5 class="center">{{getSetting('Advantage_2_name')}}</h5>

                        <p class="light">{{ getSetting('Advantage_2_desc') }}</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
                        <h5 class="center">{{getSetting('Advantage_3_name')}}</h5>
                        <p class="light">{{ getSetting('Advantage_3_desc') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="parallax-container valign-wrapper">
        <div class="parallax"><img src="{{asset('frontend/images/2.jpeg')}}" alt="Unsplashed background img 2"></div>
    </div>

    <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class="mdi-content-send brown-text"></i></h3>
                    <h4>Contact Us</h4>

                    <form action="{{ route('contact.store') }}" method="post">
                         {{ csrf_field() }}
                        <div class="row">
                            <div class="col s6">
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="name-contact" type="text" data-length="10" name="name" required>
                                            <label for="name-contact">Name</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="email-contact" type="email" name="email" class="validate" required>
                                            <label for="email-contact" data-error="Please Write A Valid Email" data-success="right">Email</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="ph-contact" type="number" data-length="11" class="validate" name="phone" required>
                                            <label for="ph-contact" data-error="Please Write A Valid Phonenumber" data-success="right">Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea id="mag" class="materialize-textarea" data-length="500" name="message" required></textarea>
                                            <label for="mag">Message</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12">
                                            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>
                            </div>
                            <div class="col s6">
                                <img class="responsive-img z-depth-3" style="height: 350px;border-radius: 5px;" src="{{ asset('frontend/images/logo.png') }}" alt="">
                                <hr>

                                <h5>information about Stuff <a href="{{ route('staff.view.frontend') }}">Here</a> </h5>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div class="parallax-container valign-wrapper">
        <div class="parallax"><img src="{{asset('frontend/images/1.jpeg')}}" alt="Unsplashed background img 3"></div>
    </div>


    @if (!Auth::check())
        <div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: true">
            <button data-remodal-action="close" class="remodal-close"></button>
            <h1>Welcome Message</h1>
            <p>
               {{ getSetting('welcomemessage') }}
            </p>
            <br>
            <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>

            <a href="{{ url('/register') }}" class="remodal-confirm primary">Register</a>
        </div>
    @endif
@endsection


@section('scripts')
    @if (!Auth::check())
        <script src="{{asset('frontend/js/remodal.min.js')}}"></script>
        <script type="text/javascript">
            // for the welcome message
            var inst = $('[data-remodal-id=modal]').remodal();

            /**
            * Opens the modal window
            */
            inst.open();

            $(document).on('click', '#closeifremodalisopen', function(event) {
                event.preventDefault();
                inst.close();
            })

        </script>
    @endif
@endsection
