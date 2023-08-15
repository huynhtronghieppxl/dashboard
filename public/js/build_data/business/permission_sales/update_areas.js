let idEmployee,
    nameEmployeeUpdateArea ,
    idEmployeeUpdateArea ,
    idAreaPermissionSale,
    areaNamePermissionSale,
    nameArearIndex,
    checkSaveUpdatePermissionSales = 0,
    checkCancelUpdatePermissionSales = 0;

function openModalUpdatePermissionSalesAreasData(r) {
    $('#modal-update-permission-sales-data').modal('show');
    idEmployee = r.data('employee');
    idAreaPermissionSale = r.data('id');
    areaNamePermissionSale =  r.data('area');
    nameArearIndex = r.data('employee-manager')
    dataListAllEmployee();
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalUpdatePermissionSales();
    });
}
async function dataListAllEmployee(){
    let branch = $('.select-branch-permission-sales').val();
    let method = 'get',
        url = 'permission-sales.data-update',
        params = {
            branch: branch,
            id : idEmployee
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-list-all-employee-data'), $('#info-employee-permission-sales')]);
    dataTableAllListEmployeeData(res.data[0].original.data);
    if(idEmployee != 0){
        $('#cancel-employee-permission-sales').removeClass('d-none');
        $('#name-employee-permission-sales').text(res.data[1].name);
        $('#phone-employee-permission-sales').text(res.data[1].phone);
        $('#address-employee-permission-sales').text(res.data[1].address);
        $('#branch-employee-permission-sales').text(res.data[1].branch_name);
        $('#role-employee-permission-sales').text(res.data[1].role_name);
        $('#image-employee-permission-sales').attr('src',res.data[1].avatar);
    }else{
        $('#cancel-employee-permission-sales').addClass('d-none')
    }
}

async function dataTableAllListEmployeeData(data) {
    let id = $('#table-list-all-employee-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'check' , className: 'text-center'},
            {data: 'employee_avatar',className: 'text-center' , width: '5%'},
            {data: 'name', className: 'text-center'},
            {data: 'role_name', className: 'text-center'},
            {data: 'keysearch', name:'keysearch', className: 'd-none'},
        ],
        scroll_Y = "40vh",
        fixedLeft = 0,
        fixedRight = 0;
    await DatatableTemplate(id, data, column, scroll_Y, fixedLeft, fixedRight);
}

function checkEmployee(r){
    idEmployeeUpdateArea = r.data('id');
    nameEmployeeUpdateArea = r.data('name');
}

function check_list(name){
    nameEmployeeUpdateArea = $(name).attr('data-name');
}

function saveModalUpdatePermissionSales(){
    if (checkSaveUpdatePermissionSales === 1) return false;
    if ($('input[name="manage"]').is(':checked') === false){
        let text = 'Bạn chưa chọn nhân viên hưởng quyền doanh số tại '  + areaNamePermissionSale ;
        WarningNotify(text);
        return false;
    };
    let branch = $('.select-branch-permission-sales').val();
    let title = 'Đổi Hưởng Doanh Số',
        content = 'Hiện tại ' + nameArearIndex  + ' đang hưởng doanh số tại ' + areaNamePermissionSale +' . Bạn có chắn chắn đổi ' + nameEmployeeUpdateArea + ' để hưởng doanh số này ?',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkSaveUpdatePermissionSales = 1;
            let method = 'post',
            url = 'permission-sales.changeArea',
            params = {
                    branch : branch,
                    id: idEmployeeUpdateArea,
                    areas_id : idAreaPermissionSale,
                },
            data = null;
            let res = await axiosTemplate(method, url, params, data, [$('#load-modal-update-permission-sales-data')]);
            checkSaveUpdatePermissionSales = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    text = $('#success-update-data-to-server').text();
                    SuccessNotify(text);
                    loadData();
                    closeModalUpdatePermissionSales();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if(res.data.message !== null){
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if(res.data.message !== null){
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    });
}

function cancelModalUpdatePermissionSales(){
    if (checkCancelUpdatePermissionSales === 1) return false;
    let branch = $('.select-branch-permission-sales').val();
    let title = 'Hủy hưởng  doanh số',
        content = 'Bạn muốn hủy hưởng doanh số của nhân viên ' + nameArearIndex  + ' ?' ,
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkCancelUpdatePermissionSales = 1;
            let method = 'post',
                url = 'permission-sales.changeArea',
                params = {
                    branch : branch,
                    id: idEmployee,
                    areas_id : idAreaPermissionSale,
                },
                data = null;
            let res = await axiosTemplate(method, url, params, data, [$('#load-modal-update-permission-sales-data')]);
            checkCancelUpdatePermissionSales = 0;
            if (res.data.status === 200) {
                let success = $('#success-update-data-to-server').text();
                SuccessNotify(success);
                loadData();
                cancelCloseModalUpdatePermissionSales();
            }
        }
    });
}

function closeModalUpdatePermissionSales(){
    $('#modal-update-permission-sales-data').modal('hide');
    $('#name-employee-permission-sales').text('Chưa có hưởng doanh số');
    $('#phone-employee-permission-sales').text('Chưa có hưởng doanh số');
    $('#address-employee-permission-sales').text('Chưa có hưởng doanh số');
    $('#branch-employee-permission-sales').text('Chưa có hưởng doanh số');
    $('#role-employee-permission-sales').text('Chưa có hưởng doanh số');
    $('#image-employee-permission-sales').attr('src', '');
}

function cancelCloseModalUpdatePermissionSales(){
    $('#name-employee-permission-sales').text('Chưa có hưởng doanh số');
    $('#phone-employee-permission-sales').text('Chưa có hưởng doanh số');
    $('#address-employee-permission-sales').text('Chưa có hưởng doanh số');
    $('#branch-employee-permission-sales').text('Chưa có hưởng doanh số');
    $('#role-employee-permission-sales').text('Chưa có hưởng doanh số');
    $('#image-employee-permission-sales').attr('src', '');
}
