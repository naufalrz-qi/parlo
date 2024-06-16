@extends('user.layouts.app')

@section('content')
<div class="container">
    <div class="card-container">
        <h2>Destinations</h2>
        @foreach($destinations as $destination)
        <div class="card">
            <img class="card-img"
                src="{{ !empty($destination->image) ? asset('assets/img/destinations/' . $destination->image) : asset('assets/img/hero.jpg') }}"
                alt="{{ $destination->image }}">
            <div class="card-body">
                <h3 class="card-title">{{ $destination->name }}</h3>
                <p class="card-text">{{ $destination->description }}</p>
                <p class="card-location"><strong>Location:</strong> {{ $destination->location }}</p>
                <p class="card-price"><strong>Price:</strong> Rp{{ number_format($destination->price, 2, ',', '.') }}</p>
                {{-- <a href="{{ route('order.destination', $destination->id) }}" class="btn btn-order">Order</a> --}}
                <a href="#" class="btn btn-order">Order</a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card-container">
        <h2>Facilities</h2>
        @foreach($facilities as $facility)
        <div class="card">
            <img src="{{ asset('assets/img/facilities/' . $facility->image) }}" alt="{{ $facility->name }}" class="card-img">
            <div class="card-body">
                <h3 class="card-title">{{ $facility->name }}</h3>
                <p class="card-text">{{ $facility->description }}</p>
                <p class="card-location"><strong>Location:</strong> {{ $facility->location }}</p>
                <p class="card-type"><strong>Type:</strong> {{ $facility->type }}</p>
                <p class="card-price"><strong>Price:</strong> Rp{{ number_format($facility->price, 2, ',', '.') }}</p>
                {{-- <a href="{{ route('order.facility', $facility->id) }}" class="btn btn-order">Order</a> --}}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
