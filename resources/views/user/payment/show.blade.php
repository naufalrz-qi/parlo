@extends($layout)

@section('content')
    <div class="container">
        <h2>Complete Payment for Booking #{{ $booking->id }}</h2>

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

        <button id="pay-button">Pay Now</button>

        <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function () {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function (result) {
                        handlePaymentResult(result);
                    },
                    onPending: function (result) {
                        handlePaymentResult(result);
                    },
                    onError: function (result) {
                        alert("Payment failed!");
                    },
                    onClose: function () {
                        alert('You closed the popup without finishing the payment');
                    }
                });
            });

            function handlePaymentResult(result) {
                console.log('Payment Result:', result);
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
    </div>
@endsection
