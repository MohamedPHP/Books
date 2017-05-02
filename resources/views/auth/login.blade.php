@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <h4 class="center-align">Login Form</h4>
                <hr>
                <br><br>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="student_id" type="text" name="student_id" class="validate" value="{{ old('student_id') }}">
                        <label for="student_id" data-success="right">student_id</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" name="password" class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="checkbox" name="remember" id="remember" />
                        <label for="remember">Remember Me</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col s12">
                        <button type="submit" class="waves-effect waves-light btn">Login</button>
                        <a class="waves-effect waves-light btn" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                    </div>
                </div>
                <br><br>
            </form>
        </div>
    </div>
@endsection
