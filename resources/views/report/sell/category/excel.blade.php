<table id="table-export-category-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="6">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="6" id="brand-export-category-report">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['name']}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="6"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="6" id="title-excel-category-report" style="background-color: #c5c5c5">@lang('app.sell-report.card1.title-excel')<span></span></th>
    </tr>
    <tr style="height:30px; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card1.stt-table')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;text-align: left">@lang('app.sell-report.card1.name-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;text-align: right">@lang('app.sell-report.card1.total-original-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;text-align: right">@lang('app.sell-report.card1.total-money-table')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;text-align: right">@lang('app.sell-report.card1.profit-table')</th>
        <th rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;text-align: center">@lang('app.sell-report.card1.profit-rate-table')</th>
    </tr>
    <tr>
        <th id="total-original-sell-category-report" style="background-color: #f2f2f2; text-align: right">
            <label></label>
        </th>
        <th id="total-money-sell-category-report" style="background-color: #f2f2f2; text-align: right">
            <label></label>
        </th>
        <th id="total-profit-sell-category-report" style="background-color: #f2f2f2; text-align: right">
            <label></label>
        </th>
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
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\sell\category\export.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
