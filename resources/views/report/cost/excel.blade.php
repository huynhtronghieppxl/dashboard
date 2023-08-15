<table id="table-export-cost-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="3">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="3">@lang('app.component.excel.text2'): <span id="brand-excel-cost"></span> -
            @lang('app.component.excel.text3'): <span id="branch-excel-cost"></span></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="3">THỜI GIAN: <span id="time-excel-cost"></span></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="3"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="3" id="title-excel-cost-report" style="background-color: #c5c5c5">@lang('app.cost-report.excel.text4')<span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.cost-report.stt')</th>
        <th rowspan="2" style="width: 400px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.cost-report.name')</th>
        <th style="width: 200px;background-color: #f2f2f2;vertical-align: middle;">@lang('app.cost-report.amount')</th>
    </tr>
    <tr>
        <th class="total-amount-cost-report" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="3"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="3">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\cost\export.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
