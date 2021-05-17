<div class="panel-tag">
    Fields marked as * are required.
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-md-12">
                <label class="form-label">Title*</label>
                <input type="text"
                       class="form-control rounded-0"
                       name="title"
                       placeholder="Bundler Title"
                       value="{{ old('title',  $bundler->title ?? null) }}"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description"
                          placeholder="Bundler Description"
                          rows="5"
                          class="form-control rounded-0">{{ old('description',  $bundler->description ?? null) }}</textarea>
            </div>
        </div>
        <div class="block-separator"></div>
        <h4><span class="badge badge-dark rounded-0 fw-400">First API</span></h4>
        <div class="form-group row">
            <div class="col-md-6">
                <label class="form-label">Endpoint*</label>
                <input type="text"
                       class="form-control rounded-0"
                       name="endpoint_1"
                       placeholder="API endpoint"
                       value="{{ old('endpoint_1',  $bundler->endpoint_1 ?? null) }}"/>
            </div>
            <div class="col-md-6">
                <label class="form-label">Method*</label>
                <select name="method_1"
                        class="form-control rounded-0">
                    <option value="get"
                            @if(old('method_1',  $bundler->method_1 ?? 'get') == 'get') selected @endif>
                        GET
                    </option>
                    <option value="post"
                            @if(old('method_1',  $bundler->method_1 ?? 'get') == 'post') selected @endif>
                        POST
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label class="form-label">Response Type*</label>
                <select name="response_type_1"
                        class="form-control rounded-0">
                    <option value="single"
                            @if(old('response_type_1',  $bundler->response_type_1 ?? 'single') == 'single') selected @endif>
                        Single Record
                    </option>
                    <option value="multiple"
                            @if(old('response_type_1',  $bundler->response_type_1 ?? 'single') == 'multiple') selected @endif>
                        Multiple Records
                    </option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Response Content*</label>
                <select name="response_content_1"
                        class="form-control rounded-0">
                    <option value="JSON"
                            @if(old('response_content_1',  $bundler->response_content_1 ?? 'JSON') == 'JSON') selected @endif>
                        JSON
                    </option>
                    {{--<option value="XML"
                            @if(old('response_content_1',  $bundler->response_content_1 ?? 'JSON') == 'XML') selected @endif>
                        XML
                    </option>--}}
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label class="form-label">Headers</label>
                <div class="add-more-block">
                    <div class="item-group">
                        @if(isset($bundler))
                            @if(count(json_decode($bundler->headers_1, true)) > 0)
                                @foreach(json_decode($bundler->headers_1, true) as $key => $value)
                                    <div class="item">
                                        <div class="input-group">
                                            <input type="text"
                                                   name="headers_1[key][]"
                                                   placeholder="Key"
                                                   value="{{ $key }}"
                                                   class="form-control rounded-0">
                                            <input type="text"
                                                   name="headers_1[value][]"
                                                   placeholder="Value"
                                                   value="{{ $value }}"
                                                   class="form-control rounded-0">
                                        </div>
                                        @if($loop->iteration > 1)
                                            <div>
                                                <a href="javascript:void(0)"
                                                   class="text-danger rounded-0 remove-group-button">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="item">
                                    <div class="input-group">
                                        <input type="text"
                                               name="headers_1[key][]"
                                               placeholder="Key"
                                               class="form-control rounded-0">
                                        <input type="text"
                                               name="headers_1[value][]"
                                               placeholder="Value"
                                               class="form-control rounded-0">
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="item">
                                <div class="input-group">
                                    <input type="text"
                                           name="headers_1[key][]"
                                           placeholder="Key"
                                           class="form-control rounded-0">
                                    <input type="text"
                                           name="headers_1[value][]"
                                           placeholder="Value"
                                           class="form-control rounded-0">
                                </div>
                            </div>
                        @endif
                    </div>
                    <a href="javascript:void(0)"
                        class="btn btn-sm btn-warning rounded-0 add-more-button">
                        <i class="fa fa-plus"></i>
                        Add Header
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Data</label>
                <div class="add-more-block">
                    <div class="item-group">
                        @if(isset($bundler))
                            @if(count(json_decode($bundler->data_1, true)) > 0)
                                @foreach(json_decode($bundler->data_1, true) as $key => $value)
                                    <div class="item">
                                        <div class="input-group">
                                            <input type="text"
                                                   name="data_1[key][]"
                                                   placeholder="Key"
                                                   value="{{ $key }}"
                                                   class="form-control rounded-0">
                                            <input type="text"
                                                   name="data_1[value][]"
                                                   placeholder="Value"
                                                   value="{{ $value }}"
                                                   class="form-control rounded-0">
                                        </div>
                                        @if($loop->iteration > 1)
                                            <div>
                                                <a href="javascript:void(0)"
                                                   class="text-danger rounded-0 remove-group-button">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="item">
                                    <div class="input-group">
                                        <input type="text"
                                               name="data_1[key][]"
                                               placeholder="Key"
                                               class="form-control rounded-0">
                                        <input type="text"
                                               name="data_1[value][]"
                                               placeholder="Value"
                                               class="form-control rounded-0">
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="item">
                                <div class="input-group">
                                    <input type="text"
                                           name="data_1[key][]"
                                           placeholder="Key"
                                           class="form-control rounded-0">
                                    <input type="text"
                                           name="data_1[value][]"
                                           placeholder="Value"
                                           class="form-control rounded-0">
                                </div>
                            </div>
                        @endif
                    </div>
                    <a href="javascript:void(0)"
                       class="btn btn-sm btn-warning rounded-0 add-more-button">
                        <i class="fa fa-plus"></i>
                        Add Parameter
                    </a>
                </div>
            </div>
        </div>
        <a href="javascript:void(0)"
           class="btn btn-primary rounded-0 api-1-submit">
            <i class="fa fa-redo"></i>
            {{ isset($bundler) ? 'Retest & Continue' : 'Test & Continue' }}
        </a>
        <div class="response-block response-1-block d-none">
            <div class="response-error d-none">
                <span class="badge badge-danger">ERROR</span>
                <div class="content"></div>
            </div>
            <div class="response-success d-none">
                <span class="badge badge-success">SUCCESS</span>
                <div class="content"></div>
            </div>
        </div>
        <div class="second-api-block d-none">
            <div class="block-separator"></div>
            <h4><span class="badge badge-dark rounded-0 fw-400">Second API</span></h4>
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="form-label">Endpoint*</label>
                    <input type="text"
                           class="form-control rounded-0"
                           name="endpoint_2"
                           placeholder="API endpoint"
                           value="{{ old('endpoint_2',  $bundler->endpoint_2 ?? null) }}"/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Method*</label>
                    <select name="method_2"
                            class="form-control rounded-0">
                        <option value="get"
                                @if(old('method_2',  $bundler->method_2 ?? 'get') == 'get') selected @endif>
                            GET
                        </option>
                        <option value="post"
                                @if(old('method_2',  $bundler->method_2 ?? 'get') == 'post') selected @endif>
                            POST
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="form-label">Response Type*</label>
                    <select name="response_type_2"
                            class="form-control rounded-0">
                        <option value="single"
                                @if(old('response_type_2',  $bundler->response_type_2 ?? 'single') == 'single') selected @endif>
                            Single Record
                        </option>
                        {{--<option value="multiple"
                                @if(old('response_type_2',  $bundler->response_type_2 ?? 'single') == 'multiple') selected @endif>
                            Multiple Records
                        </option>--}}
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Response Content*</label>
                    <select name="response_content_2"
                            class="form-control rounded-0">
                        <option value="JSON"
                                @if(old('response_content_2',  $bundler->response_content_2 ?? 'JSON') == 'JSON') selected @endif>
                            JSON
                        </option>
                        {{--<option value="XML"
                                @if(old('response_content_2',  $bundler->response_content_2 ?? 'JSON') == 'XML') selected @endif>
                            XML
                        </option>--}}
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="form-label">Headers</label>
                    <div class="add-more-block">
                        <div class="item-group">
                            @if(isset($bundler))
                                @if(count(json_decode($bundler->headers_2, true)) > 0)
                                    @foreach(json_decode($bundler->headers_2, true) as $key => $value)
                                        <div class="item">
                                            <div class="input-group">
                                                <input type="text"
                                                       name="headers_2[key][]"
                                                       placeholder="Key"
                                                       value="{{ $key }}"
                                                       class="form-control rounded-0">
                                                <input type="text"
                                                       name="headers_2[value][]"
                                                       placeholder="Value"
                                                       value="{{ $value }}"
                                                       class="form-control rounded-0">
                                            </div>
                                            @if($loop->iteration > 1)
                                                <div>
                                                    <a href="javascript:void(0)"
                                                       class="text-danger rounded-0 remove-group-button">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="item">
                                        <div class="input-group">
                                            <input type="text"
                                                   name="headers_2[key][]"
                                                   placeholder="Key"
                                                   class="form-control rounded-0">
                                            <input type="text"
                                                   name="headers_2[value][]"
                                                   placeholder="Value"
                                                   class="form-control rounded-0">
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="item">
                                    <div class="input-group">
                                        <input type="text"
                                               name="headers_2[key][]"
                                               placeholder="Key"
                                               class="form-control rounded-0">
                                        <input type="text"
                                               name="headers_2[value][]"
                                               placeholder="Value"
                                               class="form-control rounded-0">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <a href="javascript:void(0)"
                           class="btn btn-sm btn-primary rounded-0 add-more-button">
                            <i class="fa fa-plus"></i>
                            Add Header
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        Data
                        <span class="badge badge-warning rounded-0 text-black">To use values from API 1 response start typing with '1.data.value' OR '1.data.*' in value.</span>
                    </label>
                    <div class="add-more-block">
                        <div class="item-group">
                            @if(isset($bundler))
                                @if(count(json_decode($bundler->data_2, true)) > 0)
                                    @foreach(json_decode($bundler->data_2, true) as $key => $value)
                                        <div class="item">
                                            <div class="input-group">
                                                <input type="text"
                                                       name="data_2[key][]"
                                                       placeholder="Key"
                                                       value="{{ $key }}"
                                                       class="form-control rounded-0">
                                                <input type="text"
                                                       name="data_2[value][]"
                                                       placeholder="Value"
                                                       value="{{ $value }}"
                                                       class="form-control rounded-0 data-2-value">
                                            </div>
                                            <div class="search-content"></div>
                                            @if($loop->iteration > 1)
                                                <div>
                                                    <a href="javascript:void(0)"
                                                       class="text-danger rounded-0 remove-group-button">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="item">
                                        <div class="input-group">
                                            <input type="text"
                                                   name="data_2[key][]"
                                                   placeholder="Key"
                                                   class="form-control rounded-0">
                                            <input type="text"
                                                   name="data_2[value][]"
                                                   placeholder="Value"
                                                   class="form-control rounded-0 data-2-value">
                                        </div>
                                        <div class="search-content"></div>
                                    </div>
                                @endif
                            @else
                                <div class="item">
                                    <div class="input-group">
                                        <input type="text"
                                               name="data_2[key][]"
                                               placeholder="Key"
                                               class="form-control rounded-0">
                                        <input type="text"
                                               name="data_2[value][]"
                                               placeholder="Value"
                                               class="form-control rounded-0 data-2-value">
                                    </div>
                                    <div class="search-content"></div>
                                </div>
                            @endif
                        </div>
                        <a href="javascript:void(0)"
                           class="btn btn-sm btn-primary rounded-0 add-more-button">
                            <i class="fa fa-plus"></i>
                            Add Parameter
                        </a>
                    </div>
                </div>
            </div>
            <a href="javascript:void(0)"
               class="btn btn-warning rounded-0 api-2-submit">
                <i class="fa fa-cogs"></i>
                {{ isset($bundler) ? 'Retest & Review' : 'Test & Review' }}
            </a>
            <div class="response-block response-2-block d-none">
                <div class="response-error d-none">
                    <span class="badge badge-danger">ERROR</span>
                    <div class="content"></div>
                </div>
                <div class="response-success d-none">
                    <span class="badge badge-success">SUCCESS</span>
                    <div class="content"></div>
                </div>
            </div>
        </div>
        <div class="prepare-data-block d-none">
            <div class="block-separator"></div>
            <h4><span class="badge badge-dark rounded-0">Bundler Response</span></h4>
            <div class="panel-tag">
                Bundler response will be same as API 1 response. You can add data from API 2 in bundler response by adding indexes using below inputs. To use values from API 2 response start typing with '2.data.value' OR '2.data.*' in value field. In key field enter exact position in API 1 where value needs to added  i.e., '1.orders.data.*.retailer' OR '1.orders.data.retailer'.
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="form-label">Prepare Data</label>
                    <div class="add-more-block">
                        <div class="item-group">
                            @if(isset($bundler))
                                @if($bundler->modifications && count(json_decode($bundler->modifications, true)) > 0)
                                    @foreach(json_decode($bundler->modifications, true) as $key => $value)
                                        <div class="item">
                                            <div class="input-group">
                                                <input type="text"
                                                       name="modifications[key][]"
                                                       placeholder="Key"
                                                       value="{{ $key }}"
                                                       class="form-control rounded-0 data-2-value">
                                                <input type="text"
                                                       name="modifications[value][]"
                                                       placeholder="Value"
                                                       value="{{ $value }}"
                                                       class="form-control rounded-0 modifications-value">
                                            </div>
                                            <div class="search-content"></div>
                                            @if($loop->iteration > 1)
                                                <div>
                                                    <a href="javascript:void(0)"
                                                       class="text-danger rounded-0 remove-group-button">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="item">
                                        <div class="input-group">
                                            <input type="text"
                                                   name="modifications[key][]"
                                                   placeholder="Key"
                                                   class="form-control rounded-0 data-2-value">
                                            <input type="text"
                                                   name="modifications[value][]"
                                                   placeholder="Value"
                                                   class="form-control rounded-0 modifications-value">
                                        </div>
                                        <div class="search-content"></div>
                                    </div>
                                @endif
                            @else
                                <div class="item">
                                    <div class="input-group">
                                        <input type="text"
                                               name="modifications[key][]"
                                               placeholder="Key"
                                               class="form-control rounded-0 data-2-value">
                                        <input type="text"
                                               name="modifications[value][]"
                                               placeholder="Value"
                                               class="form-control rounded-0 modifications-value">
                                    </div>
                                    <div class="search-content"></div>
                                </div>
                            @endif
                        </div>
                        <a href="javascript:void(0)"
                           class="btn btn-sm btn-warning rounded-0 add-more-button">
                            <i class="fa fa-plus"></i>
                            Add Parameter
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Iterative Index (API 1)</label>
                    <input type="text"
                           class="form-control rounded-0"
                           name="iterative_index"
                           placeholder="Iterative Index"
                           value="{{ old('iterative_index',  $bundler->iterative_index ?? null) }}"/>
                </div>
            </div>
            <a href="javascript:void(0)"
               class="btn btn-secondary rounded-0 response-submit">
                <i class="fa fa-laptop-code"></i>
                {{ isset($bundler) ? 'Regenerate Response' : 'Generate Response' }}
            </a>
            <div class="response-block bundler-response-block d-none">
                <div class="response-error d-none">
                    <span class="badge badge-danger">ERROR</span>
                    <div class="content"></div>
                </div>
                <div class="response-success d-none">
                    <span class="badge badge-success">SUCCESS</span>
                    <div class="content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3 actions-block d-none">
    <div class="col-md-12">
        <button type="submit"
                class="btn btn-success rounded-0">
            <i class="fa fa-check"></i>
            Save Bundler
        </button>
        <a href="{{ route('bundlers.index') }}"
           class="btn btn-secondary rounded-0">
            <i class="fa fa-times"></i>
            Cancel
        </a>
    </div>
</div>
