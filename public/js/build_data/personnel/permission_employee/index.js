let idPermissionEmployeeRole, checkSavePermissionEmployeeData = 0, permissionEmployeeActive =[];

$(function () {
    loadData();
    $(document).on('click', '.detail-role',  function (e) {
        e.preventDefault();
        $(this).toggleClass('active').parents('.ques').siblings('.ans').slideToggle();
        if ($(this).hasClass('active')){
            $(this).text('Thu gọn')
        }else{
            $(this).text('Chi tiết')
        }
    });
    shortcut.add('F4', function () {
        savePermissionEmployeeData();
    })
    $(document).on('click', '#table-employee-permission-data tbody tr', function () {
        if($(this).hasClass('selected')) return false;
        permissionActive = [];
        if ($('#button-service-1').hasClass('d-none') === false) {
            let title = 'Cảnh báo ?',
                content = 'Sự thay đổi chưa được lưu lại, làm mới sẽ mất dữ liệu đã thay đổi !',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    let table = $('#table-employee-permission-data').DataTable();
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    idPermissionEmployeeRole = $(this).find('td:eq(1)').find('input').val();
                    dataEmployeePermissionData();
                }
            });
        } else {
            let table = $('#table-employee-permission-data').DataTable();
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            idPermissionEmployeeRole = $(this).find('td:eq(1)').find('input').val();
            dataEmployeePermissionData();
        }
    });
    $(document).on('click', '#permission-employee-data .sortable-moves .fa-square', function () {
        $(this).parents('.sortable-moves').removeClass('work-not-active');
        $(this).parents('.sortable-moves').addClass('work-active');
        $(this).removeClass('fa-square');
        $(this).addClass('fa-check-square');
        permissionEmployeeActive.push(parseInt($(this).parents('.sortable-moves').data('id')));
        checkGroupFunctionPermissionEmployeeData();
    });
    $(document).on('click', '#permission-employee-data .sortable-moves .fa-check-square', function () {
        $(this).parents('.sortable-moves').removeClass('work-active');
        $(this).parents('.sortable-moves').addClass('work-not-active');
        $(this).removeClass('fa-check-square');
        $(this).addClass('fa-square');
        permissionEmployeeActive = permissionEmployeeActive.filter(el => el !== parseInt($(this).parents('.sortable-moves').data('id')));
        checkGroupFunctionPermissionEmployeeData();
    });

    $(document).on('click', '#permission-employee-data .fa-square.employee-fa-square', function () {
        $(this).removeClass('fa-square');
        $(this).addClass('fa-check-square');
        $(this).parents('.zoneQA').find('li').addClass('active-employee-role-data');
        checkGroupPermissionEmployeeData($(this));
    });
    $(document).on('click', '#permission-employee-data .fa-check-square.employee-fa-square', function () {
        $(this).removeClass('fa-check-square');
        $(this).addClass('fa-square');
        $(this).parents('.zoneQA').find('li').removeClass('active-employee-role-data');
        unCheckGroupPermissionEmployeeData($(this));
    });
    $('#search-permission-employee-data').on('keyup', function () {
        let g = removeVietnameseStringLowerCase($(this).val());
        $("#permission-employee-data .sortable-moves").each(function () {
            let s = $(this).data('search').toLowerCase();
            $(this).closest('.card-block2')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });
});

async function loadData() {
    let method = 'get',
        url = 'permission-employee-data.employee',
        branch = $('.select-branch-permission-employee-data').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-employee-permission-data')]);
    await dataTableEmployeePermissionData(res.data[0].original.data);
    $('#table-employee-permission-data tbody tr:eq(0)').addClass('selected');
    idPermissionEmployeeRole = $('#table-employee-permission-data tbody tr:eq(0)').find('td:eq(1)').find('input').val();
    dataEmployeePermissionData();
}

async function checkSaveEmployeePermissionData() {
    let check = false;
    for await (const v of $('#permission-employee-data .sortable-moves i')) {
        if (!$(v).hasClass($(v).data('check'))) {
            check = true;
        }
    }
    (check) ? $('#button-service-1').removeClass('d-none') : $('#button-service-1').addClass('d-none');
}

