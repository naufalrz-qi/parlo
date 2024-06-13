<nav class="navbar">
    <a href="#" class="navbar-logo">Parlo</a>

    <div class="navbar-nav">
        <a href="/#home">Home</a>
        <a href="#about">About</a>
        <a href="#destinations">Destinations</a>
        <a href="#contact">Contact</a>
        @if (Route::has('login'))
            <div id="auth-nav">
                @auth
                <a href="{{ route('dashboard') }}"" class="btn-secondary">Dashboard</a>

                @else
                    <a href="{{ route('login') }}" class="btn-primary">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-secondary">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <div class="navbar-extra">
        @if (Route::has('login'))
        <div id="auth-extra">
            @auth
              @if (Auth::user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}"" class="btn-secondary">Dashboard</a>
              @else
                <a href="{{ route('home') }}"" class="btn-secondary">Dashboard</a>
              @endif

            @else
                <a href="{{ route('login') }}" class="btn-primary">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-secondary">Register</a>
                @endif
            @endauth
        </div>
    @endif
        <a href="#" class="menu" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>
</nav>

{{-- icons js --}}
<script>
    feather.replace();
</script>

<script src="{{ asset('assets/js/script.js') }}"></script>
