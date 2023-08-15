<table id="table-export-bill-manage" class="d-none">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="16">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="16">@lang('app.component.excel.text2'): <span id="brand-excel-bill-manage"></span> -
            @lang('app.component.excel.text3'): <span id="branch-excel-bill-manage"></span>
        </th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="16"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="16" id="title-excel-bill-manage" style="background-color: #c5c5c5">@lang('app.bill-manage.title-excel')<span></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.stt')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.code')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.name-table')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.employee-table')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.customer')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.amount-table')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.vat-table')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.discount-table')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.point-table')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">Số khách</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.total-amount-table')</th>
        <th  style="background-color: #f2f2f2;vertical-align: middle;">Tích luỹ điểm</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.original-price')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.profit-rate')</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">Ngày thanh toán</th>
        <th rowspan="2" style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.bill-status-table')</th>
    </tr>
    <tr>
{{--        tam tinh--}}
        <th id="amount-bill-detail-export" style="background-color: #f2f2f2">

        </th>
{{--        vat--}}
        <th id="total-vat-detail-export" style="background-color: #f2f2f2">

        </th>
{{--        giam gia--}}
        <th id="total-discount-detail-export" style="background-color: #f2f2f2">

        </th>
{{--        su dung diem--}}
        <th id="total-point-detail-export" style="background-color: #f2f2f2">

        </th>
        {{--        số khách--}}
        <th id="total-slot-customer-detail-export" style="background-color: #f2f2f2">

        </th>
{{--        thanh toan--}}
        <th id="total-amount-detail-export" style="background-color: #f2f2f2">

        </th>
{{--        tich luy diem--}}
        <th id="total-amount-accumulated-detail-export" style="background-color: #f2f2f2">

        </th>
        {{--     gia von--}}
        <th id="total-amount-original-detail-export" style="background-color: #f2f2f2">

        </th>


{{--        lợi nhuận--}}
        <th id="total-average-profit-detail-export" style="background-color: #f2f2f2">

        </th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="16"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="16">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\manage\bill\export\export.js?version=2',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
