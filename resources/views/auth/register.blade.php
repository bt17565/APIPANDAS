@extends('layouts.guest')
@section('content')
    <!-- Main content container-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-xl-10 col-lg-12">
                <div class="card card-raised shadow-10 mt-1 mt-xl-10 mb-1">
                    <div class="row g-0">
                        <div class="col-lg-5 col-md-6">
                            <div class="card-body p-5">
                                <!-- Auth header with logo image-->
                                <div class="text-center">
                                    <img class="mb-2" src="{{ asset('img/icons/background.svg') }}" alt="..." style="height: 48px" />
                                    <h1 class="display-5 mb-0">Register</h1>
                                    <div class="subheading-1 mb-1">to continue to app</div>
                                </div>
                                <!-- Rehister submission form-->
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Name') }}" />

                                        <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                                    :value="old('name')" required autofocus autocomplete="name" />
                                        <x-jet-input-error for="name"></x-jet-input-error>
                                    </div>

                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Email') }}" />

                                        <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                                    :value="old('email')" required />
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

                                        <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                    </div>

                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <x-jet-checkbox id="terms" name="terms" />
                                                <label class="custom-control-label" for="terms">
                                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                                        ]) !!}
                                                </label>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="mb-0">
                                        <div class="d-flex justify-content-end align-items-baseline">
                                            <x-jet-button>
                                                {{ __('Register') }}
                                            </x-jet-button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Auth card message-->
                                <div class="text-left mt-1"><a class="small fw-500 text-decoration-none" href="{{ route('login') }}">Already Registered?  Login Now</a></div>
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