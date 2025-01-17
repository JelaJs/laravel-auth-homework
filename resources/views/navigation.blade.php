<header>
    <nav>
        <li><a href="/">Home</a></li>
        <li><a href="{{ route("forecast.all") }}">Forecast</a></li>
        @if (!Auth::user())
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
        @else
            <form action="/logout" method="POST">

                @csrf

                <button type="submit">Logout</button>
            </form>
            <li><a href="{{ route('profile.edit') }}">{{ Auth::user()->name }}</a></li>

            @if(Auth::user()->role === 'admin')
                <li><a href="{{ route("forecast.list") }}">Admin panel</a></li>
            @endif
        @endif
    </nav>
</header>