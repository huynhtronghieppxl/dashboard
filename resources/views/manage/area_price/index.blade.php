@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row d-flex">
                <div class="edit-flex-auto-fill col-sm-12">
                    <div class="card flex-sub">
                        <div class="p-b-0">
                            <h5 class="sub-title mb-2 ml-3">@lang('app.price-by-area-data.title-right')</h5>
                        </div>
                        <div class="table-responsive new-table">
                            <div id="body-price-by-area-data" class="card-block card p-t-0 p-0">
                                <div class="select-filter-dataTable">
                                        <div class="form-validate-select">
                                            <div class="pr-0 select-material-box">
                                                <select class="js-example-basic-single select-brand"
                                                        id="brand-price-by-area-manage">
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
                                                        id="branch-price-by-area-manage" name="branch_id">
                                                </select>
                                            </div>
                                        </div>
                                    <div class="form-validate-select">
                                        <div class="select-material-box">
                                            <select class="js-example-basic-single select2-hidden-accessible"
                                                    id="select-area-price-table-manage">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-area-price-manage" class="table">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th class="text-left">@lang('app.price-by-area-data.name')</th>
                                        <th>@lang('app.price-by-area-data.category')</th>
                                        <th>@lang('app.price-by-area-data.price')</th>
                                        <th>@lang('app.price-by-area-data.amount')</th>
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
    @include('manage.food.brand.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\manage\area_price\index.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
