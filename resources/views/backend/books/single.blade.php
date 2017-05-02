@extends('backend.layout.admin')

@section('content')
     <div class="row" style="padding: 20px;">
         <div class="col s12 z-depth-1">
            <h5>Book: {{ $book->title }}</h5>
         </div>
     </div>
     <div class="row" style="padding: 20px;">
         <div class="col s12 ">
            <div class="card-panel">
                 <div class="book-info">
                      <span class="chip primary">Version:{{ $book->version }}</span>
                      <span class="chip success">Author:{{ $book->author }}</span>
                      <span class="chip info">
                            Category:
                           @foreach ($cats as $cat)
                                @php
                                $catselect = $book->cat_id == $cat->id ? $cat->name : '';
                                @endphp
                               {{ $catselect }}
                           @endforeach
                      </span>
                      <span class="chip danger">
                           Level:
                           @foreach ($levels as $level)
                                @php
                                $levelselect = $book->level_id == $level->id ? $level->number : '';
                                @endphp
                                {{ $levelselect }}
                           @endforeach
                      </span>
                      <span class="chip warning">
                           specialization:
                           @foreach ($specializations as $specialization)
                                @php
                                $specializationselect = $book->specialization_id == $specialization->id ? $specialization->name : '';
                                @endphp
                                {{ $specializationselect }}
                           @endforeach
                      </span>
                      <span class="chip success">{{ $likeRate === 0 ? 'No One Liked' : $likeRate . ' Like'  }}</span>
                      <span class="chip danger">{{ $likeRate === 0 ? 'No One Disliked' : $likeRate . ' Dislike'  }}</span>
                 </div>
            </div>
         </div>
     </div>
     <div class="row" style="padding: 20px;">
         <div class="col s8 offset-m2">
              <div class="card">
                   <div class="card-image">
                        <img style="height: 280px;" src="{{ asset($book->image) }}">
                        <span class="card-title">Card Title</span>
                   </div>
                   <div class="card-content">
                        <p style="word-break: break-all;">{{ $book->description }}</p>
                        </div>
                        <div class="card-action">
                            <a
                               href="{{ route('view.pdf', ['id' => $book->id]) }}"
                               class="waves-effect waves-light btn primary"
                               target="_blank"><i class="material-icons left">tab</i> View
                          </a>
                          <a
                              href="{{ route('download.pdf', ['id' => $book->id]) }}"
                              class="waves-effect waves-light btn success"
                              target="_blank"><i class="material-icons left">trending_down</i> Download
                         </a>

                          <a
                              href="{{ route('book.delete', ['id' => $book->id]) }}"
                              class="waves-effect waves-light btn danger"><i class="material-icons left">delete</i>delete
                         </a>

                          <a
                              href="{{ route('book.edit', ['id' => $book->id]) }}"
                              class="waves-effect waves-light btn warning"><i class="material-icons left">edit</i> Edit
                         </a>

                        </div>
                   </div>
         </div>
    </div>
@endsection
