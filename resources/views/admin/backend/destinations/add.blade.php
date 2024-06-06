@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Add New Destination</h2>
    <form action="{{ route('store.destination') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
        </div>

        <div class="form-group">
            <label for="iframe">Iframe:</label>
            <input type="text" id="iframe" name="iframe">
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>
@endsection
