@foreach ($books as $book)
     <div class="col s4">
          <div class="card">
               <div class="card-image">
                   <img style="height: 200px !important;width: 100% !important;" src="{{asset($book->image)}}">
                    <a href="{{ route('book.single', ['id' => $book->id]) }}" class="btn-floating halfway-fab waves-effect waves-light primary"><i class="material-icons">info_outline</i></a>
               </div>
               <div class="card-content">
                    <span class="card-title" style="font-size: 20px;">{{ str_limit($book->title, 16) }}</span>
                    <p>{{ str_limit($book->description, 35) . '...' }}</p>
               </div>
          </div>
     </div>
@endforeach
