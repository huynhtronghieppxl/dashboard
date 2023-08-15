let tableDetailFundPeriodPaymentBill = '', tableDetailFundPeriodPaymentRecurringBill = '';
let branchId, idDetailFundPeriod,
    columnDetailPaymentBill =  [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', className: 'text-center'},
        {data: 'employee_create_full_name', className: 'text-center'},
        {data: 'object_name', className: 'text-center'},
        {data: 'reason_name', className: 'text-center'},
        {data: 'addition_fee_time', className: 'text-center'},
        {data: 'amount', className: 'text-center'},
        {data: 'action', className: 'text-center', width: '10%'},
    ],
    columnDetailPaymentRecurringBill =[
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', className: 'text-center'},
        {data: 'employee_create_full_name', className: 'text-center'},
        {data: 'object_name', className: 'text-center'},
        {data: 'reason_name', className: 'text-center'},
        {data: 'addition_fee_time', className: 'text-center'},
        {data: 'amount', className: 'text-center'},
        {data: 'action', className: 'text-center', width: '10%'},
    ],
    fixedLeftTable = 2,
    fixedRightTable = 2,
    optionRenderTable = [];

function openModalDetailFundPeriodTreasurer(r) {
    $('#modal-detail-fund-period-treasurer').modal('show');

    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalDetailFundPeriodTreasurer();
    });
    $('#modal-detail-payment-bill').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailFundPeriodTreasurer();
        });
    });
    $('#modal-detail-order-supplier-order').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailPaymentBill();
        });
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailOrderSupplierOrder();
        });
    });

    if (r.data('status') == 3) {
        $('#label-employee-cancel-detail-fund-period-treasurer').removeClass('d-none');
        $('#label-employee-complete-detail-fund-period-treasurer').addClass('d-none');
    }else{
        $('#label-employee-cancel-detail-fund-period-treasurer').addClass('d-none');
        $('#label-employee-complete-detail-fund-period-treasurer').removeClass('d-none');
    }

    $('#name-detail-fund-period-treasurer').text(r.data('name'));
    $('#from-detail-fund-period-treasurer').text(r.data('from'));
    $('#to-detail-fund-period-treasurer').text(r.data('to'));
    $('#employee-detail-fund-period-treasurer').text(r.data('employee'));
    $('#employee-complete-detail-fund-period-treasurer').text(r.data('employee-complete'));
    $('#open-detail-fund-period-treasurer').text(r.data('openning'));
    $('#in-detail-fund-period-treasurer').text(r.data('in'));
    $('#out-to-purchase-detail-fund-period-treasurer').text(r.data('out'));
    $('#order-detail-fund-period-treasurer').text(r.data('order'));
    $('#closing-to-purchase-detail-fund-period-treasurer').text(r.data('closing'));
    $('#changing-detail-fund-period-treasurer').text(r.data('changing'));
    $('#note-detail-fund-period-treasurer').text(r.data('note'));
    $('#employee-avatar-detail-fund-period').attr('src', r.data('img-employee'))
    $('#complete-employee-avatar-detail-fund-period').attr('src', r.data('img-employee-complete'))
    switch (r.data('status')) {
        case 0:
            $('#status-detail-fund-period-treasurer').html(`<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                <label class="m-0">${r.data('status-name')}</label>
                                                            </div>`);
            break;
        case 1:
            $('#status-detail-fund-period-treasurer').html(`<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;">
                                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                <label class="m-0">${r.data('status-name')}</label>
                                                            </div>`);
            break;
        case 2:
            $('#status-detail-fund-period-treasurer').html(`<div class="seemt-green seemt-border-green status-new" style="display: inline !important; max-width: max-content;">
                                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                <label class="m-0">${r.data('status-name')}</label>
                                                            </div>`);
            break;
        case 3:
            $('#status-detail-fund-period-treasurer').html(`<div class="seemt-red seemt-border-red status-new" style="display: inline !important; max-width: max-content;">
                                                                <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i>
                                                                <label class="m-0">${r.data('status-name')}</label>
                                                            </div>`);
            break;
    }
    branchId = r.data('branch');
    idDetailFundPeriod = r.data('id');
    loadDataDetailPaymentFundPeriod();
    loadDataPaymentRecurringFundPeriod();
}

