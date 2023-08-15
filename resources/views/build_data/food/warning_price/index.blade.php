{{--@extends('layouts.layout')--}}
{{--@section('content')--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}"/>--}}
{{--    <div class="page-wrapper">--}}
{{--        <div class="page-body">--}}
{{--            <div class="card card-block3">--}}
{{--                <div class="table-responsive new-table">--}}
{{--                    <table id="table-warning-food-data" class="table">--}}
{{--                        <thead>--}}
{{--                            <tr>--}}
{{--                                <th>STT</th>--}}
{{--                                <th>Tên</th>--}}
{{--                                <th>Mức độ</th>--}}
{{--                                <th></th>--}}
{{--                                <th class="d-none"></th>--}}
{{--                            </tr>--}}
{{--                        </thead>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
{{--@push('scripts')--}}
{{--    @include('layouts.datatable')--}}
{{--    <script type="text/javascript" src="{{ asset('js\template_custom\dataTable.js?version=1')}}"></script>--}}
{{--    <script type="text/javascript"--}}
{{--            src="{{asset('js/build_data/food/warning_price/index.js?version=0')}}"></script>--}}
{{--@endpush--}}
@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <ul class="nav nav-tabs md-tabs md-6-tabs"
                    id="tabs-warning-price-food-data" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-food-warning-price" data-toggle="tab"
                           data-type="1" href="#tab-food-warning-price-data" role="tab"
                           aria-expanded="true" data-category-type="1">
                            @lang('app.food-data.tab1')
                            {{--                                <span class="label label-success" id="total-record-warning-price-food">0</span>--}}
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-1" id="tab-drink-warning-price" data-toggle="tab"
                           href="#tab-drink-warning-price-data" role="tab" aria-expanded="false"
                           data-category-type="2">
                            @lang('app.food-data.tab2')
                            {{--                                <span class="label label-warning" id="total-record-warning-price-drink">0</span>--}}
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-other-warning-price" data-toggle="tab"
                           href="#tab-other-warning-price-data" role="tab" aria-expanded="false"
                           data-category-type="3">
                            @lang('app.food-data.tab4')
                            {{--                                <span class="label label-inverse" id="total-record-warning-price-other">0</span>--}}
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-combo-warning-price" data-toggle="tab"
                           href="#tab-combo-warning-price-data"
                           role="tab" aria-expanded="false" data-category-type="4">
                            @lang('app.food-data.tab5')
                            {{--                                <span class="label label-success" id="total-record-warning-price-combo">0</span>--}}
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-addition-warning-price" data-toggle="tab"
                           href="#tab-addition-warning-price-data"
                           role="tab" aria-expanded="false" data-category-type="5">
                            @lang('app.food-data.tab7')
                            {{--                                <span class="label label-info" id="total-record-warning-price-addition" data-type="4">0</span>--}}
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="card card-block">
                    <div class="tab-content">
                        {{--                        đồ ăn--}}
                        <div class="tab-pane active" id="tab-food-warning-price-data" role="tabpanel">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand select-brand-material-data">
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
                                <table class="table" id="table-food-food-warning-price-data">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Mức độ</th>
                                        <th>Chức năng</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        {{--                        nước uống--}}
                        <div class="tab-pane" id="tab-drink-warning-price-data" role="tabpanel">
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
                                <table class="table" id="table-food-drink-warning-price-data">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Mức độ</th>
                                        <th>Chức năng</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        {{--                        khác--}}
                        <div class="tab-pane" id="tab-other-warning-price-data" role="tabpanel">
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
                                <table class="table" id="table-food-other-warning-price-data">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Mức độ</th>
                                        <th>Chức năng</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        {{--                        combo--}}
                        <div class="tab-pane" id="tab-combo-warning-price-data" role="tabpanel">
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
                                <table class="table" id="table-food-combo-warning-price-data">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Mức độ</th>
                                        <th>Chức năng</th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        {{--                        bán kèm--}}
                        <div class="tab-pane" id="tab-addition-warning-price-data" role="tabpanel">
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
                                <table class="table" id="table-food-addition-warning-price-data">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Mức độ</th>
                                        <th>Chức năng</th>
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
    </div>
@endsection

@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/food/warning_price/index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
