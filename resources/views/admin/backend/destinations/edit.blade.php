@extends('admin.layouts.app')

@section('content')

<div class="container">
    <h1>Edit Destination - {{ $destination->name }}</h1>

    <form action="{{ route('update.destinations', $destination->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $destination->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4" required>{{ $destination->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" class="form-control" value="{{ $destination->location }}" required>
        </div>

        <div class="form-group">
            <label for="iframe">Iframe</label>
            <input type="text" id="iframe" name="iframe" class="form-control" value="{{ $destination->iframe }}">
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control">
            @if ($destination->image)
                <img src="{{ asset('assets/img/destinations/') }}/{{ $destination->image }}" alt="Destination Image" height="100px">
            @else
                <p>No image available</p>
            @endif
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" class="form-control" value="{{ $destination->price }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Destination</button>
    </form>
</div>

@endsection
