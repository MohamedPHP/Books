@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form method="POST" action="{{ url('/password/reset') }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">
            <h4 class="center-align">Login Form</h4>
            <hr>
            <br><br>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate" name="email" value="{{ $email or old('email') }}">
                    <label for="email" data-error="error" data-success="right">E-Mail Address</label>
                </div>
            </div>
            <div class="row">

                <div class="input-field col s6">
                    <input id="password" type="password" name="password" class="validate">
                    <label for="password">Password</label>
                </div>
                <div class="input-field col s6">
                    <input id="password_confirmation" type="password" name="password_confirmation" class="validate">
                    <label for="password_confirmation">password confirmation</label>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col s12">
                    <button type="submit" class="waves-effect waves-light btn">Reset Password</button>
                </div>
            </div>
            <br><br>
        </form>
    </div>
</div>

@endsection
