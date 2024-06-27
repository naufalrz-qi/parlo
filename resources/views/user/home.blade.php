@extends('user.layouts.app')
@section('style')
    <style>
        .container .btn-primary {
            color: white;
            background-color: var(--quinary);
            border: var(--quinary);
            font-weight: 700;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h2 class="m-5">Destinations</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($destinations as $destination)
                <div class="col">
                    <div class="card h-100 bg-white">
                        <img src="{{ asset('assets/img/destinations/' . $destination->image) }}" class="card-img-top"
                            alt="{{ $destination->name }}">
                        <div class="card-body">
                            <h2 class="card-title">{{ $destination->name }}</h2>
                            <p class="card-location"><strong>{{ $destination->location }}</strong></p>
                            <p class="card-price fs-5">
                                <strong>Rp{{ number_format($destination->price, 2, ',', '.') }}</strong></p>
                            <p class="card-text">{{ $destination->description }}</p>
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('bookings.create', $destination->id) }}" class="btn btn-primary me-2">Book
                                    Now</a>
                                <a href="{{ route('show.destinations', $destination->id) }}" class="btn btn-secondary">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('destinations.universal') }}" class="btn btn-primary m-5 px-4 py-3">View More</a>
    </div>
    <div class="container">
        <h2 class="m-5">Facilities</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($facilities as $facility)
                <div class="col">
                    <div class="card h-100 bg-white">
                        <img src="{{ asset('assets/img/facilities/' . $facility->image) }}" alt="{{ $facility->name }}"
                            class="card-img">
                        <div class="card-body">
                            <small>{{ $facility->type }}</small>

                            <h3 class="card-title">{{ $facility->name }} </h3>
                            <p class="card-location"><strong>{{ $facility->location }}</strong> </p>

                            <p class="card-text">{{ $facility->description }}</p>
                            <p class="card-price fs-5"><strong>Rp{{ number_format($facility->price, 2, ',', '.') }}</strong></p>
                            {{-- <a href="{{ route('order.facility', $facility->id) }}" class="btn btn-order">Order</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <a href="{{ route('facilities.universal') }}" class="btn btn-primary m-5 px-4 py-3">View More</a>

    </div>
@endsection
