<table class="d-none" id="table-export-detail-bill-manage">
    <thead>
    <tr>
        <th style="background-color: #a2c4c9;text-align: center" colspan="4">NHÀ HÀNG/CÔNG
            TY: {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr>
        <th colspan="4" class="text-center font-weight-bold" id="branch-export-detail-bill-manage">THƯƠNG HIỆU: <span id="brand-export-detail-bill-manage"></span> - CHI
            NHÁNH: <span id="export-branch-detail-bill-manage"></span></th>
    </tr>
    <tr>
        <th colspan="4" class="text-center font-weight-bold" id="address-export-detail-bill-manage"></th>
    </tr>
    <tr colspan="3"></tr>
    <tr>
        <th style="background-color: #c5c5c5;" colspan="4" rowspan="2" class="text-center size-h4 font-weight-bold">@lang('app.bill-manage.excel.text1')</th>
    </tr>
    <tr colspan="4"></tr>
    <tr>
        <th colspan="2" class="font-weight-bold">@lang('app.bill-manage.excel.text2')<span class="font-1-em" id="table-using-export-detail-bill-manage"></span></th>
        <th colspan="2" class="font-weight-bold">@lang('app.bill-manage.excel.text3')<span class="font-1-em" id="customer-export-detail-bill-manage"></span></th>
    </tr>
    <tr>
        <th colspan="4" class="font-weight-bold">@lang('app.bill-manage.excel.text4')<span class="font-1-em" id="cashier-export-detail-bill-manage"></span></th>
    </tr>
    <tr>
        <th colspan="4" class="font-weight-bold">@lang('app.bill-manage.excel.text5')<span class="font-1-em" id="employee-export-detail-bill-manage"></span></th>
    </tr>
    <tr>
        <th colspan="4" class="font-weight-bold">@lang('app.bill-manage.excel.text6')<span class="font-1-em" id="date-export-detail-bill-manage"></span></th>
    </tr>
    <tr colspan="4"></tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.excel.text7')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.excel.text8')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.excel.text9')</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;">@lang('app.bill-manage.excel.text10')</th>
    </tr>
    </thead>
    <tbody></tbody>
    <tfoot>
    <tr colspan="4"></tr>
    <tr>
        <th colspan="3" class="text-left font-weight-bold">@lang('app.bill-manage.excel.text11')</th>
        <th colspan="1" class="font-weight-bold" id="money-export-detail-bill-manage"></th>
    </tr>
    <tr>
        <th colspan="3" class="text-left font-weight-bold">@lang('app.bill-manage.excel.text12')</th>
        <th colspan="1" class="font-weight-bold" id="discount-export-detail-bill-manage"></th>
    </tr>
    <tr>
        <th colspan="3" class="text-left font-weight-bold">@lang('app.bill-manage.excel.text13')</th>
        <th colspan="1" class="font-weight-bold" id="vat-export-detail-bill-manage"></th>
    </tr>
{{--    <tr>--}}
{{--        <th colspan="3" class="text-left font-weight-bold">@lang('app.bill-manage.excel.text14')</th>--}}
{{--        <th colspan="1" class="font-weight-bold" id="point-export-detail-bill-manage"></th>--}}
{{--    </tr>--}}
    <tr>
        <th colspan="3" class="text-left font-weight-bold">Điểm nạp</th>
        <th colspan="1" class="font-weight-bold" id="point-export-detail-bill-manage"></th>
    </tr>
    <tr>
        <th colspan="3" class="text-left font-weight-bold">Điểm tích lũy</th>
        <th colspan="1" class="font-weight-bold" id="point-accumulate-export-detail-bill-manage"></th>
    </tr>
    <tr>
        <th colspan="3" class="text-left font-weight-bold">Điểm khuyến mãi</th>
        <th colspan="1" class="font-weight-bold" id="promotion-point-export-detail-bill-manage"></th>
    </tr>
    <tr>
        <th colspan="3" class="text-left font-weight-bold">Điểm value</th>
        <th colspan="1" class="font-weight-bold" id="alo-point-export-detail-bill-manage"></th>
    </tr>
    <tr>
        <th colspan="3" class="text-left font-weight-bold">@lang('app.bill-manage.excel.text15')</th>
        <th colspan="1" class="font-weight-bold" id="total-export-detail-bill-manage"></th>
    </tr>
    <tr colspan="4"></tr>
    <tr>
        <th colspan="4" class="text-center font-weight-bold">@lang('app.bill-manage.excel.text16')</th>
    </tr>
    <tr>
        <th colspan="4" class="text-center font-weight-bold" id="phone-export-detail-bill-manage">
            @if(Session::get(SESSION_KEY_LEVEL ) > 3)
                <label></label>
            @else
                (+84){{Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['phone']}}
            @endif
        </th>
    </tr>
    <tr>
        <th style="background-color: #0c343d !important; color: #fff;" colspan="4" class="text-center font-weight-bold">@lang('app.bill-manage.excel.text17')</th>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{asset('/js/manage/bill/excel.js?version=5',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
