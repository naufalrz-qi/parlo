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
                            <p class="fs-4 text-green-600">
                                <strong>Rp{{ number_format($booking->total_price, 2, ',', '.') }}</strong>
                            </p>

                        </div>

                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Back to Dashboard</a>
                    </div>
                    @if ($booking->status == 'approved')
                        <h3>Submit Your Review</h3>

                        @if ($booking->review)
                            <div id="reviewDisplay" class="alert alert-info">
                                <p><strong>Rating:</strong>

                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $booking->review->rating)
                                            &#x2605; <!-- filled star -->
                                        @else
                                            &#x2606; <!-- empty star -->
                                        @endif
                                    @endfor

                                    ({{ $booking->review->rating }} / 5)

                                </p>
                                <p><strong>Review:</strong> {{ $booking->review->review }}</p>
                                <button id="editReviewButton" class="btn btn-warning">Edit</button>
                            </div>

                            <div id="reviewForm" style="display:none;">
                                <form action="{{ route('reviews.update', $booking->review->id) }}" method="POST">
                                    @method('PUT')
                                @else
                                    <div id="reviewForm">
                                        <form action="{{ route('reviews.store') }}" method="POST">
                        @endif
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <div class="form-group">
                            <label for="rating" class="control-label">Rating:</label>
                            <select name="rating" id="rating" class="form-control" required>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}"
                                        {{ $booking->review && $booking->review->rating == $i ? 'selected' : '' }}>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="review" class="control-label">Review:</label>
                            <textarea name="review" id="review" class="form-control" rows="4" required>{{ $booking->review ? $booking->review->review : '' }}</textarea>
                        </div>
                        <button type="submit"
                            class="btn btn-warning">{{ $booking->review ? 'Update' : 'Submit' }}</button>
                        </form>
                </div>
                @endif
                <button id="download-receipt" class="btn btn-secondary btn-lg">Download Receipt</button>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.72/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.72/vfs_fonts.js"></script>
    <script>
        document.getElementById('download-receipt').addEventListener('click', () => {
            const booking = {
                id: "{{ $booking->id }}",
                destination: "{{ $booking->destination->name }}",
                createdAt: "{{ $booking->created_at }}",
                startTime: "{{ $booking->start_time }}",
                endTime: "{{ $booking->end_time }}",
                destinationPrice: "{{ $booking->destination->price }}",
                facilities: [
                    @foreach ($booking->facilities as $facility)
                        {
                            name: '{{ $facility->name }}',
                            price: "{{ $facility->price }}"
                        },
                    @endforeach
                ],
                totalPrice: "{{ $booking->total_price }}",
            };

            const docDefinition = {
                content: [
                    {
                        text: `Receipt for Booking ${booking.id}`,
                        style: 'header'
                    },
                    {
                        text: `Destination: ${booking.destination}`,
                        style: 'ubheader'
                    },
                    {
                        text: `Booking Date: ${new Date(booking.createdAt).toLocaleString()}`
                    },
                    {
                        text: `Start Time: ${new Date(booking.startTime).toLocaleString()}`
                    },
                    {
                        text: `End Time: ${new Date(booking.endTime).toLocaleString()}`
                    },
                    {
                        table: {
                            widths: [100, 100],
                            body: [
                                ['Destination Price', `Rp ${parseFloat(booking.destinationPrice).toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`],
                            ]
                        }
                    },
                    {
                        text: 'Facilities:'
                    },
                    {
                        table: {
                            widths: [100, 100],
                            body: booking.facilities.map(facility => [
                                facility.name,
                                `Rp ${parseFloat(facility.price).toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
                            ])
                        }
                    },
                    {
                        table: {
                            widths: [100, 100],
                            body: [
                                ['Total Price', `Rp ${parseFloat(booking.totalPrice).toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`],
                            ],
                            bold:true
                        }
                    }
                ],
                styles: {
                    header: {
                        fontSize: 18,
                        bold: true
                    },
                    subheader: {
                        fontSize: 15,
                        bold: true
                    }
                }
            };

            pdfMake.createPdf(docDefinition).download('receipt.pdf');
        });
    </script>

    <script>
        document.getElementById('editReviewButton').addEventListener('click', function() {
            document.getElementById('reviewDisplay').style.display = 'none';
            document.getElementById('reviewForm').style.display = 'block';
        });
    </script>
@endsection
