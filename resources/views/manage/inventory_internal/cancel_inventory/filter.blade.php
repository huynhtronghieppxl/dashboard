<div class="select-filter-dataTable">
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-brand" id="select-brand-cancel-inventory-internal">
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
            <select class="js-example-basic-single select-branch" id="select-branch-cancel-inventory-internal">
            </select>
        </div>
    </div>
    <div class="time-filer-dataTale filter-date">
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input class="from-date-cancel-inventory-internal-manage" type="text" value="{{date('d/m/Y')}}">
        </div>
        <span class="input-group-addon custom-find seemt-gray-w600"><i class="fi-rr-angle-double-small-right"></i></span>
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input class="to-date-cancel-inventory-internal-manage" type="text" value="{{date('d/m/Y')}}">
        </div>
        <button class="search-btn-cancel-inventory-internal-manage"><i class="fi-rr-filter"></i></button>
    </div>
</div>
