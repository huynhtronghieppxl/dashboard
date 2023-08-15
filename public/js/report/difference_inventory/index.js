let tab_index = 1;
let data_table1 = null;
let data_table2 = null;

$(function () {
    dateTimePickerTemplate($('#difference-inventory-report-from-date'));
    dateTimePickerTemplate($('#difference-inventory-report-to-date'));
    loadData();
    $('#difference-inventory-report-from-date, #difference-inventory-report-to-date').on('dp.change', function () {
        loadData();
    });
});

async function loadData() {
    let method = 'get',
        url1 = 'difference-inventory-report.data-day',
        url2 = 'difference-inventory-report.data-periodic',
        from = $('#difference-inventory-report-from-date').val(),
        to = $('#difference-inventory-report-to-date').val(),
        params = {from: from, to: to},
        data = null;
    let res1 = await axiosTemplate(method, url1, params, data);
    let res2 = await axiosTemplate(method, url2, params, data);
    tableDate(res1);
    tablePeriodic(res2);
}

async function tableDate(data) {
    let id = $('#date-table'),
        scroll_Y = '60vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'branch', name: 'branch', className: 'text-center'},
            {data: 'inventory_status_text', name: 'Inventory_status_text', className: 'text-center'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'updated_at', name: 'updated_at', className: 'text-center'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    // data_table1 = await DatatableTemplate(id, data.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right);
    data_table1 = await DatatableTemplate(id, [], columns, scroll_Y, fixed_left, fixed_right);

    // $('#total-day').text(data.data[1]);
    $('#total-day').text(0);
}

async function tablePeriodic(data) {
    let id = $('#periodic-table'),
        scroll_Y = '60vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'branch', name: 'branch', className: 'text-center'},
            {data: 'inventory_status_text', name: 'Inventory_status_text', className: 'text-center'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'updated_at', name: 'updated_at', className: 'text-center'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    // data_table2 = await DatatableTemplate(id, data.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right);
    data_table2 = await DatatableTemplate(id, [], columns, scroll_Y, fixed_left, fixed_right);

    // $('#total-periodic').text(data.data[1]);
    $('#total-periodic').text(0);

}

function tabContent(r) {
    tab_index = r;
}

function exportExcel() {
    let element = null,
        name = null;
    switch (tab_index) {
        case 1:
            element = $('#date-table');
            name = $('#title').text() + '-' + $('#aDateTab').text().toLowerCase();
            exportExcelTemplate(element, data_table1, name);
            break;
        case 2:
            element = $('#periodic-table');
            name = $('#title').text() + '' + $('#aPeriodicTab').text().toLowerCase();
            exportExcelTemplate(element, data_table2, name);
            break;
    }
}
