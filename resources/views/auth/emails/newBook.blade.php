<div class="mail_container">
     <div class="container">
          <div class="row">
               <div class="col s8">
                    <div class="card">
                         <div class="card-image">
                              <img  class="materialboxed" style="height: 316px; width: 50% !important;" src="{{ $message->embed($book->image) }}">
                         </div>
                         <div class="card-content">
                              <span class="card-title"><a href="{{  route('book.single', ['id' => $book->id])  }}" class="btn-floating halfway-fab waves-effect waves-light red">Title{{  $book->title  }}</a></span>
                              <p>Desc{{  str_limit($book->description, 100)  }}</p>
                         </div>
                    </div>
               </div>
               <div class="col s4">
                    <div class="row" style="padding: 20px;">
                        <div class="col s12 ">
                           <div class="card-panel">
                                <div class="book-info">
                                     <span class="chip primary">Version: {{ $book->version }}</span>
                                     <span class="chip success">Author: {{ $book->author }}</span>
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
                                </div>
                           </div>
                        </div>
                    </div>
               </div>
          </div>
     </div>
</div>
