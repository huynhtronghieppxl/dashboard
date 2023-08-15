let idEmployeeMonthlyInformation = null, checkSaveModalUpdateEmployeeMonthlyInformation = 0,
    thisUpdateCurrent, checkGetMonthlySalary = 0;

function openModalUpdateBasicSalary(employee_id, branch, r) {
    thisUpdateCurrent = r;
    $('#modal-update-employee-basic-salary').modal('show');
    shortcut.add('ESC', function () {
        closeModalUpdateEmployeeMonthlyInformation();
    });
    shortcut.add('F4', function () {
        saveModalUpdateEmployeeBonusPunish();
    });
    $('#edit_monthly_salary').select2({
        dropdownParent: $('#modal-update-employee-basic-salary'),
    });
    $('#edit_monthly_salary').on('change', function () {
        $('#btn-confirm-update-employee-monthly-information').removeClass('disabled')
        $('#btn-confirm-update-employee-monthly-information').attr('disabled', false)
    })
    let month = $('#time-payroll-manage').val();
    dataUpdateTotalMonthlyOfDay(employee_id, month, branch);
}

async function dataUpdateTotalMonthlyOfDay(id, month, branch) {
    $('#name-update-basic_salary').text(thisUpdateCurrent.parents('tr').find('td:eq(1)').find('label p').text());
    $('#time-update-basic_salary').text(month);
    $('#basic_salary-update-basic_salary').text(thisUpdateCurrent.parents('tr').find('td:eq(7)').text());
    if (checkGetMonthlySalary === 1) {
        $('#edit_monthly_salary').val(-1).trigger('change.select2')
        return;
    }
    let method = 'get',
        url = 'payroll-manage.data-update',
        params = {
            id: id,
            month: month,
            branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-update-employee-monthly-information')
    ]);
    idEmployeeMonthlyInformation = res.data[0].id;
    $('#edit_monthly_salary').html(res.data[1]);
    checkGetMonthlySalary = 1
}

async function saveModalUpdateEmployeeMonthlyInformation() {
    if (checkSaveModalUpdateEmployeeMonthlyInformation === 1) return false;
    let value_select = $('#edit_monthly_salary').val();
    if (value_select === '' || value_select === null || value_select === '-2') {
        ErrorNotify('Vui lòng chọn lương điều chỉnh');
        return false;
    }
    let basic_salary = $('#select2-edit_monthly_salary-container').attr('title');
    checkSaveModalUpdateEmployeeMonthlyInformation = 1;
    let method = 'post',
        url = 'payroll-manage.update',
        params = null,
        data = {
            id: idEmployeeMonthlyInformation,
            basic_salary: basic_salary,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-employee-monthly-information'),]);
    checkSaveModalUpdateEmployeeMonthlyInformation = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalUpdateEmployeeMonthlyInformation();
            let dayMonth = thisUpdateCurrent.parents('tr').find('td:eq(8)').text().split('/')[1];
            let dayWorking = thisUpdateCurrent.parents('tr').find('td:eq(8)').text().split('/')[0];
            let oldSalaryBasic = removeformatNumber(thisUpdateCurrent.parents('tr').find('td:eq(7)').text());
            let oldSalaryDay = removeformatNumber(thisUpdateCurrent.parents('tr').find('td:eq(9)').text());

            let oldTotalSalaryBasic = removeformatNumber($('#base_salary_after_increase').text());
            let oldTotalSalaryday = removeformatNumber($('#salary_based_on_workday').text());

            let newSalaryDay = parseInt(basic_salary) / parseInt(dayMonth) * parseInt(dayWorking);

            thisUpdateCurrent.parents('tr').find('td:eq(7)').text(formatNumber(basic_salary));
            thisUpdateCurrent.parents('tr').find('td:eq(9)').text(formatNumber(parseInt(newSalaryDay)));
            $('#base_salary_after_increase').text(formatNumber(parseInt(oldTotalSalaryBasic) - parseInt(oldSalaryBasic) + parseInt(basic_salary)));
            $('#salary_based_on_workday').text(formatNumber(parseInt(newSalaryDay) - parseInt(oldSalaryDay) + parseInt(oldTotalSalaryday)));

            let valueCol1 = removeformatNumber(thisUpdateCurrent.parents('tr').find('td:eq(9)').text());
            let valueCol10 = removeformatNumber(thisUpdateCurrent.parents('tr').find('td:eq(19)').text());
            let valueCol14 = removeformatNumber(thisUpdateCurrent.parents('tr').find('td:eq(23)').text());
            let valueCol18 = removeformatNumber(thisUpdateCurrent.parents('tr').find('td:eq(27)').text());

            let newValueCol20 = parseInt(valueCol1) + parseInt(valueCol10) - parseInt(valueCol14)
            let newValueCol21 = newValueCol20 - parseInt(valueCol18)

            thisUpdateCurrent.parents('tr').find('td:eq(29)').text(formatNumber(newValueCol20))
            thisUpdateCurrent.parents('tr').find('td:eq(30)').text(formatNumber(newValueCol21))
            break;
        case 500:
            ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}

function closeModalUpdateEmployeeMonthlyInformation() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-update-employee-basic-salary').modal('hide');
    reloadModalUpdateEmployeeMonthlyInformation();
}

function reloadModalUpdateEmployeeMonthlyInformation() {
    $('#loading-modal-update-employee-monthly-information h6').text('---')
    $('#loading-modal-update-employee-monthly-information #edit_monthly_salary').val($('#edit_monthly_salary').find('option:first-child')).trigger('change.select2')
    $('#btn-confirm-update-employee-monthly-information').addClass('disabled')
    $('#btn-confirm-update-employee-monthly-information').attr('disabled', true)
}


