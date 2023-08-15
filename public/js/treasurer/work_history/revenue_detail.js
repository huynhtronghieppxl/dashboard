let tableCashRevenue, tableCardPayment, tableTransfer, tablePoint, tableDifference;
function openModalRevenueDetailWorkHistory() {
    $('#modal-revenue-detail-work-history').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalRevenueDetailWorkHistory();
    });
    $('#modal-detail-bill-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalRevenueDetailWorkHistory();
        });
    });
    dataRevenueDetailWorkHistory();
}

async function dataRevenueDetailWorkHistory() {
    let method = 'get',
        url = 'work-history-treasurer.revenue-detail',
        params = {id: idDetailWorkHistoryTreasurer},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-revenue-detail-work-history-treasurer')
    ]);
    dataTableRevenueDetailWorkHistory(res);
    dataTotalRevenueDetailWorkHistory(res.data[5]);
}

async function dataTableRevenueDetailWorkHistory(data) {
    let id1 = $('#table-cash-revenue-detail-work-history-treasurer'),
        id2 = $('#table-bank-revenue-detail-work-history-treasurer'),
        id3 = $('#table-transfer-revenue-detail-work-history-treasurer'),
        id4 = $('#table-point-revenue-detail-work-history-treasurer'),
        id5 = $('#table-unknow-revenue-detail-work-history-treasurer'),
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-left'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'employee.name', name: 'employee', className: 'text-left'},
            {data: 'cash_amount', name: 'cash_amount', className: 'text-right'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-left'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'employee.name', name: 'employee', className: 'text-left'},
            {data: 'bank_amount', name: 'bank_amount', className: 'text-right'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},

        ],
        column3 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-left'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'employee.name', name: 'employee', className: 'text-left'},
            {data: 'transfer_amount', name: 'transfer_amount', className: 'text-right'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},

        ],
        column4 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-left'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'employee.name', name: 'employee', className: 'text-left'},
            {data: 'membership_point_used_amount', name: 'membership_point_used_amount', className: 'text-right'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},

        ],
        column5 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-left'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'employee.name', name: 'employee', className: 'text-left'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},

        ],
        scroll_Y = '40vh',
        fixedLeft = 2,
        fixedRight = 1,
        option = [];
    tableCashRevenue = await DatatableTemplateNew(id1, data.data[0].original.data, column1, scroll_Y, fixedLeft, fixedRight, option);
    tableCardPayment = await DatatableTemplateNew(id2, data.data[1].original.data, column2, scroll_Y, fixedLeft, fixedRight, option);
    tableTransfer = await DatatableTemplateNew(id3, data.data[2].original.data, column3, scroll_Y, fixedLeft, fixedRight, option);
    tablePoint = await DatatableTemplateNew(id4, data.data[3].original.data, column4, scroll_Y, fixedLeft, fixedRight, option);
    tableDifference = await DatatableTemplateNew(id5, data.data[4].original.data, column5, scroll_Y, fixedLeft, fixedRight, option);

    $(document).on('input paste', '#loading-modal-revenue-detail-work-history-treasurer input[type="search"]', async function () {

        $('#total-record-cash-revenue-detail-work-history-treasurer').text(tableCashRevenue.rows({'search': 'applied'}).count())
        $('#total-record-bank-revenue-detail-work-history-treasurer').text(tableCardPayment.rows({'search': 'applied'}).count());
        $('#total-record-transfer-revenue-detail-work-history-treasurer').text(tableTransfer.rows({'search': 'applied'}).count());
        $('#total-record-point-revenue-detail-work-history-treasurer').text(tablePoint.rows({'search': 'applied'}).count());
        $('#total-record-unknow-revenue-detail-work-history-treasurer').text(tableDifference.rows({'search': 'applied'}).count());

        let totalCashRevenue = searchTableDetail(tableCashRevenue),
            totalCardPayment = searchTableDetail(tableCardPayment),
            totalTransfer = searchTableDetail(tableTransfer),
            totalPoint = searchTableDetail(tablePoint),
            totalDifference = searchTableDetail(tableDifference);

        $('#total-cash-revenue-detail-work-history-treasurer').text(formatNumber(totalCashRevenue))
        $('#total-bank-revenue-detail-work-history-treasurer').text(formatNumber(totalCardPayment))
        $('#total-transfer-revenue-detail-work-history-treasurer').text(formatNumber(totalTransfer))
        $('#total-point-revenue-detail-work-history-treasurer').text(formatNumber(totalPoint))
        $('#total-unknow-revenue-detail-work-history-treasurer').text(formatNumber(totalDifference))

    })
}

function searchTableDetail(datatable){
    let totalAmount = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(4)').text());
    })
    return totalAmount
}

function dataTotalRevenueDetailWorkHistory(data) {
    $('#total-record-cash-revenue-detail-work-history-treasurer').text(data.total_record_cash);
    $('#total-record-bank-revenue-detail-work-history-treasurer').text(data.total_record_bank);
    $('#total-record-transfer-revenue-detail-work-history-treasurer').text(data.total_record_transfer);
    $('#total-record-point-revenue-detail-work-history-treasurer').text(data.total_record_point);
    $('#total-record-unknow-revenue-detail-work-history-treasurer').text(data.total_record_unknow);
    $('#total-cash-revenue-detail-work-history-treasurer').text(data.total_cash);
    $('#total-bank-revenue-detail-work-history-treasurer').text(data.total_bank);
    $('#total-transfer-revenue-detail-work-history-treasurer').text(data.total_transfer);
    $('#total-point-revenue-detail-work-history-treasurer').text(data.total_point);
    $('#total-unknow-revenue-detail-work-history-treasurer').text(data.total_unknow);
}

function closeModalRevenueDetailWorkHistory() {
    $('#modal-revenue-detail-work-history').modal('hide');
}
