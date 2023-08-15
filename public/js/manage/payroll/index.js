let dataTablePayrollManage = null, checkDeniedSalaryEmployee = 0, timePayrollManage, selectRoleData,
    selectStatusPayrollManage,checkVerifyPayrollCheckOwnerSalaryEmployee;
let dataExcelPayrollManage = [];

$(function () {
    if (getCookieShared('cookiePayrollManage')) {
        let dataCookie = JSON.parse(getCookieShared('cookiePayrollManage'));
        timePayrollManage = dataCookie.timePayrollManage;
        selectRoleData = dataCookie.selectRoleData;
        selectStatusPayrollManage = dataCookie.selectStatusPayrollManage;
        $('#time-payroll-manage').val(timePayrollManage)
        $('#select-role-payroll-manage').val(selectRoleData).trigger('change.select2')
        $('#select-status-payroll-manage').val(selectStatusPayrollManage).trigger('change.select2')
    }
    dateTimePickerMonthYearTemplate($('#time-payroll-manage'));
    $('#search-time-payroll-manage').on("click", function () {
        $('.date-detail').html($('#time-payroll-manage').val());
        loadDataTable();
        updateCookiePayrollManage()
    });
    $('#salary-waiting-approved').on('click', function () {
        verifyPayroll(null);
    });
    $('#select-role-payroll-manage, #select-status-payroll-manage').on('select2:select', function () {
        loadDataTable();
        updateCookiePayrollManage()
    });
    $('.button-owner-confirm').on('click', function () {
        if (dataTablePayrollManage.data().length > 1) {
            $('.checkbox-owner-confirm').removeClass('d-none');
            $('.button-owner-cancel').removeClass('d-none');
            $('.item-checkbox-owner-confirm').removeClass('d-none');
            $('.item-button-owner-confirm').addClass('d-none');
            $('.button-owner-confirm').find('button').attr('onclick', 'verifyPayrollCheckOwner($(this))');
            dataTablePayrollManage.draw();
        } else {
            WarningNotify('Số nhân viên phải lớn hơn 1');
        }
    })
    $('.button-owner-cancel').on('click', function () {
        $('.item-button-owner-confirm').removeClass('d-none');
        $('.item-checkbox-owner-confirm').addClass('d-none');
        $('.button-owner-cancel').addClass('d-none');
        $('.button-owner-confirm').find('button').attr('onclick', '');
        dataTablePayrollManage.draw();
    })
    $('#checkbox-all-salary').change(function () {
        let count=0
        if ($(this).is(':checked')) {
            dataTablePayrollManage.rows().every(function (index, element) {
                let x = $(this.node());
                if( !x.find('td:eq(33)').find('.checkbox-salary-treasure ').find('input').hasClass('disabled')){
                    x.find('td:eq(33)').find('.checkbox-salary-treasure ').find('input').prop('checked', true)
                    count++
                }
            })
            $('#total-count-confirm-salary').text(count+'/'+count)
        } else {
            dataTablePayrollManage.rows().every(function (index, element) {
                let x = $(this.node());
                x.find('td:eq(33)').find('.checkbox-salary-treasure ').find('input').prop('checked', false)
                if( !x.find('td:eq(33)').find('.checkbox-salary-treasure ').find('input').hasClass('disabled')){
                    count++
                }
            })
            $('#total-count-confirm-salary').text('0/'+count)
        }
    })
    $(document).on('change', '#check-salary', function (){
        if ($(this).is(':checked')) {
            let checkALl=true
            dataTablePayrollManage.rows().every(function (index, element) {
                let x = $(this.node());
                if( !x.find('td:eq(33)').find('input').hasClass('disabled')){
                    if( x.find('td:eq(33)').find('input').is(':checked') ){}
                    else {
                        $('#checkbox-all-salary').prop('checked', false)
                        checkALl=false
                    }
                }
            })
            if(checkALl) {
                $('#checkbox-all-salary').prop('checked', true)
            }
            let total= $('#total-count-confirm-salary').text().split('/')[0]
            $('#total-count-confirm-salary').text(parseInt(total)+1+'/'+$('#total-count-confirm-salary').text().split('/')[1])
        } else {
            let total= $('#total-count-confirm-salary').text().split('/')[0]
            $('#total-count-confirm-salary').text(parseInt(total)-1+'/'+$('#total-count-confirm-salary').text().split('/')[1])
            $('#checkbox-all-salary').prop('checked', false)
        }
    })
    loadData();
});

