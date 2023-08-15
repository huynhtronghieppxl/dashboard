let tableDetailCostReport;

function openModalDetailCostReport(r) {
    $('#modal-detail-cost-report').modal('show');
    $('#name-detail-cost-report').text(r.data('name'));
    $('#type-detail-cost-report').text(r.data('type'));
    $('#amount-detail-cost-report').text(r.data('amount'));
    getTimeBasedOnTypeReport($('#time-detail-cost-report'), r.data('type-action'));
    dataDetailCostReport(r.data('id'), r.data('auto'), r.data('generated-type'), r.data('type-action'), r.data('time-action'), r.data('type-id'));
    shortcut.add('ESC', function () {
        closeModalDetailCostReport();
    });
    $('#modal-detail-receipts-bill').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailCostReport();
        });
    });
}

async function dataDetailCostReport(id, auto, generated_type, type_action, time_action, addition_reason_type_id) {
    let branch = $('.select-branch').val();
    let element = $('#table-detail-cost-report'),
        url = "cost-report.detail?id=" + id + "&auto=" + auto + "&branch=" + branch + "&type=" + type_action + "&time=" + time_action + "&generated_type=" + generated_type + "&addition_reason_type_id=" + addition_reason_type_id,
        column = [
            {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'employee.name', className: 'text-left'},
            {data: 'object_name', className: 'text-left'},
            {data: 'fee_month', className: 'text-center'},
            {data: 'amount', className: 'text-right'},
            // {data: 'action', className: 'text-center', width: '5%'},
        ];
    tableDetailCostReport = await dataDetailCostReportView(element, url, column);
}

async function dataDetailCostReportView(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, column, '40vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function callbackLoadData(response) {
}

function closeModalDetailCostReport() {
    shortcut.remove('ESC');
    $('#modal-detail-cost-report').modal('hide');
    resetModalDetailCostReport();
}

function resetModalDetailCostReport() {
    $('#table-detail-cost-report').text('');
    $('#name-detail-cost-report').text('---');
    $('#time-detail-cost-report').text('---');
    $('#type-detail-cost-report').text('---');
    $('#amount-detail-cost-report').text(0);
}
