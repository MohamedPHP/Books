@extends('backend.layout.admin')


@section('content')
    <div class="row" style="padding: 20px;">
        <div class="col s12 z-depth-1">
            <h5>Manage Codes</h5>
        </div>
    </div>
    {{-- `code``student_id` --}}
    <div class="row" style="padding: 20px;">
        <div class="col s12  z-depth-1">
            <div class="card-panel teal">
                <span class="white-text">If You Delete any Code All The Data Related To That Code Will Be Removed From The Database.</span>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 20px;">
        <div class="col s12 z-depth-1">
            <table class="bordered highlight centered responsive-table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Code</th>
                        <th>StudentID</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($codes as $code)
                        <tr>
                            <td>#{{ $code->id }}</td>
                            <td>{{ $code->code }}</td>
                            <td>{{ $code->student_id }}</td>
                            <td>  <a href="{{ route('code.delete', ['id' => $code->id]) }}" class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></a></td>
                            <td>  <a href="{{ route('code.edit', ['id' => $code->id]) }}" class="btn-floating waves-effect waves-light green"><i class="material-icons">edit</i></a></td>
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
