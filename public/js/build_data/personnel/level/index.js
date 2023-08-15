$(function () {
    $(document).on('click', '#table-role-level-data tbody tr', async function () {
        if($(this).hasClass('selected')) return false;
        let table = $('#table-role-level-data').DataTable();
        table.$('tr.selected').removeClass('selected');
        await $(this).addClass('selected');
        dataLevelData();
    });
    if (getCookieShared('inventory-supplier-report-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('inventory-supplier-report-user-id-' + idSession));
        selectSupInventorySupplierReport = dataCookie.select;
        selectInvInventorySupplierReport = dataCookie.select;
        $('#from-date-inventory-supplier-report').val(fromDateInventorySupplierReport);
        $('#to-date-inventory-supplier-report').val(toDateInventorySupplierReport);
    }
    $('#select-diligence-employee-off-manage').on('select2:select', function () {
        $('#select-diligence-employee-off-manage').val($(this).val()).trigger('change.select2');
        selectSupInventorySupplierReport = $(this).val();
        updateCookieInventorySupplierReport();
        loadDataMaterial();
    });
    $('#select-status-employee-off-manage').on('select2:select', function () {
        $('#select-status-employee-off-manage').val($(this).val()).trigger('change.select2');
        selectInvInventorySupplierReport = $(this).val();
        updateCookieInventorySupplierReport();
        loadDataMaterial();
    });
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateLevelData()
    })
    loadData();
});

async function loadData() {
    await dataRoleLevelData();
    dataLevelData();
}

async function dataRoleLevelData() {
    let method = 'get',
        url = 'level-data.role',
        params = null,
        data = null;
    let res = await (axiosTemplate(method, url, params, data, [
        $('#table-role-level-data')
    ]));
    await tableRoleLevelData(res.data[0].original.data);
    $('#table-role-level-data tbody tr:eq(0)').addClass('selected');
    $('#select-role-create-level-data').html(res.data[1]);
    $('#select-role-update-level-data').html(res.data[1]);
}

async function dataLevelData() {
    let role = $('#table-role-level-data tbody tr.selected').find('td:eq(1)').find('input').val();
    let method = 'get',
        url = 'level-data.data',
        branch = $('#change_branch').val(),
        brand = $('.select-brand.level-data').val(),
        params = {branch: branch, brand: brand, role: role},
        data = null;
    let res = await (axiosTemplate(method, url, params, data, [
        $('#loading-table-level-data')
    ]));
    tableLevelData(res.data[0].original.data)
}

async function tableRoleLevelData(data) {
    let id = $('#table-role-level-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', className: 'text-left py-2'},
            {data: 'keysearch', className: 'd-none'}
        ],
        fixed_left = 0,
        fixed_right = 0,
        option = [];
    DatatableTemplateNew(id, data, column, vh_of_table, fixed_left, fixed_right, option, '', false)
}

function tableLevelData(data) {
    let id = $('#table-level-data'),
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', className: "text-left"},
            {data: 'table_number', className: "text-center"},
            {data: 'amount', name: 'amount', className: "text-center"},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title' : 'Thêm mới (F2)',
            'icon' : 'fa fa-plus text-primary',
            'class' : '',
            'function' : 'openModalCreateLevelData'
        }];
    DatatableTemplateNew(id, data, columns, vh_of_table, fixed_left, fixed_right, option, '', false);
}



