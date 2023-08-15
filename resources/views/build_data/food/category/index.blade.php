@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="tab-category-data">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#tab1-category-food-data" role="tab"
                       aria-expanded="true" data-index="0">@lang('app.category-food-data.tab1') <span
                                class="label label-success"
                                id="total-record-tab1-category-food-data">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-category-disable-data" data-toggle="tab"
                       href="#tab2-category-food-data" role="tab"
                       aria-expanded="false" data-index="1">@lang('app.category-food-data.tab2') <span
                                class="label label-inverse"
                                id="total-record-tab2-category-food-data">0</span>
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1-category-food-data" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-category-food-data">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if($db['is_office'] === 0)
                                                    @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                        <option value="{{$db['id']}}"
                                                                selected>{{$db['name']}}</option>
                                                    @else
                                                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-enable-category-food-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.category-food-data.stt')</th>
                                    <th>@lang('app.category-food-data.name')</th>
                                    <th>@lang('app.category-food-data.type_food')</th>
                                    <th>@lang('app.category-food-data.description')</th>
                                    <th>@lang('app.category-food-data.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-category-food-data" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand select-brand-material-data">
                                            @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                    <option value="{{$db['id']}}"
                                                            selected>{{$db['name']}}</option>
                                                @else
                                                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="table-disable-category-food-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.category-food-data.stt')</th>
                                    <th>@lang('app.category-food-data.name')</th>
                                    <th>@lang('app.category-food-data.type_food')</th>
                                    <th>@lang('app.category-food-data.description')</th>
                                    <th>@lang('app.category-food-data.action')</th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.food.category.create')
    @include('build_data.food.category.update')
    @include('build_data.food.category.notify')
    @include('manage.food.brand.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\food\category\index.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
