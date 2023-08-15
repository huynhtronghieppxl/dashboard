<table id="table-export-cost-debt-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="5">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="5">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_NAME_BRAND)}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_NAME_BRANCH)}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="5"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="5" id="title-excel-cost-debt-report" style="background-color: #c5c5c5">@lang('app.cost-debt-report.excel.text4')<span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <td rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.cost-debt-report.stt')</td>
        <td rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.cost-debt-report.reason')</td>
        <td style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.cost-debt-report.done')</td>
        <td style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.cost-debt-report.waiting')</td>
        <td style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.cost-debt-report.debt')</td>
    </tr>
    <tr>
        <th class="total-done-cost-debt-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-waiting-cost-debt-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-debt-cost-debt-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="5"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="5">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
