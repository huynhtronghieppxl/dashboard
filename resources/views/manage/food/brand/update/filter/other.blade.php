<div class="select-filter-dataTable">
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-brand" >
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
    @if(Session::get(SESSION_KEY_LEVEL) != 5 )
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-data-alert-original-price"
                    data-validate="">
            </select>
        </div>
    </div>
    @endif
{{--    <div class="form-validate-select">--}}
{{--        <div class="pr-0 select-material-box">--}}
{{--            <select class="js-example-basic-single select-category-food-brand-manage-other select-category-food-manage"--}}
{{--                    data-validate="">--}}
{{--                <option value="" disabled selected hidden>@lang('app.component.option-null')</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
