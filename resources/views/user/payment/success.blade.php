@extends($layout)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h2>Payment <span class="text-green-600">Successful</span></h2>
                    </div>
                    <div class="card-body bg-white">
                        <p class="mb-4">Thank you for your payment. Here are the details of your booking:</p>

                        <div class="booking-details mb-4">
                            <h3>Booking Details</h3>
                            <p><strong>Destination:</strong> {{ $booking->destination->name }}</p>
                            <p><strong>Booking Date:</strong> {{ $booking->created_at }}</p>
                            <p><strong>Start Time:</strong> {{ $booking->start_time }}</p>
                            <p><strong>End Time:</strong> {{ $booking->end_time }}</p>
                            <p><strong>Destination Price:</strong>
                                Rp{{ number_format($booking->destination->price, 2, ',', '.') }}
                            <p class="text-green-600"><strong>Status:</strong> {{ $booking->status }}</p>

                            <h3>Facilities</h3>
                            <ul>
                                @foreach ($booking->facilities as $facility)
                                    <li>{{ $facility->name }} - Rp{{ number_format($facility->price, 2, ',', '.') }}</li>
                                @endforeach
                            </ul>

                            <p><strong>Total Price:</strong></p>
                            <p class="fs-4 text-green-600"><strong>Rp{{ number_format($booking->total_price, 2, ',', '.') }}</strong></p>

                        </div>

                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
