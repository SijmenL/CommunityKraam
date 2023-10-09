@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Welcome') }}</div>

                    <div class="card-body">
                        <h1>Welcome to List It!</h1>
                        @auth
                            <p>You are logged in, welcome!</p>
                        @endauth

                        @guest
                            <p>To experience to full website, please log in or create an account.</p>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