function updateCookiePayrollManage() {
    saveCookieShared('cookiePayrollManage', JSON.stringify({
        timePayrollManage: $('#time-payroll-manage').val(),
        selectRoleData: $('#select-role-payroll-manage').val(),
        selectStatusPayrollManage: $('#select-status-payroll-manage').val()
    }))
}

function loadData() {
    loadDataTable();
    loadRole();
}

async function loadRole() {
    let branch = $('.select-branch').val(),
        method = 'get',
        url = 'payroll-manage.role',
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#select-role-payroll-manage').html(res.data[0]);
    $('#select-role-payroll-manage').val(selectRoleData).trigger('change.select2')
}

async function loadDataTable() {
    let branch = $('.select-branch').val(),
        time = $('#time-payroll-manage').val(),
        role = $('#select-role-payroll-manage').find('option:selected').val(),
        status = $('#select-status-payroll-manage').find('option:selected').val(),
        method = 'get',
        url = 'payroll-manage.data',
        params = {time: time, branch: branch, role: role, status: status},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$("#table-data-payroll")]);
    $('.select2').attr("style", "z-index: 0");
    $('#salary_total_treasurer').attr("style", 'width: 73px !important');
    dataTotal(res.data[1]);
    dataCheck(res.data[2]);
    dataTable(res.data[0].original.data);
    dataExcelPayrollManage = res.data[3].data.list;
    $("#table-data-payroll .row").eq(1).each(function () {
        if (($(this).find('.dataTables_scrollBody table tbody tr').find('td:eq(32)').find('.item-button-owner-confirm')).length > 2) {
            $('.button-owner-confirm').removeClass('d-none');
        } else {
            $('.button-owner-confirm').addClass('d-none');
        }
    });
}

