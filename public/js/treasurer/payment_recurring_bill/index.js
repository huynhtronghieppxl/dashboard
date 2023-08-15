let tableEnablePaymentRecurringBillTreasurer,
    tableDisablePaymentRecurringBillTreasurer,
    checkStatusPaymentRecurringBillTreasurer = 0,
    thisStatusPaymentRecurringBillTreasurer,
    tabCurrentPaymentRecurringBillTreasurer = 1,
    dataReasonPaymentRecurringBill = '';

$(function () {
    if(getCookieShared('payment-recurring-bill-treasurer-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('payment-recurring-bill-treasurer-user-id-' + idSession));
        tabCurrentPaymentRecurringBillTreasurer = dataCookie.tab;
    }
    $('#nav-tab-payment-recurring-bill .nav-link').on('click', function (){
        tabCurrentPaymentRecurringBillTreasurer = $(this).attr('data-id');
        saveCookieShared('payment-recurring-bill-treasurer-user-id-' + idSession, JSON.stringify({
            'tab' : tabCurrentPaymentRecurringBillTreasurer,
        }))
    })
    loadData();
    $('#nav-tab-payment-recurring-bill a[data-id="' + tabCurrentPaymentRecurringBillTreasurer + '"]').click();
});

async function loadData() {
    let branch = $('.select-branch').val(),
        method = 'get',
        url = 'payment-recurring-bill-treasurer.data',
        param = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, param, data , [$('#content-body-techres')]);
    dataTablePaymentBill(res);
    dataTotalPaymentBill(res.data[2]);
}

async function dataTablePaymentBill(data) {
    let idTabEnablePaymentCurringBill = $('#table-payment-recurring-bill1'),
        idTabDisablePaymentCurringBill = $('#table-payment-recurring-bill2'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'object_name', name: 'object_name', className: 'text-left', width: '20%'},
            {data: 'addition_fee_reason_name', name: 'addition_fee_reason_name', className: 'text-left', width: '15%'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'type', name: 'type', className: 'text-left'},
            {data: 'note', name: 'note', className: 'text-left',  width: '15%'},
            {data: 'action', className: 'text-center',  width: '15%'},
            {data: 'keysearch', className: 'd-none'},
        ], option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreatePaymentRecurringBill',
        }]
    tableEnablePaymentRecurringBillTreasurer = await DatatableTemplateNew(idTabEnablePaymentCurringBill, data.data[0].original.data, column, vh_of_table, fixed_left, fixed_right,option);
    tableDisablePaymentRecurringBillTreasurer = await DatatableTemplateNew(idTabDisablePaymentCurringBill, data.data[1].original.data, column, vh_of_table, fixed_left, fixed_right,option);

    $(document).on('input paste keyup', '#content-body-techres input[type="search"]', async function () {
        $('#total-record-tab1-payment-recurring-bill').text(tableEnablePaymentRecurringBillTreasurer.rows({'search': 'applied'}).count());
        $('#total-record-tab2-payment-recurring-bill').text(tableDisablePaymentRecurringBillTreasurer.rows({'search': 'applied'}).count());

        let totalAmountEnablePaymentRecurringBill = searchTable(tableEnablePaymentRecurringBillTreasurer),
            totalAmountDisablePaymentRecurringBill = searchTable(tableDisablePaymentRecurringBillTreasurer)

        $('#total-amount-tab1-payment-recurring-bill').text(formatNumber(totalAmountEnablePaymentRecurringBill));
        $('#total-amount-tab2-payment-recurring-bill').text(formatNumber(totalAmountDisablePaymentRecurringBill));

    })

}

function searchTable(datatable){
    let totalAmount= 0, index = 1;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(3)').text());
        row.find('td:eq(0)').text(index)
        index++;
    })
    return totalAmount
}

function dataTotalPaymentBill(data) {
    $('#total-record-tab1-payment-recurring-bill').text(data.total_record_tab1);
    $('#total-record-tab2-payment-recurring-bill').text(data.total_record_tab2);
    $('#total-amount-tab1-payment-recurring-bill').text(data.total_tab1);
    $('#total-amount-tab2-payment-recurring-bill').text(data.total_tab2);
}

