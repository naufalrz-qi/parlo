@extends($layout)

@section('content')
<div class="container">
    <h1>Login</h1>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Login -->
        <div class="form-group">
            <label for="login">Email</label>
            <input id="login" type="text" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control">
            @error('login')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control">
            @error('password')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-group form-checkbox">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <!-- Forgot Password and Login Button -->
        <div class="form-group form-actions">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-blue-500">{{ __('Forgot your password?') }}</a>
            @endif
            <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
        </div>
    </form>
</div>
@endsection
