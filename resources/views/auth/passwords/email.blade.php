@extends('layouts.app')

<!-- Main Content -->
@section('content')




<div class="container">
    <div class="row">

        @if (session('status'))
            <br><br>
            <div class="row" style="padding: 25px;">
                <div class="col s12  z-depth-1">
                    <div class="card-panel teal">
                        <span class="white-text">{{ session('status') }}</span>
                    </div>
                </div>
            </div>
            <br><br>
        @endif


        <form method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}

            <h4 class="center-align">Send Password Reset Link Form</h4>
            <hr>
            <br><br>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate" name="email" value="{{ $email or old('email') }}" autocomplete="off">
                    <label for="email" data-error="error" data-success="right">E-Mail Address</label>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col s12">
                    <button type="submit" class="waves-effect waves-light btn">Send Password Reset Link</button>
                </div>
            </div>
            <br><br>
        </form>
    </div>
</div>


@endsection
