let data_table = null;

$(function () {
    // addLoading('/quantitative-inventory-report.data');
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    loadData();
    $('#calendar-day').on('dp.change', function () {
        let type = 1;
        let time = $('#calendar-day').val();
        $('#type').val(type);
        $('#time').val(time);
        loadData();
    });
    $('#calendar-month').on('dp.change', function () {
        let type = 3;
        let time = $('#calendar-month').val();
        $('#type').val(type);
        $('#time').val(time);
        loadData();
    });
    $('#calendar-year').on('dp.change', function () {
        let type = 5;
        let time = $('#calendar-year').val();
        $('#type').val(type);
        $('#time').val(time);
        loadData();
    });
    $('#select-type-quantitative-inventory-report').on('select2:select', function () {
        loadData();
    });
});

async function loadData() {
    let type = $('#type').val(),
        time = $('#time').val(),
        branch = $(".select-branch").val(),
        material_type = $('#select-type-quantitative-inventory-report').find('option:selected').val(),
        method = 'get',
        url = '/quantitative-inventory-report.data',
        params = {type: type, time: time, branch: branch, material_type: material_type},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    if (res.data[0] === 'error') {
        showErrorServer(res);
        return false;
    }
    // loadTable(res.data[0].original.data);
    loadTable([]);
    loadTotal(res.data[1]);

}

async function loadTable(data) {
    let id = $('#table-quantitative-inventory-report');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'name', name: 'name', className: 'text-center'},
        {data: 'type', name: 'type', className: 'text-center'},
        {data: 'category_name', name: 'material_category_name', className: 'text-center'},
        {data: 'before_quantity_converted', name: 'before_quantity_converted', className: 'text-center'},
        {data: 'before_amount', name: 'before_amount', className: 'text-center'},
        {data: 'in_quantity_converted', name: 'in_quantity_converted', className: 'text-center'},
        {data: 'in_amount', name: 'in_amount', className: 'text-center'},
        {data: 'out_quantity_converted', name: 'out_quantity_converted', className: 'text-center'},
        {data: 'out_amount', name: 'out_amount', className: 'text-center'},
        // {data: 'used_quantity_converted', name: 'used_quantity_converted', className: 'text-center'},
        // {data: 'used_amount', name: 'used_amount', className: 'text-center'},
        {data: 'remain_quantity_converted', name: 'remain_quantity_converted', className: 'text-center'},
        {data: 'remain_amount', name: 'remain_amount', className: 'text-center'},
        {data: 'deficiency_quantity_converted', name: 'deficiency_quantity_converted', className: 'text-center'},
        {data: 'deficiency_amount', name: 'deficiency_amount', className: 'text-center'},
        // {data: 'action', name: 'action', className: 'text-center', width:'10%'},
    ];
    let scrollY = '50vh';
    let fixed_left = 2;
    let fixed_right = 2;
    data_table = await DatatableTemplate(id, data, column, scrollY, fixed_left, fixed_right);
}

function loadTotal(data) {
    $('#total-before').html(data.total_before_amount);
    $('#total-in').html(data.total_in_amount);
    $('#total-out').html(data.total_out_amount);
    $('#total-used').html(data.total_used_amount);
    $('#total-remain').html(data.total_remain_amount);
    $('#total-deficiency').html(data.total_deficiency_amount);
}

function exportExcel() {
    let id = $('#table-quantitative-inventory-report');
    let name = $('#title').text();
    exportExcelTemplate(id, data_table, name);
}
