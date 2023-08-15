<div class="select-filter-dataTable">
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-brand" id="select-brand-payment-bill-treasurer">
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
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-branch" id="select-branch-payment-bill-treasurer">
                @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)
                    @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])
                        <option value="{{$db['id']}}"
                                selected>{{$db['name']}}</option>
                    @else
                        <option value="{{$db['id']}}">{{$db['name']}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="time-filer-dataTale">
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input class="from-date-payment-bill" type="text" value="01/{{date('m/Y')}}">
        </div>
        <span class="input-group-addon custom-find"><i class="fi-rr-angle-double-small-right"></i></span>
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input class="to-date-payment-bill" type="text" value="{{date('d/m/Y')}}">
        </div>
        <button class="search-btn-payment-bill"><i class="fi-rr-filter"></i></button>
    </div>
{{--    <div class="form-validate-select">--}}
{{--        <div class="pr-0 select-material-box">--}}
{{--            <select class="js-example-basic-single select-target-payment-bill"--}}
{{--                    data-validate="">--}}
{{--                <option value="-1"--}}
{{--                        selected>Đối tượng</option>--}}
{{--                <option value="1">@lang('app.payment-bill.supplier')</option>--}}
{{--                <option value="2">@lang('app.payment-bill.employees')</option>--}}
{{--                <option value="3">@lang('app.payment-bill.customer')</option>--}}
{{--                <option value="5">@lang('app.payment-bill.other')</option>--}}
{{--                <option value="6">@lang('app.payment-bill.booking')</option>--}}
{{--            </select>--}}
{{--            <div class="line"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-validate-select">--}}
{{--        <div class="pr-0 select-material-box">--}}
{{--            <select class="js-example-basic-single select-debt-payment-bill"--}}
{{--                    data-validate="">--}}
{{--                <option value="-1" selected>Công nợ</option>--}}
{{--                <option value="1">@lang('app.payment-bill.option-debt')</option>--}}
{{--                <option value="0">@lang('app.payment-bill.option-not-debt')</option>--}}
{{--            </select>--}}
{{--            <div class="line"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-reason-payment-bill"
                    data-validate="">
                <option data-reason-type-id="-1" value="-1" selected>@lang('app.component.option-all')</option>
            </select>
        </div>
    </div>
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-accounting-payment-bill"
                    data-validate="">
                <option value="-1" selected>Tất cả</option>
                <option value="1">@lang('app.payment-bill.option-accounting')</option>
                <option value="0">@lang('app.payment-bill.option-not-accounting')</option>
            </select>
        </div>
    </div>
</div>
