<!-- resources/views/employee/destinations/reviews.blade.php -->
@extends($layout)

@section('content')
<div class="container">
    <h1>Destination Reviews</h1>

    @forelse($destinations as $destination)
        <h2>{{ $destination->name }}</h2>
        <div>
            @if($destination->averageRating)
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= round($destination->averageRating))
                        ⭐
                    @else
                        ☆
                    @endif
                @endfor
                <span> (Average Rating: {{ round($destination->averageRating, 1) }})</span>
            @else
                No ratings yet.
            @endif
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Submitted By</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destination->reviews as $key => $review)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        ⭐
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </td>
                            <td>{{ $review->review }}</td>
                            <td>{{ $review->user->name }}</td>
                            <td>{{ $review->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No reviews for this destination.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @empty
        <p>No destinations available.</p>
    @endforelse
</div>
@endsection
