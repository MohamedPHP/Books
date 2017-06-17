@extends('layouts.app')

@section('content')

    {{--

    name
    email
    password
    address
    phonenumber
    level_id
    specialization_id

    --}}

    <div class="container">
        <div class="row">
            <form method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}
                <h4 class="center-align">Register Please</h4>
                <hr>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="name" type="text" name="name" class="validate" value="{{ old('name') }}">
                        <label for="name" data-success="right">Name</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="email" type="email" name="email" class="validate" value="{{ old('email') }}">
                        <label for="email" data-error="Please Write A Valid Email" data-success="right">Email</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="student_id" type="text" name="student_id" class="validate" value="{{ old('student_id') }}">
                        <label for="student_id" data-success="right">Student ID</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="code" type="text" name="code" class="validate" value="{{ old('code') }}">
                        <label for="code" data-success="right">Code</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="address" type="text" name="address" class="validate" value="{{ old('address') }}">
                        <label for="address" data-success="right">Address</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="phonenumber" type="number" name="phonenumber" class="validate" value="{{ old('phonenumber') }}">
                        <label for="phonenumber" data-error="Please Write A Valid Phone" data-success="right">Phone Number</label>
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
                <div class="row">
                    <div class="input-field col s6">
                        <select name="level_id">
                            <option value="" disabled selected>Select A Level</option>
                            @php
                                $levels = App\Level::all();
                            @endphp
                            @foreach ($levels as $key)
                                <option value="{{ $key->id }}">Level {{ $key->number }}</option>
                            @endforeach
                        </select>
                        <label>Level</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="specialization_id">
                            <option value="" disabled selected>Select A Mejor</option>
                            @php
                                $spech = App\Specialization::all();
                            @endphp
                            @foreach ($spech as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>
                        <label>Mejor</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 center-align">
                        <button type="submit" class="waves-effect waves-light btn">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
