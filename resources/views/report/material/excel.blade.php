<table class="d-none" id="table-export-report-material"
       style="display: block; overflow-x: auto; white-space: nowrap;">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="14">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="14" class="brand-export-report-material">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['name']}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="14"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="14" id="title-excel-material-report" style="background-color: #c5c5c5">BÁO CÁO NHẬP XUẤT KHO CHI NHÁNH - <span class="type-inventory-material-report"></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th style="background-color: #f2f2f2;vertical-align: middle;" rowspan="3">STT</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;" rowspan="3">Tên Nguyên liệu</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" rowspan="2">Tồn đầu</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="2">Nhập hàng</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="5">Xuất hàng</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" rowspan="2">Hủy hàng</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" rowspan="2">Tồn hệ thống</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="2">Ghi chú</th>
    </tr>
    <tr>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Chi nhánh khác</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Nhà cung cấp</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Chi nhánh khác</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Bếp</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Kho bia(Bar)</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">NVKD</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Nội bộ</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Bếp trả hàng</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;">Kho bia(Bar) trả hàng</th>
    </tr>
    <tr>
        <th class="total-amount-before-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-import-branch-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-import-supplier-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-export-branch-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-export-kitchen-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-export-bar-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-export-employee-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-export-inner-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-cancel-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-after-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-import-kitchen-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-import-bar-material" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    </thead>
    <tbody></tbody>
    <tfoot>
    <tr>
        <td style="height: 30px" colspan="14"></td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
            colspan="14">
            @lang('app.component.excel.text4')
        </td>
    </tr>
    </tfoot>
</table>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js\report\material\export.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
