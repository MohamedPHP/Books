@extends('backend.layout.admin')


@section('content')
    <div class="row" style="padding: 25px;">
        <div class="col s12 z-depth-1">
            <h5>Edit Book "{{ $book->name }}"</h5>
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
            <form action="{{ route('book.update', ['id' => $book->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{-- `title`, `author`, `image`, `file`, `version`, `description`, `cat_id`, `level_id`, `specialization_id` --}}
                <div class="row">
                    <div class="input-field col s6">
                        <input id="title" name="title" type="text" class="validate" value="{{ old('title') !== null ? old('title') : $book->title}}">
                        <label for="title">Title</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="author" name="author" type="text" class="validate" value="{{ old('author') !== null ? old('author') : $book->author}}">
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
                            <input class="file-path validate" type="text" value="{{ old('image') !== null ? old('image') : $book->image}}">
                        </div>
                    </div>
                    <div class="file-field input-field col s4">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" name="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" value="{{ old('file') !== null ? old('file') : $book->file}}">
                        </div>
                    </div>
                    <div class="file-field input-field col s4">
                        <div class="btn">
                            <span>sample</span>
                            <input type="file" name="sample">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" value="{{ old('sample') !== null ? old('sample') : $book->sample}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        <img class="materialboxed" width="100" src="{{ asset($book->image) }}">
                    </div>
                    <div class="col s6 center">
                        <a href="{{ route('view.pdf', ['id' => $book->id]) }}" class="btn-floating waves-effect waves-light gray" target="_blank"><i class="material-icons">tab</i></a>
                        <a href="{{ route('download.pdf', ['id' => $book->id]) }}" class="btn-floating waves-effect waves-light black" target="_blank"><i class="material-icons">trending_down</i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="version" name="version" type="text" class="validate" value="{{ old('version') !== null ? old('version') : $book->version}}">
                        <label for="version">version</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="description" class="materialize-textarea" name="description">{{ old('description') !== null ? old('description') : $book->description}}</textarea>
                        <label for="description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <select name="cat_id">
                            <option value="" disabled selected>Choose your option</option>
                            @foreach ($cats as $cat)
                                @php
                                $catselect = old('cat_id') !== null ? old('cat_id') : $book->cat_id;
                                @endphp
                                <option value="{{ $cat->id }}" {{ $catselect == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <label>Categoury</label>
                    </div>
                    <div class="input-field col s4">
                        <select name="level_id" id="level_id">
                            <option value="" disabled selected>Choose your option</option>
                            @foreach ($levels as $level)
                                @php
                                $levelselect = old('level_id') !== null ? old('level_id') : $book->level_id;
                                @endphp
                                <option value="{{ $level->id }}" {{ $levelselect == $level->id ? 'selected' : '' }}>{{ $level->number }}</option>
                            @endforeach
                        </select>
                        <label>Level</label>
                    </div>
                    <div class="input-field col s4">
                        <select name="specialization_id" id="specialization_id">
                            <option value="" disabled selected>Choose your option</option>
                            @foreach ($specializations as $specialization)
                                @php
                                $specializationselect = old('specialization_id') !== null ? old('specialization_id') : $book->specialization_id;
                                @endphp
                                <option value="{{ $specialization->id }}" {{ $specializationselect == $specialization->id ? 'selected' : '' }}>{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                        <label>Specialization</label>
                    </div>
                    <div class="input-field col s12 subject_container" style="display: block;">
                        <select name="subject_id" id="subject_id">
                             <option value="" disabled selected>Choose your option</option>
                            @foreach ($subjects as $subject)
                               @php
                               $subjectSelect = old('subject_id') !== null ? old('subject_id') : $book->subject_id;
                               @endphp
                               <option value="{{ $subject->id }}" {{ $subjectSelect == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                               </option>
                            @endforeach
                        </select>
                        <label>Subject</label>
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
    <script>
         var  url = '{{ route('book.subject.ajax') }}',
              token = '{{ csrf_token() }}';
    </script>
@endsection
