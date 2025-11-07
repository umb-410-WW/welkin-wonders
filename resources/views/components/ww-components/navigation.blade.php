<nav>
    <div class="logo-and-links">
        <div class="logo">
            <img src="{{asset('assets/img/crystal_ball_round.png')}}" alt="Logo" width="100" height="100">
            <h2>Welkin<br>Wonders</h2>
        </div>
        <a class="nav-button" href="{{ route('about') }}">Home</a>
        <a class="nav-button" href="{{ route('contact') }}">Contact Us</a>
        <a class="nav-button" href="#">Readings</a>
        <a class="nav-button" href="#">Shop</a>
    </div>
    <div class="search-and-login">
        <div id="search">
            <form id="search-form" action="non-existent-file.php" method="GET">
                <input type="text" name="search" placeholder="Browse our products...">
                <button type="submit">Go</button>
            </form>
        </div>
        @if (Route::has('login'))
                @auth
                    <!-- Display dashboard if logged in -->
                    <a href="{{ url('/dashboard') }}" class="nav-button login-button">Dashboard</a>
                @else
                    <!-- Display login/register if not logged in -->
                    <a href="{{ route('login') }}" class="nav-button login-button">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-button login-button">Register</a>
                    @endif
                @endauth
         @endif
    </div>
</nav>
