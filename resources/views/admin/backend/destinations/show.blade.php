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
            height: 500px;
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
    <div class="row">
        <div class="col-7">
            <div class="container align-items-start">
                <h2>Reviews<span>( @if($destination->averageRating)
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= round($destination->averageRating))
                            ⭐
                        @else
                            ☆
                        @endif
                    @endfor
                @else
                    No ratings yet.
                @endif)</span></h2>
            @if($reviews->isEmpty())
                <p>No reviews yet.</p>
            @else
                @foreach($reviews as $review)
                    <div class="card mb-3 mt-3 w-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <!-- Display stars for rating -->
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        ⭐
                                    @else
                                        ☆
                                    @endif
                                @endfor
                                ({{ $review->rating }} / 5)
                            </h5>
                            <p class="card-text"><strong>Review:</strong> {{ $review->review }}</p>
                            <p class="card-text"><strong>Submitted at:</strong> {{ $review->created_at->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
        <div class="col-5">
            <div class="container p-0" style="height: 600px">
                <h2>Location Map</h2>
                <div class="map-container">
                    <iframe src="{{ $destination->iframe }}" height="600px"></iframe>
                </div>
            </div>
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
