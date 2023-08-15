<table id="table-export-profit-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="8">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="8">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_NAME_BRAND)}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_NAME_BRANCH)}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="8"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="8" id="title-excel-profit-report" style="background-color: #c5c5c5">@lang('app.profit-report.title-excel')<span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <td rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.profit-report.stt-table')</td>
        <td rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.profit-report.name-table')</td>
        <td rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.profit-report.type-table')</td>
        <td style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.profit-report.quantity-table')</td>
        <td style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.profit-report.total-original-table')</td>
        <td style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.profit-report.total-row-table')</td>
        <td style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.profit-report.profit-table')</td>
        <td rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.profit-report.profit-rate-table')</td>
    </tr>
    <tr>
        <th class="total-quantity" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-original" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-revenue" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-profit" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="8"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="8">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\profit\export.js?version=3')}}"></script>
@endpush
