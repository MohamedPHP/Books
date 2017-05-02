@extends('backend.layout.admin')


@section('content')
    <div class="row" style="padding: 25px;">
        <div class="col s12 z-depth-1">
            <h5>Edit Staff {{ $user->name }}</h5>
        </div>
    </div>
    <div class="row" style="padding: 25px;">
        <div class="col s12 z-depth-3">
            <br>
            <form action="{{ route('staff.confirm.update', ['id' => encryptData($user->id)]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{-- `name`, `email`, `password`, `download_limit`, `address`, `phonenumber`, `generated_id`, `type`, `level_id`, `specialization_id` --}}
                <div class="row">
                    <div class="input-field col s6">
                        <input id="name" name="name" type="text" class="validate" value="{{ old('name') !== null ? old('name') : $user->name }}">
                        <label for="name">name</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="email" name="email" type="email" class="validate" value="{{ old('email') !== null ? old('email') : $user->email }}">
                        <label for="email" data-error="wrong" data-success="right">email</label>
                    </div>

                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="student_id" name="student_id" type="text" class="validate" value="{{ old('student_id') !== null ? old('student_id') : $user->student_id }}">
                        <label for="student_id" data-error="wrong" data-success="right">Student id</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="address" name="address" type="text" class="validate" value="{{ old('address') !== null ? old('address')  : $user->address }}">
                        <label for="address">address</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="phonenumber" name="phonenumber" type="number" class="validate" value="{{ old('phonenumber') !== null ? old('phonenumber')  : $user->phonenumber }}">
                        <label for="phonenumber" data-error="wrong" data-success="right">phonenumber</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="level_id">
                            <option value="" disabled selected>Choose your option</option>
                            @foreach ($levels as $level)
                                @php
                                    $levelselect = old('level_id') !== null ? old('level_id') : $user->level_id;
                                @endphp
                                <option value="{{ $level->id }}" {{ $levelselect == $level->id ? 'selected' : '' }}>Level {{ $level->number }}</option>
                            @endforeach
                        </select>
                        <label>Level</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="specialization_id">
                            <option value="" disabled selected>Choose your option</option>
                            @foreach ($specializations as $specialization)
                                @php
                                    $specializationselect = old('specialization_id') !== null ? old('specialization_id') : $user->specialization_id;
                                @endphp
                                <option value="{{ $specialization->id }}" {{ $specializationselect == $specialization->id ? 'selected' : '' }}>{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                        <label>Specialization</label>
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
                        <button class="btn waves-effect waves-light" type="submit">Update
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
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
    <script type="text/javascript">
        Materialize.updateTextFields();
    </script>
@endsection
