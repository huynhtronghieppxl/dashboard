<style>
    .seemt-main-content .select-filter-dataTable .select2-container--default .select2-selection--single .select2-selection__arrow{
        top: -6px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b{
        margin-left: 8px !important;
    }
    .icon-branch {
        margin-right: 5px;
        color: var(--green-color) !important;
    }

    .icon-brand {
        margin-right: 5px;
        color: var(--blue-color) !important;
    }
</style>
<div class="select-filter-dataTable row">
    <div class="form-validate-select ml-2 select-brand-branch">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-brand select-brand-material-data">
                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->where('is_office', ENUM_DIS_SELECTED)->all() as $db)
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
    <div class="form-validate-select ml-2 select-brand-branch">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-branch select-branch-report">
                @foreach(collect(Session::get(SESSION_KEY_DATA_BRANCH))->where('status', ENUM_SELECTED)
                    ->where('is_office', ENUM_DIS_SELECTED)->all() as $db)
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
</div>

