@extends('layouts.layout')
@section('content')
    <style>
        .select-temporary {
            transform: translateX(-16px);
        }
    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content card-block">
                                <div class="tab-pane active" id="tab1-price-temporary" role="tabpanel">
                                    <div class="table-responsive new-table">
                                        <div class="select-filter-dataTable select-temporary">
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single select-brand"
                                                            id="select-brand-price-temporary">
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
                                            <div class="form-validate-select">
                                                <div class="pr-0 select-material-box">
                                                    <select class="js-example-basic-single select-branch"
                                                            id="select-branch-price-temporary">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table" id="table-food-price-temporary">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.price-temporary.stt')</th>
                                                <th>@lang('app.price-temporary.name')</th>
                                                <th>@lang('app.price-temporary.unit')</th>
                                                <th>@lang('app.price-temporary.category')</th>
                                                <th>@lang('app.price-temporary.original-price')</th>
                                                <th>@lang('app.price-temporary.price')</th>
                                                <th>@lang('app.price-temporary.temporary-price')</th>
                                                <th>@lang('app.price-temporary.start-date')</th>
                                                <th>@lang('app.price-temporary.end-date')</th>
                                                <th>@lang('app.price-temporary.status')</th>
                                                <th></th>
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
        </div>
    </div>
    @include('build_data.business.price_temporary.update')
    @include('manage.food.brand.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/business/price_temporary/index.js?version=3', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    {{--    <script type="text/javascript" src="{{asset('js/build_data/food/food/detail.js?version=5')}}"></script>--}}
@endpush
