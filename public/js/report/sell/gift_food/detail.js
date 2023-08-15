let dataTableExportDetailBillManageEat,
    dataTableExportDetailBillManageReceipt,
    dataTableExportDetailBillManagePayment,
    idEmployeeDebitDetailBillManage,
    idBillDetailBillManage,
    accountingBillManage = -1,
    dataTableExportDetailBillManageFood,
    tableBonusPunish,
    thisBonusPunish,
    tableBill, bonusPointDetailBillManage,
    accumulatedPointDetailBillManage,
    discountPointDetailBillManage,
    valuePointDetailBillManage;

function openReportDetailFoodGift(r) {
    thisBonusPunish = r;
    idBillDetailBillManage = r.data('id');
    $('#modal-detail-food-gift').modal('show');
    dataBillDetail(r.data('id'));
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalDetailBillManage();
    });
    $('#loading-modal-detail-bill-manage .js-example-basic-single').select2({
        dropdownParent: $('#loading-modal-detail-bill-manage'),
    });
    $('#modal-detail-food-brand-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailBillManage();
        });
    });
    $('#modal-detail-receipts-bill').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailBillManage();
        });
    });
    $('#modal-history-bill').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailBillManage();
        });
    });

    $('#modal-detail-bill-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailEmployeeReport();
        });
    });

    $('.select-accounting-list-bill').on('select2:select', function () {
        $('.select-accounting-list-bill').val($(this).val()).trigger('change.select2');
        accountingBillManage = $(this).val();
        dataBillDetail(r.data('id'));
    });
}

