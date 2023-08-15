<table class="d-none" id="table-export-report-inventory"
       style="display: block; overflow-x: auto; white-space: nowrap;">
    <thead>
    <tr style="height:30px; text-align: center">
        <th style="background-color: #a2c4c9;" colspan="11">@lang('app.component.excel.text1'): {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="11" class="export-report-checklist-inventory">@lang('app.component.excel.text2'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['name']}} -
            @lang('app.component.excel.text3'): {{Session::get(SESSION_KEY_DATA_CURRENT_BRANCH)['name']}}</th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="11"></th>
    </tr>
    <tr style="height:30px; text-align: center">
        <th colspan="11" id="title-excel-inventory-report" style="background-color: #c5c5c5">BÁO CÁO KIỂM KÊ KHO CHI NHÁNH - <span class="type-inventory-inventory-report"></span></th>
    </tr>
    <tr style="height:30px; text-align: center; font-weight: bold">
        <th style="background-color: #f2f2f2;vertical-align: middle;" rowspan="3">STT</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;" rowspan="3">Tên Nguyên liệu</th>
        <th style="background-color: #f2f2f2;vertical-align: middle;" rowspan="3">Danh mục</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="1">Tồn đầu</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="1">Nhập kho</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="1">Xuất kho</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="1">Trả hàng</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="1">Hủy hàng</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="1">Tồn hệ thống</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="1">Tồn thực tế</th>
        <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;" colspan="1">Chênh lệch kỳ</th>
    </tr>
    <tr>
        <th class="total-amount-open-inventory" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-import-inventory" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-export-inventory" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-return-inventory" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-cancel-inventory" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-after-inventory" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-check-inventory" style="background-color: #f2f2f2">
            <label></label>
        </th>
        <th class="total-amount-diff-inventory" style="background-color: #f2f2f2">
            <label></label>
        </th>
    </tr>
    <tr>
        <th class="total-quantity-open-inventory" style="background-color: #f2f2f2">
            Số lượng: <label></label>
        </th>
        <th class="total-quantity-import-inventory" style="background-color: #f2f2f2">
            Số lượng: <label></label>
        </th>
        <th class="total-quantity-export-inventory" style="background-color: #f2f2f2">
            Số lượng: <label></label>
        </th>
        <th class="total-quantity-return-inventory" style="background-color: #f2f2f2">
            Số lượng: <label></label>
        </th>
        <th class="total-quantity-cancel-inventory" style="background-color: #f2f2f2">
            Số lượng: <label></label>
        </th>
        <th class="total-quantity-after-inventory" style="background-color: #f2f2f2">
            Số lượng: <label></label>
        </th>
        <th class="total-quantity-check-inventory" style="background-color: #f2f2f2">
            Số lượng: <label></label>
        </th>
        <th class="total-quantity-diff-inventory" style="background-color: #f2f2f2">
            Số lượng: <label></label>
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
    <script type="text/javascript" src="{{ asset('..\js\report\inventory\export.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
