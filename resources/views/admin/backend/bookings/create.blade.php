<!-- resources/views/admin/backend/bookings/create.blade.php -->

@extends($layout)

@section('style')
    <style>
        .facility-card img {
            height: 200px;
            object-fit: cover;
        }


        .btn-primary {
            color: white;
            background-color: var(--quinary);
            border: var(--quinary);
            font-weight: 700;
        }

        .selected-facility-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .facility-name {
            flex: 1;
        }

        .facility-price {
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="booking-form my-4">
            <h1>Create Booking</h1>

            <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm" class="form-horizontal">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">

                <div class="mb-3">
                    <label for="booking_date" class="form-label">Booking Date:</label>
                    <input type="date" id="booking_date" name="booking_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="start_time" class="form-label">Start Time:</label>
                    <input type="time" id="start_time" name="start_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="end_time" class="form-label">End Time:</label>
                    <input type="time" id="end_time" name="end_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#facilityModal">
                        Select Facilities
                    </button>
                </div>

                <!-- Daftar fasilitas yang dipilih -->
                <div id="selectedFacilities">
                    <ul id="selectedFacilitiesList"></ul>
                </div>

                <h3>Total Price: <span id="totalPrice"
                        class="total-price">Rp{{ number_format($destination->price, 2, ',', '.') }}</span></h3>
                <input type="hidden" name="total_price" id="total_price" value="{{ $destination->price }}">

                <div class="mb-3 d-grid">
                    <button type="submit" class="btn btn-primary px-4 py-2 fs-4">Book</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Facility Modal -->
    <div class="modal mt-5 fade" id="facilityModal" tabindex="-1" aria-labelledby="facilityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg mt-5">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="facilityModalLabel">Select Facilities</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach ($facilities as $facility)
                            <div class="col">
                                <div class="card h-100 facility-card bg-white">
                                    <img src="{{ asset('assets/img/facilities/' . $facility->image) }}"
                                        alt="{{ $facility->name }}" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $facility->name }}</h5>
                                        <p class="card-text">{{ $facility->description }}</p>
                                        <p class="card-price">
                                            <strong>Rp{{ number_format($facility->price, 2, ',', '.') }}</strong>
                                        </p>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input facility-checkbox"
                                                id="facility{{ $facility->id }}" data-price="{{ $facility->price }}"
                                                data-name="{{ $facility->name }}">
                                            <label class="form-check-label"
                                                for="facility{{ $facility->id }}">Select</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveFacilities">Save Selection</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const facilityCheckboxes = document.querySelectorAll('.facility-checkbox');
            const totalPriceElement = document.getElementById('totalPrice');
            const totalPriceInput = document.getElementById('total_price');
            const saveFacilitiesButton = document.getElementById('saveFacilities');
            let basePrice = parseFloat(totalPriceInput.value.replace(/\./g, '').replace(',', '.'));

            function updateTotalPrice() {
                let totalPrice = basePrice;
                facilityCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        totalPrice += parseFloat(checkbox.dataset.price.replace(/\./g, '').replace(',',
                            '.'));
                    }
                });

                // Format totalPrice to Indonesian Rupiah
                totalPriceElement.innerText = formatCurrency(totalPrice);
                totalPriceInput.value = formatCurrency(totalPrice).replace('Rp', '').replace(/\./g, '').replace(',',
                    '.');

                function formatCurrency(amount) {
                    return 'Rp' + amount.toFixed(2).replace('.', ',').replace(/\d(?=(\d{3})+,)/g, '$&.');
                }
            }

            facilityCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotalPrice);
            });

            saveFacilitiesButton.addEventListener('click', function() {
                // Handle saving selected facilities here if needed
                // Clear existing selected facilities
                selectedFacilitiesList.innerHTML = '';

                // Add selected facilities to the list
                facilityCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const facilityName = checkbox.dataset.name;
                        const facilityPrice = parseFloat(checkbox.dataset.price.replace(/\./g, '')
                            .replace(',', '.'));
                        const listItem = document.createElement('li');
                        listItem.classList.add('selected-facility-item');
                        listItem.innerHTML = `
                <span class="facility-name">${facilityName}</span>
                <span class="facility-price text-success">Rp${facilityPrice.toFixed(2).replace('.', ',')}</span>
            `;
                        selectedFacilitiesList.appendChild(listItem);
                    }
                });
                updateTotalPrice();
                bootstrap.Modal.getInstance(document.getElementById('facilityModal')).hide();
            });

        });
    </script>
@endsection
