@extends($layout)


@section('content')
<div class="container">
    <h1>Edit Facility</h1>
    <div class="form-container">
        <form action="{{ route('facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $facility->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" required>{{ $facility->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ $facility->location }}" required>
            </div>

            <div class="form-group">
                <label for="opening_hours">Opening Hours</label>
                <div class="opening-hours">
                    @php
                        list($start, $end) = explode(' - ', $facility->opening_hours);
                    @endphp
                    <select id="opening_hour_start" name="opening_hour_start" class="form-control" required>
                        @for ($i = 0; $i < 24; $i++)
                            <option value="{{ sprintf('%02d:00', $i) }}" {{ $start == sprintf('%02d:00', $i) ? 'selected' : '' }}>{{ sprintf('%02d:00', $i) }}</option>
                            <option value="{{ sprintf('%02d:30', $i) }}" {{ $start == sprintf('%02d:30', $i) ? 'selected' : '' }}>{{ sprintf('%02d:30', $i) }}</option>
                        @endfor
                    </select>
                    <span>to</span>
                    <select id="opening_hour_end" name="opening_hour_end" class="form-control" required>
                        @for ($i = 0; $i < 24; $i++)
                            <option value="{{ sprintf('%02d:00', $i) }}" {{ $end == sprintf('%02d:00', $i) ? 'selected' : '' }}>{{ sprintf('%02d:00', $i) }}</option>
                            <option value="{{ sprintf('%02d:30', $i) }}" {{ $end == sprintf('%02d:30', $i) ? 'selected' : '' }}>{{ sprintf('%02d:30', $i) }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="contact_info">Contact Info</label>
                <input type="text" id="contact_info" name="contact_info" class="form-control" value="{{ $facility->contact_info }}" required>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" id="type" name="type" class="form-control" value="{{ $facility->type }}" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ $facility->price }}" required>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                @if ($facility->image)
                    <div class="card-container">
                        <img src="{{ asset('assets/img/facilities/' . $facility->image) }}" alt="{{ $facility->name }}" class="card-img">
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-control">
            </div>

            @if (Auth::user()->role === 'admin')
                <div class="form-group">
                    <label for="destination_id">Destination</label>
                    <select id="destination_id" name="destination_id" class="form-control" required>
                        @foreach ($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ $facility->destination_id == $destination->id ? 'selected' : '' }}>{{ $destination->name }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">
            @endif

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Facility</button>
            </div>
        </form>
    </div>
</div>
@endsection
