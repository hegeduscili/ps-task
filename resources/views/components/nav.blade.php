<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand">PS-Task</a>
        <div class="navbar-nav">
            @if(auth()->check())
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button id="logout-formbtn"  type="submit" class="btn btn-link nav-link logout {{ request()->routeIs('home') ? 'text-danger' : '' }}">Log Out</button>
                </form>
            @else
                <a class="nav-link register {{ request()->routeIs('register') ? 'text-primary' : '' }}" href="{{ route('register') }}">Sign In</a>
                <a class="nav-link login {{ request()->routeIs('login') ? 'text-primary' : '' }}" href="{{ route('login') }}">Log In</a>
            @endif
        </div>
    </div>
</nav>




