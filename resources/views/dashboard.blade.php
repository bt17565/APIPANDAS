@extends('layouts.app')
@section('content')
<!-- Main dashboard content-->
<div class="container-xl p-1">
    <div class="row justify-content-between align-items-center mb-5">
        <div class="col flex-shrink-0 mb-5 mb-md-0">
            <h2 class="h5">Dashboard</h2>
        </div>
    </div>
    <!-- Colored status cards-->
    <div class="row gx-5">
        <div class="col-xxl-3 col-md-6 mb-5">
            <div class="card card-raised border-start border-primary border-4">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5">{{$ttlbundlers}}</div>
                            <div class="card-text"><a href="{{ route('bundlers.index') }}">Total Bundlers</a></div>
                        </div>
                        <div class="icon-circle bg-primary text-white"><i class="material-icons">view_compact</i></div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6 mb-5">
            <div class="card card-raised border-start border-primary border-4">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5">{{$ttlapitokens}}</div>
                            <div class="card-text"><a href="{{ route('api-tokens.index') }}">API Tokens</a></div>
                        </div>
                        <div class="icon-circle bg-primary text-white"><i class="material-icons">settings</i></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6 mb-5 d-none">
            <div class="card card-raised border-start border-primary border-4">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5">{{$ttlactivebundlers}}</div>
                            <div class="card-text">Active Blunders</div>
                        </div>
                        <div class="icon-circle bg-primary text-white"><i class="material-icons">upload</i></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6 mb-5 d-none">
            <div class="card card-raised border-start border-warning border-4">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5">{{$ttlinactivebundlers}}</div>
                            <div class="card-text">Inactive Blunders</div>
                        </div>
                        <div class="icon-circle bg-danger text-white"><i class="material-icons">download</i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gx-5">
        <!-- Projects column-->
        <div class="col-xl-12 col-lg-12 mb-5">
            <div class="card card-raised h-100 overflow-hidden">
                <div class="card-header bg-dark text-white px-4"><div class="fw-500">Bundlers</div></div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <tbody class="align-middle">
                                <thead class="text-xs font-monospace">
                                    <td class="px-4 py-2 border-bottom-0 text-muted">Title</td>
                                    <td class="px-4 py-2 border-bottom-0 text-muted">Endpoint 1</td>
                                    <td class="px-4 py-2 border-bottom-0 text-muted">Endpoint 2</td>
                                </thead>
                        @if(isset($bundlers) && count($bundlers) > 0)
                            @foreach($bundlers as $bundler)
                                <tr>
                                    <td class="px-4 border-top">
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
                                        <p><a class="btn btn-sm btn-primary m-1"
                                            href="{{ route('bundlers.edit', $bundler->id) }}"
                                            title="Edit Bundler">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a></p>
                                    </td>
                                    <td class="px-4 border-top">
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
                                    <td class="px-4 border-top">
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
                                </tr>
                            @endforeach
                        @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent position-relative ripple-gray">
                    <a class="d-flex align-items-center justify-content-end text-decoration-none stretched-link text-primary" href="{{ route('bundlers.index') }}">
                        <div class="fst-button">Manage Bundlers</div>
                        <i class="material-icons icon-sm ms-1">chevron_right</i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row gx-5">
        <!-- Projects column-->
        <div class="col-xl-12 col-lg-12 mb-5">
            <div class="card card-raised h-100 overflow-hidden">
                <div class="card-header bg-dark text-white px-4"><div class="fw-500">API Tokens</div></div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <tbody class="align-middle">
                                <thead class="text-xs font-monospace">
                                    <td class="px-4 py-2 border-bottom-0 text-muted">Name</td>
                                    <td class="px-4 py-2 border-bottom-0 text-muted">Permissions</td>
                                </thead>
                        @if(isset($apiTokens) && count($apiTokens)>0)
                            @foreach ($apiTokens->sortBy('name') as $token)
                                <tr>
                                    <td class="px-4 border-top">
                                        <div class="d-flex align-items-center">{{$token->name}}</div>
                                    </td>
                                    <td class="px-4 border-top">
                                        @php $abilities = (array) $token->abilities; @endphp
                                        @if(isset($abilities) && count($abilities)>0)
                                            {{implode(', ', $abilities)}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent position-relative ripple-gray">
                    <a class="d-flex align-items-center justify-content-end text-decoration-none stretched-link text-primary" href="{{ route('api-tokens.index') }}">
                        <div class="fst-button">Manage API Tokens</div>
                        <i class="material-icons icon-sm ms-1">chevron_right</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection