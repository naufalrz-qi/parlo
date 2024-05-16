<nav class="navbar">
    <a href="#" class="navbar-logo">Parlo</a>

    <div class="navbar-nav">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Destinations</a>
        <a href="#">Contact</a>
        <div id="auth-nav">
            <a href="#" class="btn-primary">Login</a>
            <a href="#" class="btn-secondary">Register</a>
        </div>
    </div>

    <div class="navbar-extra">
        <div id="auth-extra">
            <a href="#" class="btn-primary">Login</a>
            <a href="#" class="btn-secondary">Register</a>
        </div>
        <a href="#" class="menu" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>
</nav>

    {{-- icons js --}}
    <script>
        feather.replace();
    </script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
