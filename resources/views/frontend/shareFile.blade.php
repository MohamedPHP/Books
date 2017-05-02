@foreach ($books as $book)
     <div class="col s6">
          <div class="card hoverable">
               <div class="card-image">
                   <img  class="materialboxed" style="height: 200px;width: 100% !important;" src="{{asset($book->image)}}">
                    <a href="{{ route('book.single', ['id' => $book->id]) }}" class="btn-floating halfway-fab waves-effect waves-light primary"><i class="material-icons">info_outline</i></a>
               </div>
               <div class="card-content">
                    <span class="card-title">{{ $book->title }}</span>
                    <p>{{ str_limit($book->description, 35) . '...' }}</p>
               </div>
          </div>
     </div>
@endforeach
