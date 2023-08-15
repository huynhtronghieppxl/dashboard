let tableDetailRevenueCostProfit;

/**
 * @param type: 0 doanh thu, 1 chi phí
 * @param key tuỳ thuộc thu chi
 */
function openModalDetailRevenueCostProfit(type, key) {
    $('#modal-detail-revenue-cost-profit-branch-report').modal('show');
    dataTableDetailRevenueCostProfit(type, key);
    shortcut.add('ESC', function () {
        closeModalDetailRevenueCostProfit();
    })
}


async function dataTableDetailRevenueCostProfit(typeApi, key) {
    let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        branch = $('#change_branch').val(),
        type = $('#select-type-revenue-cost-profit-report').val(),
        time = $('#select-type-revenue-cost-profit-report').find(':selected').data('time'),
        url,
        optionRenderTable = [],
        columns = [
            {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'branch_name', className: 'text-center', width: '10%'},
            {data: 'id', className: 'text-center'},
            {data: 'employee_name', className: 'text-center'},
            {data: 'object_name', className: 'text-center'},
            {data: 'addition_fee_reason_type_name', className: 'text-center'},
            {data: 'payment_date', className: 'text-center'},
            {data: 'total_amount', className: 'text-center'},
            {data: 'status_text', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '5%'},
        ];
    let idTable = $('#table-detail-revenue-cost-profit-branch-report');
    if (typeApi === 0) {
        $('#title-detail-revenue-cost-profit-branch-report').text('Chi tiết doanh thu')
        url = "dashboard_sale_solution.data-detail-revenue-report?brand=" + brand + "&branch=" + branch + "&type=" + type + "&time=" + time + "&object_type=" + key;
    } else {
        $('#title-detail-revenue-cost-profit-branch-report').text('Chi tiết chi phí');
        url = "dashboard_sale_solution.data-detail-revenue-report?brand=" + brand + "&branch=" + branch + "&type=" + type + "&time=" + time + "&is_current=" + key;
    }
    tableDetailRevenueCostProfit = await DatatableServerSideTemplateNew(idTable, url, columns, '45vh', 2 , 1, optionRenderTable, callbackLoadDataDetailPoint);
    $('#table-detail-revenue-cost-profit-branch-report').on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    });

    function callbackLoadDataDetailPoint(response) {
        console.log(response);
        $('#total-amount-detail-revenue-cost-profit-branch-report').text(response.total_amount);
    }
}

function closeModalDetailRevenueCostProfit() {
    tableDetailRevenueCostProfit.destroy();
    $('#modal-detail-revenue-cost-profit-branch-report').modal('hide');
}
