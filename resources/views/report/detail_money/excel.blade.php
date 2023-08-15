<table id="table-export-detail-money-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="7">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_NAME_BRAND)}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_NAME_BRANCH)}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7" id="title-excel-detail-money-report" style="background-color: #c5c5c5">@lang('app.detail-money-report.title-excel')<span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.detail-money-report.tab1.stt-table')</th>
        <th rowspan="2" style="width: 150px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.detail-money-report.tab1.code-table')</th>
        <th rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.detail-money-report.tab1.employee-table')</th>
        <th rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.detail-money-report.tab1.date-table')</th>
        <th rowspan="2" style="width: 230px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.detail-money-report.tab1.object_name-table')</th>
        <th rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.detail-money-report.tab1.reason_name-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.detail-money-report.tab1.amount-table')</th>
    </tr>
    <tr>
        <th class="total-done-detail-money-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="7"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="7">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
