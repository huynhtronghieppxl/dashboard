let tableCheckInEmployeeManage, tableNotCheckInEmployeeManage, tableByPassCheckInEmployeeManage, tableOffEmployeeManage, tableQuitJobEmployeeManage,
    tableEnableEmployeeManage, tableDisableEmployeeManage, tabEmployeeChange = 1, checkLoadDataEmployeeManage = 1;
$(function () {
    if(getCookieShared('employee-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('employee-manage-user-id-' + idSession));
        tabEmployeeChange = dataCookie.tabEmployeeChange;
    }

    $('#nav-tabs-employee a').on('click', function () {
        tabEmployeeChange = $(this).data('id')
        updateCookieEmployeeManageTabs();
    })
    loadData();
    $('#nav-tabs-employee a[data-id="' + tabEmployeeChange + '"]').click()
});

function updateCookieEmployeeManageTabs(){
    saveCookieShared('employee-manage-user-id-' + idSession, JSON.stringify({
        'tabEmployeeChange' : tabEmployeeChange
    }))
}

async function loadData() {
    if(checkLoadDataEmployeeManage !== 1) return false;
    let method = 'get',
        url = 'employee-manage.data',
        branch = $('.select-branch-employee-manage-data').val(),
        restaurant_brand_id = $('.select-brand-employee-manage-data').val(),
        params = {
            branch: branch,
            restaurant_brand_id: restaurant_brand_id
        },
        data = null;
    checkLoadDataEmployeeManage = 0;
    let res = await axiosTemplate(method, url, params, data, [
        $('#content-body-techres')
    ]);
    checkLoadDataEmployeeManage = 1;
    if (res.data.length > 4) {
        dataTableEmployeeManage(res);
        dataTotalEmployeeManage(res.data[6]);
    } else {
        dataTableNotTMSEmployeeManage(res);
        dataTotalNotTMSEmployeeManage(res.data[2]);
    }
}

async function dataTableEmployeeManage(res) {
    let id1 = $('#tab1-table-employee'),
        id2 = $('#tab3-table-employee'),
        id3 = $('#tab2-table-employee'),
        id5 = $('#tab5-table-employee'),
        id6 = $('#tab6-table-employee'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', width: "20%"},
            {data: 'username', class: 'text-left', width: '8%'},
            {data: 'gender', class: 'text-left pt-3'},
            {data: 'phone', class: 'text-center'},
            {data: 'branch_name', class: 'text-left'},
            {data: 'action', width: '8%'},
            {data: 'keysearch', class: 'd-none'},
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateEmployeeManage',
        }]

    tableCheckInEmployeeManage = await DatatableTemplateNew(id1, res.data[0].original.data, column, vh_of_table, fixed_left, fixed_right,option);
    tableNotCheckInEmployeeManage = await DatatableTemplateNew(id2, res.data[2].original.data, column, vh_of_table, fixed_left, fixed_right,option);
    tableByPassCheckInEmployeeManage = await DatatableTemplateNew(id3, res.data[1].original.data, column, vh_of_table, fixed_left, fixed_right,option);
    tableOffEmployeeManage = await DatatableTemplateNew(id5, res.data[4].original.data, column, vh_of_table, fixed_left, fixed_right,option);
    tableQuitJobEmployeeManage = await DatatableTemplateNew(id6, res.data[5].original.data, column, vh_of_table, fixed_left, fixed_right,option);

    $(document).on('input paste keyup','input[type="search"]', async function (){
        $('#total-record-check-in-employee').text(formatNumber(tableCheckInEmployeeManage.rows({'search':'applied'}).count()))
        $('#total-record-not-check-in-employee').text(formatNumber(tableNotCheckInEmployeeManage.rows({'search':'applied'}).count()))
        $('#total-record-bypass-employee').text(formatNumber(tableByPassCheckInEmployeeManage.rows({'search':'applied'}).count()))
        $('#total-record-employee-off').text(formatNumber(tableOffEmployeeManage.rows({'search':'applied'}).count()))
        $('#total-record-employee-quit-job').text(formatNumber(tableQuitJobEmployeeManage.rows({'search':'applied'}).count()))
        searchUpdateIndexDatatable(tableCheckInEmployeeManage)
        searchUpdateIndexDatatable(tableNotCheckInEmployeeManage)
        searchUpdateIndexDatatable(tableByPassCheckInEmployeeManage)
        searchUpdateIndexDatatable(tableOffEmployeeManage)
        searchUpdateIndexDatatable(tableQuitJobEmployeeManage)
    })
}

function dataTotalEmployeeManage(data) {
    $('#total-record-check-in-employee').text(data.total_check_in);
    $('#total-record-not-check-in-employee').text(data.total_not_check_in);
    $('#total-record-employee-off').text(data.total_off);
    $('#total-record-employee-quit-job').text(data.total_quit_job);
    $('#total-record-bypass-employee').text(data.total_bypass_checkin);
    // $('#total-record-never-check-in-employee').text(data.total_never_check_in);
}