async function dataTable(data) {
    let statusOwnerConfirm = 0;
    data.map(item => {
        if (item.status === 1 || item.status === 2 || item.status === 3 || item.status === 4 ){
            statusOwnerConfirm++
        }
    })
    let id = $("#table-data-payroll"),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: "name", name: "name"},
            {data: "branch_working_sesion_time", name: "branch_working_sesion_time", className: "text-center"},
            {data: "total_leave_day_with_salary", name: "total_leave_day_with_salary", className: "text-center"},
            {data: "total_leave_day_without_salary", name: "total_leave_day_without_salary", className: "text-center"},
            {data: "total_not_checkin_day", className: "text-center", name: "total_not_checkin_day" +
                    ""},
            {data: "kpi_score", name: "kpi_score", className: "text-center"},
            {data: "basic_salary_in_term", name: "basic_salary_in_term", className: "text-right"},
            {data: "total_working_day", name: "total_working_day", className: "text-center"},
            {data: "salary_by_working_day", name: "salary_by_working_day", className: "text-right"},
            {data: "target_point_bonus_salary_in_branch", name: "target_point_bonus_salary_in_branch", className: "text-right"},
            {data: "bonus_booking", name: "bonus_booking", className: "text-right"},
            {data: "bonus_kaizen", name: "bonus_kaizen", className: "text-right"},

            {data: "total_customer_invited", name: "total_customer_invited", className: "text-center"},
            {data: "customer_invited_bonus", name: "customer_invited_bonus", className: "text-right"},
            {data: "other_bonus", name: "other_bonus", className: "text-right"},
            {data: "chef_bonus_amount", name: "chef_bonus_amount", className: "text-right"},
            {data: "master_chef_bonus_amount", name: "master_chef_bonus_amount", className: "text-right"},
            {data: "bonus_support_overtime_amount", name: "bonus_support_overtime_amount", className: "text-right"},
            {data: "total_bonus", name: "total_bonus", className: "text-right"},

            {data: "punish_late_minute_amount", name: "punish_late_minute_amount", className: "text-right"},
            {data: "punish_not_checkout_amount", name: "punish_not_checkout_amount", className: "text-right"},
            {data: "other_punish", name: "other_punish", className: "text-right"},

            {data: "total_punish_amount", name: "total_punish", className: "text-right"},


            {data: "uniform_amount", name: "uniform_amount", className: "text-right"},
            {data: "pre_paid_amount", name: "pre_paid_amount", className: "text-right"},
            {data: "debt_amount", name: "debt_amount", className: "text-right"},

            {data: "total_salary_reduce", name: "total_salary_reduce", className: "text-right"},
            {data: "total_punish", name: "total_punish", className: "text-right"},
            {data: "total_temporary_salary", name: "total_temporary_salary", className: "text-right"},

            {data: "total_salary", name: "total_salary", className: "text-right"},
            {data: "status_name_id", name: "status_name_id", className: "text-center"},
            {data: 'keysearch', className: 'd-none '},
            {data: "action", name: "action", className: "text-center"},
        ],
        fixed_left = 2,
        fixed_right = 1,
        option = [
            {
                'title': 'Giám đốc duyệt',
                'icon': 'fi-rr-check',
                'class': statusOwnerConfirm === 0 ? 'd-none' : '',
                'function': 'checkConfirmPayrollMutiEmployee',
            },
            {
                'title': 'Xuất Excel',
                'icon': 'fi-rr-print',
                'class': '',
                'function': 'exportExcelPayrollManage',
            }
        ];
    dataTablePayrollManage = await DatatableTemplateNew(id, data, column, vh_of_table, fixed_left, fixed_right, option);
    $('.checkbox-ripple').rkmdCheckboxRipple();
    $(document).on('input paste keyup','#table-data-payroll_filter', function (){
        let totalTablePayrollManage = searchTableUpdateTotal(dataTablePayrollManage)

        $('#leave_allowed').text(formatNumber(totalTablePayrollManage[0]));
        $('#leave_of_absence').text(formatNumber(totalTablePayrollManage[1]));
        $('#leave_not_allow').text(formatNumber(totalTablePayrollManage[2]));
        $('#kpi_point').text(formatNumber(totalTablePayrollManage[3]));
        $('#base_salary_after_increase').text(formatNumber(totalTablePayrollManage[4]));
        $('#work_day').text(formatNumber(totalTablePayrollManage[5]));
        $('#salary_based_on_workday').text(formatNumber(totalTablePayrollManage[6]));
        $('#sale_point_bonus').text(formatNumber(totalTablePayrollManage[7]));
        $('#bonus_booking').text(formatNumber(totalTablePayrollManage[8]));
        $('#customer_new').text(formatNumber(totalTablePayrollManage[9]));
        $('#customer_bonus').text(formatNumber(totalTablePayrollManage[10]));
        $('#other_bonus').text(formatNumber(totalTablePayrollManage[11]));
        $('#kitchen_staff_evaluate_food').text(formatNumber(totalTablePayrollManage[12]));
        $('#chef_evaluate_food').text(formatNumber(totalTablePayrollManage[13]));
        $('#support').text(formatNumber(totalTablePayrollManage[14]));
        $('#total_bonus').text(formatNumber(totalTablePayrollManage[15]));
        $('#excessive_late_fines').text(formatNumber(totalTablePayrollManage[16]));
        $('#excessive_fines_without_check_out').text(formatNumber(totalTablePayrollManage[17]));
        $('#other_punish').text(formatNumber(totalTablePayrollManage[18]));
        $('#total_punish_amount').text(formatNumber(totalTablePayrollManage[19]));
        $('#uniform_money').text(formatNumber(totalTablePayrollManage[20]));
        $('#pre_paid_amount').text(formatNumber(totalTablePayrollManage[21]));
        $('#debt_wrong_bill').text(formatNumber(totalTablePayrollManage[22]));
        $('#total_salary_reduce').text(formatNumber(totalTablePayrollManage[23]));
        $('#total_punish').text(formatNumber(totalTablePayrollManage[24]));
        $('#total_salary').text(formatNumber(totalTablePayrollManage[25]));
        $('#total_temporary_salary').text(formatNumber(totalTablePayrollManage[26]));
        $('#bonus_kaizen').text(formatNumber(totalTablePayrollManage[27]));
    })

}

