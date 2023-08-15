let idRoleData, idSearchRoleData, checkSavePerRoleData = 0, permissionActive = [], selectRoleDataGroup = $('.select-role-group-data').val();
$(function () {
    if(getCookieShared('role-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('role-data-user-id-' + idSession));
        selectRoleDataGroup = dataCookie.select;

        $('.select-role-group-data').val(selectRoleDataGroup).trigger('change.select2')
    }
    $(document).on('click', '.detail-role',  function (e) {
        $(this).toggleClass('active').parents('.ques').siblings('.ans').slideToggle();
        if ($(this).hasClass('active')){
            $(this).text('Thu gọn')
        }else{
            $(this).text('Chi tiết')
        }
    });

    shortcut.add('F2', function (){
        openModalCreateRoleData()
    })
    shortcut.add('F4', function (){
        savePermissionRoleData()
    })
    shortcut.remove('ESC');

    $(document).on('click', '.group-title-permission .title-name-group',  function (e) {
        if($(this).parents('.card').find('.card-block2').is(":hidden")){
            $(this).find('i').attr('class', '');
            $(this).find('i').addClass('icofont icofont-caret-up text-black-50');
        }else {
            $(this).find('i').attr('class', '');
            $(this).find('i').addClass('icofont icofont-caret-down text-black-50');
        }
        $(this).parents('.card').find('.card-block2').slideToggle();
    });


    $('.select-role-group-data').on('select2:select', function () {
        $('.select-role-group-data').val($(this).val()).trigger('change.select2');
        idSearchRoleData = $(this).val();
        selectRoleDataGroup = $(this).val();
        updateCookieRoleData();
        loadData();
    });
    $(document).on('click', '#table-role-data tbody tr', function (e) {
        if($(this).hasClass('selected') === true) return false;
        permissionActive = [];
        $('#permission-role-data').html('');
        $(this).parents('tr').addClass('selected');
        $('#table-role-data').DataTable().$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        idRoleData = $(this).find('td:eq(3)').find('button').data('id');
        dataPermissionRoleData();
    });
    /**
     * Check quyền
     */
    $(document).on('click', '#permission-role-data .sortable-moves .fa-square', function () {
        $(this).parents('.sortable-moves').removeClass('work-not-active');
        $(this).parents('.sortable-moves').addClass('work-active');
        $(this).removeClass('fa-square');
        $(this).addClass('fa-check-square');
        permissionActive.push(parseInt($(this).parents('.sortable-moves').data('id')));
        checkGroupFunctionPermissionRoleData();
    });
    /**
     * Bỏ check quyền
     */
    $(document).on('click', '#permission-role-data .sortable-moves .fa-check-square', function () {
        $(this).parents('.sortable-moves').removeClass('work-active');
        $(this).parents('.sortable-moves').addClass('work-not-active');
        $(this).removeClass('fa-check-square');
        $(this).addClass('fa-square');
        permissionActive = permissionActive.filter(el => el !== parseInt($(this).parents('.sortable-moves').data('id')));
        checkGroupFunctionPermissionRoleData();
    });
    /**
     * Check group chức năng
     */
    $(document).on('click', '#permission-role-data .fa-square.role-fa-square', function () {
        $(this).removeClass('fa-square');
        $(this).addClass('fa-check-square');
        $(this).parents('.zoneQA').find('li').addClass('active-role-data');
        checkGroupPermissionRoleData($(this));
    });
    /**
     * Bỏ check group chức năng
     */
    $(document).on('click', '#permission-role-data .fa-check-square.role-fa-square', function () {
        $(this).removeClass('fa-check-square');
        $(this).addClass('fa-square');
        $(this).parents('.zoneQA').find('li').removeClass('active-role-data');
        unCheckGroupPermissionRoleData($(this));
    });
    $('#search-permission-role-data').on('keyup', function () {
        let g = removeVietnameseStringLowerCase($(this).val());
        $("#permission-role-data .sortable-moves").each(function () {
            let s = $(this).data('search').toLowerCase();
            $(this).closest('.card-block2')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });
    loadData();
});

function updateCookieRoleData(){
    saveCookieShared('role-data-user-id-' + idSession, JSON.stringify({
        'select' : selectRoleDataGroup,
    }))
}

async function loadData() {
    let method = 'get',
        url = 'role-data.data',
        params = {role_id: selectRoleDataGroup},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-role-data')]);
    dataTableRoleData(res.data[0].original['data']);
    $('#select-role-create-role-data').html(res.data[1]);
    $('#select-role-update-role-data').html(res.data[1]);
    $('#table-role-data tbody tr:eq(0)').addClass('selected');
    idRoleData = $('#table-role-data tbody tr:eq(0)').find('td:eq(3)').find('button').data('id');
    dataPermissionRoleData();
}

function dataTableRoleData(data) {
    let id = $('#table-role-data'),
        fixed_left = 0,
        fixed_right = 2,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', className: 'text-left', width: '25%'},
            {data: 'group', className: 'text-left', width: '25%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title': 'Thêm mới (F2)',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateRoleData',
        }];
    DatatableTemplateNew(id, data, columns, vh_of_table, fixed_left, fixed_right, option, '', false);
}

async function dataPermissionRoleData() {
    let method = 'get',
        url = 'role-data.permission',
        branch = $('.select-branch').val(),
        params = {id: idRoleData, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#permission-role-data')]);
    $('#permission-role-data').html(res.data[0]);
    permissionActive = res.data[1];
}

async function checkGroupFunctionPermissionRoleData() {
    for await (const v of $('#permission-role-data .zoneQA')) {
        let arr = $(v).data('id').toString().split(",");
        if (arr.filter(o1 => permissionActive.some(o2 => parseInt(o1) === o2)).length === arr.length) {
            $(v).find('.class-group-function').addClass('work-active');
            $(v).find('.role-fa-square').removeClass('fa-square');
            $(v).find('.role-fa-square').addClass('fa-check-square');
        } else {
            $(v).find('.class-group-function').removeClass('work-active');
            $(v).find('.role-fa-square').removeClass('fa-check-square');
            $(v).find('.role-fa-square').addClass('fa-square');
        }
    }
}

async function checkGroupPermissionRoleData(r) {
    let arr = r.parents('.zoneQA').data('id').toString().split(",");
    for await (const v of $('#permission-role-data .sortable-moves .fa-square')) {
        if (arr.includes($(v).parents('.sortable-moves').data('id').toString())) {
            $(v).parents('.sortable-moves').removeClass('work-not-active');
            $(v).parents('.sortable-moves').addClass('work-active');
            $(v).removeClass('fa-square');
            $(v).addClass('fa-check-square');
        }
    }
}

async function unCheckGroupPermissionRoleData(r) {
    let arr = r.parents('.zoneQA').data('id').toString().split(",");
    for await (const v of $('#permission-role-data .sortable-moves .fa-check-square')) {
        if (arr.includes($(v).parents('.sortable-moves').data('id').toString())) {
            $(v).parents('.sortable-moves').addClass('work-not-active');
            $(v).parents('.sortable-moves').removeClass('work-active');
            $(v).addClass('fa-square');
            $(v).removeClass('fa-check-square');
        }
    }
}

async function savePermissionRoleData() {
    if (checkSavePerRoleData === 1) return false;
    let privileges = [];
    $('#permission-role-data .sortable-moves .fa-check-square').each(function (i, v) {
        privileges.push($(v).parents('.sortable-moves').data('id'));
    });
    checkSavePerRoleData = 1;
    let method = 'post',
        url = 'role-data.update-permission',
        params = null,
        data = {
            id: idRoleData,
            privilege_ids: privileges,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#permission-role-data')]);
    checkSavePerRoleData = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            break;
        case 300:
            let title = 'Xác nhận ?',
                content = res.data.message,
                icon = 'question';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    checkSavePermissionEmployeeData = 1;
                    let method = 'post',
                        url = 'role-data.update-permission',
                        params = null,
                        data = {
                            id: idRoleData,
                            privilege_ids: privileges,
                            confirmed : 1,
                        };
                    let res = await axiosTemplate(method, url, params, data, [$('#permission-role-data')]);
                    checkSavePerRoleData = 0;
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
            break;
    }
}
