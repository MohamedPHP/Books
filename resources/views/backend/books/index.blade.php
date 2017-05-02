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
                <br>

            </div>
            <a href="{{ route('book.index.table') }}" class="waves-effect waves-light btn">Table View</a>
            <a href="{{ route('book.index.table.delete') }}" class="waves-effect waves-light btn">Show Delete Re</a>
            <br><br>
        </div>
    </div>
    <div class="row" style="padding: 20px;">
        <div class="col s12 z-depth-1">
            <ul class="cd-items cd-container">
                @foreach ($books as $book)
                    <li class="cd-item">
                        <img src="{{asset($book->image)}}"
                        width="257"
                        height="280"
                        alt="Bullding {{ $book->title }} Preview"
                        title="Bullding {{ $book->title }} Preview"/>

                        <a href="#0"
                        class="cd-trigger" data-id="{{ $book->id }}"
                        title="Bullding {{ $book->title }} Preview">Quick View</a>
                    </li> <!-- cd-item -->
                @endforeach
            </ul>
            <!-- cd-items -->
            <div class="cd-quick-view">
                <div class="cd-slider-wrapper">
                    <ul class="cd-slider">
                        <li><img src="{{ asset('backend/images/default.jpg') }}" class="imgBox" alt="Product 1"></li>
                    </ul> <!-- cd-slider -->
                </div> <!-- cd-slider-wrapper -->

                <div class="cd-item-info">
                    <h2 class="title"></h2>
                    <p class="disBox" style="overflow: hidden; height: 77px;"></p>

                    <ul class="cd-item-action">
                        <div class="card-options" style="margin-left: 50%;">

                            <div class="chip priceBox"></div>

                            <a
                            href="#"
                            class="btn-floating waves-effect waves-light info moreBox"
                            target="_blank">
                            <i class="material-icons">info_outline</i>
                        </a>

                        <a
                        href="#"
                        class="btn-floating waves-effect waves-light primary viewPDF"
                        target="_blank">
                        <i class="material-icons">tab</i>
                    </a>

                    <a
                    href="#"
                    class="btn-floating waves-effect waves-light success downloadPDF"
                    target="_blank">
                    <i class="material-icons">trending_down</i>
                </a>

                <a
                href="#"
                class="btn-floating waves-effect waves-light danger deletePDF">
                <i class="material-icons">delete</i>
            </a>

            <a
            href="#"
            class="btn-floating waves-effect waves-light warning editPDF">
            <i class="material-icons">edit</i>
        </a>

    </div> <!-- cd-item-action -->
</ul> <!-- cd-item-action -->
</div> <!-- cd-item-info -->
<a href="#0" class="cd-close">Close</a>
</div>
<!-- cd-quick-view -->
</div>
    </div>
@endsection
@section('scripts')
     <script>

     // return the root link
     function urlHome(root = 0)
     {
         if (root == 0) {
               return '{{ route('show.ajax.book') }}';
         } else if(root == 1) {
              return '{{ Request::root() }}';
         } else {
               return '{{ asset('backend/images/default.jpg') }}';
         }
     }

     function publicHome(image)
     {
         return '{{ asset("image") }}';
     }

     </script>

     <script src="{{asset('backend/js/modernizr.js')}}"></script>
     <script src="{{asset('backend/js/velocity.min.js')}}"></script>
     <script src="{{asset('backend/js/card.js')}}"></script>
    @if (Session::has('message'))
        <script type="text/javascript">
        var $toastContent = $('<span>{{ Session::get('message') }}</span>');
        Materialize.toast($toastContent, 5000, 'rounded');
        </script>
    @endif
@endsection
