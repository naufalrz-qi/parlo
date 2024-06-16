@extends($layout)

@section('content')
<div class="container">
    <h1>All Destinations</h1>
    <br>
    <div class="card-container">
        @foreach($destinations as $destination)
            <div class="card">
                <img src="{{ asset('assets/img/destinations/' . $destination->image) }}" alt="{{ $destination->name }}" class="card-img">
                <div class="card-body">
                    <h2 class="card-title">{{ $destination->name }}</h2>
                    <p class="card-text">{{ $destination->description }}</p>
                    <p class="card-location"><strong>Location:</strong> {{ $destination->location }}</p>
                    <p class="card-price"><strong>Price:</strong> Rp{{ number_format($destination->price, 2, ',', '.') }}</p>
                    <a href="#" class="btn btn-order">Order</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
