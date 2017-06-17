@extends('layouts.app')

@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
@endsection

@section('content')
    <div class="site-content">
        <div class="mdl-grid site-max-width">
            <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp page-content">
                <div class="mdl-card__title">
                    <h1 class="mdl-card__title-text" style="color: blue;">{{ $getBook->title }}</h1>
                </div>
                <div class="mdl-card__media">
                     <div class="over">
                          <div class="like-container">
                               <span class="chip success liked" id="liked">{{ $likeRate === 0 ? 'No One Liked' : $likeRate . ' Likes'  }}</span>
                               <span class="chip danger disliked" id="disliked">{{ $disLikeRate === 0 ? 'No One Disliked' : $disLikeRate . ' Dislikes'  }}</span>
                          </div>
                     </div>
                     <img class="article-image" src="{{ asset($getBook->image) }}" style="height: 502px;max-height: 502px;" border="0" alt="Portfolio Page">
                </div>
                <div class="mdl-grid site-copy">
                    <div class="mdl-cell mdl-cell--12-col"><p><h3 class="mdl-cell mdl-cell--12-col mdl-typography--headline">Describtion</h3></p>
                        <div class="mdl-cell mdl-cell--10-col mdl-card__supporting-text no-padding ">
                            <p>{{ $getBook->description }}</p>
                            <div class="book-info">
                                 <span class="chip primary">Version:{{ $getBook->version }}</span>
                                 <span class="chip success">Author:{{ $getBook->author }}</span>
                                 <span class="chip info">
                                      Category:
                                      @foreach ($cats as $cat)
                                           @php
                                           $catselect = $getBook->cat_id == $cat->id ? $cat->name : '';
                                           @endphp
                                           {{ $catselect }}
                                      @endforeach
                                 </span>
                                 <span class="chip danger">
                                      Level:
                                      @foreach ($levels as $level)
                                           @php
                                           $levelselect = $getBook->level_id == $level->id ? $level->number : '';
                                           @endphp
                                           {{ $levelselect }}
                                      @endforeach
                                 </span>
                                 <span class="chip warning">
                                      specialization:
                                      @foreach ($specializations as $specialization)
                                           @php
                                           $specializationselect = $getBook->specialization_id == $specialization->id ? $specialization->name : '';
                                           @endphp
                                           {{ $specializationselect }}
                                      @endforeach
                                 </span>
                            </div>
                       </div>

                        <div class="mdl-grid">
                            <div class="options">
                                 <a
                                   class="waves-effect waves-light btn primary"
                                   href="{{ route('user.download.pdf', ['id' => $getBook->id]) }}" target="_blank" id="DBook" data-bookid="{{$getBook->id}}">
                                   Download Sample
                                 </a>

                                 <a
                                      class="waves-effect waves-light btn warning"
                                      href="{{ route('user.view.pdf', ['id' => $getBook->id]) }}" target="_blank">
                                      View
                                      <span class="mdl-button__ripple-container">
                                           <span class="mdl-ripple"></span>
                                      </span>
                                </a>
                            </div>
                        </div>
                        <div class="mdl-grid" data-id="{{ $getBook->id }}">
                            <a
                              class="waves-effect waves-light btn success like"
                              href="#">
                              {{ Auth::user()->rates()->where('book_id', $getBook->id)->first() ? Auth::user()->rates()->where('book_id', $getBook->id)->first()->like == 1 ? 'You Like This Book' : 'Like' : 'Like' }}
                            </a>
                            	&nbsp;	&nbsp;
                              <a
                                   class="waves-effect waves-light btn danger like"
                                   href="#">
                                   {{ Auth::user()->rates()->where('book_id', $getBook->id)->first() ? Auth::user()->rates()->where('book_id', $getBook->id)->first()->like == 0 ? 'You don\'t Like This Book' : 'DisLike' : 'DisLike' }}
                              </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
     <script type="text/javascript">
          var token = '{{ Session::token() }}';
          var urlLike = '{{ route('like') }}';
     </script>
     <script type="text/javascript">
     $(document).on('click', '#DBook', function(event) {
         $.ajax({
             method: 'POST',
             url: '{{ route('user.download.profile') }}',
             data: {
                 _token: token,
                 userid: "{{ Auth::user()->id }}",
                 bookid: $(this).data('bookid'),
             },
         });
     });
     </script>
@endsection
