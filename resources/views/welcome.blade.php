@extends('app.layouts.app')
@section('style')
<style>
    body {
        margin-top : 5rem;
        background-color: #A1C181;
    }
</style>
@endsection
@section('content')
    {{-- hero --}}
    <section class="hero" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 content">
                    <h1>Take a Journey with <span>Parlo</span></h1>
                    <p>Explore the world of Lombok beyond everything</p>
                    <a href="{{ route('register') }}" class="btn btn-primary py-3 px-5 fs-4 cta">Explore Now!</a>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('assets/img/hero.jpg') }}" alt="Hero Image" class="img-fluid hero-image rounded-4">
                </div>
            </div>
        </div>
    </section>
        {{-- hero end --}}

    {{-- about --}}
    <section class="about" id="about">
        <h2>
            <span>About</span> Us
        </h2>

        <div class="row">
            <div class="about-img mb-5">
                <img src="{{ asset('assets/img/about.jpg') }}" alt="About Us">
            </div>
            <div class="content">
                <h3>Do you want to know, why you are here?</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, eius animi quia saepe adipisci atque!
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias adipisci vero consectetur corrupti ullam
                    laudantium architecto quos dignissimos blanditiis porro.</p>
            </div>
        </div>
    </section>
    {{-- about end --}}

    {{-- destinations start --}}
    <section class="destinations" id="destinations">
        <h2>
            Preserved <span>Destinations</span>
        </h2>
        <p class="mb-5 text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis minus sint, tempora quibusdam est quae unde?
            Ullam, eveniet modi? Architecto!
        </p>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($destinations as $destination)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('assets/img/destinations/' . $destination->image) }}" class="card-img-top"
                            alt="{{ $destination->name }}">
                        <div class="card-body align">
                            <h5 class="card-title">{{ $destination->name }}</h5>
                            <p class="card-text">{{ $destination->description }}</p>
                            <p class="card-text">Rp{{ number_format($destination->price, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="button">
            <a href="{{ route('destinations.universal') }}" class="btn btn-primary">View More</a>
        </div>

    </section>
    {{-- destinations end --}}

    {{-- contact start --}}
    <section class="contact" id="contact">
        <h2>
            <span>Contact</span> Us
        </h2>
        <p class="mb-5">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis minus sint, tempora quibusdam est quae unde?
            Ullam, eveniet modi? Architecto!
        </p>

        <div class="container p-0 d-block">
            <div class="row">
                <div class="col-md-5">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.0500806965515!2d116.11370507422028!3d-8.591183687217205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1715907476075!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        class="map"></iframe>

                </div>
                <div class="col-md-7 p-5">
                    <form action="">
                        <div class="form-group mb-3 d-flex align-items-center">
                            <i data-feather="user" class="me-2"></i>
                            <input class="form-control" type="text" placeholder="Nama">
                        </div>
                        <div class="form-group mb-3 d-flex align-items-center">
                            <i data-feather="mail" class="me-2"></i>
                            <input class="form-control" type="email" placeholder="Email">
                        </div>
                        <div class="form-group mb-3 d-flex align-items-center">
                            <i data-feather="phone" class="me-2"></i>
                            <input class="form-control" type="text" placeholder="Phone Number">
                        </div>

                        <div class="d-grid justify-content-center">
                        <button type="submit" class="btn btn-secondary">Send Message</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </section>
    {{-- contact end --}}
@endsection
