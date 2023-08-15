let idInvoiceDetail;

async function openModalEInvoiceDetail(r) {
    $('#modal-e-invoice-detail').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalEInvoiceDetail();
    });
    idInvoiceDetail = r.data('id-invoice');

    drawTableFoodDetailInvoice([]);
    getDataDetailOrder();
}

async function getDataDetailOrder() {
    let method = 'get',
        url = 'e-invoice-manage.detail',
        params = {
            id: idInvoiceDetail,
            branch: $('.select-branch-e-invoice-manage').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-food-e-invoice-detail'), $('#form-header-bonus-punish'), $('#boxlist-detail-e-invoice')]);
    drawTableFoodDetailInvoice(res.data[0].original.data);
    $('#code-detail-e-invoice').text('#' + res.data[1].order_id);
    $('#payment-date-detail-e-invoice').text(moment(res.data[1].payment_date).format('DD/MM/YYYY HH:mm'));
    $('#discount-detail-e-invoice').text(formatNumber(res.data[1].discount_amount));
    $('#discount-percent-detail-e-invoice').text(formatNumber(res.data[1].discount_percent));
    $('#vat-amount-detail-e-invoice').text(formatNumber(res.data[1].vat_amount));
    $('#total-amount-detail-e-invoice').text(formatNumber(res.data[1].total_amount));
    $('#money-detail-e-invoice').text(formatNumber(res.data[1].amount));
    $('#name-detail-e-invoice').text(res.data[1].customer_name);
    $('#company-detail-e-invoice').text(res.data[1].customer_company_name);
    $('#tax-code-detail-e-invoice').text(res.data[1].customer_company_tax_code);
    $('#address-detail-e-invoice').text(res.data[1].customer_company_address);
    $('#email-detail-e-invoice').text(res.data[1].customer_company_email);
    $('#phone-detail-e-invoice').text(res.data[1].customer_phone);
$('#discount-text-detail-e-invoice').text(res.data[1].discount_text)
    $('#send-mail-detail-e-invoice').prop('checked', Boolean(res.data[1].is_send_mail))
    // tính tiền
    $('#total-e-invoice-detail').text(formatNumber(res.data[2]['total_amount']));
    // $('#vat-percent-detail-e-invoice').text(formatNumber(res.data[2]['total_vat']));

}

async function drawTableFoodDetailInvoice(data) {
    let id = $('#table-food-e-invoice-detail'),
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'food_name', name: 'food_name', className: 'text-center'},
            {data: 'food_unit', name: 'food_unit', className: 'text-center'},
            {data: 'unit_price', name: 'unit_price', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'total_price', name: 'total_price', className: 'text-center'},
            {data: 'vat', name: 'vat', className: 'text-center'},
            {data: 'discount_cal', name: 'discount_cal', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none', width: '5%'},
        ];
    DatatableTemplateNew(id, data, column, '20vh', fixed_left, fixed_right);
}

function closeModalEInvoiceDetail() {
    $('#modal-e-invoice-detail').modal('hide');
    resetModalEInvoiceDetail();
}

function resetModalEInvoiceDetail() {
    $('#modal-e-invoice-detail input').val('');
    $('#code-detail-e-invoice').text('---');
    $('#payment-date-detail-e-invoice').text('---');
    $('#discount-detail-e-invoice').text('---');
    $('#vat-amount-detail-e-invoice').text('---');
    $('#total-amount-detail-e-invoice').text('---');
    $('#money-detail-e-invoice').text('---');

    // tính tiền
    $('#total-e-invoice-detail').text('---');
    // $('#vat-percent-detail-e-invoice').text('---');

    //info
    $('#name-detail-e-invoice').text('---');
    $('#company-detail-e-invoice').text('---');
    $('#email-detail-e-invoice').text('---');
    $('#phone-detail-e-invoice').text('---');
    $('#address-detail-e-invoice').text('---');
}

