<nav class="navbarC">
    <a href="#" class="navbarC-logo">Parlo</a>


    <div class="navbarC-nav">
        <a href="/#home">Home</a>
        <a href="#about">About</a>
        <a href="#destinations">Destinations</a>
        <a href="#contact">Contact</a>
        @if (Route::has('login'))
            <div id="auth-nav">
                @auth
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                    @elseif (Auth::user()->role == 'employee')
                        <a href="{{ route('employee.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                    @else
                        <a href="{{ route('home') }}" class="btn btn-secondary">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <div class="navbarC-extra">
        @if (Route::has('login'))
            <div id="auth-extra">
                @auth
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                    @elseif (Auth::user()->role == 'employee')
                        <a href="{{ route('employee.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                    @else
                        <a href="{{ route('home') }}" class="btn btn-secondary">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
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
