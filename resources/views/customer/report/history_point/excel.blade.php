<table id="table-export-history-point-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="7">@lang('app.history-point-report.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7">@lang('app.history-point-report.excel.text2'): {{Session::get(SESSION_KEY_NAME_BRAND)}} -
            @lang('app.history-point-report.excel.text3'): {{Session::get(SESSION_KEY_NAME_BRANCH)}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7" id="title-excel-history-point-report" style="background-color: #c5c5c5">@lang('app.history-point-report.excel.text4')
            <span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.history-point-report.stt')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.history-point-report.name')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.history-point-report.gender')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.history-point-report.count-add')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.history-point-report.point-add')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.history-point-report.count-subtract')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.history-point-report.point-subtract')</td>
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
            @lang('app.history-point-report.excel.text5')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/report/history_point/export.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
