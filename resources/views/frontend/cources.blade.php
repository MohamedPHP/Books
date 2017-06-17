@extends('layouts.app')


@section('content')
     <br>
     <div class="container">
          {{-- start header --}}
          <div class="row">
               <div class="col s12">
                    <nav class="white">
                         <div class="nav-wrapper">
                              <a href="#" class="brand-logo" style="margin-left: 31px;">All Books</a>
                         </div>
                    </nav>
               </div>
          </div>
          {{-- start header --}}
          {{-- page content --}}
          <div class="row">
               {{-- Side Bar --}}
               <div class="col s3">
                   <div class="row">
                       <div class="col s12">
                           <form action="{{ route('cources.search') }}" method="get">
                               <div class="input-field">
                                   <input id="search" type="search" name="search" required>
                                   <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                                   <i class="material-icons">close</i>
                               </div>
                               <select name="searchBy">
                                   <option value="" disabled selected>Choose your option</option>
                                   <option value="1">Cource Name</option>
                                   <option value="2">Cource code</option>
                              </select>
                               <button class="btn waves-effect waves-light" type="submit">Submit
                                   <i class="material-icons right">send</i>
                               </button>
                           </form>
                       </div>
                   </div>
                   <hr>
                   <div class="row">
                       <div class="col s12">
                           <ul class="category hoverable">
                               @foreach (\App\Level::all() as $level)
                                   <li><a href="{{ route('books.level.filter', ['id' => $level->id]) }}">Level {{ $level->number }}</a></li>
                               @endforeach
                           </ul>
                       </div>
                   </div>
               </div>

               {{-- Side Bar --}}
               {{-- Items --}}
               <div class="col s9">
                    {{-- cards --}}
                    <div class="row">
                         @if (count($subjects) > 0)
                             @foreach ($subjects as $sub)
                                 <div class="col s6 m4">
                                     <div class="card teal darken-3 darken-1">
                                         <div class="card-content white-text">
                                             <span class="card-title">{{ $sub->name }}</span>
                                         </div>
                                         <div class="card-action">
                                             <a href="{{ route('cource.books', ['id' => $sub->id]) }}">View Cource</a>
                                         </div>
                                     </div>
                                 </div>
                             @endforeach
                         @else
                              <div class="card-panel teal"><span class="white-text">Sorry There is no books in the site</span></div>
                         @endif
                    </div>
               </div>
               {{-- cards --}}
          </div>
          {{-- Items --}}
     </div>
     {{-- page content --}}
@endsection
