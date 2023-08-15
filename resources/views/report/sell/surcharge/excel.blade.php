<table id="table-export-surcharge-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="3">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="3">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_NAME_BRAND)}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_NAME_BRANCH)}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="3"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="3" id="title-excel-surcharge-report" style="background-color: #c5c5c5">CHI TIẾT BÁO CÁO PHỤ THU  <span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card5.stt-table')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card5.create-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Phụ thu</th>
    </tr>
    <tr>
        <th id="total-value-sell-surcharge-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="3"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="3">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\sell\surcharge\export.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
