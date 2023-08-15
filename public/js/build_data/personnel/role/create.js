let saveCreateRoleData, loadPermissionCreateRoleData = 0, checkSaveRoleData = 0,permissionCreateRoleActive = [];
$(function () {
    $(document).on('click', '#permission-create-role-data .sortable-moves .fa-square', function () {
        $(this).parents('.sortable-moves').removeClass('work-not-active');
        $(this).parents('.sortable-moves').addClass('work-active');
        permissionCreateRoleActive.push(parseInt($(this).parents('.sortable-moves').data('id')));
        $(this).removeClass('fa-square');
        $(this).addClass('fa-check-square');
        checkGroupFunctionPermissionCreateRoleData();
    });

    $(document).on('click', '#permission-create-role-data .sortable-moves .fa-check-square', function () {
        $(this).parents('.sortable-moves').removeClass('work-active');
        $(this).parents('.sortable-moves').addClass('work-not-active');
        permissionCreateRoleActive = permissionCreateRoleActive.filter(el => el !== parseInt($(this).parents('.sortable-moves').data('id')));
        $(this).removeClass('fa-check-square');
        $(this).addClass('fa-square');
        checkGroupFunctionPermissionCreateRoleData();
    });

    /**
     * Check group chức năng
     */
    $(document).on('click', '#permission-create-role-data .fa-square.create-role-fa-square', function () {
         $(this).removeClass('fa-square');
        $(this).addClass('fa-check-square');
        $(this).parents('.zoneQA').find('li').addClass('active-role-data');
        checkGroupPermissionCreateRoleData($(this));
    })

    /**
     * Bỏ check group chức năng
     */
    $(document).on('click', '#permission-create-role-data .fa-check-square.create-role-fa-square', function () {
        $(this).removeClass('fa-check-square');
        $(this).addClass('fa-square');
        $(this).parents('.zoneQA').find('li').removeClass('active-role-data');
        unCheckGroupPermissionCreateRoleData($(this));
    });

    $('#modal-create-role-data input').on('keyup', function () {
        $('.btn-renew').removeClass('d-none')
    })

    $('#modal-create-role-data #description-create-role-data').on('keyup', function () {
        $('.btn-renew').removeClass('d-none')
    })
    $('#loading-modal-create-role-data select').on('change', function () {
        $('.btn-renew').removeClass('d-none')
    })
})

