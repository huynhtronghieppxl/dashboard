<table id="table-export-new-customer-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="6">@lang('app.new-customer-report.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="6">@lang('app.new-customer-report.excel.text2'): {{Session::get(SESSION_KEY_NAME_BRAND)}} -
            @lang('app.new-customer-report.excel.text3'): {{Session::get(SESSION_KEY_NAME_BRANCH)}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="6"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="6" id="title-excel-new-customer-report" style="background-color: #c5c5c5">@lang('app.new-customer-report.excel.text4')
            <span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.new-customer-report.stt')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.new-customer-report.name')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.new-customer-report.gender')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.new-customer-report.date')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.new-customer-report.type')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.new-customer-report.point')</td>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="6"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="6">
            @lang('app.new-customer-report.excel.text5')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/customer/report/new_customer/export.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