async function loadDataDetailPaymentFundPeriod() {
    loadingDataWaitingConfirmPayment = 1;
    let id = $("#table-payment-detail-fund-period-treasurer"),
        url = "fund-period-treasurer.detail?id=" + idDetailFundPeriod + "&branch_id=" + branchId + "&type=" + 1;
    tableDetailFundPeriodPaymentBill = await DatatableServerSideTemplateNew(id, url, columnDetailPaymentBill, '40vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

async function loadDataPaymentRecurringFundPeriod() {
    loadingDataWaitingConfirmPayment = 1;
    let id = $("#table-receipt-detail-fund-period-treasurer"),
        url = "fund-period-treasurer.detail?id=" + idDetailFundPeriod + "&branch_id=" + branchId + "&type=" + 0;
    tableDetailFundPeriodPaymentRecurringBill = await DatatableServerSideTemplateNew(id, url, columnDetailPaymentRecurringBill, '40vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function openModalDetailFundPeriodTreasurerInfo() {
    $('#tab1-detail-fund-period-treasurer').removeClass('d-none');
    $('#tab2-detail-fund-period-treasurer').addClass('d-none');
    $('#tab3-detail-fund-period-treasurer').addClass('d-none');
    $('#detail-fund-period-treasurer-info').addClass('active');
    $('#detail-fund-period-treasurer-payment').removeClass('active');
    $('#detail-fund-period-treasurer-receipts').removeClass('active');
}

function openModalDetailFundPeriodTreasurerPayment() {
    tableDetailFundPeriodPaymentBill.columns.adjust().draw();
    $('#tab1-detail-fund-period-treasurer').addClass('d-none');
    $('#tab2-detail-fund-period-treasurer').removeClass('d-none');
    $('#tab3-detail-fund-period-treasurer').addClass('d-none');
    $('#detail-fund-period-treasurer-info').removeClass('active');
    $('#detail-fund-period-treasurer-payment').addClass('active');
    $('#detail-fund-period-treasurer-receipts').removeClass('active');
}

function openModalDetailFundPeriodTreasurerReceipts() {
    tableDetailFundPeriodPaymentRecurringBill.columns.adjust().draw();
    $('#tab1-detail-fund-period-treasurer').addClass('d-none');
    $('#tab2-detail-fund-period-treasurer').addClass('d-none');
    $('#tab3-detail-fund-period-treasurer').removeClass('d-none');
    $('#detail-fund-period-treasurer-info').removeClass('active');
    $('#detail-fund-period-treasurer-payment').removeClass('active');
    $('#detail-fund-period-treasurer-receipts').addClass('active');
}

function closeModalDetailFundPeriodTreasurer() {
    tableDetailFundPeriodPaymentRecurringBill.clear();
    tableDetailFundPeriodPaymentBill.clear();
    if (tableDetailFundPeriodPaymentBill !== '') tableDetailFundPeriodPaymentBill.destroy();
    if (tableDetailFundPeriodPaymentRecurringBill !== '') tableDetailFundPeriodPaymentRecurringBill.destroy();
    $('#modal-detail-fund-period-treasurer').modal('hide');
    resetModalDetailFundPeriodTreasurer();
}

function callbackLoadData (response){
    console.log('123',response)
    $('#total-record-tab1-detail').text(response.out_count);
    $('#total-record-tab2-detail').text(response.in_count);
    $('#total-payment-detail-fund-period-treasurer').text(response.total_payment);
    $('#total-receipt-detail-fund-period-treasurer').text(response.total_receipt);
}
 function resetModalDetailFundPeriodTreasurer(){
     $('#tab1-detail-fund-period-treasurer').removeClass('d-none');
     $('#tab2-detail-fund-period-treasurer').addClass('d-none');
     $('#total-payment-detail-fund-period-treasurer').text('');
     $('#total-record-tab1-detail').text(0);
     $('#total-record-tab2-detail').text(0);
     $('#tab3-detail-fund-period-treasurer').addClass('d-none');
     $('#detail-fund-period-treasurer-info').addClass('active');
     $('#detail-fund-period-treasurer-payment').removeClass('active');
     $('#detail-fund-period-treasurer-receipts').removeClass('active');
     $('#name-detail-fund-period-treasurer').text('---');
     $('#from-detail-fund-period-treasurer').text(moment().format('DD/MM/YYYY'));
     $('#to-detail-fund-period-treasurer').text(moment().format('DD/MM/YYYY'));
     $('#employee-detail-fund-period-treasurer').text('---');
     $('#employee-complete-detail-fund-period-treasurer').text('---');
     $('#open-detail-fund-period-treasurer').text('0');
     $('#in-detail-fund-period-treasurer').text('0');
     $('#out-detail-fund-period-treasurer').text('0');
     $('#order-detail-fund-period-treasurer').text('0');
     $('#closing-detail-fund-period-treasurer').text('0');
     $('#note-detail-fund-period-treasurer').text('---');
 }
