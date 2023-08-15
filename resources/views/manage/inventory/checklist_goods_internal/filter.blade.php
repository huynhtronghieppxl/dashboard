<div class="select-filter-dataTable">
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-brand" id="select-brand-checklist-goods-internal">
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
            <select class="js-example-basic-single select-branch" id="select-branch-checklist-goods-internal">
            </select>
        </div>
    </div>
    <div class="time-filer-dataTale">
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input class="from-date-checklist-goods-internal-manage" type="text" value="1/{{date('m/Y')}}">
        </div>
        <span class="input-group-addon custom-find"><i class="fi-rr-angle-double-small-right"></i></span>
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input class="to-date-checklist-goods-internal-manage" type="text" value="{{date('d/m/Y')}}">
        </div>
        <button class="search-btn-checklist-goods-internal-manage"><i class="fi-rr-filter"></i></button>
    </div>
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-type-checklist-goods-internal-manage"
                    data-validate="">
                <option value="1"
                        selected>@lang('app.checklist-goods-internal-manage.type1')</option>
                <option
                    value="2">@lang('app.checklist-goods-internal-manage.type2')</option>
            </select>
        </div>
    </div>
</div>
