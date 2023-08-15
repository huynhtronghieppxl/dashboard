@extends('layouts.layout')
@section('content')
    <style>
        .tooltip_formula {
            opacity: 0.9;
            position: relative;
        }

        /*.tooltip_formula:hover .tooltip_formula_wrapper{*/
        /*    display: block;*/
        /*}*/
        .tooltip_formula_wrapper {
            cursor: pointer;
            visibility: hidden;
            background: #333;
            position: absolute;
            top: 50%;
            right: 18px;
            transform: translateY(-50%);
            display: flex;
            width: max-content;
            color: white;
            align-items: center;
            padding: 4px;
            border-radius: 4px;
            gap: 10px;
            transition: .25s ease-in;
        }

        .tooltip_formula_wrapper:before {
            content: "";
            position: absolute;
            right: -4px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 4px solid transparent;
            border-bottom: 4px solid transparent;
            border-left: 4px solid #333
        }

        .tooltip_formula:hover .tooltip_formula_wrapper {
            visibility: visible;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="">
                    <div class="table-responsive new-table">
                        <div class="select-filter-dataTable">
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-brand select-brand-bill-manage">
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
                                    <select class="js-example-basic-single select-branch select-branch-bill-manage">
                                    </select>
                                </div>
                            </div>
                            <div class="time-filer-dataTale">
                                <div class="seemt-group-date">
                                    <i class="fi-rr-calendar"></i>
                                    <input class="from-date-bill-manage" type="text" value="01/{{date('m/Y')}}">
                                </div>
                                <span class="input-group-addon custom-find"><i
                                            class="fi-rr-angle-double-small-right"></i></span>
                                <div class="seemt-group-date">
                                    <i class="fi-rr-calendar"></i>
                                    <input class="to-date-bill-manage" type="text" value="{{date('d/m/Y')}}">
                                </div>
                                <button id="search-btn-bill-manage"><i class="fi-rr-filter"></i></button>
                            </div>

                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select id="bill-select-status"
                                            class="js-example-tags select-target-payment-bill select2-hidden-accessible">
                                        <option value="0,1,2,4,5,4,7,8"
                                                selected>@lang('app.bill-manage.bill-status-table')</option>
                                        <option value="0">@lang('app.bill-manage.processing')</option>
                                        {{--                                        <option value="1">@lang('app.bill-manage.waiting')</option>--}}
                                        <option value="2">@lang('app.bill-manage.done')</option>
                                        {{--                                        <option value="4">@lang('app.bill-manage.waiting-complete')</option>--}}
                                        <option value="5">@lang('app.bill-manage.debt')</option>
                                        {{--                                        <option value="4">@lang('app.bill-manage.confirm')</option>--}}
                                        {{--                                        <option value="7">@lang('app.bill-manage.delivery')</option>--}}
                                        <option value="8">@lang('app.bill-manage.cancel')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-validate-select">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single" id="filter-status-order">
                                        <option value="-1" selected>Trạng thái</option>
                                        <option value="1">Có tính phí dịch vụ</option>
                                        <option value="0">Không tính phí dịch vụ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="table-order" class="table">
                            <thead>
                            <tr>
                                <th rowspan="2">@lang('app.bill-manage.stt')</th>
                                <th class="text-left" rowspan="2">@lang('app.bill-manage.code')</th>
                                <th class="text-left" rowspan="2">@lang('app.bill-manage.name-table')</th>
                                <th class="text-left" rowspan="2">@lang('app.bill-manage.employee-table')</th>
                                <th class="text-left" rowspan="2">@lang('app.bill-manage.customer')</th>
                                <th class="text-right">@lang('app.bill-manage.amount-table')</th>
                                <th class="text-right">@lang('app.bill-manage.vat-table')</th>
                                <th class="text-right">@lang('app.bill-manage.discount-table')</th>
                                <th>@lang('app.bill-manage.point-table')</th>
                                <th>Số khách</th>
                                <th>@lang('app.bill-manage.total-amount-table')</th>
                                <th class="text-right">Tích luỹ điểm</th>
                                <th class="text-right">@lang('app.bill-manage.original-price')</th>
                                <th class="text-right">
                                    % Lợi nhuận
                                    <i class="fi-rr-exclamation tooltip_formula"
                                       style="vertical-align: sub; display: initial !important;">
                                        <div class="row tooltip_formula_wrapper">
                                            <p>
                                                Tỷ suất LN theo giá bán =
                                            </p>
                                            <p>
                                                <span style="border-bottom: 1px solid #fff">Thanh toán - Giá vốn</span><br>
                                                <span>Thanh toán</span>
                                            </p>
                                            <p>
                                                x 100
                                            </p>
                                        </div>
                                    </i>
                                </th>
                                <th rowspan="2">@lang('app.bill-manage.payment-date-table')</th>
                                <th rowspan="2">@lang('app.bill-manage.bill-status-table')</th>
                                <th rowspan="2">Có tính chi phí dịch vụ</th>
                                <th rowspan="2">@lang('app.bill-manage.action-table')</th>
                                <th class="d-none"></th>
                            </tr>
                            <tr>
                                <th id="amount" class="text-right seemt-fz-14">0</th>
                                <th id="total-vat" class="text-right seemt-fz-14">0</th>
                                <th id="total-discount" class="text-right seemt-fz-14">0</th>
                                <th id="total-point" class="text-right seemt-fz-14">0</th>
                                <th id="total-customer-bill-manager" class="text-right seemt-fz-14">0</th>
                                <th id="total-amount" class="text-right seemt-fz-14">0</th>
                                <th id="total-accumulate" class="text-right seemt-fz-14">0</th>
                                <th id="total-original-price" class="text-right seemt-fz-14">0</th>
                                <th id="total-profit-bill-manager" class="text-right seemt-fz-14">0</th>
                                <th class="text-center seemt-fz-14 p-1"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.bill.detail')
    @include('manage.bill.export.export')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/manage/bill/index.js?version=2 ',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
