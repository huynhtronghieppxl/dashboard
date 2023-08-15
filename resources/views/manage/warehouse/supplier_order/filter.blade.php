{{--<div class="select-filter-dataTable">--}}
{{--    <div class="time-filer-dataTale">--}}
{{--        <input class="date-supplier-order" type="text" value="{{date('m/Y')}}">--}}
{{--        <button class="btn-date-supplier-order"><i class="fa fa-search"></i></button>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="select-filter-dataTable">
    <div class="time-filer-dataTale tooltip-date-time-picker" >
        <input class="from-date-supplier-order" type="text" value="{{date('d/m/Y')}}">
        <span class="input-group-addon custom-find" >@lang('app.component.button.to')</span>
        <input class="to-date-supplier-order" type="text" value="{{date('d/m/Y')}}">
        <button class="search-date-btn-supplier-order" ><i class="fa fa-search"></i></button>
    </div>
</div>
