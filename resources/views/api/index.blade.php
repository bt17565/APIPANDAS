@extends('layouts.app')
@section('content')
    <h2 class="h5">
        {{ __('API Tokens') }}
    </h2>    
    <div>
        @livewire('api.api-token-manager')
    </div>
@endsection