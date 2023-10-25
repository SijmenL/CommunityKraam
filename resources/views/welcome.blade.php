@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="fullscreen-hero"
             style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.32), rgba(0, 0, 0, 0.03)),url({{ asset('img/hero-background.jpg') }})">
            <div class="hero-content align-items-center">
                <div class="p-1 display-hero">
                    <h1 class="display-1 text-light text-center">Welcome to List It!</h1>
                    <p class="text-light text-center w-75">Welcome to List It - the ultimate shopping list platform
                        designed to simplify your life. Create and customize your shopping lists and add products
                        effortlessly. Streamline your shopping experience with List It today!</p>
                    <div class="hero-buttons ">
                        <a class="btn btn-primary btn-lg" href="{{ route('login') }}">Log In</a>
                        <a class="btn btn-secondary btn-lg" href="{{ route('register') }}">Create Account</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
