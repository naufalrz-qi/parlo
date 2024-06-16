@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Destination Details</h1>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $destination->name }}</h2>
                <p class="card-text">{{ $destination->description }}</p>
                <p class="card-text"><strong>Location:</strong> {{ $destination->location }}</p>
                <p class="card-text"><strong>iframe:</strong> {{ $destination->iframe }}</p>
                <p class="card-text"><strong>Price:</strong> Rp{{ number_format($destination->price, 2, ',', '.') }}</p>
                <p class="card-text"><strong>Created At:</strong> {{ $destination->created_at->format('d M Y') }}</p>
                <p class="card-text"><strong>Updated At:</strong> {{ $destination->updated_at->format('d M Y') }}</p>
                @if ($destination->image)
                    <div class="image-container">
                        <img src="{{ asset('assets/img/destinations/' . $destination->image) }}"
                            alt="{{ $destination->name }}" class="destination-image">
                    </div>
                @else
                    <p>No image available</p>
                @endif

                <a href="{{ route('edit.destinations', $destination->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('destroy.destinations', $destination->id) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this destination?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
