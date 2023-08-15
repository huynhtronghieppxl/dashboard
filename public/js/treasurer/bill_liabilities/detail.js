let idDetailBillLiabilitiesTreasurer,
    nameDetailBillLiabilities,
    isAlreadyLoadedInventoryReceivingVoucher = 0,
    isAlreadyLoadedOptReasonPaymentDetail = 0,
    isPaidDebtInventoryReceivingVoucher = [],
    isNotPaidDebtInventoryReceivingVoucher = [],
    optReasonPaymentDetail = '',
    dataReasonCreateBillLiabilities = 0,
    checkOpenPaymentBillLiabilities = 0,
    tablePaymentDetailBillLiabilitiesWaitPay = '',
    tablePaymentDetailBillLiabilitiesPaying = '',
    tablePaymentDetailBillLiabilitiesCancel = '',
    tablePaymentDetailBillLiabilitiesDebt = '',
    tablePaymentDetailBillLiabilitiesOrderReturn = '',
    loadingTabWaitPay = 0, loadingTabPaying = 0, loadingTabCancel = 0, loadingTabDebt = 0, loadingTabOrderReturn = 0,
    branchId, brand, from, to, tabCurrent = 0, pageTabWaitPay, pageTabPaying, pageTabCancel, pageTabDebt, pageTabOrderReturn, limit,
    saveRetentionMoneyBillLiabilities,
    fixedLeftTable = 0,
    fixedRightTable = 0,
    optionRenderTable = [], typeTabWaitPay, typeTabPaying, typeTabDebt, typeTabOrderReturn;

$(function (){
    $('#detail-supplier-treasurer').on('click', function (){
        openDetailSupplierManage(idDetailBillLiabilitiesTreasurer)
    })
    $('#payment-bill-liabilities').on('click', function () {
        $('#save-payment-bill-liabilities').removeClass('d-none')
    })
    $('#detail-bill-liabilities').on('click', function () {
        $('#save-payment-bill-liabilities').addClass('d-none')
    })
})

function openDetailBillLiabilities(r) {
    $('#modal-detail-bill-liabilities-treasurer').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailBillLiabilities();
    });
    $('#modal-detail-order-supplier-order').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailBillLiabilities();
        });
    });
    $('#modal-detail-bill-liabilities-treasurer-title span').text(r.data('name'))
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailOrderSupplierOrder();
        });
    })
    $('#select-type-detail-bill-liabilities, #select-status-detail-bill-liabilities, #select-value-detail-bill-liabilities').select2({
        dropdownParent: $('#modal-detail-bill-liabilities-treasurer')
    });
    dateTimePickerTemplate($('#date-detail-bill-liabilities'), null, $('#date-detail-bill-liabilities'));
    vh_of_table = '40vh';
    fixedLeftTable = 0;
    fixedRightTable = 0;
    optionRenderTable = [];
    tablePaymentDetailBillLiabilitiesWaitPay = '';
    tablePaymentDetailBillLiabilitiesPaying = '';
    tablePaymentDetailBillLiabilitiesCancel = '';
    tablePaymentDetailBillLiabilitiesDebt = '';
    saveRetentionMoneyBillLiabilities = 0;
    idDetailBillLiabilitiesTreasurer = r.data('id');
    loadingTabWaitPay = 0;
    loadingTabPaying = 0;
    loadingTabCancel = 0;
    loadingTabDebt = 0;
    limit = $('#data-table-length').val();
    typeTabWaitPay = 1;
    typeTabPaying = 2;
    typeTabCancel = 3;
    typeTabDebt = 4;
    typeTabOrderReturn = 5;
    pageTabWaitPay = 1;
    pageTabPaying = 1;
    pageTabCancel = 1;
    pageTabDebt = 1;
    pageTabOrderReturn = 1;
    branchId = $('.select-branch').val();
    from = $('#from-date-bill-liabilities').val();
    to = $('#to-date-bill-liabilities').val();
    brand =  $('.select-brand').val();
    $('#accounting-detail-bill-liabilities').prop('checked', true);
    savePaymentBillLiabilities = 0;
    $('#select-status-detail-bill-liabilities').unbind('select2:select').on('select2:select', function () {
        dataTablePaymentDetailBillLiabilities();
    });
    $(document).on('change', '.checkbox-order-retention-money-bill-liabilities', function () {
        let title = 'Đổi trạng thái Nợ gối đầu?',
            content = '',
            icon = 'question';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                changeRetentionBillLiabilities($(this).val());
            } else {
                if ($(this).prop('checked') === true) {
                    $(this).prop('checked', false);
                } else {
                    $(this).prop('checked', true);
                }
            }
        })
    });
    $('#total-record-order-return').text(r.parents('tr').find('td:eq(3) .number-order').text().trim().replace('đơn hàng', ''));
    changeTabPaymentBill(1);
    dataTablePaymentDetailBillLiabilities();
}

