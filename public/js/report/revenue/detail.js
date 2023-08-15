let tableDetailRevenueReport;

function openModalDetailRevenueReport(r) {
    $('#modal-detail-revenue-report').modal('show');
    $('#name-detail-revenue-report').text(r.data('name'));
    $('#type-detail-revenue-report').text(r.data('type'));
    $('#amount-detail-revenue-report').text(r.data('amount'));
    getTimeBasedOnTypeReport($('#time-detail-revenue-report'), r.data('type-action'));
    dataDetailRevenueReport(r.data('id'), r.data('auto'), r.data('generated-type'), r.data('type-action'), r.data('time-action'), r.data('addition-fee-reason'));
    shortcut.add('ESC', function () {
        closeModalDetailRevenueReport();
    });
    $('#modal-detail-receipts-bill').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalDetailRevenueReport();
        });
    });
}

async function dataDetailRevenueReport(id, auto, generated_type, type_action, time_action, addition_reason_type_id) {
    let branch = $('.select-branch').val();
    let element = $('#table-detail-revenue-report'),
        url = "revenue-report.detail?id=" + id + "&auto=" + auto + "&type=" + type_action + "&branch=" + branch + "&time=" + time_action + "&generated_type=" + generated_type + "&addition_reason_type_id=" + addition_reason_type_id,
        column = [
            {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'employee.name'},
            {data: 'object_name', className: 'text-center'},
            {data: 'fee_month', className: 'text-center'},
            {data: 'amount', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '5%'},
        ];
    tableDetailRevenueReport = await dataDetailRevenueReportView(element, url, column);
}

async function dataDetailRevenueReportView(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, column,'40vh' , fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function callbackLoadData(response) {
}

function closeModalDetailRevenueReport() {
    shortcut.remove('ESC');
    $('#modal-detail-revenue-report').modal('hide');
    resetModalDetailRevenueReport();
}

function resetModalDetailRevenueReport() {
    $('#table-detail-revenue-report').text('');
    $('#name-detail-revenue-report').text('---');
    $('#time-detail-revenue-report').text('---');
    $('#type-detail-revenue-report').text('---');
    $('#amount-detail-revenue-report').text(0);
}