function dataTableEmployeePermissionData(data) {
    let id = $('#table-employee-permission-data'),
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', className: 'text-left'},
            {data: 'role_name', className: 'text-left border-resize-datatable'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [],
        fixed_left = 0,
        fixed_right = 0;
    DatatableTemplateNew(id, data, columns, vh_of_table, fixed_left, fixed_right,option, '', false);
}

async function dataEmployeePermissionData() {
    if(!idPermissionEmployeeRole) {
        WarningNotify(`Chi nhánh ${$('.select-branch').find(':selected').text()} chưa có nhân viên`);
        $('#permission-employee-data').html('');
        return false;
    }
    let method = 'GET',
        url = 'permission-employee-data.permission',
        branch = $('.select-branch-permission-employee-data').val(),
        params = {id: idPermissionEmployeeRole, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#permission-employee-data')]);
    $('#permission-employee-data').html(res.data[0]);
    $('#button-service-1').addClass('d-none')
}

async function savePermissionEmployeeData() {
    if(checkSavePermissionEmployeeData === 1) return false;
    let privileges = [];
    $('#permission-employee-data .sortable-moves').each(function (i, v) {
        if ($(v).find('.fa-check-square').length === 1) {
            privileges.push($(v).data('id'));
        }
    });
    checkSavePermissionEmployeeData = 1;
    let method = 'post',
        url = 'permission-employee-data.update',
        params = null,
        data = {
            id: idPermissionEmployeeRole,
            privileges: privileges,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#permission-employee-data')]);
    checkSavePermissionEmployeeData = 0;
    let text = '';
    switch (res.data.status ) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            $('#button-service-1').addClass('d-none');
            break;
        case 300:
            let title = 'Xác nhận ?',
                content = res.data.message,
                icon = 'question';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    checkSavePermissionEmployeeData = 1;
                    let method = 'post',
                        url = 'permission-employee-data.update',
                        params = null,
                        data = {
                            id: idPermissionEmployeeRole,
                            privileges: privileges,
                            confirmed : 1,
                        };
                    let res = await axiosTemplate(method, url, params, data, [$('#permission-employee-data')]);
                    checkSavePermissionEmployeeData = 0;
                    switch (res.data.status) {
                        case 200:
                            text = $('#success-update-data-to-server').text();
                            SuccessNotify(text);
                            break;
                        case 500:
                            text = $('#error-post-data-to-server').text();
                            if (res.data.message !== null) {
                                text = res.data.message;
                            }
                            ErrorNotify(text);
                            break;
                        default:
                            text = $('#error-post-data-to-server').text();
                            if (res.data.message !== null) {
                                text = res.data.message;
                            }
                            WarningNotify(text);
                    }
                }
            })
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

async function checkGroupFunctionPermissionEmployeeData() {
    for await (const v of $('#permission-employee-data .zoneQA')) {
        let arr = $(v).data('id').toString().split(",");
        if (arr.filter(o1 => permissionEmployeeActive.some(o2 => parseInt(o1) === o2)).length === arr.length) {
            $(v).find('.class-group-function').addClass('work-active');
            $(v).find('.employee-fa-square').removeClass('fa-square');
            $(v).find('.employee-fa-square').addClass('fa-check-square');
        } else {
            $(v).find('.class-group-function').removeClass('work-active');
            $(v).find('.employee-fa-square').removeClass('fa-check-square');
            $(v).find('.employee-fa-square').addClass('fa-square');
        }
    }
}

async function checkGroupPermissionEmployeeData(r) {
    let arr = r.parents('.zoneQA').data('id').toString().split(",");
    for await (const v of $('#permission-employee-data .sortable-moves .fa-square')) {
        if (arr.includes($(v).parents('.sortable-moves').data('id').toString())) {
            $(v).parents('.sortable-moves').removeClass('work-not-active');
            $(v).parents('.sortable-moves').addClass('work-active');
            $(v).removeClass('fa-square');
            $(v).addClass('fa-check-square');
        }
    }
}

async function unCheckGroupPermissionEmployeeData(r) {
    let arr = r.parents('.zoneQA').data('id').toString().split(",");
    for await (const v of $('#permission-employee-data .sortable-moves .fa-check-square')) {
        if (arr.includes($(v).parents('.sortable-moves').data('id').toString())) {
            $(v).parents('.sortable-moves').addClass('work-not-active');
            $(v).parents('.sortable-moves').removeClass('work-active');
            $(v).addClass('fa-square');
            $(v).removeClass('fa-check-square');
        }
    }
}