function searchTableUpdateTotal(datatable){
    let totalLeaveAllowed = 0,
    totalLeaveOfAbsence = 0,
    totalLeaveNotAllow = 0,
    totalKPIPoint = 0,
    totalBaseSalaryAfterIncrease = 0,
    totalWorkDay = 0,
    totalSalaryBasedOnWorkday = 0,
    totalSalePointBonus = 0,
    totalBonusBooking = 0,
    totalBonusKaizen = 0,
    totalCustomerNew = 0,
    totalCustomerBonus = 0,
    totalOtherBonus = 0,
    totalKitchenStaffEvaluateFood = 0,
    totalChefEvaluateFood = 0,
    totalSupport = 0,
    totalBonus = 0,
    totalExcessiveLateFines = 0,
    totalExcessiveFinesWithoutCheckOut = 0,
    totalOtherPunish = 0,
    totalPunishAmount = 0,
    totalUniformMoney = 0,
    totalPrePaidAmount = 0,
    totalDebtWrongBill = 0,
    totalSalaryReduce = 0,
    totalPunish = 0,
    totalSalary = 0,
    totalTemporarySalary = 0
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalLeaveAllowed += removeformatNumber(row.find('td:eq(3)').text());
        totalLeaveOfAbsence += removeformatNumber(row.find('td:eq(4)').text());
        totalLeaveNotAllow += removeformatNumber(row.find('td:eq(5)').text());
        totalKPIPoint += removeformatNumber(row.find('td:eq(6)').text().slice(0, -2));
        totalBaseSalaryAfterIncrease += removeformatNumber(row.find('td:eq(7)').text());
        totalWorkDay += removeformatNumber(row.find('td:eq(8)').text().slice(0, -3));
        totalSalaryBasedOnWorkday += removeformatNumber(row.find('td:eq(9)').text());
        totalSalePointBonus += removeformatNumber(row.find('td:eq(10)').text());
        totalBonusBooking += removeformatNumber(row.find('td:eq(11)').text());
        totalBonusKaizen += removeformatNumber(row.find('td:eq(12)').text());
        totalCustomerNew += removeformatNumber(row.find('td:eq(13)').text());
        totalCustomerBonus += removeformatNumber(row.find('td:eq(14)').text());
        totalOtherBonus += removeformatNumber(row.find('td:eq(15)').text());
        totalKitchenStaffEvaluateFood += removeformatNumber(row.find('td:eq(16)').text());
        totalChefEvaluateFood += removeformatNumber(row.find('td:eq(17)').text());
        totalSupport += removeformatNumber(row.find('td:eq(18)').text());
        totalBonus += removeformatNumber(row.find('td:eq(19)').text());
        totalExcessiveLateFines += removeformatNumber(row.find('td:eq(20)').text());
        totalExcessiveFinesWithoutCheckOut += removeformatNumber(row.find('td:eq(21)').text());
        totalOtherPunish += removeformatNumber(row.find('td:eq(22)').text());
        totalPunishAmount += removeformatNumber(row.find('td:eq(23)').text());
        totalUniformMoney += removeformatNumber(row.find('td:eq(24)').text());
        totalPrePaidAmount += removeformatNumber(row.find('td:eq(25)').text());
        totalDebtWrongBill += removeformatNumber(row.find('td:eq(26)').text());
        totalSalaryReduce += removeformatNumber(row.find('td:eq(27)').text());
        totalPunish += removeformatNumber(row.find('td:eq(28)').text());
        totalSalary += removeformatNumber(row.find('td:eq(29)').text());
        totalTemporarySalary += removeformatNumber(row.find('td:eq(30)').text());
    })
    return [totalLeaveAllowed,
        totalLeaveOfAbsence,
        totalLeaveNotAllow,
        totalKPIPoint,
        totalBaseSalaryAfterIncrease,
        totalWorkDay,
        totalSalaryBasedOnWorkday,
        totalSalePointBonus,
        totalBonusBooking,
        totalCustomerNew,
        totalCustomerBonus,
        totalOtherBonus,
        totalKitchenStaffEvaluateFood,
        totalChefEvaluateFood,
        totalSupport,
        totalBonus,
        totalExcessiveLateFines,
        totalExcessiveFinesWithoutCheckOut,
        totalOtherPunish,
        totalPunishAmount,
        totalUniformMoney,
        totalPrePaidAmount,
        totalDebtWrongBill,
        totalSalaryReduce,
        totalPunish,
        totalSalary,
        totalTemporarySalary,
        totalBonusKaizen]
}