async function dataTableNotTMSEmployeeManage(data) {
    let scroll_Y = vh_of_table,
        fixed_left = 3,
        fixed_right = 2,
        id1 = $('#tab1-not-tms-table-employee'),
        id2 = $('#tab2-not-tms-table-employee'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name'},
            {data: 'username', class: 'text-center', width: '8%'},
            {data: 'gender', class: 'text-center'},
            {data: 'phone', class: 'text-center'},
            {data: 'branch_name', class: 'text-center'},
            {data: 'action', width: '8%', class: 'text-center'},
            {data: 'keysearch', className: 'd-none '},
        ];
    tableEnableEmployeeManage = await DatatableTemplateNew(id1, data.data[0], column, scroll_Y, fixed_left, fixed_right);
    tableDisableEmployeeManage = await DatatableTemplateNew(id2, data.data[1], column, scroll_Y, fixed_left, fixed_right);

    $(document).on('input paste keyup','input[type="search"]', async function (){
        $('#total-record-enable-employee-not-tms').text(formatNumber(tableEnableEmployeeManage.rows({'search':'applied'}).count()))
        $('#total-record-disable-employee-not-tms').text(formatNumber(tableDisableEmployeeManage.rows({'search':'applied'}).count()))
        searchUpdateIndexDatatable(tableEnableEmployeeManage)
        searchUpdateIndexDatatable(tableDisableEmployeeManage)
    })
}

function dataTotalNotTMSEmployeeManage(data) {
    $('#total-record-enable-employee-not-tms').text(data.enable);
    $('#total-record-disable-employee-not-tms').text(data.disable);
}

async function changeStatusWorkingEmployeeManage(id, branch_id) {
    let title = 'Nhân viên thôi việc?',
        content = 'Nhân viên sau khi thôi việc sẽ xóa dữ liệu nghỉ phép, chuyên cần, điểm thưởng!',
        icon = 'warning';

    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'employee-manage.quit-job',
                params = null,
                data = {
                    id: id,
                };
            await $('#btn-status-working-employee-manage').prop('disabled', true);
            let res = await axiosTemplate(method, url, params, data);
            let text = '';
            switch(res.data[0].status) {
                case 200:
                    text = $('#success-status-data-to-server').text();
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data[0].message !== null) {
                        text = res.data[0].message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data[0].message !== null) {
                        text = res.data[0].message;
                    }
                    WarningNotify(text)
            }
        }
    })
}

async function changeStatusEmployeeManage(id, branch_id, status = 0) {
    let title = 'Tạm khoá tài khoản ?',
        content = '',
        icon = 'question';
    if (status != 0) {
        title = 'Bật hoạt động tài khoản ?',
            content = '',
            icon = 'question';
    }
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'employee-manage.off',
                params = null,
                data = {
                    id: id,
                };
            await $('#btn-status-working-employee-manage').prop('disabled', true);
            let res = await axiosTemplate(method, url, params, data);
            let text = '';
            switch(res.data.status) {
                case 200:
                    text = $('#success-status-data-to-server').text();
                    SuccessNotify(text);
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
                    WarningNotify(text)
            }
        }
    })
}

async function resetPassword(r) {
    let title = 'Reset mật khẩu',
        content = '',
        icon = 'question',
        html = 'Bạn có muốn reset lại mật khẩu của nhân viên '
            + '<div class="text-left">'
            + '</br>Tên nhân viên: <strong>'+r.data('name')+'</strong>'
            + '</br> Công ty/nhà hàng: <strong>'+r.data('restaurant-normalize-name')+'</strong>'
            + '</br>Tài khoản:  <strong>'+r.data('user')+'</strong>'
            + '</br>Mật khẩu :  <strong> 0000 </strong></div>'
    sweetAlertComponent(title, content, icon, html).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'employee-manage.reset-password',
                params = null,
                data = {
                    id: r.data('id'),
                };
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            let text = '';
            switch(res.data.status) {
                case 200:
                    // text = $('#success-status-data-to-server').text();
                    SuccessNotify('Đổi mật khẩu thành công');
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
                    WarningNotify(text)
            }
        }
    })
}

async function changeStatusEmployeeManageNotTms(id, branch_id, status) {
    let title = (status === 1) ? 'Tạm ngưng tài khoản này?' : 'Bật hoạt động tài khoản này?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'employee-manage.off',
                params = null,
                data = {
                    id: id,
                };
            await $('#btn-status-working-employee-manage').prop('disabled', true);
            let res = await axiosTemplate(method, url, params, data);
            let text = '';
            switch(res.data.status) {
                case 200:
                    text = $('#success-status-data-to-server').text();
                    SuccessNotify(text);
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
                    WarningNotify(text)
            }
        }
    })
}
