@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Facilities</h1>
        <a href="{{ route('facilities.create') }}" class="btn btn-primary">Add New Facility</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Opening Hours</th>
                        <th>Contact Info</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facilities as $facility)
                        <tr>
                            <td>{{ $facility->name }}</td>
                            <td>{{ $facility->description }}</td>
                            <td>{{ $facility->location }}</td>
                            <td>{{ $facility->opening_hours }}</td>
                            <td>{{ $facility->contact_info }}</td>
                            <td>{{ $facility->type }}</td>
                            <td>
                                <a href="{{ route('facilities.show', $facility->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('facilities.edit', $facility->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
