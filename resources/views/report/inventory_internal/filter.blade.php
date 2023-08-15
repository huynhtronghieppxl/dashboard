<div class="select-filter-dataTable">
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-brand select-brand-material-data">
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
            <select class="js-example-basic-single form-control custom-form-search select-from-inventory-internal-report">
                <option disabled selected hidden>@lang('app.component.option_default')</option>
            </select>
            <div class="line"></div>
        </div>
    </div>
    <span class="input-group-addon custom-find">@lang('app.component.button.to')</span>
    <div class="pr-0 select-material-box">
        <select class="js-example-basic-single form-control custom-form-search select-to-inventory-internal-report">
            <option disabled selected hidden>@lang('app.component.option_default')</option>
        </select>
        <div class="line"></div>
    </div>
    <button class="search-btn-inventory-report">
        <i class="fa fa-search"></i>
    </button>
</div>
