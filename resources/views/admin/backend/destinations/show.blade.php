@extends($layout)
@section('style')
    <style>
        .card {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .btn-primary {
            color: white;
            background-color: var(--quinary);
            border: var(--quinary);
            font-weight: 700;
        }

        .map-container {

            width: 100%;
            height: 100
        }

        .map-container iframe {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h1>{{ $destination->name }}</h1>
        <div class="row">
            @if ($destination->image)
                <div class="col-md-4">
                    <img src="{{ asset('assets/img/destinations/' . $destination->image) }}" alt="{{ $destination->name }}"
                        class="img-fluid rounded">
                </div>
            @else
                <div class="col-md-4">
                    <p>No image available</p>
                </div>
            @endif
            <div class="col-md-8">
                <p><strong>{{ $destination->location }}</strong></p>
                <p>{{ $destination->description }}</p>
                <p class="fs-5"><strong>Rp{{ number_format($destination->price, 2, ',', '.') }}</strong></p>

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('edit.destinations', $destination->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('destroy.destinations', $destination->id) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this destination?')">Delete</button>
                    </form>
                @elseif (auth()->user()->role === 'user')
                    <a href="{{ route('bookings.create', $destination->id) }}" class="btn btn-primary">Book Now</a>
                @endif

            </div>
        </div>

    </div>

    <div class="container mt-5">
        <h2>Location Map</h2>
        <div class="map-container">
            <iframe src="{{ $destination->iframe }}"></iframe>
        </div>
    </div>
    <div class="container">
        <h2>Facilities</h2>
        @if ($facilities->isEmpty())
            <p>No facilities available for this destination.</p>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($facilities as $facility)
                    <div class="col">
                        <div class="card h-100 bg-white">
                            <img src="{{ asset('assets/img/facilities/' . $facility->image) }}"
                                alt="{{ $facility->name }}" class="card-img">
                            <div class="card-body">
                                <small>{{ $facility->type }}</small>
                                <h3 class="card-title">{{ $facility->name }}</h3>
                                <p class="card-location"><strong>{{ $facility->location }}</strong></p>
                                <p class="card-text">{{ $facility->description }}</p>
                                <p class="card-price fs-5">
                                    <strong>Rp{{ number_format($facility->price, 2, ',', '.') }}</strong>
                                </p>
                                {{-- <a href="{{ route('order.facility', $facility->id) }}" class="btn btn-order">Order</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection
