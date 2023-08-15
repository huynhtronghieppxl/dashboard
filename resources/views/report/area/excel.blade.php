<table id="table-export-area-report" class="d-none">
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
        <th colspan="4" id="title-excel-area-report" style="background-color: #c5c5c5">@lang('app.area-report.excel.text4')<span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.area-report.stt-table')</th>
        <th rowspan="2" style="width: 300px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.area-report.area-table')</th>
        <th style="width: 150px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.area-report.order-table')</th>
        <th style="width: 200px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.area-report.revenue-table')</th>
    </tr>
    <tr>
        <th class="total-order-area-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-revenue-area-report" style="background-color: #f2f2f2">
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
    <script type="text/javascript" src="{{ asset('/js/report/area/export.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
