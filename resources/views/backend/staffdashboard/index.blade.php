@extends('backend.layout.admin')


@section('styles')
     {{-- card view stylesheet --}}
     <link rel="stylesheet" href="{{asset('backend/css/card.css')}}">
     {{-- card view stylesheet --}}

    <style media="screen">
    .side-nav {
         z-index: 0;
    }
    /* this rule very important to avoid the card.css before and after errors */
    .btn-floating:before,
     .btn-floating:after{
          content: none;
    }
    /* this rule very important to avoid the card.css before and after errors */

    span.badge {
        position: inherit;
        padding: 5px;
        border-radius: 5px;
        color: #fff;
    }
    </style>
@endsection

@section('content')
    <div class="row" style="padding: 20px;">
        <div class="col s12 z-depth-1">
            <h5>Manage Books</h5>
        </div>
    </div>
    <div class="row" style="padding: 20px;">
        <div class="col s12  z-depth-1">
            <div class="card-panel teal">
                <span class="white-text">Note.</span>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 20px;">
        <div class="col s12 z-depth-1">
            <table class="bordered highlight centered responsive-table">
                <thead>
                    {{-- `title`, `author`, `image`, `file`, `version`, `description`, `cat_id`, `level_id`, `specialization_id` --}}
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Image</th>
                        <th>Version</th>
                        <th>Description</th>
                        <th>Categoury</th>
                        <th>Level</th>
                        <th>Specialization</th>
                        <th>View</th>
                        <th>Download</th>
                        <th>Delete Re</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td><img class="materialboxed" width="100" src="{{asset($book->image)}}"></td>
                            <td>{{ $book->version }}</td>
                            <td>{{ str_split($book->description, 20)[0] . '...' }}</td>
                            <td>{{ App\Categoury::where('id', $book->cat_id)->first()->name }}</td>
                            <td>{{ $book->level->number }}</td>
                            <td>{{ $book->specialization->name }}</td>
                            <td><a href="{{ route('staff.view.pdf', ['id' => $book->id]) }}" class="btn-floating waves-effect waves-light gray" target="_blank"><i class="material-icons">tab</i></a></td>
                            <td><a href="{{ route('staff.download.pdf', ['id' => $book->id]) }}" class="btn-floating waves-effect waves-light black" target="_blank"><i class="material-icons">trending_down</i></a></td>
                            <td>
                                <a href="{{ route('staff.delete.re', ['id' => $book->id]) }}" class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></a>
                            </td>
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
        Materialize.toast($toastContent, 5000, 'rounded');
        </script>
    @endif
@endsection
