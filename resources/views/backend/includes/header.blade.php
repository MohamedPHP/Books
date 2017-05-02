<header>
    <ul class="dropdown-content" id="user_dropdown">
        <li><a class="indigo-text" href="{{ url('/profile') }}">Profile</a></li>
        <li><a class="indigo-text" href="{{ url('/logout') }}">Logout</a></li>
    </ul>

    <nav>
        <div class="nav-wrapper indigo darken-2">
            @if (Auth::user()->type == 3)
                <a class="breadcrumb" href="#!">Admin</a>
            @else
                <a class="breadcrumb" href="#!">STaff</a>
            @endif
            <a class="breadcrumb" href="#!">Index</a>

            <div style="margin-right: 20px;" id="timestamp" class="right">
                <a class='dropdown-button btn' href='#' data-activates='user_dropdown'>Options</a>
            </div>
        </div>
    </nav>
</header>
