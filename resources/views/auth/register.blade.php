@extends($layout)

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center w-100">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg bg-white">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/img/facilities/default.jpg') }}" class="img-fluid rounded h-100 object-fit-cover" alt="Register Image">
                    </div>
                    <div class="col-md-6">
                        <div class="card-header bg-primary text-white text-center">
                            <h1>Register User</h1>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Username -->
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" class="form-control @error('username') is-invalid @enderror">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Email Address -->
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div class="form-group mb-3">
                                    <label for="phonenumber">Phone Number</label>
                                    <div class="d-flex">
                                        <input id="country_code" type="text" name="country_code" value="{{ old('country_code') }}" required autocomplete="country_code" placeholder="Country Code" class="form-control me-2 @error('country_code') is-invalid @enderror">
                                        <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" class="form-control @error('phone_number') is-invalid @enderror">
                                    </div>
                                    @error('country_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control @error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Register Button -->
                                <div class="form-group mb-3">
                                    <button class="btn btn-primary w-100" type="submit">Register</button>
                                </div>

                                <!-- Already registered link -->
                                <div class="form-group text-center">
                                    <a href="{{ route('login') }}" class="text-primary">Already registered?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
