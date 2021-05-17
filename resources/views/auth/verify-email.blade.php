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
                                    <h1 class="display-5 mb-0">Email Verification</h1>
                                    <div class="subheading-3 mb-5">
                                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                    </div>
                                </div>
                                <form class="mb-5"  method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div>
                                        <x-jet-button type="submit">
                                            {{ __('Resend Verification Email') }}
                                        </x-jet-button>
                                    </div>
                                </form>

                                <form class="mb-5"  method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="btn btn-link">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
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