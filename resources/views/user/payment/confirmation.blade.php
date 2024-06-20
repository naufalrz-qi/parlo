@extends($layout)

@section('content')
<div class="container">
    <h1>Payment Confirmation</h1>
    <p>{{ $message }}</p>

    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
</div>
@endsection
