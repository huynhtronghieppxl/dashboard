let tableEmployeeDisSelectPermissionKitchen, tableEmployeeSelectPermissionKitchen, tableEmployeeLeaderPermissionKitchen,
    dataCheckAllTableLeft = [], dataCheckAllTableRight = [],
    savePermissionKitchen = 0, checkEmployeeLeaderData = 0, tabChangePermission = 1, typeRoleChangePermission;
$(async function () {
    if (getCookieShared('permission-kitchen-data-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('permission-kitchen-data-user-id-' + idSession));
        tabChangePermission = dataCookie.tab
    }
    $('.nav-link').on('click', function () {
        tabChangePermission = $(this).data('id')
        updateCookiePermissionKitchen()
    })

    $('#select-role-permission-data').on('change', function () {
        typeRoleChangePermission = $(this).val();
        loadData();
    })
    if(!$('.select-branch-permission-data').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
});

async function loadData() {
    let branch = $('.select-branch-permission-data').val();
    let brand= $('.select-brand-permission-data').val();
    let typeRole = typeRoleChangePermission;
    let method = 'get',
        url = 'permission-kitchen.data',
        params = {
            branch: branch,
            brand: brand,
            type: typeRole
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-employee-kitchen-data'), $('#table-employee-select-kitchen-data'), $('#table-employee-leader-kitchen-data')]);
    $('#name-employee').html(res.data[3].name);
    $('#name-branch').text($('.select-branch-permission-data:first').find(':selected').text());
    await dataTablePermissionKitchen(res);
    $('#material-kitchen-tab1 .toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});
    dataCheckAllTableLeft = res.data[0].original.data;
    dataCheckAllTableRight = res.data[1].original.data;
    if (dataCheckAllTableLeft.length === 0){
        $('.btn-all-left').css({"transition" : "all .2s linear","opacity": "0", "pointer-events": "none"});
    } else {
        $('.btn-all-left').css({"transition" : "","opacity": "", "pointer-events": ""});
    }
    if (dataCheckAllTableRight.length === 0){
        $('.btn-all-right').css({"transition" : "all .2s linear","opacity": "0", "pointer-events": "none"});
    } else {
        $('.btn-all-right').css({"transition" : "","opacity": "", "pointer-events": ""});
    }
}

function updateCookiePermissionKitchen() {
    saveCookieShared('permission-kitchen-data-user-id-' + idSession, JSON.stringify({
        'tab': tabChangePermission,
    }))
}

async function dataTablePermissionKitchen(data) {
    let idEmployeeKitchenData = $('#table-employee-kitchen-data'),
        idEmployeeSelectKitchenData = $('#table-employee-select-kitchen-data'),
        idEmployeeLeaderKitchenData = $('#table-employee-leader-kitchen-data'),
        column0 = [
            {data: 'avatar', name: 'avatar'},
            {data: 'role_group', name: 'role_group'},
            {data: 'action', className: 'text-center', width: '5%'},
            {data: 'check', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        column1 = [
            {data: 'check', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar'},
            {data: 'role_group', name: 'role_group', width: '5%'},
            {data: 'action', class: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        column2 = [
            {data: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'checkbox', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar'},
            {data: 'action', class: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': '',
                'function': 'saveEmployeeKitchen',
            }
        ],
        fixedLeft = 0,
        fixedRight = 2;
    tableEmployeeDisSelectPermissionKitchen = await DatatableTemplateNew(idEmployeeKitchenData, data.data[0].original.data, column0, vh_of_table, fixedLeft, fixedRight);
    tableEmployeeSelectPermissionKitchen = await DatatableTemplateNew(idEmployeeSelectKitchenData, data.data[1].original.data, column1, vh_of_table, fixedLeft, fixedRight, option);
    tableEmployeeLeaderPermissionKitchen = await DatatableTemplateNew(idEmployeeLeaderKitchenData, data.data[2].original.data, column2, vh_of_table, fixedLeft, fixedRight);
}

/**
 * Xử lý phần bếp viên
 * @param r
 * @returns {Promise<void>}
 */
async function checkEmployeeKitchen(r) {
    tableEmployeeDisSelectPermissionKitchen.row(r.parents('tr')).remove().draw(false);
    addRowDatatableTemplate(tableEmployeeSelectPermissionKitchen, {
        'check': '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"   onclick="unCheckEmployeeKitchen($(this))" data-id="' + r.parents('tr').find('td:eq(3) button').attr('data-id') + '"  data-type="0" >' +
             '<i class="fi-rr-arrow-small-left"></i></button></div>',
        'avatar': r.parents('tr').find('td:eq(0)').html(),
        'role_group': r.parents('tr').find('td:eq(1)').html(),
        'action': r.parents('tr').find('td:eq(2)').html(),
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    });
    $('#material-kitchen-tab1 .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

async function unCheckEmployeeKitchen(r) {
    tableEmployeeSelectPermissionKitchen.row(r.parents('tr')).remove().draw(false);
    addRowDatatableTemplate(tableEmployeeDisSelectPermissionKitchen, {
        'avatar': r.parents('tr').find('td:eq(1)').html(),
        'role_group': r.parents('tr').find('td:eq(2)').html(),
        'action': r.parents('tr').find('td:eq(3)').html(),
        'check': '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"   onclick="checkEmployeeKitchen($(this))" data-id="' + r.parents('tr').find('td:eq(0) button').attr('data-id') + '"  data-type="1" >' +
            '<i class="fi-rr-arrow-small-right"></i></button></div>',
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    });
    $('#material-kitchen-tab1 .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

async function checkAllPermissionKitChenData() {
    addAllRowDatatableTemplate(tableEmployeeDisSelectPermissionKitchen, tableEmployeeSelectPermissionKitchen, itemCheckPermissionKitChenData)
    $('#material-kitchen-tab1 .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

async function unAllPermissionKitChenData() {
    addAllRowDatatableTemplate(tableEmployeeSelectPermissionKitchen, tableEmployeeDisSelectPermissionKitchen, itemUnPermissionKitChenData)
    $('#material-kitchen-tab1 .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

function itemCheckPermissionKitChenData(row) {
    return {
        'check': '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"   onclick="unCheckEmployeeKitchen($(this))" data-id="' + row.find('td:eq(3) button').attr('data-id') + '"  data-type="' + row.find('td:eq(3) button').attr('data-type') + '" >' +
            '<i class="fi-rr-arrow-small-left"></i></button></div>',
        'avatar': row.find('td:eq(0)').html(),
        'role_group': row.find('td:eq(1)').html(),
        'action': row.find('td:eq(2)').html(),
        'keysearch': row.parents('tr').find('td:eq(4)').text(),
    };
}

function itemUnPermissionKitChenData(row) {
    return {
        'avatar': row.find('td:eq(1)').html(),
        'check': '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"   onclick="checkEmployeeKitchen($(this))" data-id="' + row.find('td:eq(0) button').attr('data-id') + '"  data-type="' + row.find('td:eq(0) button').attr('data-type') + '" >' +
            '<i class="fi-rr-arrow-small-right"></i></button></div>',
        'action': row.find('td:eq(3)').html(),
        'role_group': row.find('td:eq(2)').html(),
        'keysearch': row.parents('tr').find('td:eq(4)').text(),
    }
}

async function saveEmployeeKitchen() {
    if (savePermissionKitchen !== 0) {
        return false;
    }
    savePermissionKitchen = 1;
    let branch = $('.select-branch-permission-data').val(),
        employeeInsert = [],
        employeeDelete = [];
    tableEmployeeSelectPermissionKitchen.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(0) button').attr('data-type') == 0) {
            employeeInsert.push(row.find('td:eq(0) button').attr('data-id'));
        }
    });
    tableEmployeeDisSelectPermissionKitchen.rows().every(function (i, v) {
        let row = $(this.node());
        if (row.find('td:eq(3) button').attr('data-type') == 1) {
            employeeDelete.push(row.find('td:eq(3) button').attr('data-id'));
        }
    });

    let method = 'post',
        url = 'permission-kitchen.update',
        params = null,
        data = {
            branch: branch,
            employee_insert: employeeInsert,
            employee_delete: employeeDelete,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#table-employee-kitchen-data'), $('#table-employee-select-kitchen-data')]);
    savePermissionKitchen = 0;
    if (res.data.status === 200) {
        await tableEmployeeSelectPermissionKitchen.rows().every(function () {
            let row = $(this.node());
            row.find('td:eq(0) button').attr('data-type', 1)
        });
        await tableEmployeeDisSelectPermissionKitchen.rows().every(function (i, v) {
            let row = $(this.node());
            row.find('td:eq(0) button').attr('data-type', 0)
        });
        $('#material-kitchen-tab1 .toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});
        SuccessNotify($('#success-update-data-to-server').text());
    } else {
        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
    loadData();
}

function checkEmployeeLeaderKitchen(r) {
    if (checkEmployeeLeaderData === 1) return false;
    let branch = $('.select-branch-permission-data').val();
    let title = 'Đổi nhân viên hưởng doanh số bếp trưởng',
        content = 'Hiện tại ' + $('#name-employee').text() + ' đang hưởng doanh số bếp trưởng tại chi nhánh ' + $('.select-branch-permission-data').find(':selected').text() + ' . Bạn có chắc chắn đổi ' + r.data('name') + ' để  hưởng doanh số bếp trưởng tại chi nhánh này ?',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'permission-kitchen.update-leader',
                params = {
                    branch: branch,
                    employee: r.data('id')
                },
                data = null;
            checkEmployeeLeaderData = 1;
            let res = await axiosTemplate(method, url, params, data);
            checkEmployeeLeaderData = 0;
            switch (res.data.status) {
                case 200:
                    let success = $('#success-update-data-to-server').text();
                    SuccessNotify(success);
                    $('#name-employee').html('<b style="font-size: 15px;font-weight: bold; cursor: pointer" onclick="openModalInfoEmployeeManage(' + r.data('id') + ')">' + r.data('name') + '</b>');
                    r.prop('checked', false);
                    r.parents('tbody').find('tr.highlight_row').removeClass('highlight_row');
                    r.parents('tbody').find('div.fade-in-primary').removeClass('d-none');
                    r.parents('tr').addClass('highlight_row');
                    r.parents('div.fade-in-primary').addClass('d-none');
                    break;
                case 500:
                    ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text())
            }
        } else {
            r.prop('checked', false);
        }
    });
}
