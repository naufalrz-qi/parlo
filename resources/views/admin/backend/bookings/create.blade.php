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

        .error-message {
            color: red;
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="booking-form my-4">
            <h1>Create Booking</h1>
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm" class="form-horizontal">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">

                <div class="mb-3">
                    <label for="start_time" class="form-label">Start Time:</label>
                    <input type="datetime-local" id="start_time" name="start_time"
                        class="form-control @error('start_time') is-invalid @enderror" required>
                    @error('start_time')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="end_time" class="form-label">End Time:</label>
                    <input type="datetime-local" id="end_time" name="end_time"
                        class="form-control @error('end_time') is-invalid @enderror" required>
                    @error('end_time')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" id="destination_price" value="{{ $destination->price }}">
                <!-- Input hidden untuk fasilitas yang dipilih -->
                <input type="hidden" name="facilities[]" id="selectedFacilitiesInput">
                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#facilityModal">
                        Select Facilities
                    </button>
                    @error('facilities')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Daftar fasilitas yang dipilih -->
                <div id="selectedFacilities">
                    <ul id="selectedFacilitiesList"></ul>
                </div>

                <h3>Total Price: <span id="totalPrice"
                        class="total-price">Rp{{ number_format($destination->price, 2, ',', '.') }}</span></h3>
                <input type="hidden" name="total_price" id="total_price" value="{{ $destination->price }}">
                @error('total_price')
                    <div class="error-message">{{ $message }}</div>
                @enderror

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
            const selectedFacilitiesList = document.getElementById('selectedFacilitiesList');
            const selectedFacilitiesInput = document.getElementById('selectedFacilitiesInput');
            const destinationPrice = parseFloat(document.getElementById('destination_price').value.replace(/\./g,
                '').replace(',', '.')); // Assume you have hidden input for destination price
            const pricePerDay = 100000; // Set price per day

            // Set the min attribute for start_time and end_time
            const now = new Date();
            const nowString = now.toISOString().slice(0, 16);
            document.getElementById('start_time').setAttribute('min', nowString);
            document.getElementById('end_time').setAttribute('min', nowString);

            function formatCurrency(amount) {
                return 'Rp' + amount.toFixed(2).replace('.', ',').replace(/\d(?=(\d{3})+,)/g, '$&.');
            }

            function updateTotalPrice() {
                let totalPrice = destinationPrice;
                facilityCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        totalPrice += parseFloat(checkbox.dataset.price.replace(/\./g, '').replace(',',
                            '.'));
                    }
                });

                totalPriceElement.innerText = formatCurrency(totalPrice);
                totalPriceInput.value = totalPrice.toFixed(2).replace('.', ',').replace(/\./g, '');
            }

            facilityCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotalPrice);
            });

            document.getElementById('start_time').addEventListener('change', updateTotalPrice);
            document.getElementById('end_time').addEventListener('change', updateTotalPrice);

            saveFacilitiesButton.addEventListener('click', function() {
                // Clear existing selected facilities
                selectedFacilitiesList.innerHTML = '';
                selectedFacilitiesInput.value = ''; // Clear hidden input

                // Add selected facilities to the list and update hidden input
                let selectedFacilityIds = [];
                facilityCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const facilityName = checkbox.dataset.name;
                        const facilityPrice = parseFloat(checkbox.dataset.price.replace(/\./g, '')
                            .replace(',', '.'));
                        const facilityId = checkbox.id.replace('facility',
                        ''); // Extract facility ID
                        selectedFacilityIds.push(facilityId);
                        const listItem = document.createElement('li');
                        listItem.classList.add('selected-facility-item');
                        listItem.innerHTML = `
                    <span class="facility-name">${facilityName}</span>
                    <span class="facility-price text-success">${formatCurrency(facilityPrice)}</span>
                `;
                        selectedFacilitiesList.appendChild(listItem);
                    }
                });

                // Update hidden input with selected facility IDs
                selectedFacilitiesInput.value = selectedFacilityIds.join(',');

                updateTotalPrice();
                bootstrap.Modal.getInstance(document.getElementById('facilityModal')).hide();
            });
        });
    </script>
@endsection
