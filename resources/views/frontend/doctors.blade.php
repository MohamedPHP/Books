@extends('layouts.app')



@section('content')
     <br><br>
     <div class="container">
         {{-- start header --}}
         <div class="row">
              <div class="col s12">
                   <nav class="white">
                        <div class="nav-wrapper">
                             <a href="#" class="brand-logo" style="margin-left: 31px;">Stuff Information</a>
                        </div>
                   </nav>
              </div>
         </div>
         {{-- start header --}}

         <div class="row">
              {{-- Items --}}
              <div class="col s12">
                   {{-- cards --}}
                   <div class="row">
                        @if (count($staffs) > 0)
                             @foreach ($staffs as $staff)
                                  <div class="col s6">
                                       <div class="card hoverable">
                                            <div class="card-image">
                                                <img  class="materialboxed" style="height: 200px;width: 100% !important;" src="{{asset($staff->staff_image)}}">
                                            </div>
                                            <div class="card-content">
                                                 <span class="card-title">{{ $staff->name }}</span>
                                                 <p style="word-break: break-all;">{{ $staff->bio }}</p>
                                            </div>
                                       </div>
                                  </div>
                             @endforeach
                        @else
                            <div class="col s12">
                                <div class="card-panel teal"><span class="white-text">No Stuff</span></div>
                            </div>
                        @endif
                   </div>
              </div>
         </div>
         {{-- Items --}}

    </div>
@endsection
