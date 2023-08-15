let branchIdInvoiceManage = $('.select-branch').val();
let loadingDataWaitingExportInvoice = 1, loadingDataWaitingInvoice = 0, loadingDataUpdatedInvoice =0,
    loadingDataDoneInvoice = 0, loadingDataCancelInvoice = 0, loadingDataWaitingConfirmInvoice = 0,
    tabCurrentInvoice = 1, tableWaitingConfirmInvoice = '', tableWaitingExportInvoice = '', tableUpdatedInvoice = '',
    tableDoneInvoice = '', tableCancelInvoice = '',
    fromEInvoiceManage = $('.from-date-e-invoice-manage').val(), toEInvoiceManage=$('.to-date-e-invoice-manage').val()
    limit = $('#data-table-length').val(), checkSaveChangeStatusCancelInvoiceManage = 0 ;
let fixedLeftTableInvoice = 2,
    fixedRightTableInvoice = 2,
    columnInvoice = [
        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
        {data: 'order_id', name: 'order_id', class: 'text-left'},
        {data: 'amount', name: 'amount', className: 'text-right'},
        {data: 'vat_amount', name: 'vat_amount', className: 'text-right'},
        {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
        {data: 'partner_type', name: 'partner_type', className: 'text-left'},
        {data: 'payment_date', name: 'payment_date', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
    ],
    columnInvoiceWaitingExport = [
        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
        {data: 'order_id', name: 'order_id', class: 'text-left'},
        {data: 'amount', name: 'amount', className: 'text-right'},
        {data: 'vat_amount', name: 'vat_amount', className: 'text-right'},
        {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
        {data: 'payment_date', name: 'payment_date', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
    ];

$( async function () {
    dateTimePickerTemplate($('.from-date-e-invoice-manage'));
    dateTimePickerTemplate($('.to-date-e-invoice-manage'));
    if(getCookieShared('e-invoice-manage-user-id' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('e-invoice-manage-user-id' + idSession));
        fromEInvoiceManage = dataCookie.from;
        toEInvoiceManage = dataCookie.to;
        tabCurrentInvoice = dataCookie.tab;
        $('.from-date-e-invoice-manage').val(fromEInvoiceManage)
        $('.to-date-e-invoice-manage').val(toEInvoiceManage)
    }
    $(document).on('dp.change', '.to-date-e-invoice-manage', function (){
        toEInvoiceManage=$(this).val()
        updateCookieEInvoiceManage()
        $('.to-date-e-invoice-manage').val(toEInvoiceManage)
    })
    $(document).on('dp.change', '.from-date-e-invoice-manage', function (){
        fromEInvoiceManage= $(this).val()
        updateCookieEInvoiceManage()
        $('.from-date-e-invoice-manage').val(fromEInvoiceManage)
    })
    $(document).on('click', '.nav-link', function (){
        tabCurrentInvoice= $(this).data('id')
        updateCookieEInvoiceManage()
    })
    $('.search-btn-e-invoice-manage').on('click', function () {
        if(!checkDateTimePicker($(this))){
            return false
        }
        loadData()

    });
    // loadData();
    if(!branchIdInvoiceManage) {
        await updateSessionBrandNew($('.select-brand'))
    }else {
        loadData();
    }
})


function updateCookieEInvoiceManage(){
    saveCookieShared('e-invoice-manage-user-id' + idSession, JSON.stringify({
        from : fromEInvoiceManage,
        to : toEInvoiceManage,
        tab: tabCurrentInvoice
    }))
}
async function loadData() {
    let method = 'get',
        url = 'e-invoice.check',
        params = {
            branch: $('.select-branch-e-invoice-manage').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#body-e-invoice-treasurer'), $('#body-e-invoice-disabled')]);
    if(res.data.data?.is_have_partner_in_branch){
        branchIdInvoiceManage = $('.select-branch-e-invoice-manage').val();
        tableWaitingExportInvoice = '';
        tableWaitingConfirmInvoice = '';
        tableUpdatedInvoice = '';
        tableDoneInvoice = '';
        tableCancelInvoice = '';
        $('#body-e-invoice-treasurer').removeClass('d-none');
        $('#body-e-invoice-disabled').addClass('d-none');
        $('#nav-tab-e-invoice .nav-link[data-id="'+tabCurrentInvoice+'"]').click()
    }else{
        $('#body-e-invoice-treasurer').addClass('d-none');
        $('#body-e-invoice-disabled').removeClass('d-none');
    }
}

async function loadingData() {
    switch (tabCurrentInvoice) {
        case 1:
             loadingDataWaitingExportInvoice = 1;
            loadingDataWaitingInvoice = 0;
            loadingDataDoneInvoice = 0;
            loadingDataCancelInvoice = 0;
            loadingDataUpdatedInvoice = 0;
            await tableWaitingExportInvoice.ajax.url("e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=0&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=0").load();
            break;
        case 2:
            loadingDataWaitingConfirmInvoice = 0;
            loadingDataWaitingInvoice = 1;
            loadingDataDoneInvoice = 0;
            loadingDataCancelInvoice = 0;
            loadingDataUpdatedInvoice = 0;
            await tableWaitingConfirmInvoice.ajax.url("e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=1&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=0").load();
            break;
        case 3:
            loadingDataWaitingConfirmInvoice = 0;
            loadingDataWaitingInvoice = 0;
            loadingDataDoneInvoice = 1;
            loadingDataCancelInvoice = 0;
            loadingDataUpdatedInvoice = 0;
            await tableDoneInvoice.ajax.url("e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=1&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=1").load();
            break;
        case 4:
            loadingDataWaitingConfirmInvoice = 0;
            loadingDataWaitingInvoice = 0;
            loadingDataDoneInvoice = 0;
            loadingDataCancelInvoice = 1;
            loadingDataUpdatedInvoice = 0;
            await tableCancelInvoice.ajax.url("e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=3&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=0").load();
            break;
        case 5:
            loadingDataWaitingConfirmInvoice = 0;
            loadingDataWaitingInvoice = 0;
            loadingDataDoneInvoice = 0;
            loadingDataCancelInvoice = 0;
            loadingDataUpdatedInvoice = 1;
            await tableUpdatedInvoice.ajax.url("e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=2&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=0").load();
            break;
    }
}

async function changeTabInvoice(tab) {
    tabCurrentInvoice = tab;
    switch (tab) {
        case 1:
            if (tableWaitingExportInvoice === '') {
                await loadDataWaitingExportInvoice();
                loadingDataWaitingExportInvoice = 1;
            } else if (loadingDataWaitingExportInvoice === 0) {
                await tableWaitingExportInvoice.ajax.url("e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=0&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=0").load();
            }
            break;
        case 2:
            if (tableWaitingConfirmInvoice === '') {
                await loadDataWaitingConfirmInvoice();
                loadingDataWaitingInvoice = 1;
            } else if (loadingDataWaitingInvoice === 0) {
                await tableWaitingConfirmInvoice.ajax.url("e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=1&branch_id=" + branchIdInvoiceManage  + "&invoice_confirm=0").load();
            }
            break;
        case 3:
            if (tableDoneInvoice === '') {
                await loadDataDoneInvoice();
                loadingDataDoneInvoice = 1;
            } else if (loadingDataDoneInvoice === 0) {
                await tableDoneInvoice.ajax.url("e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=1&branch_id=" + branchIdInvoiceManage  + "&invoice_confirm=1").load();
            }
            break;
        case 4:
            if (tableCancelInvoice === '') {
                await loadDataCancelInvoice();
                loadingDataCancelInvoice = 1;
            } else if (loadingDataCancelInvoice === 0) {
                await tableCancelInvoice.ajax.url("e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=3&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=0").load();
            }
            break;
        case 5:
            if (tableUpdatedInvoice === '') {
                await loadDataUpdatedInvoice();
                loadingDataUpdatedInvoice = 1;
            } else if (loadingDataUpdatedInvoice === 0) {
                await tableUpdatedInvoice.ajax.url("e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=2&branch_id=" + branchIdInvoiceManage  + "&invoice_confirm=0").load();
            }
            break;
    }
}

async function loadDataWaitingExportInvoice() {
    loadingDataWaitingExportInvoice = 1;
    let id = $("#table-waiting-export-e-invoice"),
        url = "e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=0&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=0";
    tableWaitingExportInvoice = await DatatableServerSideTemplateNew(id, url, columnInvoiceWaitingExport    , vh_of_table, fixedLeftTableInvoice, fixedRightTableInvoice, [], callbackInvoiceLoadData);
}

async function loadDataWaitingConfirmInvoice() {
    loadingDataWaitingConfirmInvoice = 1;
    let id = $("#table-waiting-confirm-e-invoice"),
        url = "e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=1&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=0";
    tableWaitingConfirmInvoice = await DatatableServerSideTemplateNew(id, url, columnInvoice, vh_of_table, fixedLeftTableInvoice, fixedRightTableInvoice, [], callbackInvoiceLoadData);
}

async function loadDataDoneInvoice() {
    loadingDataDoneInvoice = 1;
    let id = $("#table-done-export-e-invoice"),
        url = "e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=1&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=1";
    tableDoneInvoice = await DatatableServerSideTemplateNew(id, url, columnInvoice, vh_of_table, fixedLeftTableInvoice, fixedRightTableInvoice, [], callbackInvoiceLoadData);
}

async function loadDataCancelInvoice() {
    loadingDataCancelInvoice = 1;
    let id = $("#table-cancel-export-e-invoice"),
        url = "e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=3&branch_id=" + branchIdInvoiceManage + "&invoice_confirm=0";
    tableCancelInvoice = await DatatableServerSideTemplateNew(id, url, columnInvoice, vh_of_table, fixedLeftTableInvoice, fixedRightTableInvoice, [], callbackInvoiceLoadData);
}

async function loadDataUpdatedInvoice() {
    loadingDataUpdatedInvoice = 1;
    let id = $("#table-updated-export-e-invoice"),
        url = "e-invoice-manage.data?from="+fromEInvoiceManage+ "&to="+toEInvoiceManage +"&status=2&branch_id=" + branchIdInvoiceManage  + "&invoice_confirm=0";
    tableUpdatedInvoice = await DatatableServerSideTemplateNew(id, url, columnInvoice, vh_of_table, fixedLeftTableInvoice, fixedRightTableInvoice, [], callbackInvoiceLoadData);
}

function callbackInvoiceLoadData(response) {
    console.log(response)
    $('#total-record-tab-waiting-export-e-invoice-manage').text(response.total_waiting_export);
    $('#total-record-tab-waiting-payment-payment-treasurer').text(response.total_waiting_browse);
    $('#total-record-tab-done-payment-treasurer').text(response.exported);
    $('#total-record-tab-updated-invoice-manage').text(response.total_have_update_in_partner);
    $('#total-record-tab-cancel-payment-treasurer').text(response.total_canceled);
    $('.total-amount-e-invoice').text(formatNumber(checkTrunc(response.config[0].data.total_amount)));
    $('.total-discount-amount-e-invoice').text(formatNumber(checkTrunc(response.config[0].data.total_discount_amount)));
    $('.total-payment-amount-e-invoice').text(formatNumber(checkTrunc(response.config[0].data.total_payment_amount)));
    $('.total-vat-amount-e-invoice').text(formatNumber(checkTrunc(response.config[0].data.total_vat_amount)));
}

function cancelEInvoiceManage(r){
    let  title = 'Huỷ phiếu hoá đơn ?',
        content = '';
    let icon = 'question',
        element = 'note-cancel-e-invoice';
    sweetAlertInputComponent(title, element, content, icon).then(async (result) => {
        if(checkSaveChangeStatusCancelInvoiceManage === 1) return false;
        if (result.value) {
            let method = 'post',
                url = 'e-invoice-manage.cancel',
                params = null,
                data = {
                    id: r.data('id-invoice'), note : result.value
                };
            checkSaveChangeStatusCancelInvoiceManage = 1;
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            checkSaveChangeStatusCancelInvoiceManage = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    loadingData();
                    break;
                case 500:
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify(res.data.message);
            }
        }else{
            checkSaveChangeStatusCancelInvoiceManage = 0;
        }
    })
}
