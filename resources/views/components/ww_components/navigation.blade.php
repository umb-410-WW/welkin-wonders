<nav>
    <input id="mobile-toggle" type='checkbox'>
    <a class="logo" href={{ route('about') }}>
        <img class='logo-image' src="{{ asset('assets/img/crystal_ball_round.png') }}" alt="Logo">
        <h2>Welkin<br>Wonders</h2>
    </a>
    <label id="mobile-toggle-custom" for="mobile-toggle"></label>
    <div class="nav-content">
        <div class="logo-and-links">
            <a class="nav-button" href="{{ route('contact') }}">Contact Us</a>
            <a class="nav-button" href="{{ route('readings') }}">Readings</a>
            <a class="nav-button" href="{{ route('products.shop') }}">Shop</a>
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
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <input style="border: 2px solid #915cfa; font-size: 1rem" class="nav-button login-button" type="submit" value="Logout">
                    </form>
                    @if(auth()->user()?->user_type ==='admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-button login-button">Administration</a>
                    @endif
                @else
                    <!-- Display login/register if not logged in -->
                    <a href="{{ route('login') }}" class="nav-button login-button">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-button login-button">Register</a>
                    @endif
                @endauth
            @endif

            @auth
                {{-- Display shopping cart if logged in --}}
                <a href="{{ route('cart.index') }}" class="nav-button login-button">Cart</a>
            @endauth
        </div>
    </div>
</nav>
