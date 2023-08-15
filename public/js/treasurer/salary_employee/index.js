let dataTablePayrollManage = null,
    checkSendSalaryEmployee = 0,
    checkConfirmSalaryEmployee = 0,
    rolePayrollManage = '',
    statusPayrollManage,
    monthPayrollManage,
    dataExcelPayrollManage;

$(function () {
    dateTimePickerMonthYearTemplate($('#time-payroll-manage'));
    if (getCookieShared('salary-employee-treasurer-user-id-' + idSession)) {
        let data = JSON.parse(getCookieShared('salary-employee-treasurer-user-id-' + idSession));
        rolePayrollManage = data.rolePayrollManage;
        statusPayrollManage = data.status;
        monthPayrollManage = data.month;
        $('#select-status-payroll-manage').val(statusPayrollManage).trigger('change.select2')
        $('#time-payroll-manage').val(monthPayrollManage)
    }
    $('#search-time-payroll-manage').on("click", function () {
        $('.date-detail').html($('#time-payroll-manage').val());
        loadDataTable();
    });
    $('#salary-employee-confirm').on('click', function () {
        confirmSalaryEmployee(null);
    });
    $('#salary-employee-send').on('click', function () {
        sendSalaryEmployee(null);
    });
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

    $('#select-role-payroll-manage, #select-status-payroll-manage').on('select2:select', function () {
        rolePayrollManage = $('#select-role-payroll-manage').val()
        loadDataTable();
    });
    loadData();
});

function updateCookieSalaryEmployee() {
    saveCookieShared('salary-employee-treasurer-user-id-' + idSession, JSON.stringify({
        'rolePayrollManage': rolePayrollManage,
        'month': monthPayrollManage,
        'status': statusPayrollManage,
    }))
}

function loadData() {
    loadRole();
    loadDataTable();
}