async function loadingData() {
    switch (tabCurrent) {
        case 0:
            loadingTabWaitPay = 1;
            loadingTabPaying = 0;
            loadingTabCancel = 0;
            loadingTabDebt = 0;
            tablePaymentDetailBillLiabilitiesWaitPay.clear().draw(false);
            tablePaymentDetailBillLiabilitiesWaitPay.ajax.url("order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabWaitPay + "&page=" + pageTabWaitPay + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand).load();
            break;
        case 1:
            loadingTabWaitPay = 0;
            loadingTabPaying = 1;
            loadingTabCancel = 0;
            loadingTabDebt = 0;
            tablePaymentDetailBillLiabilitiesPaying.clear().draw(false);
            tablePaymentDetailBillLiabilitiesPaying.ajax.url("order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabPaying + "&page=" + pageTabPaying + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + 1).load();
            break;
        case 2:
            loadingTabWaitPay = 0;
            loadingTabPaying = 0;
            loadingTabCancel = 1;
            loadingTabDebt = 0;
            tablePaymentDetailBillLiabilitiesCancel.clear().draw(false);
            tablePaymentDetailBillLiabilitiesCancel.ajax.url("order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabCancel + "&page=" + pageTabCancel + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand).load();
            break;
        case 3:
            loadingTabWaitPay = 0;
            loadingTabPaying = 0;
            loadingTabCancel = 0;
            loadingTabDebt = 1;
            tablePaymentDetailBillLiabilitiesDebt.clear().draw(false);
            tablePaymentDetailBillLiabilitiesDebt.ajax.url("order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabDebt + "&page=" + pageTabDebt + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand).load();
            break;
    }
}

async function changeTabPaymentBill(tab) {
    tabCurrent = tab;
    switch (tab) {
        case 1:
            if (tablePaymentDetailBillLiabilitiesWaitPay === '') {
                loadDataWaitPay();
                loadingTabWaitPay = 1;
            } else if (loadingTabWaitPay === 0){
                tablePaymentDetailBillLiabilitiesWaitPay.clear().draw(false);
                await tablePaymentDetailBillLiabilitiesWaitPay.ajax.url("order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabWaitPay + "&page=" + pageTabWaitPay + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand).load();
            }
            break;
        case 2:
            if (tablePaymentDetailBillLiabilitiesPaying === '') {
                loadDataPaying();
                loadingTabPaying = 1;
            } else if (loadingTabPaying === 0){
                tablePaymentDetailBillLiabilitiesPaying.clear().draw(false);
                await tablePaymentDetailBillLiabilitiesPaying.ajax.url("order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabPaying + "&page=" + pageTabPaying + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand).load();
            }
            break;
        case 3:
            if (tablePaymentDetailBillLiabilitiesCancel === '') {
                loadDataCancel();
                loadingTabCancel = 1;
            } else if (loadingTabCancel === 0){
                tablePaymentDetailBillLiabilitiesCancel.clear().draw(false);
                await tablePaymentDetailBillLiabilitiesCancel.ajax.url("order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabCancel + "&page=" + pageTabCancel + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand).load();
            }
            break;
        case 4:
            if (tablePaymentDetailBillLiabilitiesDebt === '') {
                loadDataDebt();
                loadingTabDebt = 1;
            } else if (loadingTabDebt === 0){
                tablePaymentDetailBillLiabilitiesDebt.clear().draw(false);
                await tablePaymentDetailBillLiabilitiesDebt.ajax.url("order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabDebt + "&page=" + pageTabDebt + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand).load();
            }
            break;
    }
}

async function loadDataWaitPay() {
    loadingTabWaitPay = 1;
    let id = $("#table-bill-liabilities2"),
        url = "order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabWaitPay + "&page=" + pageTabWaitPay + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand,
        columns = [
            {data: 'index', name: 'index', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left', width: '20%'},
            {data: 'employee_complete', name: 'employee_full_name', className: 'text-left  col-name-avatar', width: '30%'},
            {data: 'received_at', name: 'received_at', className: 'text-center',  width: '15%'},
            {data: 'total_amount_reality', name: 'total_amount_reality', className: 'text-right',  width: '15%'},
            {data: 'retention_money', name: 'retention_money', className: 'text-center', width: '10%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ]
    tablePaymentDetailBillLiabilitiesWaitPay = await DatatableServerSideTemplateNew(id, url, columns, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, function (response){
        console.log(response)
        $('#total-record-pending').text(response.count_waiting);
        $('#total-record-complete').text(response.count_paid);
        $('#total-record-cancel').text(response.count_cancel);
        $('#total-record-liabilities').text(response.count_debt);
        $('#total-pending').text(response.totalAmount);
        $('#payment-bill-liabilities').addClass('d-none');
        if (removeformatNumber(response.count_waiting) + removeformatNumber(response.count_debt) > 0) $('#payment-bill-liabilities').removeClass('d-none');


    });
    $('#table-bill-liabilities2').on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    });
}

async function loadDataPaying() {
    loadingTabPaying = 1;
    let id = $("#table-bill-liabilities1"),
        url = "order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabPaying + "&page=" + pageTabPaying + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand,
        columns = [
            {data: 'index', name: 'index', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left', width: '20%'},
            {data: 'employee_complete', name: 'employee_full_name',className: 'text-left col-name-avatar' , width: '30%'},
            {data: 'received_at', name: 'received_at', className: 'text-center', width: '20%'},
            {data: 'total_amount_reality', name: 'total_amount_reality', className: 'text-right', width: '20%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ]
    tablePaymentDetailBillLiabilitiesPaying = await DatatableServerSideTemplateNew(id, url, columns, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, function (response) {
        console.log(response)
        $('#total-record-pending').text(response.count_waiting);
        $('#total-record-complete').text(response.count_paid);
        $('#total-record-cancel').text(response.count_cancel);
        $('#total-record-liabilities').text(response.count_debt);
        $('#payment-bill-liabilities').addClass('d-none');
        $('#total-complete').text(response.totalAmount);
        if (removeformatNumber(response.count_waiting) + removeformatNumber(response.count_debt) > 0) $('#payment-bill-liabilities').removeClass('d-none');
    });

    $('#table-bill-liabilities1').on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    });
}

async function loadDataCancel() {
    loadingTabCancel = 1;
    let id = $("#table-bill-liabilities3"),
        url = "order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabCancel + "&page=" + pageTabCancel + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand,
        columns = [
            {data: 'index', name: 'index', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left', width: '20%'},
            {data: 'employee_cancel_full_name', name: 'employee_full_name', className: 'text-left col-name-avatar', width: '30%'},
            {data: 'updated_at', name: 'updated_at', className: 'text-center', width: '20%'},
            {data: 'total_amount_reality', name: 'total_amount_reality', className: 'text-right', width: '20%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ]
    tablePaymentDetailBillLiabilitiesCancel = await DatatableServerSideTemplateNew(id, url, columns, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, function (response){
        $('#total-record-pending').text(response.count_waiting);
        $('#total-record-complete').text(response.count_paid);
        $('#total-record-cancel').text(response.count_cancel);
        $('#total-record-liabilities').text(response.count_debt);
        $('#payment-bill-liabilities').addClass('d-none');
        $('#total-cancel').text(response.totalAmount);
        if (removeformatNumber(response.count_waiting) + removeformatNumber(response.count_debt) > 0) $('#payment-bill-liabilities').removeClass('d-none');
    });

    $('#table-bill-liabilities3').on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    });
}

async function loadDataDebt() {
    loadingTabDebt = 1;
    let id = $("#table-bill-liabilities4"),
        url = "order-bill-treasurer.order?from=" + from + "&to=" + to + "&branch_id=" + branchId + "&type=" + typeTabDebt + "&page=" + pageTabDebt + "&limit=" + limit + "&id=" + idDetailBillLiabilitiesTreasurer + "&brand=" + brand,
        columns = [
            {data: 'index', name: 'index', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left', width: '20%'},
            {data: 'employee_complete', name: 'employee_full_name', className: 'text-left', width: '30%'},
            {data: 'received_at', name: 'received_at', className: 'col-name-avatar', width: '15%'},
            {data: 'total_amount_reality', name: 'total_amount_reality', className: 'text-right', width: '15%'},
            {data: 'retention_money', name: 'retention_money', className: 'text-center', width: '10%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%',},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ]
    tablePaymentDetailBillLiabilitiesDebt = await DatatableServerSideTemplateNew(id, url, columns, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, function (response){
        console.log(response)
        $('#total-record-pending').text(response.count_waiting);
        $('#total-record-complete').text(response.count_paid);
        $('#total-record-cancel').text(response.count_cancel);
        $('#total-record-liabilities').text(response.count_debt);
        $('#payment-bill-liabilities').addClass('d-none');
        $('#total-liabilities').text(response.totalAmount);
        if (removeformatNumber(response.count_waiting) + removeformatNumber(response.count_debt) > 0) $('#payment-bill-liabilities').removeClass('d-none');
    });
    $('#table-bill-liabilities4').on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    });
}

async function changeRetentionBillLiabilities(id) {
    if (saveRetentionMoneyBillLiabilities !== 0) return false;
    saveRetentionMoneyBillLiabilities = 1;
    let method = 'post',
        url = 'order-bill-treasurer.retention-money',
        params = null,
        data = {
            id: id,
        };
    let res = await axiosTemplate(method, url, params, data);
    saveRetentionMoneyBillLiabilities = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status) {
        case 200:
            dataTablePaymentDetailBillLiabilities();
            SuccessNotify(text);
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            WarningNotify(text);
    }
}

function closeModalDetailBillLiabilities() {
    shortcut.remove("ESC");
    isAlreadyLoadedInventoryReceivingVoucher = 0;
    isAlreadyLoadedOptReasonPaymentDetail = 0;
    isPaidDebtInventoryReceivingVoucher = [];
    isNotPaidDebtInventoryReceivingVoucher = [];
    optReasonPaymentDetail = '';
    checkOpenPaymentBillLiabilities = 0;
    resetModalDetailBillLiabilities();
    removeAllValidate();
    countCharacterTextarea()
}
function resetModalDetailBillLiabilities(){
    $('#total-record-pending').text(0);
    $('#total-record-complete').text(0);
    $('#total-record-cancel').text(0);
    $('#total-record-liabilities').text(0);
    $('#name-detail-bill-liabilities').text('');
    $('#type-detail-bill-liabilities').text('');
    $('#phone-detail-bill-liabilities').text('');
    $('#address-detail-bill-liabilities').text('');
    $('#website-detail-bill-liabilities').text('');
    $('#email-detail-bill-liabilities').text('');
    $('#tax-detail-bill-liabilities').text('');
    $('#value-detail-bill-liabilities').text(0);
    $('#original-price-payment-bill-liabilities').text(0);
    $('#return-price-payment-bill-liabilities').text(0);
    $('#description-detail-bill-liabilities').val('');
    $('#create-detail-liabilities-treasurer').addClass('d-none');
    $('#detail-bill-liabilities').addClass('d-none');
    $('#save-payment-bill-liabilities').addClass('d-none');
    $('#sub-detail-liabilities-treasurer').removeClass('d-none');
    $('#payment-bill-liabilities').removeClass('d-none');
    $('input[type=checkbox]').prop('checked', true);
    $('#modal-detail-bill-liabilities-treasurer').modal('hide');
    $('a[href="#bill-liabilities-tab2"]').trigger("click");
    $("#select-status-detail-bill-liabilities").val('0').change();
    $('#loading-modal-detail-bill-liabilities').scrollTop(0);
    $('#check-all-supplier-order-detail-bill-liabilities').prop('checked', false);
    $('#select-type-detail-bill-liabilities').val(-1).trigger('change');
    $('#select-value-detail-bill-liabilities').val(1).trigger('change');
    $('#date-detail-bill-liabilities').val(moment(new Date).format('DD/MM/YYYY'));
    $('#total-record-order-return').text(0);
}
