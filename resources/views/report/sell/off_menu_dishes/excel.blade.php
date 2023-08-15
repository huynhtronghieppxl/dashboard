<table id="table-export-off-menu-dishes" class="d-none">
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
        <th colspan="7" id="title-excel-off-menu-dishes" style="background-color: #c5c5c5">@lang('app.sell-report.dishes-report.title') <span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card1.stt-table')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card1.name-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card1.quantity-table')</th>
        <th rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card1.total-original-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card1.total-money-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card1.profit-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card1.profit-rate-table')</th>
    </tr>
    <tr>
        <th id="total-quantity-off-menu-dishes" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th id="total-original-off-menu-dishes" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th id="total-money-off-menu-dishes" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th id="total-profit-off-menu-dishes" style="background-color: #f2f2f2">
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
    <script type="text/javascript" src="{{ asset('../js/report/sell/off_menu_dishes/export.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
