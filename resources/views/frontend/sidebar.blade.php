<div class="col s3">
    <div class="row">
        <div class="col s12">
            <form action="{{ route('books.search') }}" method="get">
                <div class="input-field">
                    <input id="search" type="search" name="search" required>
                    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
                <select name="searchBy">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Book Name</option>
                    <option value="2">Author</option>
                    <option value="3">book code</option>
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
                @foreach (\App\Categoury::all() as $cat)
                    <li><a href="{{ route('books.category.filter', ['cat_id' => $cat->id]) }}">{{ $cat->name }}</a></li>
                @endforeach
            </ul><!-- Dropdown Structure -->
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
