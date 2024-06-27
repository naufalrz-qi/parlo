@extends($layout)
@section('style')
<style>
    .card {
       background-color: white;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
       border: none;
    }

    .btn-primary{
        color: white;
        background-color: var(--quinary);
        border: var(--quinary);
        font-weight: 700;
    }
</style>
@endsection
@section('content')
<a href="{{ route('destinations.universal') }}" class="btn btn-primary  btn btn-primary fixed-bottom m-5 px-4 py-3" style="right: 0; left: auto;">Booking Now!</a>
<div class="container mt-5">
    <h1 class="mb-4">Facilities</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($facilities as $facility)
        <div class="col">
            <div class="card h-100 bg-white">
                <img src="{{ asset('assets/img/facilities/' . $facility->image) }}" alt="{{ $facility->name }}"
                    class="card-img">
                <div class="card-body">
                    <small>{{ $facility->type }}</small>

                    <h3 class="card-title">{{ $facility->name }} </h3>
                    <p class="card-location"><strong>{{ $facility->location }}</strong> </p>

                    <p class="card-text">{{ $facility->description }}</p>
                    <p class="card-price fs-5"><strong>Rp{{ number_format($facility->price, 2, ',', '.') }}</strong></p>
                    {{-- <a href="{{ route('order.facility', $facility->id) }}" class="btn btn-order">Order</a> --}}
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection
