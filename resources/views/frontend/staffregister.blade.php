@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form method="POST" action="{{ route('staff.register.post') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h4 class="center-align">Register As Staff</h4>
                <hr>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="name" name="name" type="text" class="validate" value="{{ old('name') }}">
                        <label for="name">name</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="email" name="email" type="email" class="validate" value="{{ old('email') }}">
                        <label for="email" data-error="wrong" data-success="right">email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="student_id" name="student_id" type="text" class="validate" value="{{ old('student_id') }}">
                        <label for="student_id" data-error="wrong" data-success="right">Staff id</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="address" name="address" type="text" class="validate" value="{{ old('address') }}">
                        <label for="address">address</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="phonenumber" name="phonenumber" type="number" class="validate" value="{{ old('phonenumber') }}">
                        <label for="phonenumber" data-error="wrong" data-success="right">phonenumber</label>
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
                            <option value="" disabled selected>Select A specialization</option>
                            @php
                                $spech = App\Specialization::all();
                            @endphp
                            @foreach ($spech as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>
                        <label>Level</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>staff_image</span>
                                <input type="file" name="staff_image">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit">Register
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
