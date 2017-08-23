<nav>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav">
            @if (Auth::guest())
                <li><a href="{{ route('home.index') }}">Home</a></li>
                <li><a href="https://github.com/danielkleach" target="_blank">Github</a></li>
                <li><a href="https://www.linkedin.com/in/daniel-leach-477a3847" target="_blank">LinkedIn</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu -nav dropdown-menu-right" role="menu">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                               Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>