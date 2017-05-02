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
            <div class="card-panel teal">
                <span class="white-text">
                    Note: These books Are Filtterd by the Level and the Specialization That You In It These year.
                </span>
            </div>
        </div>
    </div>
</div>
