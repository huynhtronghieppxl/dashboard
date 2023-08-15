<table class="d-none" id="table-export-report-inventory-internal"
       style="display: block; overflow-x: auto; white-space: nowrap;">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="11">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="11" class="export-report-checklist-inventory-internal">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['name']}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="11"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="11" id="title-excel-inventory-internal-report" style="background-color: #c5c5c5">@lang('app.inventory-internal-report.title-excel') - <span class="type-report-checklist-inventory-internal"></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th style="background-color: #f2f2f2;vertical-align: middle;" rowspan="2">@lang('app.inventory-internal-report.stt')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;" rowspan="2">@lang('app.inventory-internal-report.name')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;" rowspan="2">@lang('app.inventory-internal-report.category')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-internal-report.open')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-internal-report.import')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-internal-report.export')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-internal-report.cancel')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-internal-report.wastage')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-internal-report.after')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-internal-report.check')</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.inventory-internal-report.diff')</th>
    </tr>
    <tr>
        <th class="total-quantity-open-bar" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-quantity-import-bar" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-quantity-export-bar" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-quantity-cancel-bar" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-quantity-wastage-bar" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-quantity-after-bar" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-quantity-check-bar" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-quantity-diff-bar" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody></tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="11"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="11">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\inventory_internal\export.js?version=1')}}"></script>
@endpush
