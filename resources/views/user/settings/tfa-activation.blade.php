@extends($layout)

@section('content')
<div class="container mt-5 bg-white">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- QR Code Card -->
            <div class="card bg-white p-0 shadow-lg mb-4">
                <div class="card-header bg-primary text-white">{{ __('Two Factor Authentication') }}</div>
                <div class="card-body">
                    @if (session('status') == "two-factor-authentication-disabled")
                        <div class="alert alert-danger" role="alert">
                            Two factor authentication has been disabled
                        </div>
                    @endif

                    @if (session('status') == "two-factor-authentication-enabled")
                        <div class="alert alert-success" role="alert">
                            Two factor authentication has been enabled
                        </div>
                    @endif
                    <form method="post" action="/user/two-factor-authentication">
                        @csrf
                        @if (auth()->user()->two_factor_secret)
                            @method('DELETE')
                            <div class="pb-3 text-center">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                            <button class="btn btn-danger mt-3 w-100">
                                Disable
                            </button>
                        @else
                            <button class="btn btn-success mt-3 w-100">
                                Enable
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Recovery Codes Card -->
            <div class="card bg-white p-0 shadow-lg mb-4">
                <div class="card-header bg-primary text-white">{{ __('Recovery Codes') }}</div>
                <div class="card-body">
                    @if (auth()->user()->two_factor_secret)
                        <div class="mt-4">
                            <ul class="list-group mb-2">
                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                    <li class="list-group-item">{{ $code }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn btn-secondary mb-3 w-100" onclick="downloadRecoveryCodes()">
                                Download Recovery Codes
                            </button>
                        </div>
                    @else
                        <p class="text-center">Two-factor authentication is not enabled.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if (auth()->user()->two_factor_secret)
<script>
function downloadRecoveryCodes() {
    const recoveryCodes = @json(json_decode(decrypt(auth()->user()->two_factor_recovery_codes)));
    const blob = new Blob([recoveryCodes.join('\n')], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'recovery_codes.txt';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}
</script>
@endif
@endsection