function openModalCreateRoleData() {
    saveCreateRoleData = 0;
    $('#modal-create-role-data').modal('show');
    addLoading('role-data.create', '#loading-modal-create-role-data');
    addLoading('role-data.data-permission', '#loading-modal-create-role-data');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalCreateRoleData();
    });
    shortcut.add('F4', function () {
        saveModalCreateRoleData();
    });
    $('#select-role-create-role-data, #select-group-create-role-data').select2({
        dropdownParent: $('#modal-create-role-data'),
    });
    $('#search-permission-create-role-data').on('keyup', function () {
        let g = removeVietnameseStringLowerCase($(this).val());
        $("#permission-create-role-data .sortable-moves").each(function () {
            let s = $(this).data('search').toLowerCase();
            $(this).closest('.card-block2')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });
    dataPermissionCreateRoleData();

}

async function dataPermissionCreateRoleData() {
    if (loadPermissionCreateRoleData === 0) {
        let method = 'get',
            url = 'role-data.data-permission',
            branch = $('#change_branch').val(),
            params = {id: idRoleData, branch: branch},
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#select-role-create-role-data')]);
        loadPermissionCreateRoleData = 1;
        $('#permission-create-role-data').html(res.data[0]);
    }
}

async function saveModalCreateRoleData() {
    if (checkSaveRoleData === 1) return false;
    if (!checkValidateSave($('#modal-create-role-data'))) return false
    let name = $('#name-create-role-data').val(),
        role = $('#select-role-create-role-data').val(),
        description = $('#description-create-role-data').val(),
        type = $('#select-group-create-role-data').val(),
        employee_privilege_group_ids = [];
    $('#permission-create-role-data .sortable-moves').each(function (i, v) {
        if ($(v).find('.fa-check-square').length === 1) {
            employee_privilege_group_ids.push($(v).data('id'));
        }
    });
    checkSaveRoleData = 1;
    let method = 'post',
        url = 'role-data.create',
        params = null,
        data = {
            name: name,
            role: role,
            id: idRoleData,
            description: description,
            type: type,
            employee_privilege_group_ids: employee_privilege_group_ids,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-role-data ')]);
    checkSaveRoleData = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = 'Thêm mới thành công !';
            SuccessNotify(text);
            closeModalCreateRoleData();
            shortcut.remove('ESC');
            shortcut.add('F2', function (){
                openModalCreateRoleData()
            })
            shortcut.add('F4', function (){
                savePermissionRoleData()
            })
            loadData();
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

function closeModalCreateRoleData() {
    $('#modal-create-role-data').modal('hide');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateRoleData()
    })
    shortcut.add('F4', function (){
        savePermissionRoleData()
    })
    reloadModalCreateRoleData();
}

function reloadModalCreateRoleData(){
    removeAllValidate();
    $('#name-create-role-data').val('');
    $('#select-role-create-role-data').val('').trigger('change.select2');
    $('#description-create-role-data').val('');
    $('#select-group-create-role-data').val(-2).trigger('change.select2');
    $('#search-permission-create-role-data').val('');
    $('#select-group-create-role-data').find('option:first').prop('selected', true).trigger('change.select2');
    $('#permission-create-role-data .fa-check-square').addClass('fa-square');
    $('#permission-create-role-data .fa-check-square').removeClass('fa-check-square');
    $('#permission-create-role-data .fa-minus-square').parents('.sortable-moves').addClass('work-not-active');
    $('#permission-create-role-data .fa-minus-square').parents('.sortable-moves').removeClass('work-active');
    $('#modal-create-role-data .btn-renew').addClass('d-none')
}

async function checkGroupPermissionCreateRoleData(r) {
    let arr = r.parents('.zoneQA').data('id').toString().split(",");
    for await (const v of $('#permission-create-role-data .sortable-moves .fa-square')) {
        if (arr.includes($(v).parents('.sortable-moves').data('id').toString())) {
            $(v).parents('.sortable-moves').removeClass('work-not-active');
            $(v).parents('.sortable-moves').addClass('work-active');
            $(v).removeClass('fa-square');
            $(v).addClass('fa-check-square');
        }
    }
}

async function unCheckGroupPermissionCreateRoleData(r) {
    let arr = r.parents('.zoneQA').data('id').toString().split(",");
    for await (const v of $('#permission-create-role-data .sortable-moves .fa-check-square')) {
        if (arr.includes($(v).parents('.sortable-moves').data('id').toString())) {
            $(v).parents('.sortable-moves').addClass('work-not-active');
            $(v).parents('.sortable-moves').removeClass('work-active');
            $(v).addClass('fa-square');
            $(v).removeClass('fa-check-square');
        }
    }
}

async function checkGroupFunctionPermissionCreateRoleData() {
    for await (const v of $('#permission-create-role-data .zoneQA')) {
        let arr = $(v).data('id').toString().split(",");
        if (arr.filter(o1 => permissionCreateRoleActive.some(o2 => parseInt(o1) === o2)).length === arr.length) {
            $(v).find('.class-group-function').addClass('work-active');
            $(v).find('.create-role-fa-square').removeClass('fa-square');
            $(v).find('.create-role-fa-square').addClass('fa-check-square');
        } else {
            $(v).find('.class-group-function').removeClass('work-active');
            $(v).find('.create-role-fa-square').removeClass('fa-check-square');
            $(v).find('.create-role-fa-square').addClass('fa-square');
        }
    }
}
