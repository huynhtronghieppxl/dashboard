@extends('layouts.layout') @section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}" />
    <div class="page-wrapper" id="div-layout-gift-marketing">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-gift-marketing">
                <li class="nav-item">
                    <a class="nav-link" data-tab="0" data-toggle="tab" href="#tab1-gift-marketing" role="tab" aria-expanded="true">@lang('app.gift-marketing.tab1') <span class="label label-success" id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-tab="1" data-toggle="tab" href="#tab2-gift-marketing" role="tab" aria-expanded="false">@lang('app.gift-marketing.tab2') <span class="label label-warning" id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content m-t-5px">
                    <div class="tab-pane active" id="tab1-gift-marketing" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table class="table" id="table-enable-gift-marketing">
                                <thead>
                                <tr>
                                    <th>@lang('app.gift-marketing.stt')</th>
                                    <th>@lang('app.gift-marketing.name')</th>
                                    <th>@lang('app.gift-marketing.type')</th>
                                    <th>@lang('app.gift-marketing.value')</th>
                                    <th>@lang('app.gift-marketing.day')</th>
                                    <th></th>
                                    <th class="">1</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-gift-marketing" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                @include('marketing.brand')
                            </div>
                            <table class="table" id="table-disable-gift-marketing">
                                <thead>
                                <tr>
                                    <th>@lang('app.gift-marketing.stt')</th>
                                    <th>@lang('app.gift-marketing.name')</th>
                                    <th>@lang('app.gift-marketing.type')</th>
                                    <th>@lang('app.gift-marketing.value')</th>
                                    <th>@lang('app.gift-marketing.day')</th>
                                    <th></th>
                                    <th class="">2</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('marketing.gift.gift.detail')
    @include('marketing.gift.gift.create')
    @include('marketing.gift.gift.update')
@endsection
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript"
            src="{{ asset('js\template_custom\dataTable.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('js\marketing\gift\gift\index.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
