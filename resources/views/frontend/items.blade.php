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
               @include('frontend.sidebar')
               {{-- Side Bar --}}
               {{-- Items --}}
               <div class="col s9">
                    {{-- cards --}}
                    <div class="row">
                         @if (count($books) > 0)
                              @include('frontend.shareFile', $books)
                         @else
                              <div class="card-panel teal"><span class="white-text">Sorry There is no books in the site</span></div>
                         @endif
                    </div>
                    <ul class="pagination col s6 offset-s3">
                         {{ $books->appends(Request::query())->render() }}
                    </ul>
               </div>
               {{-- cards --}}
          </div>
          {{-- Items --}}
     </div>
     {{-- page content --}}
@endsection
