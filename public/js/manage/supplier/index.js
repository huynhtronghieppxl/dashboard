$(function () {
    $('.select-branch').on('change', function (){
        $('.select-branch').val($(this).val());
    })
    $('.select-brand').on('change', function (){
        $('.select-brand').val($(this).val());
        if($(this).val() == -1){
            $('#select-branch-supplier-manage').addClass('d-none');
        }
        else{
            $('#select-branch-supplier-manage').removeClass('d-none');
        }
    })
    loadData();
});

async function loadData() {
    let method = 'get',
        branch = $('.select-branch').val(),
        params = {
            branch: branch,
            brand : $('.select-brand').val(),
        },
        data = null,
        url = 'supplier-manage.data';
    let res = await axiosTemplate(method, url, params, data, [
        $('#content-body-techres')
    ]);
    dataTableBillLiabilities(res.data[0].original.data);
    dataTotalBillLiabilities(res.data[1]);
}

async function dataTableBillLiabilities(data) {
    let id = $('#table-supplier-supplier-manage'),
        scroll_Y = vh_of_table,
        fixedLeft = 2,
        fixedRight = 1;
    let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'supplier_name', name: 'supplier_name',width: '5%', class: 'text-left'},
            {data: 'total_order_amount', name: 'total_order_amount', className: 'text-right'},
            {data: 'total_order_amount_paid', name: 'total_order_amount_paid', className: 'text-right'},
            {data: 'total_order_amount_waiting_payment',name: 'total_order_amount_waiting_payment',className: 'text-right'},
            {data: 'total_order_amount_debt', name: 'total_order_amount_debt', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = []
    let dataTableBillLiabilities = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight,option);
    $(document).on('input paste keydown keyup', '#table-supplier-supplier-manage_filter', async function () {
        $('#total-record-done-advance-salary-employee').text(dataTableBillLiabilities.rows({'search': 'applied'}).count());
        let totalAmount = 0, totalRecord = 0,
            totalAmountReturn = 0, totalRecordReturn = 0,
            totalAmountDone = 0, totalRecordDone = 0,
            totalAmountConfirm = 0, totalRecordConfirm = 0,
            totalAmountPayment = 0, totalRecordPayment = 0

        await dataTableBillLiabilities.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalAmount += removeformatNumber(row.find('td:eq(2) label:first-child').text());
            totalRecord += removeformatNumber(row.find('td:eq(2) label:last-child').text().slice(0,-2));
            totalAmountReturn += removeformatNumber(row.find('td:eq(3) label:first-child').text());
            totalRecordReturn += removeformatNumber(row.find('td:eq(3) label:last-child').text().slice(0,-2));
            totalAmountDone += removeformatNumber(row.find('td:eq(4) label:first-child').text());
            totalRecordDone += removeformatNumber(row.find('td:eq(4) label:last-child').text().slice(0,-2));
            totalAmountConfirm += removeformatNumber(row.find('td:eq(5) label:first-child').text());
            totalRecordConfirm += removeformatNumber(row.find('td:eq(5) label:last-child').text().slice(0,-2));
            totalAmountPayment += removeformatNumber(row.find('td:eq(6) label:first-child').text());
            totalRecordPayment += removeformatNumber(row.find('td:eq(6) label:last-child').text().slice(0,-2));
        })
        $('#total-amount-session-supplier-manage').html(formatNumber(totalAmount));
        $('#total-record-session-supplier-manage').html(formatNumber(totalRecord) + '<em> đơn hàng</em>')
        $('#total-amount-return-supplier-manage').html(formatNumber(totalAmountReturn));
        $('#total-record-return-supplier-manage').html(formatNumber(totalRecordReturn)+ '<em> đơn hàng</em>');
        $('#total-amount-done-supplier-manage').html(formatNumber(totalAmountDone));
        $('#total-record-done-supplier-manage').html(formatNumber(totalRecordDone)+ '<em> đơn hàng</em>');
        $('#total-amount-confirm-supplier-manage').html(formatNumber(totalAmountConfirm));
        $('#total-record-confirm-supplier-manage').html(formatNumber(totalRecordConfirm)+ '<em> đơn hàng</em>');
        $('#total-amount-payment-supplier-manage').html(formatNumber(totalAmountPayment));
        $('#total-record-payment-supplier-manage').html(formatNumber(totalRecordPayment)+ '<em> đơn hàng</em>');
    })
}

function dataTotalBillLiabilities(data) {
    $('#total-record-done-supplier-manage').html(data.total_record_done + '<em> đơn hàng</em>');
    $('#total-amount-done-supplier-manage').html(data.total_amount_done);
    $('#total-record-return-supplier-manage').html(data.total_record_return + '<em> đơn hàng</em>');
    $('#total-amount-return-supplier-manage').html(data.total_amount_return);
    $('#total-record-confirm-supplier-manage').html(data.total_record_confirm + '<em> đơn hàng</em>');
    $('#total-amount-confirm-supplier-manage').html(data.total_amount_confirm);
    $('#total-record-session-supplier-manage').html(data.total_record_session + '<em> đơn hàng</em>');
    $('#total-amount-session-supplier-manage').html(data.total_amount_session);
    $('#total-record-payment-supplier-manage').html(data.total_record_payment + '<em> đơn hàng</em>');
    $('#total-amount-payment-supplier-manage').html(data.total_amount_payment);
}
