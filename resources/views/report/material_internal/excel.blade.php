<table id="table-export-material-internal-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="10">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="10" class="brand-export-material-internal-report">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['name']}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="10"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="10" id="title-excel-material-internal-report" style="background-color: #c5c5c5">BÁO CÁO NHẬP XUẤT KHO BỘ PHẬN - <span class="type-inventory-material-internal-report"></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <td style="background-color: #f2f2f2;text-align: left">@lang('app.material-internal-report.stt')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.material-internal-report.name')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.material-internal-report.before')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.material-internal-report.import')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.material-internal-report.export')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.material-internal-report.return')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.material-internal-report.cancel')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.material-internal-report.wastage-rate')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.material-internal-report.wastage-allow')</td>
        <td style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.material-internal-report.current-quantity')</td>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="10"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="10">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\material_internal\export.js?version=1')}}"></script>
@endpush
