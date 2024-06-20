<!-- resources/views/admin/backend/bookings/create.blade.php -->

@extends($layout)

@section('content')
    <div class="container">
        <div class="booking-form">
            <h1>Create Booking</h1>

            <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">

                <label for="booking_date">Booking Date:</label>
                <input type="date" id="booking_date" name="booking_date" required>

                <label for="start_time">Start Time:</label>
                <input type="time" id="start_time" name="start_time" required>

                <label for="end_time">End Time:</label>
                <input type="time" id="end_time" name="end_time" required>

                <h3>Select Facilities</h3>
                @foreach($facilities as $facility)
                    <div class="facility">
                        <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" class="facility-checkbox" data-price="{{ $facility->price }}">
                        <label class="facility-label">{{ $facility->name }} ({{ $facility->price }})</label>
                    </div>
                @endforeach

                <h3>Total Price: <span id="totalPrice" class="total-price">{{ $destination->price }}</span></h3>
                <input type="hidden" name="total_price" id="total_price" value="{{ $destination->price }}">

                <button type="submit">Book</button>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const facilityCheckboxes = document.querySelectorAll('.facility-checkbox');
                const totalPriceElement = document.getElementById('totalPrice');
                const totalPriceInput = document.getElementById('total_price');
                let basePrice = parseFloat(totalPriceElement.innerText);

                facilityCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        let totalPrice = basePrice;
                        facilityCheckboxes.forEach(facilityCheckbox => {
                            if (facilityCheckbox.checked) {
                                totalPrice += parseFloat(facilityCheckbox.dataset.price);
                            }
                        });
                        totalPriceElement.innerText = totalPrice.toFixed(2);
                        totalPriceInput.value = totalPrice.toFixed(2);
                    });
                });
            });
        </script>
    </div>
@endsection
