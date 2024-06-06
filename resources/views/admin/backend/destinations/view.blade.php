@extends('admin.layouts.app')
@section('content')

<div class="container">
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
                <td>{{ $data->price }}</td>
                <td>edit</td>
            </tr>
        @endforeach


    </table>
</div>
   
@endsection
