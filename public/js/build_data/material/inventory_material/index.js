let drawTableInventoryMaterialData,
    checkSaveInventoryMaterialData = 0;
let totalRecordInventoryMaterialData, branchRecordInventoryMaterialData, internalPeriodRecordInventoryMaterialData,
    internalDayRecordInventoryMaterialData;

$(function () {
    $('#check-all-branch-inventory-material-data, #check-all-internal-period-inventory-material-data, #check-all-internal-day-inventory-material-data').on('click', function () {
        checkInventoryMaterialData($(this).prop('checked'), $(this).data('col'))
    })
    $(document).on('click', '.item-branch-inventory-material-data', function () {
        ($(this).prop('checked') && totalRecordInventoryMaterialData === branchRecordInventoryMaterialData + 1) ? $('#check-all-branch-inventory-material-data').prop('checked', true) : $('#check-all-branch-inventory-material-data').prop('checked', false);
        ($(this).prop('checked')) ? branchRecordInventoryMaterialData++ : branchRecordInventoryMaterialData--;
    })
    $(document).on('click', '.item-internal-period-inventory-material-data', function () {
        ($(this).prop('checked') && totalRecordInventoryMaterialData === internalPeriodRecordInventoryMaterialData + 1) ? $('#check-all-internal-period-inventory-material-data').prop('checked', true) : $('#check-all-internal-period-inventory-material-data').prop('checked', false);
        ($(this).prop('checked')) ? internalPeriodRecordInventoryMaterialData++ : internalPeriodRecordInventoryMaterialData--;
    })
    $(document).on('click', '.item-internal-day-inventory-material-data', function () {
        ($(this).prop('checked') && totalRecordInventoryMaterialData === internalDayRecordInventoryMaterialData + 1) ? $('#check-all-internal-day-inventory-material-data').prop('checked', true) : $('#check-all-internal-day-inventory-material-data').prop('checked', false);
        ($(this).prop('checked')) ? internalDayRecordInventoryMaterialData++ : internalDayRecordInventoryMaterialData--;
    })
    loadData();
})

async function loadData() {
    let method = 'get',
        url = 'inventory-material.data',
        params = {
            branch: $('.select-branch').val(),
            brand: $('.select-brand').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-inventory-material-data'), $('#table-selected-inventory-material-data')]);
    dataTableInventoryMaterialData(res);
    (res.data[1].total === res.data[1].total_branch) ? $('#check-all-branch-inventory-material-data').prop('checked', true) : $('#check-all-branch-inventory-material-data').prop('checked', false);
    (res.data[1].total === res.data[1].total_internal_period) ? $('#check-all-internal-period-inventory-material-data').prop('checked', true) : $('#check-all-internal-period-inventory-material-data').prop('checked', false);
    (res.data[1].total === res.data[1].total_internal_day) ? $('#check-all-internal-day-inventory-material-data').prop('checked', true) : $('#check-all-internal-day-inventory-material-data').prop('checked', false);
    totalRecordInventoryMaterialData = res.data[1].total;
    branchRecordInventoryMaterialData = 0;
    $('#total-record-x').text(res.data[1].total_internal_period);
    $('#total-record-y').text(res.data[1].total_internal_day);
    internalPeriodRecordInventoryMaterialData = res.data[1].total_internal_period;
    internalDayRecordInventoryMaterialData = res.data[1].total_internal_day;
}

async function dataTableInventoryMaterialData(data) {
    let id = $('#table-inventory-material-data'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'material_unit_full_name', name: 'material_unit_full_name', className: 'text-center'},
            {data: 'inventory', name: 'inventory', className: 'text-center'},
            {data: 'internal_period', name: 'internal_period', className: 'text-center', width: '5%'},
            {data: 'internal_day', name: 'internal_day', className: 'text-center', width: '5%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title': 'Cập nhật',
            'icon': 'fa fa-upload',
            'class': '',
            'function': 'saveInventoryMaterialData',
        }];
    drawTableInventoryMaterialData = await DatatableTemplateNew(id, data.data[0].original.data, column, vh_of_table, fixed_left, fixed_right, option);
}

function checkInventoryMaterialData(check, col) {
    if (check) {
        switch (col) {
            case 4:
                branchRecordInventoryMaterialData = totalRecordInventoryMaterialData;
                break;
            case 5:
                internalPeriodRecordInventoryMaterialData = totalRecordInventoryMaterialData;
                break;
            case 6:
                internalDayRecordInventoryMaterialData = totalRecordInventoryMaterialData;
                break;
        }
        drawTableInventoryMaterialData.rows().every(function () {
            $(this.node()).find('td:eq(' + col + ') input').prop('checked', true);
        });
    } else {
        switch (col) {
            case 4:
                branchRecordInventoryMaterialData = 0;
                break;
            case 5:
                internalPeriodRecordInventoryMaterialData = 0;
                break;
            case 6:
                internalDayRecordInventoryMaterialData = 0;
                break;
        }
        drawTableInventoryMaterialData.rows().every(function () {
            $(this.node()).find('td:eq(' + col + ') input').prop('checked', false);
        });
    }
}

async function saveInventoryMaterialData() {
    if (checkSaveInventoryMaterialData === 1) return false;
    let materials = [];
    await drawTableInventoryMaterialData.rows().every(function () {
        let row = $(this.node());
        materials.push({
            'restaurant_material_id': row.find('td:eq(7) button').data('id'),
            'is_allow_inventory_check': +row.find('td:eq(4) input').prop('checked'),
            'is_allow_check': +row.find('td:eq(5) input').prop('checked'),
            'is_allow_daily_check': +row.find('td:eq(6) input').prop('checked'),
        });
    });
    checkSaveInventoryMaterialData = 1;
    let method = 'post',
        url = 'inventory-material.update',
        params = null,
        data = {
            material: materials,
            brand: $('.select-brand').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$('#table-selected-inventory-material-data')]);
    checkSaveInventoryMaterialData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            break;
        case 500:
            ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());

            break;
        default:
            WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}

