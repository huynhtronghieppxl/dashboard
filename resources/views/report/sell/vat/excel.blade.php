<table id="table-export-vat-report" class="d-none">
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
        <th colspan="3" id="title-excel-vat-report" style="background-color: #c5c5c5">CHI TIẾT BÁO CÁO VAT  <span id="type-inventory-vat-report"></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card5.stt-table')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card5.create-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">VAT</th>
    </tr>
    <tr>
        <th id="total-value-sell-vat-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="3">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\sell\vat\export.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
