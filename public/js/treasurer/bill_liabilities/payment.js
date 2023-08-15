let savePaymentBillLiabilities, tablePaymentDetail = null;

function paymentModalDetailBillLiabilities() {
    shortcut.remove("F4");
    shortcut.add('F4', function () {
        saveModalDetailBillLiabilities();
    });
    dataReasonPaymentDetailBillLiabilities();
    $('#sub-detail-liabilities-treasurer').addClass('d-none');
    $('#payment-bill-liabilities').addClass('d-none');
    $('#create-detail-liabilities-treasurer').removeClass('d-none');
    $('#detail-bill-liabilities').removeClass('d-none');
    $('#save-bill-liabilities').removeClass('d-none');
    $('#branch-detail-bill-liabilities').text($('#change_branch option:selected').text());
    $('#target-detail-bill-liabilities').text(nameDetailBillLiabilities);

}

async function dataTablePaymentDetailBillLiabilities() {
    $('#check-all-supplier-order-detail-bill-liabilities').prop('checked', false);
    $('#original-price-payment-bill-liabilities').text(0);
    $('#return-price-payment-bill-liabilities').text(0);
    $('#debt-payment-bill-liabilities').text(0);
    $('#total-original-price-payment-bill-liabilities').text(0);
    $('#total-return-price-payment-bill-liabilities').text(0);
    $('#total-debt-payment-bill-liabilities').text(0);
    $('#payment-bill-liabilities').attr('disabled', true)
    let method = 'get',
        url = 'payment-bill-treasurer.order',
        is_debt = $('#select-status-detail-bill-liabilities').val(),
        from = $('#from-date-bill-liabilities').val(),
        to = $('#to-date-bill-liabilities').val(),
        param = {
            supplier: idDetailBillLiabilitiesTreasurer,
            branch: branchId,
            from: from,
            to: to,
            is_debt: is_debt
        },
        data = null;
    let res = await axiosTemplate(method, url, param, data, [$('#table-inventory-detail-bill-liabilities')]);
    $('#payment-bill-liabilities').removeAttr('disabled')
    $('#total-original-price-payment-bill-liabilities').text(res.data[1].total_original);
    $('#total-return-price-payment-bill-liabilities').text(res.data[1].total_return);
    $('#total-debt-payment-bill-liabilities').text(res.data[1].total_det_amount);
    let id = $('#table-inventory-detail-bill-liabilities'),
        scroll_Y = '40vh',
        fixedLeft = 0,
        fixedRight = 0,
        column = [
            {data: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'checkbox', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left', width: '15%'},
            {data: 'employee_complete', name: 'employee_complete', width: '25%'},
            {data: 'restaurant_debt_amount', name: 'restaurant_debt_amount', className: 'text-center', width: '15%'},
            {data: 'retention_money', name: 'retention_money', className: 'text-center', width: '15%'},
            {data: 'received_at', name: 'received_at', className: 'text-left', width: '15%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    tablePaymentDetail = await DatatableTemplateNew(id, res.data[0].original.data, column, scroll_Y, fixedLeft, fixedRight);

    $(document).on('input paste', '#table-inventory-detail-bill-liabilities_filter', async function () {
        let totalDebtTableCreatePaymentBill = searchTable(tablePaymentDetail)
        $('#total-debt-payment-bill-liabilities').text(formatNumber(totalDebtTableCreatePaymentBill))
    })
}
function searchTable(datatable){
    let totalDebt = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalDebt += removeformatNumber(row.find('td:eq(4)').text());
    })
    return totalDebt;
}


async function dataReasonPaymentDetailBillLiabilities() {
        let method = 'get',
            url = 'order-bill-treasurer.reason',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#select-type-detail-bill-liabilities')]);
        dataReasonCreateBillLiabilities = 1;
        $('#select-type-detail-bill-liabilities').html(res.data[0]);
}

function detailModalDetailBillLiabilities() {
    $('#create-detail-liabilities-treasurer').addClass('d-none');
    $('#detail-bill-liabilities').addClass('d-none');
    $('#save-bill-liabilities').addClass('d-none');
    $('#sub-detail-liabilities-treasurer').removeClass('d-none');
    $('#payment-bill-liabilities').removeClass('d-none');
}

async function checkItemSupplierOrderCreatePaymentBill() {
    let total = 0, original = 0, returnAmount = 0, check = 0;
    await tablePaymentDetail.rows().every(function (index, element) {
        let x = $(this.node());
        if (x.find('td:eq(1)').find('input[type="checkbox"]').is(':checked')) {
            check++;
            original += removeformatNumber(x.find('td:eq(3)').text());
            returnAmount += removeformatNumber(x.find('td:eq(4)').text());
            total += removeformatNumber(x.find('td:eq(4)').text());
        }
    });
    (check === tablePaymentDetail.rows().count()) ? $('#check-all-supplier-order-detail-bill-liabilities').prop('checked', true) : $('#check-all-supplier-order-detail-bill-liabilities').prop('checked', false);
    $('#original-price-payment-bill-liabilities').text(formatNumber(original));
    $('#return-price-payment-bill-liabilities').text(formatNumber(returnAmount));
    $('#debt-payment-bill-liabilities').text(formatNumber(total));
}

async function checkAllPaymentDetailBillLiabilities(r) {
    if (r.is(':checked')) {
        let total = 0, original = 0, returnAmount = 0;
        await tablePaymentDetail.rows().every(function (index, element) {
            let x = $(this.node());
            x.find('td:eq(1)').find('input[type="checkbox"]').prop('checked', true);
            original += removeformatNumber(x.find('td:eq(3)').text());
            returnAmount += removeformatNumber(x.find('td:eq(4)').text());
            total += removeformatNumber(x.find('td:eq(4)').text());
        });
        $('#original-price-payment-bill-liabilities').text(formatNumber(original));
        $('#return-price-payment-bill-liabilities').text(formatNumber(returnAmount));
        $('#debt-payment-bill-liabilities').text(formatNumber(total));
    } else {
        await tablePaymentDetail.rows().every(function (index, element) {
            let x = $(this.node());
            x.find('td:eq(1)').find('input[type="checkbox"]').prop('checked', false);
        });
        $('#original-price-payment-bill-liabilities').text(0);
        $('#return-price-payment-bill-liabilities').text(0);
        $('#debt-payment-bill-liabilities').text(0);
    }
}

async function saveModalDetailBillLiabilities() {
    if (savePaymentBillLiabilities !== 0) return false;
    if (!checkValidateSave($('#create-detail-liabilities-treasurer'))) return false;
    let type = $('#select-type-detail-bill-liabilities').val(),
        value = removeformatNumber($('#debt-payment-bill-liabilities').text()),
        value_type = $('#select-value-detail-bill-liabilities').val(),
        accounting = 0,
        date = $('#date-detail-bill-liabilities').val(),
        description = $('#description-detail-bill-liabilities').val(),
        is_paid_debt = $('#select-status-detail-bill-liabilities').val();
    if ($('#accounting-detail-bill-liabilities').is(':checked') === true) accounting = 1;
    let temp = [];
    await tablePaymentDetail.rows().every(function (index, element) {
        let x = $(this.node());
        if (x.find('td:eq(1)').find('input[type="checkbox"]').is(':checked')) {
            temp.push(x.find('td:eq(1)').find('input[type="checkbox"]').val());
        }
    });
    savePaymentBillLiabilities = 1;
    let method = 'post',
        url = 'payment-bill-treasurer.create',
        params = null,
        data = {
            branch: branchId,
            addition_fee_reason_id: type,
            amount: value,
            date: date,
            is_count_to_revenue: accounting,
            note: description,
            object_id: idDetailBillLiabilitiesTreasurer,
            object_name: nameDetailBillLiabilities,
            object_type: 1,
            payment_method_id: value_type,
            supplier_order_ids: temp,
            is_paid_debt: is_paid_debt
        };
    let res = await axiosTemplate(method, url, params, data);
    savePaymentBillLiabilities = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalDetailBillLiabilities();
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
