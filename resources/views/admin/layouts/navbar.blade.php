<nav class="navbarC">
    <a href="#" class="navbarC-logo">Parlo</a>

    <div class="navbarC-nav">
        <p style=>Dashboard</p>
        <hr>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <p style=>Data Master</p>
        <hr>
        <a onclick="toggleDropdown('destinations')" href="#">Destinations</a>
        <div class="dp" id="dp-destinations">
            <a href="{{ route('add.destinations') }}">Add Destination</a>
            <a href="{{ route('view.destinations') }}">View Destination</a>
        </div>
        <a onclick="toggleDropdown('facilities')" href="#">Facilities</a>
        <div class="dp" id="dp-facilities">
            <a href="{{ route('facilities.create') }}">Add Facility</a>
            <a href="{{ route('facilities.index') }}">View Facilities</a>
        </div>
        <a href="{{ route('bookings.index') }}">Booking Transactions</a>
        <p style=>Reports and User Datas</p>
        <hr>
        <a onclick="toggleDropdown('reports')" href="#">Reports</a>
        <div class="dp" id="dp-reports">
            <a href="#">Add Report</a>
            <a href="#">View Report</a>
        </div>
        <a onclick="toggleDropdown('users')" href="#">Users</a>
        <div class="dp" id="dp-users">
            <a href="{{ route('users.create') }}">Add User</a>
            <a href="{{ route('users.index') }}">View User</a>
        </div>
        <p style=>Settings</p>
        <hr>
        <a href="{{ route('profile.edit') }}">Edit Profile</a>
        <a href="{{ route('tfa.settings') }}">Two Factor Authentication</a>
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
