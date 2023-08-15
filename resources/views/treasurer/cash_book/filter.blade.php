<div class="select-filter-dataTable">
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-brand">
                <option value="-1" selected>Toàn thương hiệu</option>
                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                    <option value="{{$db['id']}}">{{$db['name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-validate-select d-none" id="select-branch-cask-book">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-branch">
{{--                @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)->all() as $db)--}}
{{--                    @if(Session::get(SESSION_KEY_BRANCH_ID) == $db['id'])--}}
{{--                        <option value="{{$db['id']}}"--}}
{{--                                selected>{{$db['name']}}</option>--}}
{{--                    @else--}}
{{--                        <option value="{{$db['id']}}">{{$db['name']}}</option>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
            </select>
        </div>
    </div>
    <div class="form-validate-select">
        <div class="select-material-box">
            <select class="select-revenue-cash-book js-example-basic-single select2-hidden-accessible">
                <option value="-1">@lang('app.cash-book.revenue')</option>
                <option value="1">@lang('app.cash-book.is-revenue')</option>
                <option value="0">@lang('app.cash-book.no-revenue')</option>
            </select>
        </div>
    </div>
    <div class="time-filer-dataTale">
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input disabled class="from-date-cash-book disabled" type="text" value="1/{{date('m/Y')}}">
        </div>
        <span class="input-group-addon custom-find"><i class="fi-rr-angle-double-small-right"></i></span>
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input class="to-date-cash-book" type="text" value="{{date('d/m/Y')}}">
        </div>
        <button class="search-btn-cash-book"><i class="fi-rr-filter"></i></button>
    </div>

</div>