async function loadRole() {
    let branch = $('#select-branch-salary-employee-treasurer').val(),
        method = 'get',
        url = 'salary-employee-treasurer.role',
        params = {
            branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#select-role-payroll-manage').html(res.data[0]);
    checkHasInSelect(rolePayrollManage, $('#select-role-payroll-manage'));
    // $('#select-role-payroll-manage').val(rolePayrollManage).trigger('change.select2');
}

async function loadDataTable() {
    statusPayrollManage = $('#select-status-payroll-manage').val()
    monthPayrollManage = $('#time-payroll-manage').val()
    updateCookieSalaryEmployee()
    let branch = $('#select-branch-salary-employee-treasurer').val(),
        time = monthPayrollManage,
        role = rolePayrollManage,
        status = statusPayrollManage,
        method = 'get',
        url = 'salary-employee-treasurer.data',
        params = {time: time, branch: branch, role: role, status: status},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    await dataTableSalaryTreasurer(res.data[0].original.data);
    dataMessageSalaryTreasurer(res.data[2]);
    dataCheckSalaryTreasurer(res.data[3], res.data[4]);
    dataTotalSalaryTreasurer(res.data[1]);
    dataExcelPayrollManage = res.data[5].data.list;
}

async function dataTableSalaryTreasurer(data) {
    let statusValue = 0;
    for (let i = 0; i < data.length; i++) {
        if (data[i].status === 5) {
            statusValue++;
        }
    }
    let id = $("#table-data-payroll"),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: "name", name: "name"},
            {data: "branch_working_sesion_time", name: "branch_working_sesion_time", className: "text-center"},
            {data: "total_leave_day_with_salary", name: "total_leave_day_with_salary", className: "text-center"},
            {data: "total_leave_day_without_salary", name: "total_leave_day_without_salary", className: "text-center"},
            {data: "total_not_checkin_day", className: "text-center", name: "total_not_checkin_day"},
            {data: "kpi_score", name: "kpi_score", className: "text-center"},
            {data: "basic_salary", name: "basic_salary", className: "text-center"},
            {data: "total_working_day", name: "total_working_day", className: "text-center"},
            {data: "salary_by_working_day", name: "salary_by_working_day", className: "text-center"},
            {
                data: "target_point_bonus_salary_in_branch",
                name: "target_point_bonus_salary_in_branch",
                className: "text-center"
            },
            {data: "bonus_booking", name: "bonus_booking", className: "text-center"},
            {data: "bonus_kaizen", name: "bonus_kaizen", className: "text-center"},
            {data: "total_customer_invited", name: "total_customer_invited", className: "text-center"},
            {data: "customer_invited_bonus", name: "customer_invited_bonus", className: "text-center"},
            {data: "other_bonus", name: "other_bonus", className: "text-center"},
            {data: "chef_bonus_amount", name: "chef_bonus_amount", className: "text-center"},
            {data: "master_chef_bonus_amount", name: "master_chef_bonus_amount", className: "text-center"},
            {data: "bonus_support_overtime_amount", name: "bonus_support_overtime_amount", className: "text-center"},
            {data: "total_bonus", name: "total_bonus", className: "text-center"},

            {data: "punish_late_minute_amount", name: "punish_late_minute_amount", className: "text-center"},
            {data: "punish_not_checkout_amount", name: "punish_not_checkout_amount", className: "text-center"},
            {data: "other_punish", name: "other_punish", className: "text-center"},

            {data: "total_punish_amount", name: "total_punish", className: "text-center"},


            {data: "uniform_amount", name: "uniform_amount", className: "text-center"},
            {data: "pre_paid_amount", name: "pre_paid_amount", className: "text-center"},
            {data: "debt_amount", name: "debt_amount", className: "text-center"},

            {data: "total_salary_reduce", name: "total_salary_reduce", className: "text-center"},
            {data: "total_punish", name: "total_punish", className: "text-center"},
            {data: "total_temporary_salary", name: "total_temporary_salary", className: "text-center"},

            {data: "total_salary", name: "total_salary", className: "text-center"},
            {data: "status_name_id", name: "status_name_id", className: "text-center"},
            {data: 'keysearch', className: 'd-none '},
            {data: "action", name: "action", className: "text-center"},
        ],
        fixedLeft = 2,
        fixedRight = 2,
        option = [
            {
                'title': 'Gửi bảng lương cho tất cả nhân viên',
                'icon': 'fi-rr-paper-plane text-primary',
                'class': 'send-salary-employee',
                'function': 'sendSalaryEmployee',
            },
            {
                'title': 'Chi lương',
                'icon': 'fi-rr-check text-success',
                'class': statusValue > 0 ? 'confirm-salary-employee' : 'confirm-salary-employee d-none',
                'function': 'checkConfirmSalaryMutiEmployee',
            },
            {
                'title': 'Xuất Excel',
                'icon': 'fi-rr-print text-warning',
                'class': 'export-excel',
                'function': 'exportExcelPayrollManage',
            }
        ];

    dataTablePayrollManage = await DatatableTemplateNew(id, data, column, vh_of_table - 100, fixedLeft, fixedRight, option);
    // $('.select-filter-dataTable').eq(1).css({"top": '50px important', "right": '25px !important'})

    $(document).on('input paste keyup', '#table-data-payroll_filter', async function () {
        let totalTablePayrollManage = searchTableSalaryEmployee(dataTablePayrollManage)

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

    if ($('.btn-treasurer-confirm .tabledit-edit-button').length > 1) {
        $('.button-treasurer-confirm').removeClass('d-none');
    } else {
        $('.button-treasurer-confirm').addClass('d-none');
    }
}

function searchTableSalaryEmployee(datatable) {
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
        totalBonusBooking += removeformatNumber(row.find('td:eq(12)').text());
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

function dataTotalSalaryTreasurer(data) {
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
    $('#total_salary').text(data.total_temporary_salary)
    $('#total_temporary_salary').text(data.total_salary);
    if(data.total_count_confirm_salary>0)
    $('#total-count-confirm-salary').text('0/'+data.total_count_confirm_salary);
}

function confirmSalaryEmployee(id) {
    let branch = $('#select-branch-salary-employee-treasurer').val();
    let employee_id = [id];
    if (id === undefined) {
        let i = $('#table-data-payroll tbody tr').length;
        if (i === 0) {
            return false;
        } else {
            employee_id = [];
            dataTablePayrollManage.rows().every(function (index, element) {
                let x = $(this.node());
                if (x.find('td:eq(1)').find('img').data('status') === 5) {
                    employee_id.push(x.find('td:eq(1)').find('img').data('value'));
                } else {
                    WarningNotify('Trạng thái không hợp lệ');
                    return false;
                }
            });
        }
    }
    let time = $('#time-payroll-manage').val();
    let title = $('#title-owner-salary').text();
    let text = $('#text-owner-salary').text();
    let icon = 'warning';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            if (checkConfirmSalaryEmployee !== 0) return false;
            checkConfirmSalaryEmployee = 1;
            let method = 'post';
            let url = 'salary-employee-treasurer.salary-confirm';
            let params = {
                employee_id: employee_id,
                time: time,
                branch: branch
            };
            let data = null;
            let res = await axiosTemplate(method, url, params, data);
            checkConfirmSalaryEmployee = 0;
            if (res.data.status === 200) {
                let text_success = $('#success-owner-salary').text();
                SuccessNotify(text_success);
                $('#button-service-2').addClass('d-none');
                drawDatatableSalaryMutilEmployee(employee_id, 6);
                // loadDataTable();
            } else {
                let text = $('#error-owner-salary').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                ErrorNotify(text);
            }
        }
    });
}

