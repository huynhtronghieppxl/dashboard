<table id="table-export-food-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="7">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['name']}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7" id="title-excel-food-report" style="background-color: #c5c5c5">@lang('app.sell-report.card2.title-excel') - <span id="type-inventory-food-report"></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card2.stt-table')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card2.name-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card2.quantity-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card2.total-original-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card2.total-money-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card2.profit-table')</th>
        <th rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card2.profit-rate-table')</th>
    </tr>
    <tr>
        <th id="total-quantity-sell-food-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th id="total-original-sell-food-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th id="total-money-sell-food-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th id="total-profit-sell-food-report" style="background-color: #f2f2f2">
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
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\sell\food\export.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
