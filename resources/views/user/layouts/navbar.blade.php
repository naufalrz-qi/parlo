<nav class="navbar">
    <a href="{{ route('home', ['id'=>1]) }}" class="navbar-logo">Parlo</a>

    <div class="navbar-nav">
        <p style=>Menu</p>
        <hr>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('destinations.universal') }}">Destinations</a>
        <a href="#">Facilities</a>
        <a href="#">History</a>

        <div id="auth-nav">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a type="submit" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    this.closest('form').submit();"
                    class="btn-secondary">Logout</a>
            </form>
        </div>

    </div>

    <div class="navbar-extra">
        <a href="#" class="menu" >{{ Auth::user()->name }}</a>
        <a href="#" class="menu" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>
</nav>

{{-- icons js --}}
<script>
    function toggleDropdown(id) {
    if (id === 'destinations') {
        var dropdownContent = document.querySelector("#dp-destinations");
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
    } else {
        dropdownContent.style.display = "block";
    }
    }
    if (id === 'facilities') {
        var dropdownContent = document.querySelector("#dp-facilities");
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
    } else {
        dropdownContent.style.display = "block";
    }
    }
    if (id === 'reviews') {
        var dropdownContent = document.querySelector("#dp-reviews");
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
    } else {
        dropdownContent.style.display = "block";
    }
    }
    if (id === 'reports') {
        var dropdownContent = document.querySelector("#dp-reports");
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
    } else {
        dropdownContent.style.display = "block";
    }
    }
    if (id === 'users') {
        var dropdownContent = document.querySelector("#dp-users");
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
    } else {
        dropdownContent.style.display = "block";
    }
    }

}

    feather.replace();
</script>

<script src="{{ asset('assets/js/script.js') }}"></script>