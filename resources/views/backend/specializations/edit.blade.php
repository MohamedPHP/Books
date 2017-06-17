@extends('backend.layout.admin')


@section('content')
    <div class="row" style="padding: 25px;">
        <div class="col s12 z-depth-1">
            <h5>Edit Major "{{ $specialization->name }}"</h5>
        </div>
    </div>
    <div class="row" style="padding: 25px;">
        <div class="col s12  z-depth-1">
            <div class="card-panel teal">
                <span class="white-text">The Major Name Can't Be Reapeated And It's required.</span>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 25px;">
        <div class="col s12 z-depth-3">
            <br>
            <form action="{{ route('specialization.update', ['id' => $specialization->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12">
                        <input id="specialization" name="name" type="text" class="validate" value="{{ old('name') !== null ? old('name') : $specialization->name }}">
                        <label for="specialization">Major name</label>
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
                Materialize.toast($toastContent, 5000);
            </script>
        @endforeach
    @endif
    <script type="text/javascript">
        Materialize.updateTextFields();
    </script>
@endsection
