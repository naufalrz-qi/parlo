@extends($layout)

@section('content')
<div class="container">
    <h1>Booking History</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Destination</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Facilities</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->destination->name }}</td>
                <td>{{ $booking->start_time }}</td>
                <td>{{ $booking->end_time }}</td>
                <td>
                    @foreach($booking->facilities as $facility)
                        {{ $facility->name }}@if(!$loop->last), @endif
                    @endforeach
                </td>
                <td>${{ number_format($booking->total_price, 2) }}</td>
                @if ($booking->status == 'pending')
                    <td><a href="{{ route('payment.pending', $booking->id) }}">{{ ucfirst($booking->status) }}</a></td>
                @elseif ($booking->status == 'approved')
                <td><a href="{{ route('payment.success', $booking->id) }}">{{ ucfirst($booking->status) }}</a></td>

                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
