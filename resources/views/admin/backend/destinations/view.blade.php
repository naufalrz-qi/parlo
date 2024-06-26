@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <h1>Destinations</h1>
        <a href="{{ route('add.destinations') }}" class="btn btn-primary mb-5">+ Add New Destinations</a>
        <div class="table-responsive">
            <table class="table table-light">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Location</th>
                        <th scope="col">iframe</th>
                        <th scope="col">image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->location }}</td>
                            <td>{{ $data->iframe }}</td>
                            <td><img src="{{ asset('assets/img/destinations/') }}/{{ $data->image }}" alt=""
                                    height="50px">
                            </td>
                            <td>Rp{{ number_format($data->price, 2, ',', '.') }}</td>

                            <td>
                                <a href="{{ route('show.destinations', $data->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('edit.destinations', $data->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('destroy.destinations', $data->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this destination?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>

    </div>
@endsection
