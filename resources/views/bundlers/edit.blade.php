@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-header">
                    <h2 class="h5 mb-0">
                        {{ __('Update Bundler') }}
                    </h2>
                </div>
                <div class="card-body bg-white py-3 border-bottom rounded-top">
                    <div class="my-3">
                        <form method="post"
                              class="bundler-form"
                              action="{{ route('bundlers.update', $bundler->id) }}">
                            @csrf
                            @method('PATCH')
                            @include('bundlers.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