function dataTotal(data) {
    $('#leave_allowed').text(data.leave_allowed);
    $('#leave_of_absence').text(data.leave_of_absence);
    $('#leave_not_allow').text(data.total_not_checkin_day);
    $('#kpi_point').text(data.kpi_point);
    $('#base_salary_after_increase').text(data.base_salary_after_increase);
    $('#work_day').text(data.work_day);
    $('#salary_based_on_workday').text(data.salary_based_on_workday);
    $('#sale_point_bonus').text(data.sale_point_bonus);
    $('#bonus_booking').text(data.bonus_booking);
    $('#bonus_kaizen').text(data.bonus_kaizen);
    $('#customer_new').text(data.customer_new);
    $('#customer_bonus').text(data.customer_bonus);
    $('#other_bonus').text(data.other_bonus);
    $('#kitchen_staff_evaluate_food').text(data.kitchen_staff_evaluate_food);
    $('#chef_evaluate_food').text(data.chef_evaluate_food);
    $('#support').text(data.support);
    $('#total_bonus').text(data.total_bonus);
    $('#excessive_late_fines').text(data.excessive_late_fines);
    $('#excessive_fines_without_check_out').text(data.excessive_fines_without_check_out);
    $('#other_punish').text(data.other_punish);
    $('#total_punish_amount').text(data.total_punish_amount);
    $('#uniform_money').text(data.uniform_money);
    $('#pre_paid_amount').text(data.pre_paid_amount);
    $('#debt_wrong_bill').text(data.debt_wrong_bill);
    $('#total_salary_reduce').text(data.total_salary_reduce);
    $('#total_punish').text(data.total_punish);
    $('#total_salary').text(data.total_temporary_salary);
    $('#total_temporary_salary').text(data.total_salary);
    if(data.total_count_confirm_salary>0)
        $('#total-count-confirm-salary').text('0/'+data.total_count_confirm_salary);
}

function checkConfirmPayrollMutiEmployee() {
    dataTablePayrollManage.rows().every(function (index, element) {
        let x = $(this.node());
        x.find('td:eq(33)').find('.checkbox-salary-treasure').removeClass('d-none')
        x.find('td:eq(33)').find('button').addClass('d-none')
    })
    $('.checkbox-all-salary-treasure').removeClass('d-none')
    $('.check-confirm-salary-muti-employee').removeClass('d-none')
    $('.cancel-confirm-salary-muti-employee').removeClass('d-none')
    dataTablePayrollManage.draw(false)
    $('.toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});
}

function cancelConfirmSalaryPayrollMutiEmployee() {
    dataTablePayrollManage.rows().every(function (index, element) {
        let x = $(this.node());
        x.find('td:eq(33)').find('.checkbox-salary-treasure').addClass('d-none')
        x.find('td:eq(33)').find('button').removeClass('d-none')
        x.find('td:eq(33)').find('.checkbox-salary-treasure ').find('input').prop('checked', false)
    })
    $('#total-count-confirm-salary').text('0/'+$('#total-count-confirm-salary').text().split('/')[1])
    $('#checkbox-all-salary').prop('checked', false)
    $('.checkbox-all-salary-treasure').addClass('d-none')
    $('.check-confirm-salary-muti-employee').addClass('d-none')
    $('.cancel-confirm-salary-muti-employee').addClass('d-none')
    $('.toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

function confirmSalaryPayrollMutiEmployee() {
    let branch = $('.select-branch').val();
    let employee_id = [];
    dataTablePayrollManage.rows().every(function (index, element) {
        let x = $(this.node());
        if (x.find('td:eq(33)').find('input').is(':checked')) {
            employee_id.push(Number(x.find('td:eq(1) img').attr('data-value')));
        }
    });
    if(employee_id.length==0) {
        WarningNotify('Vui lòng chọn nhân viên !')
        return
    }
    let time = $('#time-payroll-manage').val();
    let title = $('#title-owner-verify').text();
    let text = $('#text-owner-verify').text();
    let icon = 'question';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            let method = 'get';
            let url = 'payroll-manage.owner-confirm';
            let params = {
                employee_id: employee_id,
                time: time,
                branch: branch
            };
            let data = null;
            let res = await axiosTemplate(method, url, params, data, [$('#table-data-payroll')]);
            switch (res.data.status){
                case 200:
                    SuccessNotify($('#success-owner-verify').text());
                    drawDatatableSalaryPayrollMutilEmployee(employee_id, 5)
                    cancelConfirmSalaryPayrollMutiEmployee()
                    break;
                case 500:
                    ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            }

        }
    });
}

