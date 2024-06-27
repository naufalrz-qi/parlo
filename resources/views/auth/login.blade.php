@extends($layout)

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center w-100">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg bg-white">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/img/facilities/default.jpg') }}" class="img-fluid rounded h-100 object-fit-cover" alt="Login Image">
                    </div>
                    <div class="col-md-6">
                        <div class="card-header bg-primary text-white text-center">
                            <h1>Login</h1>
                        </div>
                        <div class="card-body">
                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="form-group mb-3">
                                    <label for="login">Email</label>
                                    <input id="login" type="text" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="form-group form-check mb-3">
                                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                                    <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                                </div>

                                <!-- Forgot Password and Login Button -->
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-primary">{{ __('Forgot your password?') }}</a>
                                    @endif
                                    <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
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
