let idUpdateOffEmployeeManage = null, checkSaveModalUpdateOffEmployeeManage = 0;

async function openModalUpdateOffEmployeeManage(id) {
    $('#modal-update-off-employee-manage').modal('show');
    addLoading('employee-manage.data-off', '#loading-modal-update-off-employee-manage');
    addLoading('employee-manage.update-off', '#loading-modal-update-off-employee-manage');
    idUpdateOffEmployeeManage = id;
    await dataUpdateOffEmployeeManage(id);

}

function eventModalUpdateOffEmployeeManage() {
    $('#modal-update-off-employee-manage').on('shown.bs.modal', function () {
        $(this).find('input').eq(0).select();
    });
    $('input').on('input', function () {
        if (removeformatNumber($(this).val()) < 0) {
            $(this).val(0);
            $(this).select();
            let text = 'Không được nhập nhỏ hơn 0 !';
            ErrorNotify(text);
        }
    });
    $('#used-month-update-off-employee-manage').on('keydown', function (e) {
        if (e.keyCode === 13) $('#available-month-update-off-employee-manage').select();
    });
    $('#available-month-update-off-employee-manage').on('keydown', function (e) {
        if (e.keyCode === 13) $('#total-month-update-off-employee-manage').focus();
    });
    $('#total-month-update-off-employee-manage').on('keydown', function (e) {
        if (e.keyCode === 13) $('#used-year-update-off-employee-manage').select();
    });
    $('#used-year-update-off-employee-manage').on('keydown', function (e) {
        if (e.keyCode === 13) $('#available-year-update-off-employee-manage').focus();
    });
    $('#available-year-update-off-employee-manage').on('keydown', function (e) {
        if (e.keyCode === 13) $('#total-year-update-off-employee-manage').select();
    });
}

async function dataUpdateOffEmployeeManage(id) {
    let method = 'get',
        url = 'employee-manage.data-off',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#used-month-update-off-employee-manage').val(res.data[0].used_monthly_off_day);
    $('#available-month-update-off-employee-manage').val(res.data[0].total_monthly_off_day_available);
    $('#total-month-update-off-employee-manage').val(res.data[0].total_monthly_off_day);
    $('#used-year-update-off-employee-manage').val(res.data[0].used_yearly_off_day);
    $('#available-year-update-off-employee-manage').val(res.data[0].total_yearly_off_day_available);
    $('#total-month-year-off-employee-manage').val(res.data[0].total_yearly_off_day);
}

async function saveModalUpdateOffEmployeeManage() {
    if (checkSaveModalUpdateOffEmployeeManage === 1) return false;
    let used_monthly_off_day = removeformatNumber($('#used-month-update-off-employee-manage').val()),
        total_monthly_off_day_available = removeformatNumber($('#available-month-update-off-employee-manage').val()),
        total_monthly_off_day = removeformatNumber($('#total-month-update-off-employee-manage').val()),
        used_yearly_off_day = removeformatNumber($('#used-year-update-off-employee-manage').val()),
        total_yearly_off_day_available = removeformatNumber($('#available-year-update-off-employee-manage').val()),
        total_yearly_off_day = removeformatNumber($('#total-year-update-off-employee-manage').val());
    checkSaveModalUpdateOffEmployeeManage = 1;
    let method = 'post',
        url = 'employee-manage.update-off',
        params = null,
        data = {
            used_monthly_off_day: used_monthly_off_day,
            total_monthly_off_day_available: total_monthly_off_day_available,
            total_monthly_off_day: total_monthly_off_day,
            used_yearly_off_day: used_yearly_off_day,
            total_yearly_off_day_available: total_yearly_off_day_available,
            total_yearly_off_day: total_yearly_off_day,
            id: idUpdateOffEmployeeManage,
        };
    let res = await axiosTemplate(method, url, params, data);
    checkSaveModalUpdateOffEmployeeManage = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            let success = $('#success-update-off-data-to-server').text();
            SuccessNotify(success);
            closeModalUpdateOffEmployeeManage();
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

function closeModalUpdateOffEmployeeManage() {
    $('#modal-update-off-employee-manage').modal('hide');
}
