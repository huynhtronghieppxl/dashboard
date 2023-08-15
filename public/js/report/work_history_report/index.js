let fromWorkHistory = $('.from-date-work-history-treasurer').val(),
    toWorkHistory = $('.to-date-work-history-treasurer').val(),
    tableWorkHistory, loadBrandNoOfficeHistoryTreasurer = 0;
$(async function () {
    if(getCookieShared('work-history-treasurer-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('work-history-treasurer-user-id-' + idSession));
        fromWorkHistory = dataCookie.from;
        toWorkHistory = dataCookie.to
        $('.from-date-work-history-treasurer').val(fromWorkHistory)
        $('.to-date-work-history-treasurer').val(toWorkHistory)
    }


    dateTimePickerFromToDateTemplate2($('.from-date-work-history-treasurer'), $('.to-date-work-history-treasurer'));
    $('.search-btn-work-history-treasurer').on('click', function () {
        if(!checkDateTimePicker($(this))){
            $('.from-date-work-history-treasurer').val(fromWorkHistory).trigger('dp.change');
            $('.to-date-work-history-treasurer').val(toWorkHistory).trigger('dp.change');
            return false
        }else {
            fromWorkHistory = $('.from-date-work-history-treasurer').val();
            toWorkHistory = $('.to-date-work-history-treasurer').val();
        }
        loadData();
    });
    if(loadBrandNoOfficeHistoryTreasurer === 0) {
        await updateSessionBrandNew($('.select-brand'));
        loadBrandNoOfficeHistoryTreasurer = 1;
    }
    loadData();
});

async function loadData() {
    saveCookieShared('work-history-treasurer-user-id-' + idSession, JSON.stringify({
        'from' : fromWorkHistory,
        'to' : toWorkHistory,
    }))
    let method = 'get',
        url = 'work-history-treasurer.data',
        from = fromWorkHistory,
        to = toWorkHistory,
        branch = $('#select-branch-work-history-treasurer').val(),
        params = {branch: branch, from: from, to: to},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    if (res.data[1].status === 406) {
        WarningNotify(res.data[1].message);
    }
    dataTable(res.data[0].original.data);
    $('#total-order-work-history-treasurer').text(res.data[2].total_orders) // Tổng đơn hàng
    $('#total-cash-amount-shift-work-history-treasurer').text(res.data[2].total_receipt_amount_final) // // Tiền mặt trong ca
    $('#total-revenue-amount-work-history-treasurer').text(res.data[2].total_amount) // Tổng doanh thu
    $('#total-real-amount-work-history-treasurer').text(res.data[2].total_real_amount) // Tổng tiền mặt thực tế
    $('#total-difference-amount-work-history-treasurer').text(res.data[2].total_difference_amount) // Chênh lệch
}

async function dataTable(data) {
    let id = $('#table-work-history-treasurer'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', class: 'text-left', width: '5%'}, // Mã ca
            {data: 'open_employee_name', name: 'open_employee_name', className: 'text-left'}, //Nhân viên mở
            {data: 'close_employee_name', name: 'close_employee_name', className: 'text-left'}, // Nhân viên chốt
            {data: 'open_time', name: 'open_time', className: 'text-center'}, // Thời gian mở
            {data: 'close_time', name: 'close_time', className: 'text-center'}, //Thời gian chốt
            {data: 'number_orders', name: 'number_orders', className: 'text-right'}, // Tổng đơn hàng
            {data: 'revenue', name: 'revenue', className: 'text-right'}, // Tổng doanh thu bán hàng
            {data: 'total_receipt_amount_final', name: 'total_receipt_amount_final', className: 'text-right'}, //Tổng tiền mặt trong ca
            {data: 'real_amount', name: 'real_amount', className: 'text-right'}, // Tổng doanh thu bán hàng
            {data: 'difference_amount', name: 'difference_amount', className: 'text-right'}, // total_difference_amount_final
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        fixedLeft = 2,
        fixedRight = 2,
        option = [];
    tableWorkHistory = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);

    $(document).on('input paste keyup keydown', '#table-work-history-treasurer_filter', async function () {
        let totalTableWorkHistory = searchTable(tableWorkHistory)
        $('#total-order-work-history-treasurer').text(formatNumber(totalTableWorkHistory[0])) // Tổng đơn hàng
        $('#total-revenue-amount-work-history-treasurer').text(formatNumber(totalTableWorkHistory[1])) // Tổng doanh thu
        $('#total-cash-amount-shift-work-history-treasurer').text(formatNumber(totalTableWorkHistory[2])) // // Tiền mặt trong ca
        $('#total-real-amount-work-history-treasurer').text(formatNumber(totalTableWorkHistory[3])) // Tổng tiền mặt thực tế
        $('#total-difference-amount-work-history-treasurer').text(formatNumber(totalTableWorkHistory[4])) // Chênh lệch

    })
}

function searchTable(datatable){
    let totalOrder = 0, totalCashAmount = 0,totalRevenue = 0,
        totalRealAmount = 0, totalDifferenceAmount = 0 ;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalOrder += removeformatNumber(row.find('td:eq(6)').text());
        totalRevenue += removeformatNumber(row.find('td:eq(7)').text());
        totalCashAmount += removeformatNumber(row.find('td:eq(8)').text());
        totalRealAmount += removeformatNumber(row.find('td:eq(9)').text());
        totalDifferenceAmount += removeformatNumber(row.find('td:eq(10)').text());
    })

    return [totalOrder, totalRevenue , totalCashAmount, totalRealAmount, totalDifferenceAmount]
}
