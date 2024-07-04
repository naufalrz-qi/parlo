@extends('employee.layouts.app')

@section('content')
<div class="container">
    <h1>Employee Dashboard</h1>

    <div class="destination-info">
        <h2>    {{ $destination->name }}</h2>
        <p>{{ $destination->description }}</p>
    </div>

    <div class="facilities-overview">
        <h2>Overview</h2>
        <p>Total Facilities: {{ $totalFacilities }}</p>
    </div>

    <div class="latest-facilities table-responsive">
        <h2>Latest Facilities</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Opening Hours</th>
                    <th>Contact Info</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($latestFacilities as $key => $facility)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $facility->name }}</td>
                        <td>{{ $facility->description }}</td>
                        <td>{{ $facility->location }}</td>
                        <td>{{ $facility->opening_hours }}</td>
                        <td>{{ $facility->contact_info }}</td>
                        <td>{{ $facility->type }}</td>
                        <td>{{ $facility->price }}</td>
                        <td>
                            <img src="{{ asset('assets/img/facilities/' . $facility->image) }}" alt="{{ $facility->name }}" width="200px" class="img-fluid">
                        </td>
                        <td>
                            <a href="{{ route('facilities.edit', $facility->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this facility?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