async function dataBillDetail(id) {
    let method = 'GET',
        url = 'report-gift-food.detail',
        params = {
            id: id,
            accounting: accountingBillManage,
            is_cancel: thisBonusPunish.data('cancel'),
            is_print: thisBonusPunish.data('is-print'),
            branch : $('#change_branch').val(),
            restaurant_brands_id : thisBonusPunish.data('brand'),
            report_type: thisBonusPunish.data('type')

        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#table-detail-order thead"),
        $("#table-receipt-detail-bill-manage"),
        $("#table-payment-detail-bill-manage"),
        $("#boxlist-detail-bill-manage"),
    ])
    idEmployeeDebitDetailBillManage = res.data[4].employee_debt_id;

    //point order hide show
    bonusPointDetailBillManage = res.data[4].membership_point_used_amount;
    accumulatedPointDetailBillManage = res.data[4].membership_accumulate_point_used_amount;
    discountPointDetailBillManage = res.data[4].membership_promotion_point_used_amount;
    valuePointDetailBillManage = res.data[4].membership_alo_point_used_amount;
    $('#bonus-point-detail-bill-manage').text(res.data[4].membership_point_used_amount + '('+res.data[4].membership_point_used+' điểm)');
    $('#accumulated-point-detail-bill-manage').text(res.data[4].membership_accumulate_point_used_amount + '('+ res.data[4].membership_accumulate_point_used+' điểm)');
    $('#discount-point-detail-bill-manage').text(res.data[4].membership_promotion_point_used_amount + '('+ res.data[4].membership_promotion_point_used+' điểm)');
    $('#value-point-detail-bill-manage').text(res.data[4].membership_alo_point_used_amount + '('+ res.data[4].membership_alo_point_used+' điểm)');
    removeformatNumber(res.data[4].membership_point_used_amount) > 0 ? $('#bonus-point-detail-bill-manage-div').removeClass('d-none') : $('#bonus-point-detail-bill-manage-div').addClass('d-none');
    removeformatNumber(res.data[4].membership_accumulate_point_used_amount) > 0 ? $('#accumulated-point-detail-bill-manage-div').removeClass('d-none') : $('#accumulated-point-detail-bill-manage-div').addClass('d-none');
    removeformatNumber(res.data[4].membership_promotion_point_used_amount) > 0 ? $('#discount-point-detail-bill-manage-div').removeClass('d-none') : $('#discount-pointer-detail-bill-manage-div').addClass('d-none');
    removeformatNumber(res.data[4].membership_alo_point_used_amount) > 0 ? $('#value-point-detail-bill-manage-div').removeClass('d-none') : $('#value-pointer-detail-bill-manage-div').addClass('d-none');

    //info order
    $('#code-detail-bill-manage').text(res.data[4].code);
    $('#table-detail-bill-manage').text(res.data[4].table_name);
    $('#customer-detail-bill-manage').text(res.data[4].customer_slot_number);
    $('#id-cashier-detail-bill-manage').text(res.data[4].cashier_id);
    $('#cashier-detail-bill-manage').text(res.data[4].cashier_name);
    $('#id-employee-detail-bill-manage').text(res.data[4].employee_id);
    $('#employee-detail-bill-manage').text(res.data[4].employee_name);
    $('#id-employee-debt-detail-bill-manage').text(res.data[4].employee_debt_id);
    $('#employee-debt-detail-bill-manage').text(res.data[4].employee_debt_name);
    if(res.data[4].employee_debt_name !== ''){
        $('#employee-debt-detail-bill-manage-div').removeClass('d-none')
    }
    $('#note-detail-bill-manage').text(res.data[4].note);
    $('#in-detail-bill-manage').text(res.data[4].created_at);
    $('#out-detail-bill-manage').text(res.data[4].updated_at);
    $('#date-detail-bill-manage').text(res.data[4].date);
    $('#money-detail-bill-manage').text(res.data[4].cash_amount);
    $('#total-amount-detail-bill-treasurer').text(res.data[5].total_amount);
    $('#discount-detail-bill-manage').text(res.data[4].discount);
    $('#vat-detail-bill-manage').text(res.data[4].vat_amount);
    // $('#point-detail-bill-manage').text(formatNumber(accumulate+promotion+point+alo));
    $('#total-detail-bill-manage').text(res.data[4].total_amount);
    $('#original-price-detail-bill-manage').text(res.data[4].original_price);
    $('#rate-profit-detail-bill-manage').text(res.data[4].rate_profit);
    $('#status-detail-bill-manage').text(res.data[4].status);
    $('#branch-phone-detail-bill-manage').text(res.data[4].branch_phone);
    $('#branch-address-detail-bill-manage').text(res.data[4].branch_address);
    $('#branch-name-detail-bill-manage').text(res.data[4].branch_name);
    $('#total-record-food-detail-bill-manage').text(res.data[4].total_record_food);
    $('#total-record-receipt-detail-bill-manage').text(res.data[4].total_record_receipt);
    $('#total-record-payment-detail-bill-manage').text(res.data[4].total_record_payment);
    $('#total-receipt-detail-bill-manage').text(res.data[4].total_receipt);
    $('#total-payment-detail-bill-manage').text(res.data[4].total_payment);
    $('#total-point-detail-bill-manage').html(`Điểm nạp: ${res.data[4].membership_point_used} ( ${res.data[4].membership_point_used_amount} VNĐ)<br>Điểm tích luỹ: ${res.data[3].membership_accumulate_point_used} ( ${res.data[3].membership_accumulate_point_used_amount} VNĐ)<br>Điểm khuyến mãi: ${res.data[3].membership_promotion_point_used} ( ${res.data[3].membership_promotion_point_used_amount} VNĐ)<br>Điểm Value: ${res.data[3].membership_alo_point_used} ( ${res.data[3].membership_alo_point_used_amount} VNĐ)`);

    tableDetailBillManage(res);
}

