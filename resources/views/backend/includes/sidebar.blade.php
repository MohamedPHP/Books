<ul id="slide-out" class="side-nav fixed z-depth-2">


    <li class="center no-padding">
        <div class="indigo darken-2 white-text" style="height: 180px;">
            <div class="row">
                <img style="margin-top: 5%;" width="100" height="100" src="https://res.cloudinary.com/dacg0wegv/image/upload/t_media_lib_thumb/v1463990208/photo_dkkrxc.png" class="circle responsive-img" />

                <p style="margin-top: -13%;">
                    {{ Auth::user()->name }}
                </p>
            </div>
        </div>
    </li>

    @if (Auth::user()->type == 3)

    <li id="dash_dashboard"><a class="waves-effect" href="{{ url('/admin') }}"><b>Dashboard</b></a></li>

    @endif

    <ul class="collapsible" data-collapsible="accordion">
        @if (Auth::user()->type == 3)
        {{-- levels --}}
        <li id="dash_levels">
            <div id="dash_levels_header" class="collapsible-header waves-effect"><b>levels</b></div>
            <div id="dash_levels_body" class="collapsible-body">
                <ul>
                    <li id="levels_all">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('level.index') }}">View All</a>
                    </li>

                    <li id="levels_create">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('level.create') }}">Create</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- cats --}}
        <li id="dash_cats">
            <div id="dash_cats_header" class="collapsible-header waves-effect"><b>Categories</b></div>
            <div id="dash_cats_body" class="collapsible-body">
                <ul>
                    <li id="cats_all">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('cat.index') }}">Category</a>
                    </li>

                    <li id="cats_create">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('cat.create') }}">Add Categouries</a>
                    </li>
                </ul>
            </div>
        </li>

        <li id="dash_users">
            <div id="dash_users_header" class="collapsible-header waves-effect"><b>Users</b></div>
            <div id="dash_users_body" class="collapsible-body">
                <ul>
                    <li id="users_all">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('user.index') }}">View All</a>
                    </li>

                    <li id="users_create">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('user.create') }}">Create</a>
                    </li>
                </ul>
            </div>
        </li>

        <li id="dash_specialization">
            <div id="dash_specialization_header" class="collapsible-header waves-effect"><b>Majors</b></div>
            <div id="dash_specialization_body" class="collapsible-body">
                <ul>
                    <li id="specialization_product">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('specialization.index') }}">All Majors</a>
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('specialization.create') }}">Create</a>
                    </li>
                </ul>
            </div>
        </li>


        <li id="dash_subjects">
            <div id="dash_subjects_header" class="collapsible-header waves-effect"><b>Cources</b></div>
            <div id="dash_subjects_body" class="collapsible-body">
                <ul>
                    <li id="subjects">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('subject.index') }}">View Cources</a>
                    </li>

                    <li id="subjects_add">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('subject.create') }}">Add Cource</a>
                    </li>
                </ul>
            </div>
        </li>


        <li id="dash_books">
            <div id="dash_books_header" class="collapsible-header waves-effect"><b>Books</b></div>
            <div id="dash_books_body" class="collapsible-body">
                <ul>
                    <li id="books">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('book.index') }}">View Books</a>
                    </li>

                    <li id="books_add">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('book.create') }}">Add Books</a>
                    </li>
                </ul>
            </div>
        </li>

        <li id="dash_site_setting">
            <div id="dash_site_setting_header" class="collapsible-header waves-effect"><b>Site Setting</b></div>
            <div id="dash_site_setting_body" class="collapsible-body">
                <ul>
                    <li id="site_setting">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('setting.index') }}">View Site Setting</a>
                    </li>

                </ul>
            </div>
        </li>
        <li id="dash_contact">
            <div id="dash_contact_header" class="collapsible-header waves-effect"><b>Messages</b></div>
            <div id="dash_contact_body" class="collapsible-body">
                <ul>
                    <li id="dash_contact">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('contact.index') }}">View Messages</a>
                    </li>
                </ul>
            </div>
        </li>

    @else
        <li id="dash_books">
            <div id="dash_books_header" class="collapsible-header waves-effect"><b>Books</b></div>
            <div id="dash_books_body" class="collapsible-body">
                <ul>
                    <li id="books">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('staff.index') }}">View Books</a>
                    </li>

                    <li id="books_add">
                        <a class="waves-effect" style="text-decoration: none;" href="{{ route('staff.create') }}">Add Books</a>
                    </li>
                </ul>
            </div>
        </li>
    @endif

    </ul>

</ul>