function drawDatatableSalaryMutilEmployee(employee_id, status, reason = '') {
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
            if (status === 6) {
                statusEl = `
                    <div class="status-new seemt-green seemt-border-green " style="display: inline !important; max-width: max-content;">
                        <i class="fi-rr-time-quarter-to   " style=" font-size: 14px; vertical-align: middle; "></i>
                        <label class="m-0" data-id="5">Đã chi</label>
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
    console.log("count: ", count)
    $('#total-count-confirm-salary').text('0/'+ (Number($('#total-count-confirm-salary').text().split('/')[1]) - count));
}

function checkConfirmSalaryMutiEmployee() {
    dataTablePayrollManage.rows().every(function (index, element) {
        let x = $(this.node());
        x.find('td:eq(33)').find('.checkbox-salary-treasure ').removeClass('d-none')
        x.find('td:eq(33)').find('button').addClass('d-none')
    })
    $('.checkbox-all-salary-treasure').removeClass('d-none')
    $('.check-confirm-salary-muti-employee').removeClass('d-none')
    $('.cancel-confirm-salary-muti-employee').removeClass('d-none')
    dataTablePayrollManage.draw(false)
    $('.toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});

}

function cancelConfirmSalaryMutiEmployee() {
    dataTablePayrollManage.rows().every(function (index, element) {
        let x = $(this.node());
        x.find('td:eq(33)').find('.checkbox-salary-treasure ').addClass('d-none')
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

function confirmSalaryMutiEmployee() {
    let branch = $('#select-branch-salary-employee-treasurer').val();
    let employee_id = [];
    dataTablePayrollManage.rows().every(function (index, element) {
        let x = $(this.node());
        // if (x.find('td:eq(33)').find('input').is('status') === 5) {
            if (x.find('td:eq(33)').find('input').is(':checked')) {
                employee_id.push(Number(x.find('td:eq(1) img').attr('data-value')));
            }
        // }
        // if (x.find('td:eq(1)').find('img').data('status') === 5) {
        //     employee_id.push(x.find('td:eq(1)').find('img').data('value'));
        // }
    });
    if(employee_id.length==0) {
        WarningNotify('Vui lòng chọn nhân viên !')
        return
    }
    let time = $('#time-payroll-manage').val();
    let title = $('#title-owner-salary').text();
    let text = $('#text-owner-salary').text();
    let icon = 'warning';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            if (employee_id.length === 0) {
                $('.confirm-salary-employee').addClass('d-none');
                // WarningNotify('Vui lòng chọn nhân viên để chi');
                WarningNotify('Vui lòng chờ giám đốc duyệt bảng lương nhân viên');
                return false;
            }
            let method = 'post';
            let url = 'salary-employee-treasurer.salary-confirm';
            let params = {
                employee_id: employee_id,
                time: time,
                branch: branch
            };
            let data = null;
            let res = await axiosTemplate(method, url, params, data);
            if (res.data.status === 200) {
                let text_success = $('#success-owner-salary').text();
                SuccessNotify(text_success);
                drawDatatableSalaryMutilEmployee(employee_id, 6);
                $('#button-service-2').addClass('d-none');
                $('.item-checkbox-treasurer-confirm').addClass('d-none');
                $('.button-treasurer-cancel').addClass('d-none');
                $('.btn-treasurer-confirm').removeClass('d-none');
                $('.button-treasurer-confirm').removeAttr('onclick');
                cancelConfirmSalaryMutiEmployee()
                // loadDataTable();
            } else {
                let text = $('#error-owner-salary').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                ErrorNotify(text);
            }
        }
    });
}

function sendSalaryEmployee(id) {
    let branch = $('#select-branch-salary-employee-treasurer').val();
    let employee_id = [id];
    if (id === undefined) {
        employee_id = []
        let i = $('#table-data-payroll tbody tr').length;
        if (i === 0) return false;
    }
    let time = $('#time-payroll-manage').val();
    let title = $('#title-send-salary').text();
    let text = $('#content-send-salary').text();
    let icon = 'question';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            if (checkSendSalaryEmployee !== 0) return false;
            checkSendSalaryEmployee = 1;
            let method = 'post';
            let url = 'salary-employee-treasurer.send-salary';
            let params = {
                employee_id: employee_id,
                time: time,
                branch: branch
            };
            let data = null;
            let res = await axiosTemplate(method, url, params, data, $('#table-data-payroll'));
            checkSendSalaryEmployee = 0;
            if (res.data.status === 200) {
                let text_success = $('#success-send-salary').text();
                SuccessNotify(text_success);
                $('#button-service-1').removeClass('d-none');
                loadDataTable();
            } else {
                let text = $('#error-send-salary').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                ErrorNotify(text);
            }
        }
    });
}

function confirmTreasurerSalaryEmployee(id, r) {
    let branch = $('#select-branch-salary-employee-treasurer').val();
    let employee_id = [id];
    let time = $('#time-payroll-manage').val();
    let title = 'Kế toán xác nhận bảng lương ?';
    let text = 'Bảng lương nhân viên này sẽ được chuyển thẳng đến Giám Đốc duyệt và không thông qua Tổng Quản Lý duyệt nữa !';
    let icon = 'question';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            let method = 'post';
            let url = 'salary-employee-treasurer.confirm-treasurer';
            let params = {
                employee_id: employee_id,
                time: time,
                branch: branch
            };
            let data = null;
            let res = await axiosTemplate(method, url, params, data, [$('#table-data-payroll_wrapper')]);
            if (res.data.status === 200) {
                let text_success = $('#success-confirm-data-to-server').text();
                SuccessNotify(text_success);
                loadDataTable();
                // r.parents('.btn-group').find('#send-salary-employee').remove()
                // r.parents('.btn-group').find('#update-salary-basic-employee').remove()
                // r.parents('.btn-group').prepend('<button type="button" class="tabledit-edit-button btn seemt-btn-hover-green waves-effect waves-light" onclick="confirmSalaryEmployee(' + employee_id[0] + ')" data-toggle="tooltip" data-placement="top" data-original-title="Chi lương" data-status="5"><i class="fi-rr-check"></i></button>\n' +
                //     '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="deniedSalaryEmployee(' + employee_id[0] + ')" data-toggle="tooltip" data-placement="top" data-original-title="Từ chối"><i class="fi-rr-cross"></i></button>')
                // r.parents('tr').find('td:eq(31)').html('<div class="status-new seemt-blue seemt-border-blue " style="display: inline !important; max-width: max-content;">\n' +
                //     '                                    <i class="fi-rr-time-quarter-to " style=" font-size: 14px; vertical-align: middle; "></i>\n' +
                //     '                                    <label class="m-0" data-id="5">Chờ thủ quỹ chi</label>\n' +
                //     '                                    </div>')
                // r.parents('tr').find('td:eq(1)').find('img').data('status', 5)
                // r.remove()
                // $('.button-treasurer-cancel button').click();
            } else {
                let text = $('#error-send-salary').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                ErrorNotify(text);
            }
        }
    });
}

function dataMessageSalaryTreasurer(data) {
    if (data === 1) {
        dataTablePayrollManage.rows().every(function (index, element) {
            let x = $(this.node());
            x.find('button.confirm-treasurer').addClass('d-none');
            x.find('button.denied-salary-treasurer').addClass('d-none');
        });
    }
}

function dataCheckSalaryTreasurer(data_check, data_send) {
    if (data_check === 1) {
        $('.confirm-salary-employee').removeClass('d-none');
    } else {
        $('.confirm-salary-employee').addClass('d-none');
    }
    if (data_send === 0) {
        $('.send-salary-employee').removeClass('d-none');
    }
}

async function checkChangeConfirmTreasurer() {
    $('#check-all-treasurer-confirm-salary').prop('checked', false);
    let i = 0;
    let x = 0;
    await dataTablePayrollManage.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(33)').find('input').length > 0) {
            if (row.find('td:eq(33)').find('input').is(':checked') === true) {
                i++;
            }
            x++;
        }
    });
    if (i === x) {
        $('#check-all-treasurer-confirm-salary').prop('checked', true);
    } else {
        $('#check-all-treasurer-confirm-salary').prop('checked', false);
    }
}


function checkAllOwnerConfirmTreasurer() {
    if ($('#check-all-treasurer-confirm-salary').is(':checked')) {
        dataTablePayrollManage.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(33)').find('input[type="checkbox"]').prop('checked', true);
        });
    } else {
        dataTablePayrollManage.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(33)').find('input[type="checkbox"]').prop('checked', false);
        });
    }
}

let checkDeniedSalaryEmployee = 0;

function deniedSalaryEmployee(id) {
    if (checkDeniedSalaryEmployee !== 0) return false;
    let branch = $('#select-branch-salary-employee-treasurer').val();
    let employee_id = [id];
    let time = $('#time-payroll-manage').val();
    let title = 'Thủ quỹ từ chối';
    let text = 'Sau khi từ chối chi, bảng lương của nhân viên này sẽ bị hủy !';
    let icon = 'warning';
    sweetAlertInputComponent(title, 'denied-salary-employee', text, icon).then(async result => {
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
            let res = await axiosTemplate(method, url, params, data, [$('#table-data-payroll_wrapper')]);
            checkDeniedSalaryEmployee = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify('Từ chối chi thành công!');
                    drawDatatableSalaryMutilEmployee(employee_id, 7,result.value);
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
