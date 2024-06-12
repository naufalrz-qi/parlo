@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="stats">
        <div class="stat-item">
            <h2>Total Destinations</h2>
            <p>{{ $totalDestinations }}</p>
        </div>
        <div class="stat-item">
            <h2>Total Facilities</h2>
            <p>{{ $totalFacilities }}</p>
        </div>
    </div>
    <div class="latest-items">
        <div class="latest-destinations">
            <h2>Latest Destinations</h2>
            <ul>
                @foreach($latestDestinations as $destination)
                    <li>{{ $destination->name }} - {{ $destination->created_at->format('d M Y') }}</li>
                @endforeach
            </ul>
        </div>
        <div class="latest-facilities">
            <h2>Latest Facilities</h2>
            <ul>
                @foreach($latestFacilities as $facility)
                    <li>{{ $facility->name }} - {{ $facility->created_at->format('d M Y') }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
