
    <div class="form-validate-select" style="min-width: 190px">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-brand select-brand-campaign-marketing">
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
    <div class="form-validate-select ml-3 d-none" style="min-width: 242px; margin-right: 6px">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-branch select-branch-campaign-marketing">
            </select>
        </div>
    </div>
