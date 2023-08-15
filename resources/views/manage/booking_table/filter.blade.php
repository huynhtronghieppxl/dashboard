<style>
    .search-time-booking-table-manage, .search-month-booking-table-manage {
        width: 32px !important;
    }

    .month-booking-table-manage {
        width: 150px !important;
    }

    .seemt-main-content .new-table .time-filer-dataTale input {
        padding-left: 0 !important;
    }
</style>
<div class="select-filter-dataTable">
    <div class="time-filer-dataTale row d-none div-month-booking-table-manage">
        <input class="month-booking-table-manage text-center" type="text"
               value="{{date('m/Y')}}">
        <button class="input-group-addon cursor-pointer search-month-booking-table-manage">
            <i class="fi-rr-filter p-r-0px"></i>
        </button>
    </div>
    <div class="time-filer-dataTale row d-none align-items-center div-time-booking-table-manage">
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input class="from-date-booking-table-manage" type="text" value="01/{{date('m/Y')}}">
        </div>
        <span class="input-group-addon custom-find"><i class="fi-rr-angle-double-small-right"></i></span>
        <div class="seemt-group-date">
            <i class="fi-rr-calendar"></i>
            <input class="to-date-booking-table-manage" type="text" value="{{date('d/m/Y')}}">
        </div>
        <button class="search-time-booking-table-manage"><i class="fi-rr-filter"></i></button>
    </div>
    <div class="form-validate-select">
        <div class="col-lg-12 pr-0 select-material-box">
            <select class="select-type-booking-table-manage js-example-basic-single">
                <option value="1" data-from="{{date('d/m/Y')}}"
                        data-to="{{date('d/m/Y')}}">@lang('app.component.date.to-day')</option>
                <option value="2" data-from="{{date('d/m/Y', strtotime('monday this week'))}}"
                        data-to="{{date('d/m/Y', strtotime('sunday this week'))}}">@lang('app.component.date.this-week')</option>
                <option value="3" data-from="01/{{date('m/Y')}}"
                        data-to="{{date('t/m/Y')}}">@lang('app.component.date.month')</option>
                <option value="4" data-from="{{date('d/m/Y')}}"
                        data-to="{{date('d/m/Y')}}">@lang('app.component.date.custom')</option>
            </select>
        </div>
    </div>
</div>