function verifyPayroll(id) {
    let branch = $('.select-branch').val();
    let employee_id = [];
    if (id === undefined) {
        let i = $('#table-data-payroll tbody tr').length;
        if (i === 0) {
            return false;
        } else {
            dataTablePayrollManage.rows().every(function (index, element) {
                let x = $(this.node());
                if (x.find('td:eq(1)').find('img').data('status') != 7) {
                    employee_id.push(x.find('td:eq(1)').find('img').data('value'));
                }
            });
        }
    }else {
        employee_id = [id];
    }
    let time = $('#time-payroll-manage').val();
    let title = $('#title-owner-verify').text();
    let text = $('#text-owner-verify').text();
    let icon = 'question';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            let method = 'get';
            let url = 'payroll-manage.owner-confirm';
            let params = {
                employee_id: employee_id,
                time: time,
                branch: branch
            };
            let data = null;
            let res = await axiosTemplate(method, url, params, data, [$('#table-data-payroll')]);
            switch (res.data.status){
                case 200:
                    SuccessNotify($('#success-owner-verify').text());
                    drawDatatableSalaryPayrollMutilEmployee(employee_id, 5)
                    break;
                case 500:
                    ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            }

        }
    });
}

function drawDatatableSalaryPayrollMutilEmployee(employee_id, status, reason = '') {
    let count = 0;
    dataTablePayrollManage.rows().every(function (index, element) {
        let x = $(this.node());
        let id = Number(x.find('td:eq(1)').find('img').data('value'))
        if ($.inArray(id, employee_id) !== -1) {
            count++;
            x.find('td:eq(1)').find('img').data('status', status);
            x.find('td:eq(1)').find('img').data('reason', reason);
            x.find('td:eq(33)').html(`
                <div class="checkbox-form-group d-none checkbox-salary-treasure "  >
                    <input type="checkbox" id="check-salary" class="disabled m-0" disabled style="cursor: no-drop;">
                </div>
                <div class="btn-group btn-group-sm float-right">
                    <button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="detailPayroll(${id},this)" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                </div>
            `);
            let statusEl = '';
            if (status === 5) {
                statusEl = `
                    <div class="status-new seemt-blue seemt-border-blue " style="display: inline !important; max-width: max-content;">
                        <i class="fi-rr-time-quarter-to " style=" font-size: 14px; vertical-align: middle; "></i>
                        <label class="m-0" data-id="5">Chờ thủ quỹ chi</label>
                    </div>
                `;
            } else if (status === 7) {
                statusEl = `
                    <div class="status-new seemt-red seemt-border-red " style="display: inline !important; max-width: max-content;">
                        <i class="fi-rr-time-quarter-to " style=" font-size: 14px; vertical-align: middle; "></i>
                        <label class="m-0" data-id="' . $row['status'] . '">Từ chối</label>
                    </div>
                `;
            }
            x.find('td:eq(31)').html(statusEl)
        }
    });
    $('#total-count-confirm-salary').text('0/'+ (Number($('#total-count-confirm-salary').text().split('/')[1]) - count));
}

