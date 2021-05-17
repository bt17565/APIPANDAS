@extends('layouts.guest')
@section('content')
    <!-- Main content container-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-xl-10 col-lg-12">
                <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-4">
                    <div class="row g-0">
                        <div class="col-lg-5 col-md-6">
                            <div class="card-body p-5">
                                <!-- Auth header with logo image-->
                                <div class="text-center">
                                    <img class="mb-3" src="{{ asset('img/icons/background.svg') }}" alt="..." style="height: 48px" />
                                    <h1 class="display-5 mb-0">Confirm Password</h1>
                                    <div class="subheading-3 mb-4 text-muted">
                                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                                    </div>
                                </div>
                                <!-- Login submission form-->
                                <form class="mb-5" method="POST" action="{{ route('password.confirm') }}">
                                    @csrf
                                    <div>
                                        <x-jet-label for="password" value="{{ __('Password') }}" />
                                        <x-jet-input id="password" type="password" name="password" required autocomplete="current-password" autofocus />
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <x-jet-button class="ml-4">
                                            {{ __('Confirm') }}
                                        </x-jet-button>
                                    </div>
                                </form>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Background image column using inline CSS-->
                        <div class="col-lg-7 col-md-6 d-none d-md-block" style="background-image: url('https://source.unsplash.com/-uHVRvDr7pg/1600x900'); background-size: cover; background-repeat: no-repeat; background-position: center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
