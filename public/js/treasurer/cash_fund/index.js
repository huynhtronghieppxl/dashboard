let monthCashFund = $('.time-bonus-punish-index').val(),
    tableDataTableBillLiabilities

$(function () {
    FormDateTempOneInput("MM/YYYY", 'date-cash-fund-treasurer');
    if (getCookieShared('cash-fund-treasurer-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('cash-fund-treasurer-user-id-' + idSession));
        monthCashFund = dataCookie.month;
    }
    $('#table-cash-fund-treasurer').off('mouseenter mouseleave');
    $('.time-bonus-punish-index').val(monthCashFund);
    dateTimePickerMonthYearTemplate($('.time-bonus-punish-index'));
    loadData();
});

async function loadData() {
    updateCookieCashFund()
    let method = 'get',
        brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        date = $('.time-bonus-punish-index').val(),
        params = {brand: brand, branch: branch, date: date},
        data = null,
        url1 = 'cash-fund-treasurer.data';
    let res = await axiosTemplate(method, url1, params, data, [$('#table-cash-fund-treasurer')]);
    await dataTableBillLiabilities(res.data[0].original.data);
    $('#total-accumulate').text(res.data[1].total_accumulate);
    dataTotalBillLiabilities();
}

async function dataTableBillLiabilities(data) {
    let id = $('#table-cash-fund-treasurer'),
        fixedLeft = 0,
        fixedRight = 0,
        column = [
            {data: 'fee_month', name: 'fee_month', class: 'text-center'},
            {data: 'type', name: 'type', class: 'text-left'},
            {data: 'addition_fee_reason_content', name: 'addition_fee_reason_content', class: 'text-left border-resize-datatable'},
            {data: 'amount', name: 'amount', class: 'text-right border-resize-datatable'},
            {data: 'total_revenue', name: 'total_revenue', class: 'text-right'},
            {data: 'total_cost', name: 'total_cost', class: 'text-right'},
            {data: 'total_accumulation', name: 'total_accumulation', class: 'text-right'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = [],
        rowsGroup = [0, 4, 5, 6, 1];

    tableDataTableBillLiabilities =  await DatatableTemplateRowGroupNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option, rowsGroup);
    $(document).on('input paste keyup', '#table-cash-fund-treasurer_filter input', async function () {
        let totalTableBillLiabilities = searchTable(tableDataTableBillLiabilities)
        $('#total-amount').text(formatNumber(totalTableBillLiabilities[0]))
        $('#total-revenue').text(formatNumber(totalTableBillLiabilities[1]))
        $('#total-cost').text(formatNumber(totalTableBillLiabilities[2]))
        $('#total-accumulate').text($('#table-cash-fund-treasurer').find('tr:last').find('td:eq(6)').text())
    })
}

function searchTable(datatable){
    let totalRevenue = 0, totalCost = 0, totalAccumulate = 0, totalAmount = 0, rowspan;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        rowspan = row.find('td:eq(0)').attr('rowspan')
        if (rowspan !== undefined ){
            totalRevenue += removeformatNumber(row.find('td:eq(4)').text())
            totalCost += removeformatNumber(row.find('td:eq(5)').text())
            totalAccumulate += removeformatNumber(row.find('td:eq(6)').text())
        }
        totalAmount += removeformatNumber(row.find('td:eq(3)').text());
    })
    return [totalAmount,totalRevenue, totalCost, totalAccumulate, ]
}

function updateCookieCashFund() {
    saveCookieShared('cash-fund-treasurer-user-id-' + idSession, JSON.stringify({
        'month': monthCashFund,
    }))
}

function dataTotalBillLiabilities() {
    let totalTableBillLiabilities = searchTable(tableDataTableBillLiabilities)
    $('#total-amount').text(formatNumber(totalTableBillLiabilities[0]))
    $('#total-revenue').text(formatNumber(totalTableBillLiabilities[1]))
    $('#total-cost').text(formatNumber(totalTableBillLiabilities[2]))
}
