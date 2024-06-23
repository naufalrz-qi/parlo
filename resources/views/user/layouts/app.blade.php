<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parlo</title>

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- icons --}}
    <script src="https://unpkg.com/feather-icons"></script>

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/component.css') }}">
</head>

<body>
    {{-- navbar start --}}
    @extends('user.layouts.navbar')
    {{-- navbar end --}}

    {{-- Hero --}}
    @yield('content')
    {{-- Hero end --}}


    @extends('user.layouts.footer')
    {{-- icons js --}}
    <script>
        feather.replace();
    </script>
</body>

</html>
