@extends($layout)


@section('content')
    <div class="container">
        <h1>Create Facility</h1>
        <div class="form-container">
            <form action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="opening_hours">Opening Hours</label>
                    <div class="opening-hours">
                        <select id="opening_hour_start" name="opening_hour_start" class="form-control" required>
                            @for ($i = 0; $i < 24; $i++)
                                <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                <option value="{{ sprintf('%02d:30', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                            @endfor
                        </select>
                        <span>to</span>
                        <select id="opening_hour_end" name="opening_hour_end" class="form-control" required>
                            @for ($i = 0; $i < 24; $i++)
                                <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                <option value="{{ sprintf('%02d:30', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="contact_info">Contact Info</label>
                    <input type="text" id="contact_info" name="contact_info" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" id="type" name="type" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>

                @if (Auth::user()->role === 'admin')
                    <div class="form-group">
                        <label for="destination_id">Destination</label>
                        <select id="destination_id" name="destination_id" class="form-control" required>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Facility</button>
                </div>
            </form>
        </div>
    </div>
@endsection
