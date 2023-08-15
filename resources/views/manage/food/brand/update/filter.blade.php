<div class="select-filter-dataTable">
    @if(Session::get(SESSION_KEY_LEVEL) != 5 )
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-data-alert-original-price"
                    data-validate="">
            </select>
        </div>
    </div>
    @endif
    <div class="form-validate-select">
        <div class="pr-0 select-material-box">
            <select class="js-example-basic-single select-category-food-brand-manage"
                    data-validate="">
                <option value="" disabled selected hidden>@lang('app.component.option-null')</option>
            </select>
        </div>
    </div>
</div>