function changeStatusPaymentRecurringBill(r) {
    thisStatusPaymentRecurringBillTreasurer = r;
    let title = 'Đổi trạng thái ?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            if (checkStatusPaymentRecurringBillTreasurer !== 0) return false;
            checkStatusPaymentRecurringBillTreasurer = 1;
            let method = 'post',
                url = 'payment-recurring-bill-treasurer.change-status',
                params = null,
                data = {
                    id: r.data('id'),
                    branch: r.data('branch'),
                    status: r.data('status'),
                };
            let res = await axiosTemplate(method, url, params, data);
            checkStatusPaymentRecurringBillTreasurer = 0;
            let text = $('#success-status-data-to-server').text();
            switch (res.data.status){
                case 200:
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
    })
}

function drawStatusPaymentRecurringBill(r, action) {
    let x = r.parents('tr').data('dt-row'),
        object_name = r.parents('.DTFC_ScrollWrapper').find('.DTFC_LeftBodyLiner').find('tbody tr:eq(' + x + ')').find('td:eq(1)').text(),
        amount = r.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(2)').text(),
        addition_fee_reason_name = r.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(3)').text(),
        type = r.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(4)').text(),
        note = r.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(5)').text(),
        keysearch = '';
    if (r.data('status') === 1) {
        $('#nav-tab-payment-recurring-bill li:eq(1) a').click();
        $('#total-record-tab1-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-record-tab1-payment-recurring-bill').text()) - 1));
        $('#total-amount-tab1-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-amount-tab1-payment-recurring-bill').text()) - removeformatNumber(amount)));
        $('#total-record-tab2-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-record-tab2-payment-recurring-bill').text()) + 1));
        $('#total-amount-tab2-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-amount-tab2-payment-recurring-bill').text()) + removeformatNumber(amount)));
        tableEnablePaymentRecurringBillTreasurer.row(r.parents('tr')).remove().draw(false);
        addRowDatatableTemplate(tableDisablePaymentRecurringBillTreasurer, {
            'object_name': object_name,
            'addition_fee_reason_name': addition_fee_reason_name,
            'amount': amount,
            'type': type,
            'note': note,
            'action': action,
            'keysearch': keysearch,
        });
    } else {
        $('#nav-tab-payment-recurring-bill li:eq(0) a').click();
        $('#total-record-tab2-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-record-tab2-payment-recurring-bill').text()) - 1));
        $('#total-amount-tab2-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-amount-tab2-payment-recurring-bill').text()) - removeformatNumber(amount)));
        $('#total-record-tab1-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-record-tab1-payment-recurring-bill').text()) + 1));
        $('#total-amount-tab1-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-amount-tab1-payment-recurring-bill').text()) + removeformatNumber(amount)));
        tableDisablePaymentRecurringBillTreasurer.row(r.parents('tr')).remove().draw(false);
        addRowDatatableTemplate(tableEnablePaymentRecurringBillTreasurer, {
            'object_name': object_name,
            'addition_fee_reason_name': addition_fee_reason_name,
            'amount': amount,
            'type': type,
            'note': note,
            'action': action,
            'keysearch': keysearch,
        });
    }
}

async function dataReasonCreatePaymentRecurringBill() {
    if (dataReasonPaymentRecurringBill) {
        $('#select-type-create-payment-recurring-bill').html(dataReasonPaymentRecurringBill);
        $('#select-type-update-payment-recurring-bill').html(dataReasonPaymentRecurringBill);
    } else {
        let method = 'get',
            url = 'payment-recurring-bill-treasurer.reason',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#loading-create-payment-recurring-bill')]);
        $('#select-type-create-payment-recurring-bill').html(res.data[0]);
        $('#select-type-update-payment-recurring-bill').html(res.data[0]);
        dataReasonPaymentRecurringBill = res.data[0];
    }
}
