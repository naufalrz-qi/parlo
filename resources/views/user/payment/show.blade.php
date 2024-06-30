@extends($layout)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card bg-white">
                    <div class="card-header">
                        <h2>Complete Payment for Booking #{{ $booking->id }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="booking-details mb-4">
                            <h3>Booking Details</h3>
                            <p><strong>Destination:</strong> {{ $booking->destination->name }}</p>
                            <p><strong>Booking Date:</strong> {{ $booking->created_at }}</p>
                            <p><strong>Start Time:</strong> {{ $booking->start_time }}</p>
                            <p><strong>End Time:</strong> {{ $booking->end_time }}</p>
                            <p><strong>Destination Price:</strong>
                                Rp{{ number_format($booking->destination->price, 2, ',', '.') }}
                            <p><strong>Status:</strong> {{ $booking->status }}</p>

                            <h3>Facilities</h3>
                            <ul>
                                @foreach ($booking->facilities as $facility)
                                    <li>{{ $facility->name }} - Rp{{ number_format($facility->price, 2, ',', '.') }}</li>
                                @endforeach
                            </ul>

                            <p><strong>Total Price:</strong></p>
                            <p class="fs-4"><strong>Rp{{ number_format($booking->total_price, 2, ',', '.') }}</strong></p>
                        </div>
                        <button id="pay-button" class="btn btn-primary btn-lg">Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    handlePaymentResult(result);
                },
                onPending: function(result) {
                    handlePaymentResult(result);
                },
                onError: function(result) {
                    alert("Payment failed!");
                },
                onClose: function() {
                    alert('You closed the popup without finishing the payment');
                }
            });
        });

        function handlePaymentResult(result) {
            $.ajax({
                url: "{{ route('payment.callback') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: result.order_id,
                    status_code: result.status_code,
                    transaction_status: result.transaction_status,
                    gross_amount: result.gross_amount,
                    payment_type: result.payment_type,
                    transaction_time: result.transaction_time,
                    fraud_status: result.fraud_status,
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert("Payment successful!");
                        window.location.href = "{{ route('payment.success', $booking->id) }}";
                    } else {
                        alert("Payment failed!");
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error);
                    alert("An error occurred while processing payment: " + error);
                }
            });
        }
    </script>
@endsection
