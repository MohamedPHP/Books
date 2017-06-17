@extends('backend.layout.admin')


@section('content')
    <div class="row" style="padding: 25px;">
        <div class="col s12 z-depth-1">
            <h5>Add Books</h5>
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
            <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{-- `title`, `author`, `image`, `file`, `version`, `description`, `cat_id`, `level_id`, `specialization_id` --}}
                <div class="row">
                    <div class="input-field col s6">
                        <input id="title" name="title" type="text" class="validate" value="{{ old('title') }}">
                        <label for="title">Title</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="author" name="author" type="text" class="validate" value="{{ old('author') }}">
                        <label for="author">author</label>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field col s4">
                        <div class="btn">
                            <span>Image</span>
                            <input type="file" name="image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="file-field input-field col s4">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" name="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="file-field input-field col s4">
                        <div class="btn">
                            <span>Sample</span>
                            <input type="file" name="sample">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="version" name="version" type="text" class="validate" value="{{ old('version') }}">
                        <label for="version">version</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="book_code" name="book_code" type="text" class="validate" value="{{ old('book_code') }}">
                        <label for="book_code">book code</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="description" class="materialize-textarea" name="description">{{ old('description') }}</textarea>
                        <label for="description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <select name="cat_id">
                            <option value="" disabled selected>Choose your option</option>
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <label>Categoury</label>
                    </div>
                    <div class="input-field col s4">
                        <select name="level_id" id="level_id">
                            <option value="" disabled selected>Choose your option</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>{{ $level->number }}</option>
                            @endforeach
                        </select>
                        <label>Level</label>
                    </div>
                    <div class="input-field col s4">
                        <select name="specialization_id" id="specialization_id">
                            <option value="" disabled selected>Choose your option</option>
                            @foreach ($specializations as $specialization)
                                <option value="{{ $specialization->id }}" {{ old('specialization_id') == $specialization->id ? 'selected' : '' }}>{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                        <label>Specialization</label>
                    </div>
                    <div class="input-field col s12 subject_container">
                        <select name="subject_id" id="subject_id">

                        </select>
                        <label>Subject</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit">Create
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
<script>
     var  url = '{{ route('book.subject.ajax') }}',
          token = '{{ csrf_token() }}';
</script>
@endsection
