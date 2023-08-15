let dataKitchenUnAssignEmployeeData = [], dataKitchenAssignEmployeeData = [],
    drawUnCheckKitchenEmployeeData, drawCheckKitchenEmployeeData,
    isSaveAssignKitchenEmployeeData = 0, idKitchenData;

async function openModalKitchenAssignForEmployee(r) {
    idKitchenData = r.data('id');
    $('#modal-kitchen-assign-employee-kitchen-data').modal('show');
    loadEmployeeData(r);
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalKitchenAssignForEmployee();
    });
    shortcut.add("F4", function () {
        saveModalKitchenAssignForEmployee();
    });
}

function closeModalKitchenAssignForEmployee() {
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateKitchenData();
    })
    $('#modal-kitchen-assign-employee-kitchen-data').modal('hide');
}

async function loadEmployeeData(r) {
    let method = 'get',
        url = 'employee-assign-manage.data',
        restaurant_kitchen_place_id = r.data('id'),
        params = {restaurant_kitchen_place_id: restaurant_kitchen_place_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#body-list-employee-un-assign-kitchen'), $('#body-list-employee-assign-kitchen')
    ]);
    dataKitchenUnAssignEmployeeData = res.data[0].original.data;
    dataKitchenAssignEmployeeData = res.data[1].original.data;
    dataTableKitchenAssignForEmployee(res);
    if (dataKitchenUnAssignEmployeeData.length === 0) {
        $('.btn-click-all-left').css({"opacity": "0", "pointer-events": "none"});
    } else {
        $('.btn-click-all-left').css({"opacity": "", "pointer-events": ""});
    }
    if (dataKitchenAssignEmployeeData.length === 0) {
        $('.btn-click-all-right').css({"opacity": "0", "pointer-events": "none"});
    } else {
        $('.btn-click-all-right').css({"opacity": "", "pointer-events": ""});
    }
}

async function dataTableKitchenAssignForEmployee(data) {
    let table_un_check = $('#table-un-check-employee-assign-kitchen'),
        table_check = $('#table-check-employee-assign-kitchen'),
        fixed_left = 0,
        fixed_right = 0,
        column_un_check = [
            {data: 'name', name: 'name'},
            {data: 'role', name: 'role', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        column_check = [
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'name', name: 'name'},
            {data: 'role', name: 'role', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ], option = [];
    drawUnCheckKitchenEmployeeData = await DatatableTemplateNew(table_un_check, data.data[0].original.data, column_un_check, vh_of_table, fixed_left, 2, []);
    drawCheckKitchenEmployeeData = await DatatableTemplateNew(table_check, data.data[1].original.data, column_check, vh_of_table, 1, fixed_right, []);
}

async function saveModalKitchenAssignForEmployee() {
    if (isSaveAssignKitchenEmployeeData !== 0) return false;
    let employees_id_insert = [], employees_id_delete = [];
    await drawUnCheckKitchenEmployeeData.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(2) button').attr('data-type') == 1) {
            employees_id_delete.push(row.find('td:eq(2) button').attr('data-id'));
        }
    });
    await drawCheckKitchenEmployeeData.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(0) button').attr('data-type') == 0) {
            employees_id_insert.push(row.find('td:eq(0) button').attr('data-id'));
        }
    });
    let method = 'post',
        url = 'kitchen-assign-employee-data.assign',
        params = null,
        data = {
            id: idKitchenData,
            employees_id_insert: employees_id_insert,
            employees_id_delete: employees_id_delete
        };
    isSaveAssignKitchenEmployeeData = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-kitchen-assign')]);
    isSaveAssignKitchenEmployeeData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            $('#modal-kitchen-assign-employee-kitchen-data').modal('hide');
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function () {
                openModalCreateKitchenData();
            })
            break;
        case 500:
            ErrorNotify(res.data.message);
            break;
        default:
            WarningNotify((res.data.message !== null) ? res.data.message : $('#warning-post-data-to-server').text());
    }
}

async function checkAllEmployeeData() {
    addAllRowDatatableTemplate(drawUnCheckKitchenEmployeeData, drawCheckKitchenEmployeeData, itemCheckDraw);
}

async function unCheckAllEmployeeData() {
    addAllRowDatatableTemplate(drawCheckKitchenEmployeeData, drawUnCheckKitchenEmployeeData, itemUnCheckDraw);
}

function itemCheckDraw(r) {
    return {
        'name': r.find('td:eq(0)').html(),
        'role': r.find('td:eq(1)').text(),
        'action': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-right  pointer"  onclick="unCheckKitchenEmployeeData($(this))"  data-id="' + r.find('td:eq(2)').find('button').attr('data-id') + '" data-type="0"  ><i class="fi-rr-arrow-small-left " ></i></button>\n' +
            '</div>',
        'keysearch': r.find('td:eq(4)').text(),
    };
}

function itemUnCheckDraw(r) {
    return {
        'name': r.find('td:eq(1)').html(),
        'role': r.find('td:eq(2)').text(),
        'action': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-right-to-left  pointer"  onclick="checkKitchenEmployeeData($(this))"  data-id="' + r.find('td:eq(0)').find('button').attr('data-id') + '" data-type="1"  ><i class="fi-rr-arrow-small-right " ></i></button>\n' +
            '</div>',
        'keysearch': r.find('td:eq(4)').text(),
    };
}

async function checkKitchenEmployeeData(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(0)').html(),
        'role': r.parents('tr').find('td:eq(1)').text(),
        'action': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-right  pointer"  onclick="unCheckKitchenEmployeeData($(this))"  data-id="' + r.attr('data-id') + '" data-type="0"  ><i class="fi-rr-arrow-small-left" ></i></button>\n' +
            '</div>',
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    };
    if (dataKitchenAssignEmployeeData.length + 1 === 0) {
        $('.btn-click-all-right').css({"opacity": "0", "pointer-events": "none"});
    } else {
        $('.btn-click-all-right').css({"opacity": "", "pointer-events": ""});
    }
    addRowDatatableTemplate(drawCheckKitchenEmployeeData, item);
    drawUnCheckKitchenEmployeeData.row(r.parents('tr')).remove().draw(false);
}

async function unCheckKitchenEmployeeData(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(1)').html(),
        'role': r.parents('tr').find('td:eq(2)').text(),
        'action': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-right  pointer"  onclick="checkKitchenEmployeeData($(this))"  data-id="' + r.attr('data-id') + '" data-type="1"  ><i class="fi-rr-arrow-small-right" ></i></button>\n' +
            '</div>',
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    };
    if (dataKitchenUnAssignEmployeeData.length + 1 === 0) {
        $('.btn-click-all-left').css({"opacity": "0", "pointer-events": "none"});
    } else {
        $('.btn-click-all-left').css({"opacity": "", "pointer-events": ""});
    }
    addRowDatatableTemplate(drawUnCheckKitchenEmployeeData, item);
    drawCheckKitchenEmployeeData.row(r.parents('tr')).remove().draw(false);
}
