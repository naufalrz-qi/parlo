<nav class="navbarC">
    <a href="#" class="navbarC-logo">Parlo</a>

    <div class="navbarC-nav">
        <p style=>Dashboard</p>
        <hr>
        <a href="{{ route('employee.dashboard') }}">Dashboard</a>
        <p style=>Data Master</p>
        <hr>
        <a onclick="toggleDropdown('facilities')" href="#">Facilities</a>
        <div class="dp" id="dp-facilities">
            <a href="{{ route('facilities.create') }}">Add Facility</a>
            <a href="{{ route('facilities.index') }}">View Facilities</a>
        </div>
        <a onclick="toggleDropdown('reviews')" href="#">Reviews</a>
        <div class="dp" id="dp-reviews">
            <a href="#">Add Review</a>
            <a href="#">View Review</a>
        </div>
        <p style=>Reports</p>
        <hr>
        <a onclick="toggleDropdown('reports')" href="#">Reports</a>
        <div class="dp" id="dp-reports">
            <a href="#">Add Report</a>
            <a href="#">View Report</a>
        </div>
        <p style=>User</p>

        <hr>
        <a onclick="toggleDropdown('users')" href="#">Settings</a>
        <div class="dp" id="dp-users">
            <a href="#">Edit Profile</a>
            <a href="#">Change Password</a>
            <a href="{{ route('tfa.settings') }}">Two Factor Authentication</a>
        </div>
        <div id="auth-nav" class="my-4 d-grid justify-content-center text-align-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    this.closest('form').submit();"
                    class="btn btn-danger">Logout</button>
            </form>
        </div>

    </div>

    <div class="navbarC-extra">
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
