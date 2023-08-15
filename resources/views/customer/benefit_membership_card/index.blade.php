@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
{{--            <div class="page-header">--}}
{{--                <div class="row align-items-end">--}}
{{--                    <div class="col-lg-8">--}}
{{--                        <div class="page-header-title">--}}
{{--                            <div class="d-inline">--}}
{{--                                <h4>@lang('app.benefit-membership-card.title')</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="page-header-breadcrumb">--}}
{{--                            <ul class="breadcrumb-title">--}}
{{--                                <li class="breadcrumb-item">--}}
{{--                                    <a href="/"> <i class="feather icon-home"></i> </a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item"><a--}}
{{--                                            href="{{route('customer.benefit-membership-card.index')}}">@lang('app.benefit-membership-card.breadcrumb')</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="page-body">
                <div class="card card-block tab-icon">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                       href="#tab1-benefit-membership-card" role="tab"
                                       aria-expanded="false">@lang('app.benefit-membership-card.tab1') <span
                                                class="label label-success"
                                                id="total-record-tab1-benefit-membership-card">0</span>
                                    </a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                       href="#tab2-benefit-membership-card" role="tab"
                                       aria-expanded="false">@lang('app.benefit-membership-card.tab2') <span
                                                class="label label-inverse"
                                                id="total-record-tab2-benefit-membership-card">0</span>
                                    </a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <select id="select-card-benefit-membership-card"
                                            class="js-example-basic-single"></select>
                                </li>
                                <li class="nav-item">
                                    <div class="card-block">
                                        <button type="button"
                                                class="btn btn-primary float-right"
                                                onclick="openModalCreateMemberShipCard()">@lang('app.component.button.create')</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content p-2 mb-0">
                        <div class="tab-pane" id="tab1-benefit-membership-card" role="tabpanel">
                            <div class="col-sm-12 p-0">
                                <div class="table-responsive">
                                    <table id="table-enable-member-ship-card"
                                           class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.benefit-membership-card.stt')</th>
                                            <th>@lang('app.benefit-membership-card.content')</th>
                                            <th>@lang('app.benefit-membership-card.description')</th>
                                            <th>@lang('app.benefit-membership-card.action')</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-benefit-membership-card" role="tabpanel">
                            <div class="col-sm-12 p-0">
                                <div class="table-responsive">
                                    <table id="table-disable-member-ship-card"
                                           class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>@lang('app.benefit-membership-card.stt')</th>
                                            <th>@lang('app.benefit-membership-card.content')</th>
                                            <th>@lang('app.benefit-membership-card.description')</th>
                                            <th>@lang('app.benefit-membership-card.action')</th>
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
    {{--@include('customer.benefit_membership_card.create')--}}
    {{--@include('customer.benefit_membership_card.update')--}}

@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript"
            src="{{asset('js/customer/benefit_membership_card/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
