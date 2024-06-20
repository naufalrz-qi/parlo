@extends($layout)

@section('content')
    <div class="container">
        <h2>Payment Successful</h2>
        <p>Thank you for your payment. Here are the details of your booking:</p>

        <div class="booking-details">
            <h3>Booking Details</h3>
            <p><strong>Destination:</strong> {{ $booking->destination->name }}</p>
            <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
            <p><strong>Start Time:</strong> {{ $booking->start_time }}</p>
            <p><strong>End Time:</strong> {{ $booking->end_time }}</p>
            <p><strong>Total Price:</strong> {{ $booking->total_price }}</p>
            <p><strong>Status:</strong> {{ $booking->status }}</p>

            <h3>Facilities</h3>
            <ul>
                @foreach($booking->facilities as $facility)
                    <li>{{ $facility->name }}</li>
                @endforeach
            </ul>
        </div>

        <a href="{{ route('home') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
@endsection
