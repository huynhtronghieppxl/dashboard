let brandDetailSurchargeSellReport, branchDetailSurchargeSellReport,
    typeDetailSurchargeSellReport, timeDetailSurchargeSellReport, fromDetailSurchargeSellReport, toDetailSurchargeSellReport;
function openModalDetailSurchargeSellReport(r) {
    brandDetailSurchargeSellReport = r.data('brand');
    branchDetailSurchargeSellReport =  r.data('branch');
    typeDetailSurchargeSellReport =  r.data('type');
    timeDetailSurchargeSellReport =  r.data('time');
    fromDetailSurchargeSellReport = r.data('from');
    toDetailSurchargeSellReport = r.data('to');
    id = r.data('id')

    // getTimeBasedOnTypeReport($('#time-detail-discount-sell-report'), r.data('type'));

    $('#modal-detail-surcharge-sell-report').modal('show');
    shortcut.add('ESC', function () {
        closeModalDetailSurchargeSellReport();
    });
    loadDataDetail()
}

async function loadDataDetail() {
    let method = 'get',
        url = 'surcharge-report.detail',
        params = {
            id: id,
            brand: brandDetailSurchargeSellReport,
            branch: branchDetailSurchargeSellReport,
            type: typeDetailSurchargeSellReport,
            time: timeDetailSurchargeSellReport,
            limit: 100,
            form: $('#from-date-filter-time-bar').val(),
            to:  $('#to-date-filter-time-bar').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-detail-surcharge-sell-report')])
    dataSurchargeTable(res.data[0].original.data)
}

async function dataSurchargeTable(data) {
    let fixedLeft = 0;
    let fixedRight = 0;
    let id = $('#table-detail-surcharge-sell-report');
    let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
            {data: 'table_name', name: 'table_name', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'note', name: 'note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none', width:'5%'},
        ],
        option = []
    await DatatableTemplateNew(id, data, column, '40vh', fixedLeft, fixedRight, option);
}

// async function dataDetailSurchargeSellReport() {
//     let element = $('#table-detail-surcharge-sell-report'),
//         url = "surcharge-report.detail?brand=" + brandDetailSurchargeSellReport + "&branch=" + branchDetailSurchargeSellReport + "&type=" + typeDetailSurchargeSellReport + "&time=" + timeDetailSurchargeSellReport + "&limit=" + 100 + "&from=" + $('#from-date-filter-time-bar').val() + "&to=" + $('#to-date-filter-time-bar').val(),
//         column = [
//             {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//             {data: 'code', name: 'code', className: 'text-center'},
//             {data: 'employee_full_name', name: 'employee_full_name', className: 'text-center'},
//             {data: 'table_name', name: 'table_name', className: 'text-center'},
//             {data: 'amount', name: 'amount', className: 'text-center'},
//             {data: 'vat_amount', name: 'vat_amount', className: 'text-center'},
//             {data: 'payment_date', name: 'payment_date', className: 'text-center'},
//             {data: 'keysearch', className: 'd-none', width:'5%'},
//         ],
//         option = []
//     dataDetailSurchargeSellReportView(element, url, column, option);
// }

async function dataDetailSurchargeSellReportView(element, url, column) {
    let fixedLeftTable = 0,
        fixedRightTable = 0,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, column, '40vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackDetailSurchargeSellReportViewData);
}

function callbackDetailSurchargeSellReportViewData(response) {
    $('#total-amount-detail-vat-sell-report').text(response.total_amount);
}

function closeModalDetailSurchargeSellReport() {
    $('#modal-detail-surcharge-sell-report').modal('hide');
    $('#table-detail-surcharge-sell-report').DataTable().destroy();

}
