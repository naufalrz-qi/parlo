@extends($layout)
@section('content')
<div class="container">
    <h2 class="mb-4">Profile</h2>

    <div class="card mb-4 bg-white w-100 px-5">
        <div class="card-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="card mb-4 bg-white w-100 px-5">
        <div class="card-body">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="card mb-4 bg-white w-100 px-5">
        <div class="card-body">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection



