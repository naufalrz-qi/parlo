@extends('app.layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <br>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a type="submit" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            this.closest('form').submit();"
            class="btn-secondary">Logout</a>
    </form>
</div>
@endsection
