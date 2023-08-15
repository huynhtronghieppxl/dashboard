@extends('layouts.layout')
@section('content')
    <style>
        .seemt-main-content .new-table tr:hover {
            background: #F5F6FA !important;
        }

        .seemt-main-content .new-table tr {
            border-top: 0 !important;
        }

        .table td, .table th {
            border-top: none;
        }

        .table tr {
            border-bottom: 1px solid #ededed !important;
        }

        .seemt-main-content .new-table thead {
            border-bottom: 3px solid #F5D1B8 !important;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <ul class="nav nav-tabs md-tabs" role="tablist" id="tab-nav-bonus-booking">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-booking-bonus-data-1"
                       href="#booking-bonus-tab1" role="tab" data-tab="1"
                       aria-expanded="true">@lang('app.booking-bonus-data.tab1') <span
                                class="label label-success" id="total-record-enable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-booking-bonus-data-2"
                       href="#booking-bonus-tab2" data-tab="2"
                       role="tab"
                       aria-expanded="false">@lang('app.booking-bonus-data.tab2') <span
                                class="label label-inverse" id="total-record-disable">0</span></a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="tab-booking-bonus-data-3"
                       href="#booking-bonus-tab3" data-tab="3"
                       role="tab"
                       aria-expanded="false">@lang('app.booking-bonus-data.tab3') </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="card card-block">
                <div class="tab-content">
                    <div class="tab-pane active" id="booking-bonus-tab1" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand booking-bonus-data">
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
                            <table id="table-enable-booking-bonus-data" class="table">
                                <thead>
                                <tr>
                                    <th>@lang('app.booking-bonus-data.stt')</th>
                                    <th>@lang('app.booking-bonus-data.name')</th>
                                    <th>@lang('app.booking-bonus-data.amount')</th>
                                    <th>@lang('app.booking-bonus-data.percent')</th>
                                    <th>@lang('app.booking-bonus-data.description')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="booking-bonus-tab2" role="tabpanel">
                        <div class="table-responsive new-table">
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand booking-bonus-data">
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
                            <table id="table-disable-booking-bonus-data" class="table ">
                                <thead>
                                <tr>
                                    <th>@lang('app.booking-bonus-data.stt')</th>
                                    <th>@lang('app.booking-bonus-data.name')</th>
                                    <th>@lang('app.booking-bonus-data.amount')</th>
                                    <th>@lang('app.booking-bonus-data.bonus')</th>
                                    <th>@lang('app.booking-bonus-data.description')</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="booking-bonus-tab3" role="tabpanel">
                        <div class="">
                            <div class="form-group col-lg-12 px-0">
                                <div class="form-validate-input">
                                    <input type="text" class="form-control" id="price-update-setting-booking-bonus-data"
                                           value="100" data-max="999999999" data-min="100" data-type="currency-edit"/>
                                    <label for="name-create-booking-bonus-data">
                                        Số tiền Booking tối thiểu để được hưởng chính sách
                                        @include('layouts.start') </label>
                                    <div class="line"></div>
                                </div>
                                <div class="link-href"></div>
                            </div>
                            <div class="select-filter-dataTable">
                                <div class="form-validate-select">
                                    <div class="pr-0 select-material-box">
                                        <select class="js-example-basic-single select-brand booking-bonus-data">
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
                            <div class="table-responsive new-table seemt-main-content">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-left" style="width: 50%">Lần áp dụng</th>
                                        <th class="text-center" style="width: 50%">Số tiền thưởng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="pl-3">Lần đầu tiên</td>
                                        <td>
                                            <div class="form-group mb-0 w-50 mx-auto">
                                                <div class="border-group validate-table-validate">
                                                    <input type="text"
                                                           style="padding: 5px 10px !important;width: 100% !important;"
                                                           class="form-control text-center border-0" value="100"
                                                           id="price-first-update-setting-booking-bonus-data"
                                                           data-max="999999999" data-min="100"
                                                           data-type="currency-edit"/>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-3">
                                            <label style="font-size: 16px !important;">Lần thứ 2 đến lần thứ</label>
                                            <div class="d-inline-block pl-2">
                                                <div class="w-50 border-group validate-table-validate">
                                                    <input type="text"
                                                           style="padding: 5px 10px !important;width: 100% !important;"
                                                           class="form-control border-0 text-center" value="3"
                                                           id="second-update-setting-booking-bonus-data"
                                                           data-max="999" data-min="3" data-type="currency-edit"/>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group mb-0 w-50 mx-auto">
                                                <div class="border-group validate-table-validate">
                                                    <input type="text"
                                                           style="padding: 5px 10px !important;width: 100% !important;"
                                                           class="form-control text-center border-0" value="100"
                                                           id="price-second-update-setting-booking-bonus-data"
                                                           data-max="999999999" data-min="100" data-type="currency-edit"/>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-3">Từ lần thứ <label style="font-size: 16px !important;"
                                                                           id="label-second-setting-booking-bonus-data">3</label>
                                            trở
                                            đi
                                        </td>
                                        <td>
                                            <div class="form-group mb-0 w-50 mx-auto">
                                                <div class="border-group validate-table-validate">
                                                    <input type="text"
                                                           style="padding: 5px 10px !important;width: 100% !important;"
                                                           class="form-control text-center border-0" value="100"
                                                           id="price-three-update-setting-booking-bonus-data"
                                                           data-max="999999999" data-min="100"/>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="link-href"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue ml-auto"
                                     onclick="saveModalUpdateSettingBookingBonusData()">
                                    <i class="fi-rr-disk"></i>
                                    <span>@lang('app.component.button.save')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.personnel.booking_bonus.create')
    @include('build_data.personnel.booking_bonus.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/booking_bonus/index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
