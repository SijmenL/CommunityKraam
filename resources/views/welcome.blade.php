@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="fullscreen-hero" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.32), rgba(0, 0, 0, 0.03)),url({{ asset('img/hero-background.jpg') }})">
                <div class="hero-content">
                    <h1 class="display-1 text-light">Welcome to List It!</h1>
                    <div class="hero-buttons ">
                        <a class="btn btn-primary btn-lg" href="{{ route('login') }}">Log In</a>
                        <a class="btn btn-secondary btn-lg" href="{{ route('register') }}">Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
