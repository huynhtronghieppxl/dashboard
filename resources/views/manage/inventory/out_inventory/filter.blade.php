<div class="select-filter-dataTable">
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-brand select-brand-out-inventory">
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
            <select class="js-example-basic-single select-branch select-branch-out-inventory">
            </select>
        </div>
    </div>
    <div class="time-filer-dataTale">
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input id  class="from-date-out-inventory-manage" type="text" value="01/{{date('m/Y')}}">
        </div>
        <span class="input-group-addon custom-find"><i class="fi-rr-angle-double-small-right"></i></span>
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input   class="to-date-out-inventory-manage" type="text" value="{{date('d/m/Y')}}">
        </div>
        <button  class="search-btn-out-inventory-manage"><i class="fi-rr-filter"></i></button>
    </div>
</div>

