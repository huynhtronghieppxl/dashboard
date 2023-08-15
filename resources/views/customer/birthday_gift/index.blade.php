@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->
{{--            <div class="page-header">--}}
{{--                <div class="row align-items-end">--}}
{{--                    <div class="col-lg-8">--}}
{{--                        <div class="page-header-title">--}}
{{--                            <div class="d-inline">--}}
{{--                                <h4>@lang('app.birthday-gift.title')</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="page-header-breadcrumb">--}}
{{--                            <ul class="breadcrumb-title">--}}
{{--                                <li class="breadcrumb-item">--}}
{{--                                    <a href="/"> <i class="feather icon-home"></i> </a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item">--}}
{{--                                    <a href="{{route('customer.birthday-gift.index')}}">@lang('app.birthday-gift.breadcrumb')</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- Page-header end -->
            <!-- Page-body start -->
            <div class="page-body">
                <div class="card">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="table-birthday-gift" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>@lang('app.birthday-gift.stt')</th>
                                    <th>@lang('app.birthday-gift.avatar')</th>
                                    <th>@lang('app.birthday-gift.icon')</th>
                                    <th>@lang('app.birthday-gift.name')</th>
                                    <th>@lang('app.birthday-gift.gift')</th>
                                    <th>@lang('app.birthday-gift.status')</th>
                                    <th>@lang('app.birthday-gift.action')</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
    <div class="d-none">
        <span id="msg-title-status-birthday-gift">@lang('app.birthday-gift.title-status')</span>
        <span id="msg-content-status-birthday-gift">@lang('app.birthday-gift.content-status')</span>
        <span id="msg-success-status-birthday-gift">@lang('app.birthday-gift.success-status')</span>
    </div>

    @include('customer.birthday_gift.create')
    @include('customer.birthday_gift.update')

    <div id="mySidenav-321" class="sidenav">
        <a href="javascript:void(0)" id="button-service-1" class="bg-primary" onclick="openModalCreateBirthdayGift()" style="width: max-content ; right: -79px;">
            <i class="fa fa-plus-square"></i>&emsp; @lang('app.component.button.create')
        </a>
    </div>

@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript" src="{{asset('js/customer/birthday_gift/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
