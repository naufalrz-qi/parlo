@extends($layout)

@section('content')
<div class="container">
    <h1>Register User</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username">
            @error('username')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Phone Number -->
        <div class="form-group">
            <label for="phonenumber">Phone Number</label>
            <input id="country_code" type="text" name="country_code" value="{{ old('country_code') }}" required autocomplete="country_code" placeholder="Country Code">
            <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
            @error('country_code')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            @error('phone_number')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Register Button -->
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Register</button>
        </div>

        <!-- Already registered link -->
        <div class="form-group">
            <a href="{{ route('login') }}">Already registered?</a>
        </div>
    </form>
</div>
@endsection
