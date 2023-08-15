function openModalDetailCostDebtReport(r) {
    $('#modal-cost-debt-detail').modal('show');
    addLoading('cost-debt-report.detail', '#loading-modal-detail-cost-debt-report');
    $('#name-detail-cost-debt-report').text(r.data('name'));
    $('#type-detail-cost-debt-report').text(r.data('type'));
    $('#amount-detail-cost-debt-report').text(r.data('amount'));
    dataDetailCostDebtReport(r.data('id'), r.data('auto'));
}

async function dataDetailCostDebtReport(id, auto) {
    let method = 'get',
        url = 'cost-debt-report.detail',
        branch = $('#change_branch').val(),
        date = $('#time').val(),
        type = $('#type').val(),
        params = {id: id, auto: auto, type: type, branch: branch, date: date},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTableDetailCostDebtReport(res.data[0].original.data);
}

function dataTableDetailCostDebtReport(data) {
    let scroll_Y = '50vh',
        fixedLeft = 2,
        fixedRight = 0,
        id = $('#table-detail-cost-debt-report'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'employee.name', className: 'text-center'},
            {data: 'object_name', className: 'text-center'},
            {data: 'date', className: 'text-center'},
            {data: 'amount', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '5%'},
        ],option =[];
    DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight,option);
}

function closeModalDetailCostDebtReport() {
    $('#modal-cost-debt-detail').modal('hide');
}
