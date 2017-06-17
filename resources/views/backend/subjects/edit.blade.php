@extends('backend.layout.admin')


@section('content')
    <div class="row" style="padding: 25px;">
        <div class="col s12 z-depth-1">
            <h5>Edit Cource {{ $subject->name }}</h5>
        </div>
    </div>
    <div class="row" style="padding: 25px;">
        <div class="col s12  z-depth-1">
            <div class="card-panel teal">
                <span class="white-text">Note</span>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 25px;">
        <div class="col s12 z-depth-3">
            <br>
            <form action="{{ route('subject.update', ['id' => $subject->id]) }}" method="post">
                {{ csrf_field() }}
                {{-- `name`, `email`, `password`, `download_limit`, `address`, `phonenumber`, `generated_id`, `type`, `level_id`, `specialization_id` --}}
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="validate" value="{{ old('name') !== null ? old('name') : $subject->name }}">
                        <label for="name">name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="level_id">
                            <option value="" disabled selected>Choose your option</option>
                            @foreach ($levels as $level)
                                @php
                                    $levelselect = old('level_id') !== null ? old('level_id') : $subject->level_id;
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
                                    $specializationselect = old('specialization_id') !== null ? old('specialization_id') : $subject->specialization_id;
                                @endphp
                                <option value="{{ $specialization->id }}" {{ $specializationselect == $specialization->id ? 'selected' : '' }}>{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                        <label>Specialization</label>
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
