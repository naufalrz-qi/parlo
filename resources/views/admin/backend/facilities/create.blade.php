@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Create Facility</h1>
    <div class="form-container">
        <form action="{{ route('facilities.store') }}" method="POST">
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
                <button type="submit" class="btn btn-primary">Create Facility</button>
            </div>
        </form>
    </div>
</div>
@endsection
