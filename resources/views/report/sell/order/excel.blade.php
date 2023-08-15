<table id="table-export-sell-order-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="14">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="14">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_NAME_BRAND)}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_NAME_BRANCH)}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="14"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="14" id="title-excel-sell-order-report" style="background-color: #c5c5c5">@lang('app.sell-report.card8.title-excel')<span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.stt-table')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.employee-table')</th>
        <th rowspan="2" style="width:60px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.table-table')</th>
        <th rowspan="2" style="width:60px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.table-merge-table')</th>
        <th rowspan="2" style="width:60px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.move-tables-table')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.using-slot-table')</th>
        <th style="width:130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.vat-table')</th>
        <th style="width:130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.discount-table')</th>
        <th style="width:130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.bank-table')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.cash-table')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.transfer-table')</th>
        <th style="width:130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.total-amount-table')</th>
        <th rowspan="2" style="width:130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.date-table')</th>
        <th rowspan="2" style="width:130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card8.time-table')</th>
    </tr>
    <tr>
        <th style="background-color: #f2f2f2" class="total-customer-order">
            <label></label>
        </th>
        <th style="background-color: #f2f2f2" class="total-vat">
            <label></label>
        </th>
        <th style="background-color: #f2f2f2" class="total-discount">
            <label></label>
        </th>
        <th style="background-color: #f2f2f2" class="total-bank">
            <label></label>
        </th>
        <th style="background-color: #f2f2f2" class="total-cash">
            <label></label>
        </th>
        <th style="background-color: #f2f2f2" class="total-transfer">
            <label></label>
        </th>
        <th style="background-color: #f2f2f2" class="total-value-order">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="14"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="14">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\sell\order\export.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
