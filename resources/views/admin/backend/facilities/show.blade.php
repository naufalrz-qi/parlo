@extends($layout)

@section('content')
<div class="container">
    <h1>Facility Details</h1>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $facility->name }}</h2>
            <p class="card-text">{{ $facility->description }}</p>
            <p class="card-text"><strong>Location:</strong> {{ $facility->location }}</p>
            <p class="card-text"><strong>Opening Hours:</strong> {{ $facility->opening_hours }}</p>
            <p class="card-text"><strong>Contact Info:</strong> {{ $facility->contact_info }}</p>
            <p class="card-text"><strong>Type:</strong> {{ $facility->type }}</p>
            <p class="card-text"><strong>Price:</strong> Rp{{ number_format($facility->price, 2, ',', '.') }}</p>
            <p class="card-text"><strong>Destination:</strong> {{ $facility->destination->name }}</p>
            @if ($facility->image)
                <div class="card-container">
                    <img src="{{ asset('assets/img/facilities/' . $facility->image) }}" alt="{{ $facility->name }}" class="card-img">
                </div>
            @else
                <p>No image available</p>
            @endif
            <a href="{{ route('facilities.edit', $facility->id) }}" class="btn btn-warning mt-3">Edit</a>
            <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to delete this facility?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
