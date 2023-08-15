<table id="table-export-sell-order-report-by-time" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="8">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th id="brand-export-sell-order-report-by-time" colspan="8">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['name']}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="8"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="8" id="title-excel-sell-order-report-by-time" style="background-color: #c5c5c5">BÁO CÁO DOANH THU BÁN HÀNG THEO THỜI GIAN</th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th>@lang('app.sell-report.card2.stt-table')</th>
        <th>Nội dung</th>
        <th>Đơn hàng</th>
        <th>Doanh thu bán hàng (Chưa VAT)</th>
        <th>Tiền VAT thu của khách</th>
        <th>Doanh thu bán hàng (Có VAT)</th>
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
    <script type="text/javascript" src="{{ asset('js/report/order/export.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
