@extends($layout)

@section('content')
    <div class="container">
        <h1>Bookings</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Destination</th>
                    <th>Facilities</th>
                    <th>Booking Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $key => $booking)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->destination->name }}</td>
                        <td>
                            @foreach($booking->facilities as $facility)
                                {{ $facility->name }}<br>
                            @endforeach
                        </td>
                        <td>{{ $booking->created_at }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                        <td>Rp{{ number_format($booking->total_price, 2, ',', '.') }}</td>
                        <td>{{ $booking->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
