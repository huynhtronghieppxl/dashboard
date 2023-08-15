@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
{{--        <div class="page-header">--}}
{{--            <div class="row align-items-end">--}}
{{--                <div class="col-lg-8">--}}
{{--                    <div class="page-header-title">--}}
{{--                        <div class="d-inline">--}}
{{--                            <h4>@lang('app.cash-book-manage.title')</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <div class="page-header-breadcrumb">--}}
{{--                        <ul class="breadcrumb-title">--}}
{{--                            <li class="breadcrumb-item">--}}
{{--                                <a href="/"> <i class="feather icon-home"></i> </a>--}}
{{--                            </li>--}}
{{--                            <li class="breadcrumb-item"><a--}}
{{--                                        href="{{route('manage.cash_book.cash-book-manage.index')}}">@lang('app.cash-book-manage.breadcrumb')</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="page-body">
            <div class="card tab-icon">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab"
                                   href="#tab1-cash-book-manage" role="tab"
                                   aria-expanded="true">@lang('app.cash-book-manage.tab1') <span
                                            class="label label-warning"
                                            id="total-record-tab1-cash-book-manage">0</span>
                                </a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                   href="#tab2-cash-book-manage" role="tab"
                                   aria-expanded="false">@lang('app.cash-book-manage.tab2') <span
                                            class="label label-success"
                                            id="total-record-tab2-cash-book-manage">0</span>
                                </a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                   href="#tab3-cash-book-manage" role="tab"
                                   aria-expanded="false">@lang('app.cash-book-manage.tab3') <span
                                            class="label label-danger"
                                            id="total-record-tab3-cash-book-manage">0</span>
                                </a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item"></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content card p-2 mb-0">
                    <div class="tab-pane active" id="tab1-cash-book-manage" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive">
                                <table id="table-waiting-cash-book-manage" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.cash-book-manage.stt')</th>
                                        <th>@lang('app.cash-book-manage.name')</th>
                                        <th>@lang('app.cash-book-manage.employee')</th>
                                        <th>@lang('app.cash-book-manage.confirm')</th>
                                        <th>@lang('app.cash-book-manage.from')</th>
                                        <th>@lang('app.cash-book-manage.to')</th>
                                        <th>@lang('app.cash-book-manage.open')</th>
                                        <th>@lang('app.cash-book-manage.in')</th>
                                        <th>@lang('app.cash-book-manage.out')</th>
                                        <th>@lang('app.cash-book-manage.order')</th>
                                        <th>@lang('app.cash-book-manage.close')</th>
                                        <th>@lang('app.cash-book-manage.change')</th>
                                        <th>@lang('app.cash-book-manage.action')</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">@lang('app.cash-book-manage.total')</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th id="total-open-tab1-cash-book-manage">0</th>
                                        <th id="total-in-tab1-cash-book-manage">0</th>
                                        <th id="total-out-tab1-cash-book-manage">0</th>
                                        <th id="total-order-tab1-cash-book-manage">0</th>
                                        <th id="total-close-tab1-cash-book-manage">0</th>
                                        <th id="total-change-tab1-cash-book-manage">0</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-cash-book-manage" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive">
                                <table id="table-done-cash-book-manage" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.cash-book-manage.stt')</th>
                                        <th>@lang('app.cash-book-manage.name')</th>
                                        <th>@lang('app.cash-book-manage.employee')</th>
                                        <th>@lang('app.cash-book-manage.confirm')</th>
                                        <th>@lang('app.cash-book-manage.from')</th>
                                        <th>@lang('app.cash-book-manage.to')</th>
                                        <th>@lang('app.cash-book-manage.open')</th>
                                        <th>@lang('app.cash-book-manage.in')</th>
                                        <th>@lang('app.cash-book-manage.out')</th>
                                        <th>@lang('app.cash-book-manage.order')</th>
                                        <th>@lang('app.cash-book-manage.close')</th>
                                        <th>@lang('app.cash-book-manage.change')</th>
                                        <th>@lang('app.cash-book-manage.action')</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">@lang('app.cash-book-manage.total')</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th id="total-open-tab2-cash-book-manage">0</th>
                                        <th id="total-in-tab2-cash-book-manage">0</th>
                                        <th id="total-out-tab2-cash-book-manage">0</th>
                                        <th id="total-order-tab2-cash-book-manage">0</th>
                                        <th id="total-close-tab2-cash-book-manage">0</th>
                                        <th id="total-change-tab2-cash-book-manage">0</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3-cash-book-manage" role="tabpanel">
                        <div class="col-sm-12 p-0">
                            <div class="table-responsive">
                                <table id="table-cancel-cash-book-manage" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.cash-book-manage.stt')</th>
                                        <th>@lang('app.cash-book-manage.name')</th>
                                        <th>@lang('app.cash-book-manage.employee')</th>
                                        <th>@lang('app.cash-book-manage.confirm')</th>
                                        <th>@lang('app.cash-book-manage.from')</th>
                                        <th>@lang('app.cash-book-manage.to')</th>
                                        <th>@lang('app.cash-book-manage.open')</th>
                                        <th>@lang('app.cash-book-manage.in')</th>
                                        <th>@lang('app.cash-book-manage.out')</th>
                                        <th>@lang('app.cash-book-manage.order')</th>
                                        <th>@lang('app.cash-book-manage.close')</th>
                                        <th>@lang('app.cash-book-manage.change')</th>
                                        <th>@lang('app.cash-book-manage.action')</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">@lang('app.cash-book-manage.total')</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th id="total-open-tab3-cash-book-manage">0</th>
                                        <th id="total-in-tab3-cash-book-manage">0</th>
                                        <th id="total-out-tab3-cash-book-manage">0</th>
                                        <th id="total-order-tab3-cash-book-manage">0</th>
                                        <th id="total-close-tab3-cash-book-manage">0</th>
                                        <th id="total-change-tab3-cash-book-manage">0</th>
                                        <th></th>
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
    @include('manage.cash_book.detail')
@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('/js/manage/cash_book/index.js?version=1',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
