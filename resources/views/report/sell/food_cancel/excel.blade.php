<table id="table-export-food-cancel-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="9">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="9">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_NAME_BRAND)}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_NAME_BRANCH)}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="9"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="9" id="title-excel-food-cancel-report" style="background-color: #c5c5c5">@lang('app.sell-report.card7.title-excel') <span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card7.stt-table')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card7.employee-table')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card7.employee-role-table')</th>
        <th rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card7.food-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card7.quantity-table')</th>
        <th rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card7.price-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card7.total-amount-table')</th>
        <th rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card7.date-table')</th>
        <th rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card7.name-table')</th>
    </tr>
    <tr>
        <th class="total-quantity-card7" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-card7" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="9"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="9">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\sell\food_cancel\export.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
