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
                    <th>Actions</th>
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
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                        <td>Rp{{ number_format($booking->total_price, 2, ',', '.') }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