function dataCheck(data) {
    if (data === 1) {
        $('#button-service-1').removeClass('d-none');
    } else {
        $('#button-service-1').addClass('d-none');
    }
}

function deniedSalaryEmployee(id) {
    if (checkDeniedSalaryEmployee !== 0) return false;
    let branch = $('.select-branch').val();
    let employee_id = [id];
    let time = $('#time-payroll-manage').val();
    let title = $('#title-denied-salary').text();
    let text = $('#content-denied-salary').text();
    let icon = 'warning';
    sweetAlertInputComponent(title,'id-cancel-payroll', text, icon).then(async result => {
        if (result.isConfirmed) {
            checkDeniedSalaryEmployee = 1;
            let method = 'post';
            let url = 'salary-employee-treasurer.denied-salary';
            let params = {
                employee_id: employee_id,
                time: time,
                branch: branch,
                reason: result.value
            };
            let data = null;
            let res = await axiosTemplate(method, url, params, data, [$('#table-data-payroll')]);
            checkDeniedSalaryEmployee = 0;
            switch (res.data.status){
                case 200:
                    SuccessNotify('Từ chối chi thành công!');
                    drawDatatableSalaryPayrollMutilEmployee(employee_id, 7, result.value)
                    break;
                case 500:
                    ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());

            }
        }
    });
}

function checkAllOwnerConfirmPayroll() {
    if ($('#check-all-owner-confirm-payroll').is(':checked')) {
        dataTablePayrollManage.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(32)').find('input[type="checkbox"]').prop('checked', true);
        });
    } else {
        dataTablePayrollManage.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(32)').find('input[type="checkbox"]').prop('checked', false);
        });
    }
}

function verifyPayrollCheckOwner(r) {
    if (checkVerifyPayrollCheckOwnerSalaryEmployee !== 0) return false;
    let branch = $('.select-branch').val();
    let id = r.data('id');
    let employee_id = [];
    if (id === undefined) {
        let i = $('#table-data-payroll tbody tr').length;
        if (i === 0) {
            return false;
        } else {
            dataTablePayrollManage.rows().every(function (index, element) {
                let x = $(this.node());
                if (x.find('td:eq(32)').find('input').length > 0) {
                    if (Number(x.find('td:eq(32)').find('input').is(':checked'))) {
                        employee_id.push(x.find('td:eq(32)').find('input').data('id'));
                    }
                }
            });
        }
    }
    let time = $('#time-payroll-manage').val();
    let title = $('#title-owner-verify').text();
    let text = $('#text-owner-verify').text();
    let icon = 'warning';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            checkVerifyPayrollCheckOwnerSalaryEmployee = 1;
            let method = 'get';
            let url = 'payroll-manage.owner-confirm';
            let params = {
                employee_id: employee_id,
                time: time,
                branch: branch
            };
            let data = null;
            let res = await axiosTemplate(method, url, params, data);
            checkVerifyPayrollCheckOwnerSalaryEmployee = 0;
            switch (res.data.status){
                case 200:
                    SuccessNotify($('#success-owner-verify').text());
                    $('#salary-waiting-approved').addClass('d-none');
                    $('.item-checkbox-owner-confirm').addClass('d-none');
                    $('.button-owner-confirm').find('button').attr('onclick', '');
                    loadDataTable();
                    break;
                case 500:
                    ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify((res.data.message !== null) ? res.data.message : $('#error-owner-verify').text());
            }
        }
    });
}

async function checkChangeConfirmOwner() {
    $('#check-all-owner-confirm-payroll').prop('checked', false);
    let i = 0;
    let x = 0;
    await dataTablePayrollManage.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(32)').find('input').length > 0) {
            if (row.find('td:eq(32)').find('input').is(':checked') === true) {
                i++;
            }
            x++;
        }
    });
    if (i === x) {
        $('#check-all-owner-confirm-payroll').prop('checked', true);
    } else {
        $('#check-all-owner-confirm-payroll').prop('checked', false);
    }
}

