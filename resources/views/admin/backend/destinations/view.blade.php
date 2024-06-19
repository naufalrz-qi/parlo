@extends('admin.layouts.app')
@section('content')

<div class="container">
    <h1>Destinations</h1>
        <a href="{{ route('add.destinations') }}" class="btn btn-primary">Add New Destinations</a>
    <table>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>iframe</th>
            <th>image</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        @foreach ($datas as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->location }}</td>
                <td>{{ $data->iframe }}</td>
                <td><img src="{{ asset('assets/img/destinations/') }}/{{ $data->image }}" alt="" height="50px"></td>
                <td>Rp{{ number_format($data->price, 2, ',', '.') }}</td>

                <td>
                    <a href="{{ route('show.destinations', $data->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('edit.destinations', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('destroy.destinations', $data->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this destination?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach


    </table>
</div>

@endsection
