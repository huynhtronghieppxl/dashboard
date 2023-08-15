<div class="select-filter-dataTable">
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-brand" id="select-brand-receipts-bill-treasurer">
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
            <select class="js-example-basic-single select-branch" id="select-branch-receipts-bill-treasurer">
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
            <input class="from-date-receipts-bill" type="text" value="01/{{date('m/Y')}}">
        </div>
        <span class="input-group-addon custom-find"><i class="fi-rr-angle-double-small-right"></i></span>
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input class="to-date-receipts-bill" type="text" value="{{date('d/m/Y')}}">
        </div>
        <button class="search-btn-receipts-bill"><i class="fi-rr-filter"></i></button>
    </div>
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-tags select-target-receipts-bill">
                <option value="-1" selected>@lang('app.receipts-bill.group')</option>
                <option value="1">@lang('app.receipts-bill.supplier')</option>
                <option value="2">@lang('app.receipts-bill.employees')</option>
                <option value="3">@lang('app.receipts-bill.customer')</option>
                <option value="4">@lang('app.receipts-bill.bill')</option>
                <option value="4">Thêm VAT tay</option>
                <option value="5">@lang('app.receipts-bill.other')</option>
            </select>
        </div>
    </div>
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-tags select-reason-receipts-bill" >
                <option data-type-id="-1" value="-1" selected>@lang('app.receipts-bill.reason')</option>
            </select>
        </div>
    </div>
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-tags select-accounting-receipts-bill">
                <option value="-1" selected>Tất cả</option>
                <option value="1">@lang('app.receipts-bill.option-accounting')</option>
                <option value="0">@lang('app.receipts-bill.option-not-accounting')</option>
            </select>
        </div>
    </div>
</div>
