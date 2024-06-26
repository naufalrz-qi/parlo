@extends($layout)
@section('style')
<style>
    .card {
       background-color: white;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
       border: none;
    }
</style>
@endsection
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">All Destinations</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($destinations as $destination)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('assets/img/destinations/' . $destination->image) }}" class="card-img-top" alt="{{ $destination->name }}">
                    <div class="card-body">
                        <h2 class="card-title">{{ $destination->name }}</h2>
                        <p class="card-text">{{ $destination->description }}</p>
                        <p class="card-location"><strong>Location:</strong> {{ $destination->location }}</p>
                        <p class="card-price"><strong>Price:</strong> Rp{{ number_format($destination->price, 2, ',', '.') }}</p>
                        <a href="{{ route('bookings.create', $destination->id) }}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
