let status,tablePendingProduct, tableApprovedProduct, tableEnableProduct,tableDisableProduct, tableReasonProduct,thisStatusAfterPayment, brandIdAfterPayment = $('.select-brand').val(),
    checkRemoveCustomerMessage = 0, checkChangeStatusCustomerMessage = 0, checkSaveIsRunningCustomerMessage = 0;

$(function() {
    shortcut.add("F2",function() {
        openModalCreateAfterPaymentCampaign();
    })
})

async function loadDataAfterPayment() {
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'))
    }
    let method = 'get',
        url = 'after_payment.data',
        params = {brandId: brandIdAfterPayment},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#table-pending-after-payment-campaign"), $("#table-approved-after-payment-campaign"), $("#table-enable-after-payment-campaign"), $("#table-disable-after-payment-campaign")]);
    dataTableAfterPayment(res);
    $('#total-record-pending-after-payment-campaign').text(formatNumber(res.data[6].total_record_pending));
    $('#total-record-approved-after-payment-campaign').text(formatNumber(res.data[6].total_record_approved));
    $('#total-record-enable-after-payment-campaign').text(formatNumber(res.data[6].total_record_enable));
    $('#total-record-disable-after-payment-campaign').text(formatNumber(res.data[6].total_record_disable));
    $('#total-record-reason-after-payment-campaign').text(formatNumber(res.data[6].total_record_reason));
}

async function dataTableAfterPayment(data) {
    let fixed_left = 1;
    let fixed_right = 1;
    let tablePendingAfterPaymentCampaign = $('#table-pending-after-payment-campaign'),
        tableApprovedAfterPaymentCampaign = $('#table-approved-after-payment-campaign'),
        tableEnableAfterPaymentCampaign = $('#table-enable-after-payment-campaign'),
        tableDisableAfterPaymentCampaign = $('#table-disable-after-payment-campaign'),
        tableReasonAfterPaymentCampaign = $('#table-reason-after-payment-campaign'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'branch_name', name: 'branch_name', className: 'text-left', width: '25%'},
            {data: 'type', name: 'type', className: 'text-left'},
            {data: 'content', name: 'content', className: 'text-left', width: '30%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', class: 'd-none'},
        ],
        columnReason = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'branch_name', name: 'branch_name', className: 'text-left', width: '25%'},
            {data: 'type', name: 'type', className: 'text-left'},
            {data: 'content', name: 'content', className: 'text-left', width: '30%'},
            {data: 'reason', name: 'reason', className: 'text-left', width: '30%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', class: 'd-none'},
        ],

    option = [{
            'title': 'Thêm mới (F2)',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateAfterPaymentCampaign',
        }]
    vh_of_table = await (($("#pcoded").outerHeight(true) - ($('.pcoded-inner-content').outerHeight(true) + $('.navbar').outerHeight(true) + 16)) * 10) / 100 + 'vh';
    tablePendingProduct = await DatatableTemplateNew(tablePendingAfterPaymentCampaign, data.data[0].original.data, column, vh_of_table, fixed_left, fixed_right, option);
    tableApprovedProduct = await DatatableTemplateNew(tableApprovedAfterPaymentCampaign, data.data[1].original.data, column, vh_of_table, fixed_left, fixed_right, option);
    tableEnableProduct = await DatatableTemplateNew(tableEnableAfterPaymentCampaign, data.data[2].original.data, column, vh_of_table, fixed_left, fixed_right, option);
    tableDisableProduct = await DatatableTemplateNew(tableDisableAfterPaymentCampaign, data.data[3].original.data, column, vh_of_table, fixed_left, fixed_right, option);
    tableReasonProduct = await DatatableTemplateNew(tableReasonAfterPaymentCampaign, data.data[4].original.data, columnReason, vh_of_table, fixed_left, fixed_right, option);
    $('#table-enable-after-payment-campaign tbody tr td:nth-child(4)').attr('style', 'white-space:normal');
    $(document).on('input paste', 'input[type="search"]', async function () {
        $('#total-record-pending-after-payment-campaign').text(tablePendingProduct.rows({'search': 'applied'}).count())
        $('#total-record-approved-after-payment-campaign').text(tableApprovedProduct.rows({'search': 'applied'}).count())
        $('#total-record-enable-after-payment-campaign').text(tableEnableProduct.rows({'search': 'applied'}).count())
        $('#total-record-disable-after-payment-campaign').text(tableDisableProduct.rows({'search': 'applied'}).count())
        $('#total-record-reason-after-payment-campaign').text(tableReasonProduct.rows({'search': 'applied'}).count())
    })
}

async function removeCustomerMessage(id) {
    if(checkRemoveCustomerMessage === 1) return false;
    checkRemoveCustomerMessage = 1;
    let method = 'post',
        url = 'after_payment.delete',
        params = null,
        data = {id : id};
    let res = await axiosTemplate(method, url, params, data);
    checkRemoveCustomerMessage = 0;
    let text = '';
    switch (res.data.status){
        case 200:
            text = 'Xóa thành công!';
            SuccessNotify(text);
            loadData();
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


function changeStatusCustomerMessage(r) {
    if(checkChangeStatusCustomerMessage === 1) return false;
    thisStatusAfterPayment = r;
    let title = 'Xác nhận đổi trạng thái hoạt động !',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'after_payment.change-status',
                params = null,
                data = {id: r.data('id'), branch_id: r.data('branch-id'), status: r.data('status')};
            checkChangeStatusCustomerMessage = 1;
            let res = await axiosTemplate(method, url, params, data);
            checkChangeStatusCustomerMessage = 0;
            let text = $('#success-status-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    drawTableStatusCustomerMessage(res.data);
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
    })
}

async function changeIsRunningCustomerMessage(r) {
    if (checkSaveIsRunningCustomerMessage === 1) return false;
    let title = 'Đổi trạng thái ?', text = '', icon = 'question';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            checkSaveIsRunningCustomerMessage = 1;
            let method = 'POST',
                url = 'after_payment.is-running',
                params = {id: r.data('id')},
                data = '';
            let res = await axiosTemplate(method, url, params, data);
            checkSaveIsRunningCustomerMessage = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    text = $('#success-status-data-to-server').text();
                    SuccessNotify(text);
                    loadData();
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
    });
}

function drawTableStatusCustomerMessage(data){
    let tableStatus;
    if (data.data.status == 1){
        $('#total-record-pending-after-payment-campaign').text(formatNumber(removeformatNumber($('#total-record-pending-after-payment-campaign').text()) + 1));
        $('#total-record-disable-after-payment-campaign').text(formatNumber(removeformatNumber($('#total-record-disable-after-payment-campaign').text()) - 1));

        tableStatus = tableEnableProduct;
        removeRowDatatableTemplate(tableDisableProduct , thisStatusAfterPayment , true);

    }else {
        $('#total-record-pending-after-payment-campaign').text(formatNumber(removeformatNumber($('#total-record-pending-after-payment-campaign').text()) - 1));
        $('#total-record-disable-after-payment-campaign').text(formatNumber(removeformatNumber($('#total-record-disable-after-payment-campaign').text()) + 1));
        tableStatus = tableDisableProduct;
        removeRowDatatableTemplate( tableEnableProduct  , thisStatusAfterPayment , true);

    }
    addRowDatatableTemplate(tableStatus, {
        'branch_name': data.data.branch_name,
        'type': data.data.type,
        'content': data.data.content,
        'action': data.data.action,
        'keysearch': data.data.keysearch,
    });
}
