@extends('layouts.guest')
@section('content')
    <!-- Main content container-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-xl-10 col-lg-12">
                <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-2">
                    <div class="row g-0">
                        <div class="col-lg-5 col-md-6">
                            <div class="card-body p-5">
                                <!-- Auth header with logo image-->
                                <div class="text-center">
                                    <img class="mb-3" src="{{ asset('img/icons/background.svg') }}" alt="..." style="height: 48px" />
                                    <h1 class="display-5 mb-0">Login</h1>
                                    <div class="subheading-1 mb-5">to continue to app</div>
                                </div>
                                <!-- Login submission form-->
                                <form class="mb-5" method="POST" action="/reset-password">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Email') }}" />

                                        <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                                    :value="old('email', $request->email)" required autofocus />
                                        <x-jet-input-error for="email"></x-jet-input-error>
                                    </div>

                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Password') }}" />

                                        <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                                    name="password" required autocomplete="new-password" />
                                        <x-jet-input-error for="password"></x-jet-input-error>
                                    </div>

                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Confirm Password') }}" />

                                        <x-jet-input class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password"
                                                    name="password_confirmation" required autocomplete="new-password" />
                                        <x-jet-input-error for="password_confirmation"></x-jet-input-error>
                                    </div>

                                    <div class="mb-0">
                                        <div class="d-flex justify-content-end">
                                            <x-jet-button>
                                                {{ __('Reset Password') }}
                                            </x-jet-button>
                                        </div>
                                    </div>
                                </form>
                                @if (session('status'))
                                    <div class="alert alert-success mb-3 rounded-0" role="alert">
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