async function tableDetailBillManage(data) {
    let id1 = $('#table-detail-order'),
        id2 = $('#table-receipt-detail-bill-manage'),
        id3 = $('#table-payment-detail-bill-manage'),
        id4 = $('#table-detail-order-export'),
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'food_name', name: 'food_name'},
            {data: 'category_food', name: 'category_food', className: 'text-center'},
            {data: 'original_price', name: 'original_price', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'unit_price', name: 'unit_price', className: 'text-center'},
            {data: 'total_price', name: 'total_price', className: 'text-center'},
            // {data: 'vat_percent', name: 'vat_percent', className: 'text-center'},
            {data: 'vat_amount', name: 'vat_amount', className: 'text-center'},
            // {data: 'note', name: 'note', className: 'text-center'},
            {data: 'status', name: 'status', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'object_name', className: 'text-center'},
            {data: 'note', className: 'text-center'},
            {data: 'addition_fee_reason_name', className: 'text-center'},
            {data: 'fee_month', className: 'text-center'},
            {data: 'amount', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [],
        scroll_Y = "40vh",
        fixed_left = 0,
        fixed_right = 0;
    dataTableExportDetailBillManageEat = await DatatableTemplateNew(id1, data.data[0].original.data, column1, scroll_Y, fixed_left, fixed_right,option);
    dataTableExportDetailBillManageReceipt = await DatatableTemplateNew(id2, data.data[2].original.data, column2, scroll_Y, fixed_left, fixed_right,option);
    dataTableExportDetailBillManagePayment = await DatatableTemplateNew(id3, data.data[3].original.data, column2, scroll_Y, fixed_left, fixed_right,option);
    dataTableExportDetailBillManageFood = await DatatableTemplateNew(id4, data.data[1].original.data, column1, scroll_Y, fixed_left, fixed_right,option);
    $(document).on('input paste', '#loading-modal-detail-bill-manage input[type="search"]', async function () {
        $('#total-record-food-detail-bill-manage').text(dataTableExportDetailBillManageEat.rows({'search': 'applied'}).count())
        $('#total-record-receipt-detail-bill-manage').text(dataTableExportDetailBillManageReceipt.rows({'search': 'applied'}).count())
        $('#total-record-payment-detail-bill-manage').text(dataTableExportDetailBillManagePayment.rows({'search': 'applied'}).count())
        let tableDetailBillManageReceipt = await searchTableDetailBillManage(dataTableExportDetailBillManageReceipt),
            tableDetailBillManagePayment = await searchTableDetailBillManage(dataTableExportDetailBillManagePayment),
            tableDetailBillManageEat = await searchTableDetailBillManage(dataTableExportDetailBillManageEat)
        $('#total-receipt-detail-bill-manage').text(formatNumber(tableDetailBillManageReceipt))
        $('#total-payment-detail-bill-manage').text(formatNumber(tableDetailBillManagePayment))
        $('#total-amount-detail-bill-treasurer').text(formatNumber(tableDetailBillManageEat))
    })
}

function searchTableDetailBillManage(datatable){
    let totalAmount = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(6)').text());
    })
    return totalAmount
}

function openDetailCashier() {
    let id = $('#id-cashier-detail-bill-manage').text();
    openModalDetailEmployeeManageInBillDetail(id);
}

function openDetailEmployee() {
    let id = $('#id-employee-detail-bill-manage').text();
    openModalDetailEmployeeManageInBillDetail(id);
}

function openDetailEmployeeDebit() {
    openModalDetailEmployeeManageInBillDetail(idEmployeeDebitDetailBillManage);
}

function openModalDetailEmployeeManageInBillDetail(id) {
    $('#modal-bill-detail-employee-manage').modal('show');
    dataDetailEmployeeBillManage(id);
}

async function dataDetailEmployeeBillManage(id) {
    let method = 'get',
        url = 'employee-manage.detail',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#name-detail-employee-manage').text(res.data[0].name);
    $('#birthday-detail-employee-manage').text(res.data[0].birthday);
    $('#gender-detail-employee-manage').text(res.data[0].gender);
    $('#phone-detail-employee-manage').text(res.data[0].phone);
    $('#email-detail-employee-manage').text(res.data[0].email);
    $('#birthplace-detail-employee-manage').text(res.data[0].birth_place);
    $('#passport-detail-employee-manage').text(res.data[0].passport);
    $('#address-detail-employee-manage').text(res.data[0].address);
    $('#branch-detail-employee-manage').text(res.data[0].branch);
    $('#role-detail-employee-manage').text(res.data[0].role);
    $('#rank-detail-employee-manage').text(res.data[0].rank);
    $('#work-detail-employee-manage').text(res.data[0].work);
    $('#point-detail-employee-manage').text(res.data[0].point);
    $('#salary-detail-employee-manage').text(res.data[0].salary);
    $('#area-detail-employee-manage').text(res.data[0].area);
    $('#area-control-detail-employee-manage').text(res.data[0].area_control);
    $('#avatar-detail-employee-manage').attr('src', res.data[0].avatar);
    $('#color-detail-employee-manage').addClass(res.data[0].color);
    $('#status-detail-employee-manage').html(res.data[0].status);
    $('#box-point-detail-manage').addClass('d-none');
    dataTableDetailEmployeeManage(res);
    dataTotalDetailEmployeeManage(res.data[3]);
}
async function dataTableDetailEmployeeManage(data) {
    let id1 = $('#table-employee-manage-detail-tab1'),
        id2 = $('#table-employee-manage-detail-tab2'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'type', name: 'type', className: 'text-center'},
            {data: 'bonus', name: 'bonus', className: 'text-center', width: '20%'},
            {data: 'punish', name: 'punish', className: 'text-center', width: '20%'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-center', width : '20%'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center', width: '20%'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],option = []
    tableBonusPunish = await DatatableTemplateNew(id1, data.data[1].original.data, column1, scroll_Y, fixed_left, fixed_right,option);
    tableBill = await DatatableTemplateNew(id2, data.data[2].original.data, column2, scroll_Y, fixed_left, fixed_right,option);
}


