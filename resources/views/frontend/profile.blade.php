@extends('layouts.app')

@section('styles')
    <style media="screen">
        .table-cont {
            width: 100%;
            height: auto;
            padding: 20px 10px;
            background-color: #fff;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
@endsection
@section('content')
    <br><br>
    <div class="container">
         {{-- start header --}}
         <div class="row">
              <div class="col s12">
                   <nav class="white">
                        <div class="nav-wrapper">
                             <a href="#" class="brand-logo" style="margin-left: 31px;">Profile</a>
                             @if (Auth::user()->type === 3)
                                  <a href="{{ route('dashboard') }}" class="chip danger right" style="margin-top: 16px;">Admin Dashboard</a>
                             @elseif (Auth::user()->type === 2)
                                  <a href="{{ route('staff.index') }}" class="chip danger right" style="margin-top: 16px;">Staff Dashboard</a>
                             @endif
                        </div>
                   </nav>
              </div>
         </div>
         {{-- start header --}}
         {{-- page content --}}

         <div class="row">
             <div class="col s12">
                 <ul class="tabs">
                     <li class="tab col s3"><a class="active" href="#test1">Liked Books</a></li>
                     <li class="tab col s3"><a class="active" href="#downloaded">Downloaded Books</a></li>
                     <li class="tab col s3"><a href="#test2">My Data</a></li>
                     @php
                          $type = '';
                     @endphp
                 </ul>
             </div>
             <br><br>
             <br><br>
             <div id="test1" class="col s12">
                 <div class="table-cont z-depth-1">
                     <h5>Liked Books</h5>
                     <hr>
                 </div>
                 <div class="table-cont z-depth-1">
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
                                 <th>File View</th>
                                 <th>File Download</th>
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
                                     <td><a href="{{ route('view.pdf', ['id' => $book->id]) }}" class="btn-floating waves-effect waves-light gray" target="_blank"><i class="material-icons">tab</i></a></td>
                                     <td><a href="{{ route('user.download.pdf', ['id' => $book->id]) }}" class="btn-floating waves-effect waves-light black" target="_blank"><i class="material-icons">trending_down</i></a></td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
             <div id="downloaded" class="col s12">
                 <div class="table-cont z-depth-1">
                     <h5>Downloaded Books</h5>
                     <hr>
                 </div>
                 <div class="table-cont z-depth-1">
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
                                 <th>File View</th>
                                 <th>File Download</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($dbooks as $book)
                                 <tr>
                                     <td>{{ $book->title }}</td>
                                     <td>{{ $book->author }}</td>
                                     <td><img class="materialboxed" width="100" src="{{asset($book->image)}}"></td>
                                     <td>{{ $book->version }}</td>
                                     <td>{{ str_split($book->description, 20)[0] . '...' }}</td>
                                     <td>{{ App\Categoury::where('id', $book->cat_id)->first()->name }}</td>
                                     <td><a href="{{ route('view.pdf', ['id' => $book->id]) }}" class="btn-floating waves-effect waves-light gray" target="_blank"><i class="material-icons">tab</i></a></td>
                                     <td><a href="{{ route('user.download.pdf', ['id' => $book->id]) }}" class="btn-floating waves-effect waves-light black" target="_blank"><i class="material-icons">trending_down</i></a></td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
             <div id="test2" class="col s12">
                 <div class="table-cont z-depth-1">
                     <h5>Edit Profie</h5>
                     <hr>
                 </div>
                 <div class="table-cont z-depth-1">
                     <form action="{{ route('user.pro.update', ['id' => $user->id]) }}" method="post">
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
                                 <input id="address" name="address" type="text" class="validate" value="{{ old('address') !== null ? old('address')  : $user->address }}">
                                 <label for="address">address</label>
                             </div>
                             <div class="input-field col s6">
                                 <input id="phonenumber" name="phonenumber" type="number" class="validate" value="{{ old('phonenumber') !== null ? old('phonenumber')  : $user->phonenumber }}">
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

                             @if ($user->type === 2)
                                  <div class="input-field col s12">
                                       <textarea id="bio" class="materialize-textarea" name="bio">{{ old('bio') !== null ? old('bio') : $user->bio}}</textarea>
                                       <label for="bio">BIO</label>
                                  </div>
                             @endif

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
         </div>

    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        Materialize.updateTextFields();
    </script>
@endsection
