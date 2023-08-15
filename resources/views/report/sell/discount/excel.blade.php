<table id="table-export-discount-report" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="11">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="11">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['name']}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="11"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="11" id="title-excel-discount-report" style="background-color: #c5c5c5">@lang('app.sell-report.card5.title-excel') <span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.sell-report.card5.stt-table')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">Mã</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Bàn</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Số khách</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Nhân viên</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Tổng bill</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Giảm giá</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Tiền giảm</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Thanh toán</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Ngày</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Ghi chú</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
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
    <script type="text/javascript" src="{{ asset('..\js\report\sell\discount\export.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
