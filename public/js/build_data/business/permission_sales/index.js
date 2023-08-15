let tableEmployeePermissionSale, checkChangeEmployeeManageBranch = 0;

$(async function () {
    if(!$('.select-branch-permission-sales').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
});

async function loadData() {
    let branch = $('.select-branch-permission-sales').val();
    let method = 'get',
        url = 'permission-sales.data',
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-pesmission-sales-branch-data'), $('#table-All-employee-branch-data')]);
    $('#name-employee').text(res.data[0].name);
    $('#name-branch').text($('.select-branch-permission-sales').find(':selected').text());
    await dataTablePermissionSale(res);
    tableEmployeePermissionSale.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('input').data('id') == res.data[0].id) {
            row.find('input').parents('tr').addClass('highlight_row');
            row.find('input').parents('div.check-manage-branch').addClass('d-none');
        }
    });
}

async function dataTablePermissionSale(data) {
        let id = $('#table-All-employee-branch-data'),
            columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'check', className: 'text-center', width: '5%'},
            {data: 'name',name: 'name'},
            {data: 'username',name: 'username', className: 'text-left'},
            {data: 'gender',name: 'gender', className: 'text-left pt-3'},
            {data: 'phone',name: 'phone', className: 'text-center'},
            {data: 'branch_name',name: 'branch_name', className: 'text-left'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [],
        fixedLeft = 0,
        fixedRight = 0;
    tableEmployeePermissionSale = await DatatableTemplateNew(id, data.data[2].original.data, columns, vh_of_table, fixedLeft, fixedRight, option);
}

function checkEmployeeManageBranch(r) {
    if (checkChangeEmployeeManageBranch === 1) return false;
    let branch = $('.select-branch-permission-sales').val();
    let title = 'Đổi Nhân viên hưởng doanh số',
        content = 'Hiện tại ' + $('#name-employee').text() + ' đang hưởng doanh số tại chi nhánh ' + $('.select-branch-permission-sales').find(':selected').text() + ' . Bạn có chắc chắn đổi ' + r.data('name') + ' để quản lý chi nhánh này ?',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkChangeEmployeeManageBranch = 1;
            let method = 'post',
                url = 'permission-sales.manage-branch',
                params = {
                    branch: branch,
                    id: r.data('id')
                },
                data = null;
            let res = await axiosTemplate(method, url, params, data, [$('#table-All-employee-branch-data')]);
            checkChangeEmployeeManageBranch = 0;
            switch (res.data.status) {
                case 200:
                    let success = $('#success-update-data-to-server').text();
                    SuccessNotify(success);
                    $('#name-employee').text(r.data('name'));
                    // r.prop('checked', false);
                    $('.m-0').change(function(){
                        if($(this).is(':checked')){
                            $('.m-0').prop('checked',false);
                            $(this).prop('checked',true);
                        }
                    });
                    r.parents('tbody').find('tr.highlight_row').removeClass('highlight_row');
                    r.parents('tbody').find('div.check-manage-branch').removeClass('d-none');
                    r.parents('tr').addClass('highlight_row');
                    r.parents('div.check-manage-branch').addClass('d-none');
                    break;
                case 500:
                    ErrorNotify(res.data.Config.message);
                    break;
                default:
                    WarningNotify(res.data.Config.message);
            }
        } else {
            r.prop('checked', false);
        }
    });
}
