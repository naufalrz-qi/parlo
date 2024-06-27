@extends($layout)

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center w-100">
        <div class="col-lg-6 col-md-8">
            <!-- Secret Code Form Card -->
            <div class="card shadow-lg mb-4" id="secretCodeForm">
                <div class="card-header bg-primary text-white">{{ __('Two Factor Secret Code') }}</div>
                <div class="card-body">
                    <p class="fw-bold">{{ __('Please enter your secret code to login.') }}</p>
                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Secret Code') }}</label>
                            <div class="col-md-6">
                                <input id="code" type="password" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="current-code">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                                <div class="btn btn-link" onclick='displayForm("recoveryCodeForm")'>{{ __('Use Recovery Code') }}</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Recovery Code Form Card -->
            <div class="card shadow-lg mb-4" id="recoveryCodeForm" style="display: none;">
                <div class="card-header bg-primary text-white">{{ __('Two Factor Recovery Code') }}</div>
                <div class="card-body">
                    <p class="fw-bold">{{ __('Please enter your recovery code to login.') }}</p>
                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="recovery_code" class="col-md-4 col-form-label text-md-end">{{ __('Recovery Code') }}</label>
                            <div class="col-md-6">
                                <input id="recovery_code" type="password" class="form-control @error('recovery_code') is-invalid @enderror" name="recovery_code" required autocomplete="current-recovery_code">
                                @error('recovery_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                                <div class="btn btn-link" onclick='displayForm("secretCodeForm")'>{{ __('Use Secret Code') }}</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function displayForm(type) {
        if (type === 'recoveryCodeForm') {
            document.getElementById('recoveryCodeForm').style.display = 'block';
            document.getElementById('secretCodeForm').style.display = 'none';
        } else {
            document.getElementById('recoveryCodeForm').style.display = 'none';
            document.getElementById('secretCodeForm').style.display = 'block';
        }
    }
</script>
@endsection
