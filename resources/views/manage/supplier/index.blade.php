<style>
    .swal2-container {
        z-index: 0 !important;
    }
</style>
@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-block">
                    <div id="toolbar-options1" class="hidden">
                        <a href="#"><label
                                    class="text-white">@lang('app.supplier-manage.note-payment') {{date('m/Y', strtotime('-1 month'))}}</label></a>
                    </div>
                    <div class="table-responsive new-table">
                        <div class="select-filter-dataTable">
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-brand">
{{--                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)--}}
{{--                                            @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])--}}
{{--                                                <option value="{{$db['id']}}"--}}
{{--                                                        selected>{{$db['name']}}</option>--}}
{{--                                            @else--}}
{{--                                                <option value="{{$db['id']}}">{{$db['name']}}</option>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
                                        <option value="-1" selected>Toàn thương hiệu</option>
                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-validate-select d-none" id="select-branch-supplier-manage">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-branch">
{{--                                        @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)--}}
{{--                                            @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])--}}
{{--                                                <option value="{{$db['id']}}"--}}
{{--                                                        selected>{{$db['name']}}</option>--}}
{{--                                            @else--}}
{{--                                                <option value="{{$db['id']}}">{{$db['name']}}</option>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="table-supplier-supplier-manage" class="table">
                            <thead>
                            <tr>
                                <th rowspan="2">@lang('app.supplier-manage.stt')</th>
                                <th rowspan="2">@lang('app.supplier-manage.name')</th>
                                <th class="text-right">@lang('app.supplier-manage.session')</th>
                                <th class="text-right">@lang('app.supplier-manage.done')</th>
                                <th class="text-right">
                                    <div class="row m-0 p-0">
                                        <div class="col-5 ml-auto pr-0 pl-0">@lang('app.supplier-manage.confirm')
                                            <label class="mb-0 ml-1">
                                                <div class="tool-box">
                                                    <div data-toolbar="user-options">
                                                        <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                           data-toggle="tooltip" data-placement="top"
                                                           data-original-title="@lang('app.supplier-manage.note-confirm') {{date('m/Y')}}"></i>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </th>
                                <th class="text-right">
                                    <div class="row m-0 p-0">
                                        <div class="col-5 ml-auto pr-0 pl-0">@lang('app.supplier-manage.payment')
                                            <label class="mb-0 ml-1">
                                                <div class="tool-box">
                                                    <div data-toolbar="user-options">
                                                        <i class="fi-rr-exclamation" style="vertical-align: sub"
                                                           data-toggle="tooltip" data-placement="top"
                                                           data-original-title="@lang('app.supplier-manage.note-payment') {{date('m/Y', strtotime('-1 month'))}}"></i>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                            </label>
                                        </div>

                                    </div>
                                </th>
                                <th rowspan="2">@lang('app.supplier-manage.action')</th>
                                <th class="d-none" rowspan="2"></th>
                            </tr>
                            <tr>
                                <th class="text-right">
                                    <label id="total-amount-session-supplier-manage" class="seemt-fz-14">0</label><br>
                                    <label class="number-order-header"
                                           id="total-record-session-supplier-manage"></label>
                                </th>

                                <th class="text-right">
                                    <label id="total-amount-done-supplier-manage" class="seemt-fz-14">0</label><br>
                                    <label class="number-order-header" id="total-record-done-supplier-manage"></label>
                                </th>
                                <th class="text-right">
                                    <label id="total-amount-confirm-supplier-manage" class="seemt-fz-14">0</label><br>
                                    <label class="number-order-header"
                                           id="total-record-confirm-supplier-manage"></label>
                                </th>
                                <th class="text-right">
                                    <label id="total-amount-payment-supplier-manage" class="seemt-fz-14">0</label><br>
                                    <label class="number-order-header"
                                           id="total-record-payment-supplier-manage"></label>
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.supplier.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/supplier/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
