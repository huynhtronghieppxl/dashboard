let fromBillLiabilities = $('#from-date-bill-liabilities').val(), toBillLiabilities = $('#to-date-bill-liabilities').val();

$(async function () {
    if(getCookieShared('order-bill-treasurer-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('order-bill-treasurer-user-id-' + idSession));
        fromBillLiabilities = dataCookie.from;
        toBillLiabilities = dataCookie.to;
        $('#from-date-bill-liabilities').val(fromBillLiabilities)
        $('#to-date-bill-liabilities').val(toBillLiabilities)
        dateTimePickerFromMaxToDate($('#from-date-bill-liabilities'), $('#to-date-bill-liabilities'))
    }
    dateTimePickerFromMaxToDate($('#from-date-bill-liabilities'), $('#to-date-bill-liabilities'))
    $('#search-btn-payment-bill').on('click', function () {
        fromBillLiabilities = $('#from-date-bill-liabilities').val();
        toBillLiabilities = $('#to-date-bill-liabilities').val();
        if(!checkDateTimePicker($(this))){
            $('#from-date-bill-liabilities').val(fromBillLiabilities).trigger('dp.change');
            $('#to-date-bill-liabilities').val(toBillLiabilities).trigger('dp.change');
            return false;
        }
        loadData();
    });
    $('.select-branch').on('change', function (){
        $('.select-branch').val($(this).val());
    })
    $('.select-brand').on('change', function (){
        $('.select-brand').val($(this).val());
        if($(this).val() == -1){
            $('#select-branch-order-bill-liabilities').addClass('d-none');
        }
        else{
            $('#select-branch-order-bill-liabilities').removeClass('d-none');
        }
    })
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
});

async function loadData() {
    updateCookieBillLiabilities()
    let method = 'get',
        brand =  $('.select-brand').val(),
        branch = $('.select-branch').val(),
        params = {brand: brand, branch: branch, from: fromBillLiabilities, to: toBillLiabilities},
        data = null,
        url1 = 'order-bill-treasurer.data';
    let res = await axiosTemplate(method, url1, params, data, [$('#table-supplier-bill-liabilities')]);
    dataTableBillLiabilities(res.data[0]);
    dataTotalBillLiabilities(res.data[1]);
}

function updateCookieBillLiabilities(){
    saveCookieShared('order-bill-treasurer-user-id-' + idSession, JSON.stringify({
        'from' : fromBillLiabilities,
        'to' : toBillLiabilities,
    }))
}

async function dataTableBillLiabilities(data) {
    let id = $('#table-supplier-bill-liabilities'),
        fixedLeft = 0,
        fixedRight = 0,
        column = [
            {data: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'supplier_name', className: 'text-left', width: '20%'},
            {data: 'total_order_amount', className: 'text-right', width: '10%'},
            {data: 'total_order_amount_paid', className: 'text-right', width: '10%'},
            {data: 'total_order_amount_waiting_payment', className: 'text-right', width: '10%'},
            {data: 'total_order_amount_debt', className: 'text-right', width: '10%'},
            {data: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [];
    $('#form-order-bill-treasurer-date').remove();
    let dataTableBillLiabilities = await DatatableTemplateNew(id, data.original.data, column, vh_of_table, fixedLeft, fixedRight,option);
    $(document).on('input paste', '#table-supplier-bill-liabilities_filter', async function () {
        $('#total-record-done-advance-salary-employee').text(dataTableBillLiabilities.rows({'search': 'applied'}).count());
        let totalAmount = 0, totalRecord = 0,
            totalAmountDone = 0, totalRecordDone = 0,
            totalAmountConfirm = 0, totalRecordConfirm= 0,
            totalAmountPayment = 0, totalRecordPayment= 0
        await dataTableBillLiabilities.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalAmount += removeformatNumber(row.find('td:eq(2) label:first-child').text());
            totalRecord += removeformatNumber(row.find('td:eq(2) label:last-child').text().slice(0, -9));
            totalAmountDone += removeformatNumber(row.find('td:eq(3) label:first-child').text());
            totalRecordDone += removeformatNumber(row.find('td:eq(3) label:last-child').text().slice(0, -9));
            totalAmountConfirm += removeformatNumber(row.find('td:eq(4) label:first-child').text());
            totalRecordConfirm += removeformatNumber(row.find('td:eq(4) label:last-child').text().slice(0, -9));
            totalAmountPayment += removeformatNumber(row.find('td:eq(5) label:first-child').text());
            totalRecordPayment += removeformatNumber(row.find('td:eq(5) label:last-child').text().slice(0, -9));
        })
        $('#total-amount-session-bill-liabilities').html(formatNumber(totalAmount));
        $('#total-record-session-bill-liabilities').html(formatNumber(totalRecord) + '<em> đơn hàng</em>');
        $('#total-amount-done-bill-liabilities').html(formatNumber(totalAmountDone));
        $('#total-record-done-bill-liabilities').html(formatNumber(totalRecordDone) + '<em> đơn hàng</em>');
        $('#total-amount-confirm-bill-liabilities').html(formatNumber(totalAmountConfirm));
        $('#total-record-confirm-bill-liabilities').html(formatNumber(totalRecordConfirm) + '<em> đơn hàng</em>');
        $('#total-amount-payment-bill-liabilities').html(formatNumber(totalAmountPayment));
        $('#total-record-payment-bill-liabilities').html(formatNumber(totalRecordPayment) + '<em> đơn hàng</em>');
    })
}


function dataTotalBillLiabilities(data) {
    $('#total-record-done-bill-liabilities').html(data.total_record_done + '<em> đơn hàng</em>');
    $('#total-amount-done-bill-liabilities').html(data.total_amount_done);
    $('#total-record-confirm-bill-liabilities').html(data.total_record_confirm + '<em> đơn hàng</em>');
    $('#total-amount-confirm-bill-liabilities').html(data.total_amount_confirm);
    $('#total-record-payment-bill-liabilities').html(data.total_record_payment + '<em> đơn hàng</em>');
    $('#total-amount-payment-bill-liabilities').html(data.total_amount_payment);
    $('#total-record-session-bill-liabilities').html(data.total_record_session + '<em> đơn hàng</em>');
    $('#total-amount-session-bill-liabilities').html(data.total_amount_session);
}


