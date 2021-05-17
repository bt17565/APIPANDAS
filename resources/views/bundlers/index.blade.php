@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-header">
                    <h2 class="h5 mb-0">
                        {{ __('Manage Bundlers') }}
                    </h2>
                </div>
                <div class="card-body bg-white py-3 border-bottom rounded-top">
                    <div>
                        <div class="text-right mb-3">
                            <a href="{{ route('bundlers.create') }}"
                               class="btn btn-primary rounded-0">
                                <i class="fa fa-star"></i>
                                Create Bundler
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Endpoint 1</th>
                                        <th scope="col">Endpoint 2</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($bundlers) > 0)
                                        @foreach($bundlers as $bundler)
                                            <tr>
                                                <th scope="row">
                                                    <h5>{{ $bundler->title  }}</h5>
                                                    <span class="badge badge-secondary rounded-0">
                                                        Bundler ID:
                                                        <strong>{{ $bundler->id }}</strong>
                                                    </span>
                                                    @if(\Illuminate\Support\Facades\Cache::has('bundler_response_'.$bundler->id))
                                                        <span class="badge badge-success rounded-0">
                                                            <strong>Active</strong>
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger rounded-0">
                                                            <strong>Inactive</strong>
                                                        </span>
                                                    @endif
                                                </th>
                                                <td>
                                                    <div class="card api-card">
                                                        <div class="card-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <strong>Endpoint: </strong><br>
                                                                    {{ $bundler->endpoint_1 }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Method: </strong>
                                                                    <span class="badge badge-primary rounded-0">
                                                                        {{ strtoupper($bundler->method_1) }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Response Type: </strong>
                                                                    <span class="badge badge-warning rounded-0">
                                                                        {{ ($bundler->response_type_1 == 'single') ? 'OBJECT' : 'COLLECTION' }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Response Content: </strong>
                                                                    <span class="badge badge-success rounded-0">
                                                                        {{ $bundler->response_content_1 }}
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                            <div id="accordion_api1_{{ $bundler->id }}">
                                                                <div class="collapse-block">
                                                                    <div class="collapse-header"
                                                                         id="heading_api_1_headers_1_{{ $bundler->id }}">
                                                                        <a class="header-link"
                                                                           href="javascript:void(0)"
                                                                           data-toggle="collapse"
                                                                           data-target="#collapse_api_1_headers_1_{{ $bundler->id }}"
                                                                           aria-expanded="true"
                                                                           aria-controls="collapse_api_1_headers_1_{{ $bundler->id }}">
                                                                            <strong>Headers</strong>
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapse_api_1_headers_1_{{ $bundler->id }}"
                                                                         class="collapse"
                                                                         aria-labelledby="heading_api_1_headers_1_{{ $bundler->id }}"
                                                                         data-parent="#accordion_api1_{{ $bundler->id }}">
                                                                        <div class="collapse-body">
                                                                            {{ $bundler->headers_1 }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="collapse-block">
                                                                    <div class="collapse-header"
                                                                         id="heading_api_1_data_1_{{ $bundler->id }}">
                                                                        <a class="header-link"
                                                                           href="javascript:void(0)"
                                                                           data-toggle="collapse"
                                                                           data-target="#collapse_api_1_data_1_{{ $bundler->id }}"
                                                                           aria-expanded="true"
                                                                           aria-controls="collapse_api_1_data_1_{{ $bundler->id }}">
                                                                            <strong>Data</strong>
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapse_api_1_data_1_{{ $bundler->id }}"
                                                                         class="collapse"
                                                                         aria-labelledby="heading_api_1_data_1_{{ $bundler->id }}"
                                                                         data-parent="#accordion_api1_{{ $bundler->id }}">
                                                                        <div class="collapse-body">
                                                                            {{ $bundler->data_1 }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="card api-card">
                                                        <div class="card-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <strong>Endpoint: </strong><br>
                                                                    {{ $bundler->endpoint_2 }}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Method: </strong>
                                                                    <span class="badge badge-primary rounded-0">
                                                                        {{ strtoupper($bundler->method_2) }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Response Type: </strong>
                                                                    <span class="badge badge-warning rounded-0">
                                                                        {{ ($bundler->response_type_2 == 'single') ? 'OBJECT' : 'COLLECTION' }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Response Content: </strong>
                                                                    <span class="badge badge-success rounded-0">
                                                                        {{ $bundler->response_content_2 }}
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                            <div id="accordion_api2_{{ $bundler->id }}">
                                                                <div class="collapse-block">
                                                                    <div class="collapse-header"
                                                                         id="heading_api_2_headers_2_{{ $bundler->id }}">
                                                                        <a class="header-link"
                                                                           href="javascript:void(0)"
                                                                           data-toggle="collapse"
                                                                           data-target="#collapse_api_2_headers_2_{{ $bundler->id }}"
                                                                           aria-expanded="true"
                                                                           aria-controls="collapse_api_2_headers_2_{{ $bundler->id }}">
                                                                            <strong>Headers</strong>
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapse_api_2_headers_2_{{ $bundler->id }}"
                                                                         class="collapse"
                                                                         aria-labelledby="heading_api_2_headers_2_{{ $bundler->id }}"
                                                                         data-parent="#accordion_api2_{{ $bundler->id }}">
                                                                        <div class="collapse-body">
                                                                            {{ $bundler->headers_2 }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="collapse-block">
                                                                    <div class="collapse-header"
                                                                         id="heading_api_2_data_2_{{ $bundler->id }}">
                                                                        <a class="header-link"
                                                                           href="javascript:void(0)"
                                                                           data-toggle="collapse"
                                                                           data-target="#collapse_api_2_data_2_{{ $bundler->id }}"
                                                                           aria-expanded="true"
                                                                           aria-controls="collapse_api_2_data_2_{{ $bundler->id }}">
                                                                            <strong>Data</strong>
                                                                        </a>
                                                                    </div>
                                                                    <div id="collapse_api_2_data_2_{{ $bundler->id }}"
                                                                         class="collapse"
                                                                         aria-labelledby="heading_api_2_data_2_{{ $bundler->id }}"
                                                                         data-parent="#accordion_api2_{{ $bundler->id }}">
                                                                        <div class="collapse-body">
                                                                            {{ $bundler->data_2 }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form method="post"
                                                          action="{{ route('bundlers.destroy', $bundler->id) }}"
                                                          class="del-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-sm btn-primary m-1"
                                                           href="{{ route('bundlers.edit', $bundler->id) }}"
                                                           title="Edit Bundler">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </a>
                                                        @if(!\Illuminate\Support\Facades\Cache::has('bundler_response_'.$bundler->id))
                                                            <a class="btn btn-sm btn-secondary m-1"
                                                               href="{{ route('bundlers.execute', $bundler->id) }}"
                                                               title="Execute Bundler">
                                                                <i class="fa fa-cogs"></i>
                                                            </a>
                                                        @endif
                                                        <button class="btn btn-sm btn-danger m-1"
                                                                title="Delete Bundler"
                                                                onClick="return confirm('Are you sure you want to delete bundler?')">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">Sorry, no bundlers found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
