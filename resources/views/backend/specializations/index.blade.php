@extends('backend.layout.admin')


@section('content')
    <div class="row" style="padding: 20px;">
        <div class="col s12 z-depth-1">
            <h5>Manage Majors</h5>
        </div>
    </div>
    <div class="row" style="padding: 20px;">
        <div class="col s12  z-depth-1">
            <div class="card-panel teal">
                <span class="white-text">If You Delete any Major All The Data Related To That Major Will Be Removed From The Database.</span>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 20px;">
        <div class="col s12 z-depth-1">
            <table class="bordered highlight centered responsive-table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($specializations as $specialization)
                        <tr>
                            <td>#{{ $specialization->id }}</td>
                            <td>{{ $specialization->name }}</td>
                            <td>  <a href="{{ route('specialization.edit', ['id' => $specialization->id]) }}" class="btn-floating waves-effect waves-light green"><i class="material-icons">edit</i></a></td>
                            <td>  <a href="{{ route('specialization.delete', ['id' => $specialization->id]) }}" class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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
@endsection
