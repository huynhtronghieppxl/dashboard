<table id="table-export-employee-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="4">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="4">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_NAME_BRAND)}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_NAME_BRANCH)}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="4"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="4" id="title-excel-employee-report" style="background-color: #c5c5c5">@lang('app.employee-report.title-excel')<span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.employee-report.stt-table')</th>
        <th rowspan="2" style="width: 250px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.employee-report.name-table')</th>
        <th style="width: 150px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.employee-report.order-table')</th>
        <th style="width: 150px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.employee-report.revenue-table')</th>
    </tr>
    <tr>
        <th class="total-order-employee-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-revenue-employee-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="4"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="4">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="/js/report/employee/export.js?version="></script>
@endpush
