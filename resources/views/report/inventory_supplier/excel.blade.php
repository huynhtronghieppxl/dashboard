<table id="table-export-inventory-supplier-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="7">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7" class="export-inventory-supplier-report-brand">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['name']}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="7" id="title-excel-inventory-supplier-report" style="background-color: #c5c5c5">@lang('app.inventory-supplier-report.excel.title')<span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <td rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-supplier-report.stt')</td>
        <td rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-supplier-report.name')</td>
        <td rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-supplier-report.category')</td>
        <td rowspan="2" style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-supplier-report.inventory')</td>
        <td rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-supplier-report.accept-quantity')</td>
        <td rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-supplier-report.small-quantity')</td>
        <td style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-supplier-report.amount')</td>
    </tr>
    <tr>
        <th class="total-amount-inventory-supplier" style="background-color: #f2f2f2">
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
    <script type="text/javascript" src="{{ asset('..\js\report\inventory_supplier\export.js?version=2')}}"></script>
@endpush
