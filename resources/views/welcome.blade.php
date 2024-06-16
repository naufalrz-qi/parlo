@extends('app.layouts.app')
@section('content')
    {{-- hero --}}
    <section class="hero" id="home">
        <main class="content">
            <h1>Take a Journey with <span>Parlo</span></h1>
            <p>Explore the world of Lombok beyond everything</p>
            <a href="#" class="cta">Explore Now!</a>
        </main>
    </section>
    {{-- hero end --}}

    {{-- about --}}
    <section class="about" id="about">
        <h2>
            <span>About</span> Us
        </h2>

        <div class="row">
            <div class="about-img">
                <img src="{{ asset('assets/img/about.jpg') }}" alt="About Us">
            </div>
            <div class="content">
                <h3>Do you want to know, why you are here?</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, eius animi quia saepe adipisci atque!</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias adipisci vero consectetur corrupti ullam
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
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis minus sint, tempora quibusdam est quae unde?
            Ullam, eveniet modi? Architecto!
        </p>

        <div class="row">

            @foreach($destinations as $destination)
            <div class="destinations-card">
                <img class="card-img" src="{{ asset('assets/img/destinations/' . $destination->image) }}" alt="{{ $destination->name }}" >
                <h3 class="destination-card-title">{{ $destination->name }}</h3>
                <p class="destination-card-price">Rp{{ number_format($destination->price, 2, ',', '.') }}</p>

            </div>
        @endforeach

        </div>
        <div class="button">
            <a href="{{ route('destinations.universal') }}" class="btn-primary">View More</a>
        </div>

    </section>
    {{-- destinations end --}}

    {{-- contact start --}}
    <section class="contact" id="contact">
        <h2>
            <span>Contact</span> Us
        </h2>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis minus sint, tempora quibusdam est quae unde?
            Ullam, eveniet modi? Architecto!
        </p>

        <div class="row">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.0500806965515!2d116.11370507422028!3d-8.591183687217205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1715907476075!5m2!1sid!2sid"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>

            <form action="">
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" placeholder="Nama">
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="email" placeholder="Email">
                </div>
                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="text" placeholder="Phone Number">
                </div>

                <button type="submit" class="btn-primary">Send Message</button>
            </form>
        </div>
    </section>
    {{-- contact end --}}
@endsection