function dataTotalDetailEmployeeManage(data) {
    $('#total-record-bonus-punish-employee-manage').text(data.total_record_bonus_punish);
    $('#total-record-bill-employee-manage').text(data.total_record_bill);
    $('#total-bonus-detail-employee-manage').text(data.total_bonus);
    $('#total-punish-detail-employee-manage').text(formatNumber(Math.abs(removeformatNumber(data.total_punish))));
    $('#total-amount-bill-detail-employee-manage').text(data.total_bill);
}

function closeModalDetailEmployeeManageInBillDetail() {
    $('#modal-bill-detail-employee-manage').modal('hide');
    reloadModalDetailEmployeeManageInBillDetail();
}

function reloadModalDetailEmployeeManageInBillDetail(){
    $('.reset-data-detail-employee-manage').html('');
    $('#avatar-detail-employee-manage').attr('src', '');
}

function closeModalDetailBillManage() {
    $('#modal-detail-food-gift').modal('hide');
    reloadModalDetailBillManage()
}

function reloadModalDetailBillManage(){
    $("#loading-modal-detail-bill-manage").scrollTop(0);
    $('#code-detail-bill-manage').text('---');
    $('#table-detail-bill-manage').text('---');
    $('#customer-detail-bill-manage').text('---');
    $('#id-cashier-detail-bill-manage').text('');
    $('#cashier-detail-bill-manage').text('---');
    $('#id-employee-detail-bill-manage').text('');
    $('#employee-detail-bill-manage').text('---');
    $('#id-employee-debt-detail-bill-manage').text('');
    $('#employee-debt-detail-bill-manage').text('---');
    $('#note-detail-bill-manage').text('---');
    $('#in-detail-bill-manage').text('---');
    $('#out-detail-bill-manage').text('---');
    $('#date-detail-bill-manage').text('---');
    $('#money-detail-bill-manage').text('---');
    $('#discount-detail-bill-manage').text('---');
    $('#vat-detail-bill-manage').text('---');
    $('#point-detail-bill-manage').text('---');
    $('#total-detail-bill-manage').text('---');
    $('#status-detail-bill-manage').text('');
    $('#branch-phone-detail-bill-manage').text('');
    $('#branch-address-detail-bill-manage').text('');
    $('#branch-name-detail-bill-manage').text('');
    $('#total-record-food-detail-bill-manage').text(0);
    $('#total-record-receipt-detail-bill-manage').text(0);
    $('#total-record-payment-detail-bill-manage').text(0);
    $('#total-receipt-detail-bill-manage').text('');
    $('#total-payment-detail-bill-manage').text('');
    $('.select-accounting-list-bill').val(-1).trigger('change.select2');
    $('#bonus-point-detail-bill-manage-div').addClass('d-none')
    $('#accumulated-point-detail-bill-manage-div').addClass('d-none')
    $('#discount-point-detail-bill-manage-div').addClass('d-none')
    $('#value-point-detail-bill-manage-div').addClass('d-none')
    $('#employee-debt-detail-bill-manage-div').addClass('d-none')

    accountingBillManage = -1;
    dataTableExportDetailBillManageEat.clear().draw(false);
    dataTableExportDetailBillManageReceipt.clear().draw(false);
    dataTableExportDetailBillManagePayment.clear().draw(false);
}
