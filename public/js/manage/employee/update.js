let idUpdateEmployeeManage = 0,
    currentInputUpdateEmployeeManage = '',
    currentMonthUpdateEmployeeManage = 0,
    branchIdDefaultUpdateEmployeeManage = '',
    roleIdDefaultUpdateEmployeeManage = null,
    checkSaveUpdateEmployeeManage,
    avatarEmployeeManage = '',
    workUpdateDataCheckManage = '',
    workingFromEmployeeManage = '',
    confirmedEmployeeManage = 0, checkChangeStatusWorkingEmployee = 0, statusEmployeeManage, thisUpdateEmployeeManage,
    id, branch, is_quit_job, status,
    idEmployeeManage, branhEmployeeManage, isQuitJob, statusFood,
    brandEmployeeManage;
let isOpeningArea = false, isOpeningWork = false, isOpeningSalary = false, isOpeningRole = false, isOpeningRank = false,
    isOpeningDistrict = false, isOpeningWard = false, isOpeningBranch = false, isOpeningCity = false, isChangeBrand=false
$(function () {
    $(document).on('change', '#select-role-update-employee-manage', function () {
        if ($(this).find('option:selected').attr('data-role-owner') == 0) {
            $('#select-branch-enjoys-permission-employee-update-employee-manage').parents('.form-group').addClass('d-none');
        } else {
            $('#select-branch-enjoys-permission-employee-update-employee-manage').parents('.form-group').removeClass('d-none');
            $('#select-branch-enjoys-permission-employee-update-employee-manage').val($('#select-branch-update-employee-manage :selected').val()).trigger('change.select2');
        }
    })

    $('#select-brand-update-employee-manage').on('select2:select', function () {
        let title = 'Thay đổi thương hiệu ?',
            content = 'Sau khi chuyển thương hiệu, vui lòng chọn lại khu vực, ca làm việc !',
            icon = 'question';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            isOpeningArea = true, isOpeningWork = true, isOpeningRank = true, isOpeningBranch = true
            if (result.value) {
                await getBranchEmployeeManage()
                getAllDataUpdateEmployeeChangeBrand();
                getBranchEnjoysUpdatePermissionEmployeeManage();
                $('#select-branch-enjoys-permission-employee-update-employee-manage').val($('#select-branch-update-employee-manage :selected').val()).trigger('change.select2');
                // if ($('#select-group-role-update-employee-manage').val() === '2') {
                //     dataRankUpdateEmployeeManage();
                // }
            } else {
                $('#select-brand-update-employee-manage').val(branchIdDefaultCreateEmployeeManage).trigger('change.select2');
            }
        })
    })

    $('#select-branch-update-employee-manage').on('change', function () {
        let title = 'Chuyển chi nhánh ?',
            content = 'Sau khi chuyển chi nhánh, vui lòng chọn lại khu vực !',
            icon = 'warning';
        sweetAlertComponent(title, content, icon).then((result) => {
            if (result.value) {
                branchIdDefaultUpdateEmployeeManage = $(this).val();
                $('#select-branch-enjoys-permission-employee-update-employee-manage').val(branchIdDefaultUpdateEmployeeManage).trigger('change.select2');
                dataSelectLoadUpdate();
            } else {
                $('#select-branch-update-employee-manage').val(branchIdDefaultUpdateEmployeeManage).trigger('change.select2');
            }
        });
    });

    $('#select-role-update-employee-manage').on('select2:select', function () {
        if ($('#select-group-role-update-employee-manage').val() === '2') {
            isOpeningRank = true
            dataRankUpdateEmployeeManage();
            $('#show-select-rank-update-employee-manage').removeClass('d-none disabled',);
            $('#select-rank-update-employee-manage').attr('disabled', false);
        }
    });
    $('#select-group-role-update-employee-manage').on('select2:select', function () {
        dataRoleUpdateEmployeeManage();
        if($(this).val() === '2') {
            $('#show-select-rank-update-employee-manage').removeClass('d-none')
        }else {
            $('#show-select-rank-update-employee-manage').addClass('d-none disabled',);
            $('#select-rank-update-employee-manage').attr('disabled', true);
            $('#select-rank-update-employee-manage').val(null).trigger('change.select2');
        }
        isOpeningRole = true
    })
    $('#select-group-role-update-employee-manage').on('change', function () {
    })
    $('#birthday-update-employee-manage').on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val($(this).attr('value'));
        }
    });
    $('#select-city-update-employee-manage').on('change', async function () {
        await dataDistrictUpdateEmployee()
        $('#select-ward-update-employee-manage').attr('disabled', true)
        $('#select-ward-update-employee-manage').parents('.form-group').addClass('disabled')
        $('#select-ward-update-employee-manage').html(`<option value="-2" selected disabled hidden>Vui lòng chọn</option>`)
    })
    $('#select-district-update-employee-manage').on('change', async function () {
        $('#select-ward-update-employee-manage').attr('disabled', false)
        $('#select-ward-update-employee-manage').parents('.form-group').removeClass('disabled')
        await dataWardUpdateEmployee()
    })
    $('#select-district-update').on('click', function () {
        if ($('#select-district').hasClass('disabled')) {
            WarningNotify('Vui lòng chọn tỉnh/thành phố')
        }
    })
    $('#select-ward-update').on('click', function () {
        if ($('#select-ward').hasClass('disabled')) {
            WarningNotify('Vui lòng chọn quận/huyện')
        }
    })


})

async function openModalUpdateEmployeeManage(r) {
    idEmployeeManage = r.data('id');
    branhEmployeeManage = r.data('branch-id');
    brandEmployeeManage = r.data('brand');
    isQuitJob = r.data('is-quit-job');
    statusFood = r.data('status');
    statusEmployeeManage = statusFood;
    $('#modal-update-employee-manage').modal('show');
    checkSaveUpdateEmployeeManage = 0;
    shortcut.add('ESC', function () {
        closeModalUpdateEmployeeManage();
    });
    shortcut.add('F4', function () {
        saveModalUpdateEmployeeManage(id, branch, is_quit_job);
    });
    dateTimePickerTemplate($('#birthday-update-employee-manage'), 0, moment(new Date(), 'mm/dd/yyyy'));
    $('#select-rank-update-employee-manage').attr('disabled', false);
    $('#show-select-rank-update-employee-manage').removeClass('disabled');

    thisUpdateEmployeeManage = r;

    dateTimePickerWidgetTopTemplate($('#working-form-employee-manage'));
    $('#select-branch-update-employee-manage, #select-brand-update-employee-manage, #select-group-role-update-employee-manage, #select-role-update-employee-manage, #select-rank-update-employee-manage, #select-salary-update-employee-manage, #select-work-update-employee-manage, #select-area-update-employee-manage, #select-area-control-update-employee-manage, #select-branch-enjoys-permission-employee-update-employee-manage, #select-ward-update-employee-manage, #select-district-update-employee-manage, #select-city-update-employee-manage').select2({
        dropdownParent: $('#modal-update-employee-manage'),
    });
    eventModalUpdateEmployeeManage();
    roleIdDefaultUpdateEmployeeManage = $('#select-role-update-employee-manage').val();
    idUpdateEmployeeManage = r.data('id');
    branchIdDefaultUpdateEmployeeManage = branhEmployeeManage;
    if (isQuitJob == 1) {
        $('#employee-off').removeClass('d-none');
    } else {
        $('#employee-off').addClass('d-none');
    }
    await dataUpdateEmployeeManage(idEmployeeManage, branhEmployeeManage);
    dataEmployeeToBranchCreateEmployeeManage()
    $('#select-branch-update-employee-manage').one('select2:opening', async function (e) {
        let value_area = $('#select-branch-update-employee-manage').val()
        if (isOpeningBranch) {
            isOpeningBranch = false;
            return;
        }
        e.preventDefault();
        getBranchEmployeeManage().then(function () {
            isOpeningBranch = true;
            $('#select-branch-update-employee-manage').val(value_area).trigger('change.select2');
            $('#select-branch-update-employee-manage').select2('open');

        });
    });
    $('#select-area-update-employee-manage').one('select2:opening', async function (e) {
        let value_area = $('#select-area-update-employee-manage').val()
        let value_area_control = $('#select-area-control-update-employee-manage').val()
        if (isOpeningArea) {
            isOpeningArea = false;
            return;
        }
        e.preventDefault();
        dataAreaUpdateEmployeeManage().then(function () {
            isOpeningArea = true;
            $('#select-area-update-employee-manage').val(value_area).trigger('change.select2');
            $('#select-area-control-update-employee-manage').val(value_area_control).trigger('change.select2');
            $('#select-area-update-employee-manage').select2('open');

        });
    });
    $('#select-work-update-employee-manage').one('select2:opening', async function (e) {
        let value = $('#select-work-update-employee-manage').val()
        if (isOpeningWork) {
            isOpeningWork = false;
            return;
        }
        e.preventDefault();
        dataWorkUpdateEmployeeManage().then(function () {
            isOpeningWork = true;
            $('#select-work-update-employee-manage').val(value).trigger('change.select2');
            $('#select-work-update-employee-manage').select2('open');

        });
    });
    $('#select-salary-update-employee-manage').one('select2:opening', async function (e) {
        let value = $('#select-salary-update-employee-manage').val()
        if (isOpeningSalary) {
            isOpeningSalary = false;
            return;
        }
        e.preventDefault();
        dataSalaryUpdateEmployeeManage().then(function () {
            isOpeningSalary = true;
            $('#select-salary-update-employee-manage').val(value).trigger('change.select2');
            $('#select-salary-update-employee-manage').select2('open');

        });
    });
    $('#select-role-update-employee-manage').one('select2:opening', async function (e) {
        let value = $('#select-role-update-employee-manage').val()
        if (isOpeningRole) {
            isOpeningRole = false;
            return;
        }
        e.preventDefault();
        dataRoleUpdateEmployeeManage().then(function () {
            isOpeningRole = true;
            $('#select-role-update-employee-manage').val(value).trigger('change.select2');
            $('#select-role-update-employee-manage').select2('open');

        });
    });
    $('#select-rank-update-employee-manage').one('select2:opening', async function (e) {
        let value = $('#select-rank-update-employee-manage').val()
        if (isOpeningRank) {
            isOpeningRank = false;
            return;
        }
        e.preventDefault();
        dataRankUpdateEmployeeManage().then(function () {
            isOpeningRank = true;
            $('#select-rank-update-employee-manage').val(value).trigger('change.select2');
            $('#select-rank-update-employee-manage').select2('open');

        });
    });
    $('#select-city-update-employee-manage').one('select2:opening', async function (e) {
        let value = $('#select-city-update-employee-manage').val()
        if (isOpeningCity) {
            isOpeningCity = false;
            return;
        }
        e.preventDefault();
        dataCityUpdateEmployee().then(function () {
            isOpeningCity = true;
            $('#select-city-update-employee-manage').val(value).trigger('change.select2');
            $('#select-city-update-employee-manage').select2('open');

        });
    });
    $('#select-district-update-employee-manage').one('select2:opening', async function (e) {
        let value = $('#select-district-update-employee-manage').val()
        if (isOpeningDistrict) {
            isOpeningDistrict = false;
            return;
        }
        e.preventDefault();
        dataDistrictUpdateEmployee().then(function () {
            isOpeningDistrict = true;
            $('#select-district-update-employee-manage').val(value).trigger('change.select2');
            $('#select-district-update-employee-manage').select2('open');

        });
    });
    $('#select-ward-update-employee-manage').one('select2:opening', async function (e) {
        let value = $('#select-ward-update-employee-manage').val()
        if (isOpeningWard) {
            isOpeningWard = false;
            return;
        }
        e.preventDefault();
        dataWardUpdateEmployee().then(function () {
            isOpeningWard = true;
            $('#select-ward-update-employee-manage').val(value).trigger('change.select2');
            $('#select-ward-update-employee-manage').select2('open');

        });
    });
    $('#select-area-control-update-employee-manage').one('select2:opening', async function (e) {
        let value_area = $('#select-area-update-employee-manage').val()
        let value_area_control = $('#select-area-control-update-employee-manage').val()
        if (isOpeningArea) {
            isOpeningArea = false;
            return;
        }
        e.preventDefault();
        dataAreaUpdateEmployeeManage().then(function () {
            isOpeningArea = true;
            $('#select-area-update-employee-manage').val(value_area).trigger('change.select2');
            $('#select-area-control-update-employee-manage').val(value_area_control).trigger('change.select2');
            $('#select-area-control-update-employee-manage').select2('open');
        });
    });
}

async function dataCityUpdateEmployee() {
    let method = 'get',
        url = 'employee-manage.cities-data',
        params = {country_id: 1},
        data = '';
    let res = await axiosTemplate(method, url, params, data, [$("#select-city-update-employee-manage")]);
    $('#select-city-update-employee-manage').html(res.data[0]);
}

async function dataDistrictUpdateEmployee() {
    let city_id = await $('#select-city-update-employee-manage').val();
    let method = 'get',
        url = 'employee-manage.districts-data',
        params = {city_id: city_id},
        data = '';
    let res = await axiosTemplate(method, url, params, data, [$("#select-district-update-employee-manage")]);
    isOpeningDistrict = true
    $('#select-district-update-employee-manage').html(res.data[0]);
}

async function dataWardUpdateEmployee() {
    let district_id = await $('#select-district-update-employee-manage').val();
    let method = 'get',
        url = 'employee-manage.wards-data',
        params = {district_id: district_id},
        data = '';
    let res = await axiosTemplate(method, url, params, data, [$("#select-ward-update-employee-manage")]);
    isOpeningWard = true
    $('#select-ward-update-employee-manage').html(res.data[0]);
}

async function getBranchEmployeeManage() {
    let brandId = ($('#select-brand-update-employee-manage').is(':visible')) ? $('#select-brand-update-employee-manage :selected').val() : $('.select-brand').val();
    let method = 'get',
        url = 'employee-manage.get-branch',
        params = {
            brand_id: brandId,
            status: 1,
            is_office: -1
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-branch-update-employee-manage')]);
    $('#select-branch-update-employee-manage').html(res.data[0]);
}

async function getBranchEnjoysUpdatePermissionEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.get-branch',
        params = {
            brand_id: -1,
            status: 1,
            is_office: -1
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-branch-enjoys-permission-employee-update-employee-manage')]);
    $('#select-branch-enjoys-permission-employee-update-employee-manage').html(res.data[0])
    if ($('#select-branch-update-employee-manage option:selected').attr('data-is-office')==0) {
        $('#select-branch-enjoys-permission-employee-update-employee-manage option[data-is-office="1"]').remove()
    }
    if(!isChangeBrand){
        isChangeBrand=true
        dataEmployeeToBranchCreateEmployeeManage();
    }
    else {
        $('#select-branch-enjoys-permission-employee-update-employee-manage').val($('#select-branch-update-employee-manage :selected').val()).trigger('change.select2');
    }
}

function eventModalUpdateEmployeeManage() {
    $('#select-salary-update-employee-manage').on('select2:select', function () {
        let title = 'Thông Báo',
            content = 'Bạn có muốn áp dụng lương vào tháng sau trở đi ?   ',
            icon = 'warning';
        sweetAlertComponent(title, content, icon).then((result) => {
            if (result.value) {
                currentMonthUpdateEmployeeManage = 1;
            } else {
                currentMonthUpdateEmployeeManage = 0;
            }
        });
    });
}

async function dataUpdateEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.data-update',
        params = {
            id: idEmployeeManage,
            brand: $('.select-brand').val(),
            branch: branhEmployeeManage
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-update-employee-manage'),
    ]);
    $('#id-update-employee-manage').text(idUpdateEmployeeManage);
    if (res.data[0].employee_role_type === 2) {
        $('#select-rank-update-employee-manage').html('<option value="0" disabled="" selected="">Vui lòng chọn</option>' +
            '<option value="' + res.data[0].employee_rank_id + '">' + res.data[0].employee_rank_name + ' (' + res.data[0].table_number + ' bàn )</option>');
        $('#show-select-rank-update-employee-manage').removeClass('d-none')
    } else {
        $('#show-select-rank-update-employee-manage').addClass('d-none')
    }
    $('#select-brand-update-employee-manage').val($('.select-brand').val()).trigger('change.select2');
    $('#select-branch-update-employee-manage').html('<option data-is-office="'+res.data[0].is_office + '" value="' + res.data[0].branch_id + '">' + res.data[0].branch_name + '</option>');
    $('#select-branch-update-employee-manage').val(res.data[0].branch_id).trigger('change.select2');
    $('#name-update-employee-manage').val(res.data[0].name);
    $('#email-update-employee-manage').val(res.data[0].email);
    $('#birthday-update-employee-manage').val(res.data[0].birthday);
    $('#passport-update-employee-manage').val(res.data[0].identity_card);
    $('#phone-update-employee-manage').val(res.data[0].phone);
    $('#gender-update-employee-manage input[type="radio"][value=' + res.data[0].gender + ']').prop('checked', true);
    $('#birthday-place-update-employee-manage').val(res.data[0].birth_place);
    $('#address-update-employee-manage').val(res.data[0].address);
    $('#select-area-update-employee-manage').html('<option value="0" disabled="" selected="">Vui lòng chọn</option>' +
        '<option value="' + res.data[0].area_id + '">' + res.data[0].area_name + '</option>');
    let option_area_control = ''
    for (let i = 0; i < res.data[0].manage_areas.length; i++) {
        option_area_control += '<option value="' + res.data[0].manage_areas[i].id + '"  >' + res.data[0].manage_areas[i].name + ' (' + res.data[0].manage_areas[i].employee_manager_full_name + ')</option>'
    }
    $('#select-area-control-update-employee-manage').html(option_area_control);
    let workingSession = res.data[0].working_session_id ?
        '<option value="' + res.data[0].working_session_id + '">' + res.data[0].working_session_name + ' (' + res.data[0].working_session_time + ')</option>' :
        '<option value="">Vui lòng chọn</option>';
    let salaryLevel = res.data[0].working_session_id ?
        '<option value="' + res.data[0].salary_level_id + '">' + res.data[0].salary_level + ' - ' + formatNumber(res.data[0].basic_salary) + '</option>' :
        '<option value="">Vui lòng chọn</option>';

    $('#select-role-update-employee-manage').html('<option data-role-owner="' + res.data[0].role_leader_id + '" value="' + res.data[0].employee_role_id + '" >' + res.data[0].role_name + '</option>');
    res.data[0].is_owner === 1 ? $('#check-update-employee-permission-branch').addClass('d-none') : $('#check-update-employee-permission-branch').removeClass('d-none')
    checkHasInSelect(res.data[0].area_id, $('#select-area-update-employee-manage'))
    $('#select-area-control-update-employee-manage').val(res.data[0].manage_area).trigger('change.select2');
    $('#select-work-update-employee-manage').html(workingSession).trigger('change.select2');
    $('#select-salary-update-employee-manage').html(salaryLevel).trigger('change.select2');
    $('#select-group-role-update-employee-manage').val(res.data[0].employee_role_type).trigger('change.select2');
    $('#select-role-update-employee-manage').val(res.data[0].employee_role_id).trigger('change.select2');
    $('#select-rank-update-employee-manage').val(res.data[0].employee_rank_id).trigger('change.select2');
    getBranchEnjoysUpdatePermissionEmployeeManage()
    workUpdateDataCheckManage = removeVietnameseString($('#select-branch-update-employee-manage option:selected').text() + $('#select-role-update-employee-manage option:selected').text() + $('#select-area-update-employee-manage option:selected').text() + $('#select-rank-update-employee-manage option:selected').text());
    avatarEmployeeManage = res.data[0].url_avatar;
    workingFromEmployeeManage = res.data[0].working_from;
    $('#working-form-employee-manage').val(res.data[0].working_from)
    $('#avatar-update-employee-manage').attr('data-url', res.data[0].url_avatar);
    await $('.tab-pane.active').find('input').each(function () {
        currentInputUpdateEmployeeManage = currentInputUpdateEmployeeManage + $(this).val();
    });
    if (res.data[0].employee_profile.city_id != 0) {
        $('#select-city-update-employee-manage').html('<option value="' + res.data[0].employee_profile.city_id + '">' + res.data[0].employee_profile.city_name + '</option>');
        $('#select-city-update-employee-manage').val(res.data[0].employee_profile.city_id).trigger('change.select2')
    }
    if (res.data[0].employee_profile.district_id != 0) {
        $('#select-district-update-employee-manage').html('<option value="' + res.data[0].employee_profile.district_id + '">' + res.data[0].employee_profile.district_name + '</option>');
        $('#select-district-update-employee-manage').val(res.data[0].employee_profile.district_id).trigger('change.select2')
    }
    if (res.data[0].employee_profile.ward_id != 0) {
        $('#select-ward-update-employee-manage').html('<option value="' + res.data[0].employee_profile.ward_id + '">' + res.data[0].employee_profile.ward_name + '</option>');
        $('#select-ward-update-employee-manage').val(res.data[0].employee_profile.ward_id).trigger('change.select2')
    }

}

async function dataRoleUpdateEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.role',
        branch = $('#select-branch-update-employee-manage').val(),
        params = {
            branch: branch,
            type: $('#select-group-role-update-employee-manage').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-role-update-employee-manage')
    ]);
    $('#select-role-update-employee-manage').html(res.data[0]);
}

async function dataSalaryUpdateEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.salary',
        role = $('#select-role-update-employee-manage').val(),
        params = {role: role},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-salary-update-employee-manage')
    ]);
    $('#select-salary-update-employee-manage').html(res.data[0]);
}

async function dataRankUpdateEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.rank',
        role = $('#select-role-update-employee-manage').val(),
        brand = $('#select-brand-update-employee-manage').val(),
        params = {brand: brand, role: role},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-rank-update-employee-manage')
    ]);
    $('#select-rank-update-employee-manage').html(res.data[0]);
}

async function getAllDataUpdateEmployeeChangeBrand() {
    let method = 'get',
        url = 'employee-manage.get-data-create-employee',
        restaurant_brand_id = $('#select-brand-update-employee-manage').val(),
        branch = $('#select-branch-update-employee-manage').val(),
        params = {branch: branch, brand: restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-area-control-update-employee-manage'),
        $('#select-area-update-employee-manage'),
        $('#select-work-update-employee-manage')
    ]);
    $('#select-area-update-employee-manage').html(res.data[1]);
    $('#select-work-update-employee-manage').html(res.data[2]);
    $('#select-area-control-update-employee-manage').html(res.data[3]);
}

async function dataAreaUpdateEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.area',
        branch = $('#select-branch-update-employee-manage').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-area-update-employee-manage'),
        $('#select-area-control-update-employee-manage')
    ]);
    $('#select-area-update-employee-manage').html(res.data[0]);
    $('#select-area-control-update-employee-manage').html(res.data[1]);
    $(' #select-area-update-employee-manage').select2({
        dropdownParent: $('#modal-update-employee-manage'),
    });
    $(' #select-area-control-update-employee-manage').select2({
        dropdownParent: $('#modal-update-employee-manage'),
    });

}

async function dataWorkUpdateEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.work',
        brand = $('#select-brand-update-employee-manage').val(),
        params = {brand: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-work-update-employee-manage')
    ]);
    $('#select-work-update-employee-manage').html(res.data[0]);
}

async function dataEmployeeToBranchCreateEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.employee-to-branch',
        params = {
            restaurant_brand_id: -1,
            employee_id: idEmployeeManage
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-branch-enjoys-permission-employee-update-employee-manage')
    ]);
    $('#select-branch-enjoys-permission-employee-update-employee-manage').val(res.data[0][0]).trigger('change.select2');
    if ($('#check-permission-update-employee-manage').text() === '0') {
        $('#select-branch-enjoys-permission-employee-update-employee-manage').attr('disabled', true)
        $('#select-branch-enjoys-permission-employee-update-employee-manage').parents('.form-group').addClass('disabled');
    } else {
        $('#select-branch-enjoys-permission-employee-update-employee-manage').attr('disabled', false)
        $('#select-branch-enjoys-permission-employee-update-employee-manage').parents('.form-group').removeClass('disabled')
    }
}

async function getDataAreaControlEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.get-data-create-employee',
        restaurant_brand_id = $('#restaurant-branch-id-selected span').data('value'),
        branch = $('#select-branch-update-employee-manage').val(),
        params = {branch: branch, brand: restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#select-area-control-update-employee-manage').html(res.data[4]);
}

async function saveModalUpdateEmployeeManage(type = 0) {
    if (checkSaveUpdateEmployeeManage === 1) return false;
    if (!checkValidateSave($('#modal-update-employee-manage'))) return false;
    let name = $('#name-update-employee-manage').val(),
        mail = $('#email-update-employee-manage').val(),
        birth_day = $('#birthday-update-employee-manage').val(),
        birth_place = $('#birthday-place-update-employee-manage').val(),
        passport = $('#passport-update-employee-manage').val(),
        phone = $('#phone-update-employee-manage').val(),
        address = $('#address-update-employee-manage').val(),
        gender = $('#gender-update-employee-manage').find('input[type="radio"]:checked').val(),
        working_form = $('#working-form-employee-manage').val(),
        rank = $('#select-rank-update-employee-manage').val() == null ? '' : $('#select-rank-update-employee-manage').val(),
        salary = $('#select-salary-update-employee-manage').val(),
        work = $('#select-work-update-employee-manage').val(),
        branch = $('#select-branch-update-employee-manage').val(),
        role = $('#select-role-update-employee-manage').val(),
        area_control = ($('#select-area-control-update-employee-manage').val() === undefined) ? [] : $('#select-area-control-update-employee-manage').val(),
        area = $('#select-area-update-employee-manage').val() == null ? '' : $('#select-area-update-employee-manage').val(),
        branch_ids = $('#select-branch-enjoys-permission-employee-update-employee-manage').val(),
        ward_id = parseInt($('#select-ward-update-employee-manage').val()),
        district_id = parseInt($('#select-district-update-employee-manage').val()),
        city_id = parseInt($('#select-city-update-employee-manage').val()),
        is_owner = $('#select-role-update-employee-manage option:selected').attr('data-role-owner');
    if (!branch_ids) {
        branch_ids = [branch]
    }
    checkSaveUpdateEmployeeManage = 1;
    let method = 'post',
        url = 'employee-manage.update-employee',
        params = null,
        data = {
            id: idUpdateEmployeeManage,
            name: name,
            email: mail,
            phone: phone,
            address: address,
            avatar: avatarEmployeeManage,
            gender: gender,
            passport: passport,
            birthday: birth_day,
            birth_place: birth_place,
            working_from: working_form,
            rank: rank,
            salary: salary,
            work: work,
            branch: branch,
            status: statusEmployeeManage,
            role: role,
            area: area,
            area_control_id: area_control,
            current_month: currentMonthUpdateEmployeeManage,
            is_confirmed: confirmedEmployeeManage,
            branch_ids: branch_ids,
            is_owner: is_owner,
            ward_id: ward_id,
            district_id: district_id,
            city_id: city_id,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-update-employee-manage')
    ]);
    checkSaveUpdateEmployeeManage = 0;
    if (res.data[0][0].status === 300) {
        let title = 'Xác nhận?',
            content = res.data[0][0].message,
            icon = 'question';
        Swal.fire({
            title: title,
            text: content,
            icon: icon,
            customClass: {
                confirmButton: 'swal2-confirm btn btn-grd-primary btn-sweet-alert',
                cancelButton: 'swal2-cancel btn btn-grd-disabled btn-sweet-alert',
            },
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: 'Xác nhận',
            cancelButtonText: $('#button-btn-cancel-component').text(),
            reverseButtons: true,
            focusConfirm: true,
        }).then(async (result) => {
            if (result.isConfirmed) {
                data = {
                    id: idUpdateEmployeeManage,
                    name: name,
                    email: mail,
                    phone: phone,
                    address: address,
                    avatar: avatarEmployeeManage,
                    gender: gender,
                    passport: passport,
                    birthday: birth_day,
                    birth_place: birth_place,
                    workingForm: working_form,
                    rank: rank,
                    salary: salary,
                    work: work,
                    branch: branch,
                    role: role,
                    area: area,
                    branch_ids: $('#select-branch-enjoys-permission-employee-update-employee-manage').val(),
                    working_from: working_form,
                    area_control_id: area_control,
                    current_month: currentMonthUpdateEmployeeManage,
                    is_confirmed: 1,
                    ward_id: ward_id,
                    district_id: district_id,
                    city_id: city_id,
                };
                let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-employee-manage')]);
                switch (res.data[0][0].status) {
                    case 200:
                        SuccessNotify($('#success-update-data-to-server').text());
                        closeModalUpdateEmployeeManage();
                        loadData();
                        // thisUpdateEmployeeManage.parents('tr').find('td:eq(1)').html(res.data[0][0].data.employee_avatar);
                        // thisUpdateEmployeeManage.parents('tr').find('td:eq(2)').html(res.data[0][0].data.username);
                        // thisUpdateEmployeeManage.parents('tr').find('td:eq(3)').html(res.data[0][0].data.gender);
                        // thisUpdateEmployeeManage.parents('tr').find('td:eq(4)').html(res.data[0][0].data.phone);
                        // thisUpdateEmployeeManage.parents('tr').find('td:eq(5)').html(res.data[0][0].data.branch_name.name);
                        // thisUpdateEmployeeManage.parents('tr').find('td:eq(8)').html(res.data[0][0].data.keysearch);
                        break;
                    case 500:
                        ErrorNotify($('#error-post-data-to-server').text());
                        break;
                    default:
                        WarningNotify(res.data.message);
                }
            } else {
                confirmedEmployeeManage = 0;
            }
        })
    } else if (res.data[0][0].status === 200) {
        let success = 'Chỉnh sửa thành công';
        SuccessNotify(success);
        closeModalUpdateEmployeeManage();
        loadData();
        // thisUpdateEmployeeManage.parents('tr').find('td:eq(1)').html(res.data[0][0].data.employee_avatar);
        // thisUpdateEmployeeManage.parents('tr').find('td:eq(2)').html(res.data[0][0].data.username);
        // thisUpdateEmployeeManage.parents('tr').find('td:eq(3)').html(res.data[0][0].data.gender);
        // thisUpdateEmployeeManage.parents('tr').find('td:eq(4)').html(res.data[0][0].data.phone);
        // thisUpdateEmployeeManage.parents('tr').find('td:eq(5)').html(res.data[0][0].data.branch_name.name);
        // thisUpdateEmployeeManage.parents('tr').find('td:eq(8)').html(res.data[0][0].data.keysearch);
        confirmedEmployeeManage = 0;
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data[0][0].status !== 200 && res.data[0][0].status !== 500) {
            text = res.data[0][0].message;
            WarningNotify(text);
        } else if (res.data[0][1] !== 200 && res.data[0][1] !== 500) {
            text = res.data[0][1].message;
            WarningNotify(text);
        } else if (res.data[0][0] === 500) {
            text = res.data[0][0].message;
            ErrorNotify(text);
        } else if (res.data[0][1] === 500) {
            text = res.data[0][1].message;
            ErrorNotify(text);
        }
    }
}

async function changeStatusWorkingEmployee() {
    if (!checkValidateSave($('#modal-update-employee-manage'))) return false;
    if (checkChangeStatusWorkingEmployee === 1) return false;
    let title = 'Nhân viên làm lại?',
        content = 'Vui lòng kiểm tra tất cả thông tin trước khi cho nhân viên trở lại làm.',
        icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkSaveUpdateEmployeeManage = 1;
            let name = $('#name-update-employee-manage').val(),
                mail = $('#email-update-employee-manage').val(),
                birth_day = $('#birthday-update-employee-manage').val(),
                birth_place = $('#birthday-place-update-employee-manage').val(),
                passport = $('#passport-update-employee-manage').val(),
                phone = $('#phone-update-employee-manage').val(),
                address = $('#address-update-employee-manage').val(),
                gender = $('#gender-update-employee-manage').find('input[type="radio"]:checked').val(),
                working_form = $('#working-form-employee-manage').val(),
                rank = $('#select-rank-update-employee-manage').val() == null ? '' : $('#select-rank-update-employee-manage').val(),
                salary = $('#select-salary-update-employee-manage').val(),
                work = $('#select-work-update-employee-manage').val(),
                branch = $('#select-branch-update-employee-manage').val(),
                role = $('#select-role-update-employee-manage').val(),
                area_control = ($('#select-area-control-update-employee-manage').val() === undefined) ? [] : $('#select-area-control-update-employee-manage').val(),
                area = $('#select-area-update-employee-manage').val() == null ? '' : $('#select-area-update-employee-manage').val(),
                branch_ids = $('#select-branch-enjoys-permission-employee-update-employee-manage').val(),
                ward_id = parseInt($('#select-ward-update-employee-manage').val()),
                district_id = parseInt($('#select-district-update-employee-manage').val()),
                city_id = parseInt($('#select-city-update-employee-manage').val()),
                is_owner = $('#select-role-update-employee-manage option:selected').attr('data-role-owner');
            if (!branch_ids) {
                branch_ids = [branch]
            }
            let data = {
                id: idUpdateEmployeeManage,
                name: name,
                email: mail,
                phone: phone,
                address: address,
                avatar: avatarEmployeeManage,
                gender: gender,
                passport: passport,
                birthday: birth_day,
                birth_place: birth_place,
                working_from: working_form,
                rank: rank,
                salary: salary,
                work: work,
                branch: branch,
                status: statusEmployeeManage,
                role: role,
                area: area,
                area_control_id: area_control,
                current_month: currentMonthUpdateEmployeeManage,
                is_confirmed: 0,
                branch_ids: branch_ids,
                is_owner: is_owner,
                ward_id: ward_id,
                district_id: district_id,
                city_id: city_id,
            };
            let method = 'post',
                url = 'employee-manage.update-employee',
                params = null;
            let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-employee-manage')]);
            checkSaveUpdateEmployeeManage = 0;
            switch (res.data[0][0].status) {
                case 200:
                    confirmEmployeeGoToWork();
                    break;
                case 300:
                    let title = 'Xác nhận?',
                        content = res.data[0][0].message,
                        icon = 'question';
                    Swal.fire({
                        title: title,
                        text: content,
                        icon: icon,
                        customClass: {
                            confirmButton: 'swal2-confirm btn btn-grd-primary btn-sweet-alert',
                            cancelButton: 'swal2-cancel btn btn-grd-disabled btn-sweet-alert',
                        },
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: 'Xác nhận',
                        cancelButtonText: $('#button-btn-cancel-component').text(),
                        reverseButtons: true,
                        focusConfirm: true,
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            data.is_confirmed = 1;
                            let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-employee-manage')]);
                            switch (res.data[0][0].status) {
                                case 200:
                                    confirmEmployeeGoToWork();
                                    break;
                                case 500:
                                    ErrorNotify($('#error-post-data-to-server').text());
                                    break;
                                default:
                                    WarningNotify(res.data.message);
                            }
                        }
                    })
                    break;
            }
        }
    })
}

async function confirmEmployeeGoToWork () {
    let method = 'post',
        url = 'employee-manage.quit-job',
        params = null,
        data = {
            id: idUpdateEmployeeManage,
        };
    await $('#btn-status-working-employee-manage').prop('disabled', true);
    checkChangeStatusWorkingEmployee = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkChangeStatusWorkingEmployee = 0;
    let text = '';
    switch (res.data?.[0]?.status) {
        case 200:
            text = $('#success-status-data-to-server').text();
            SuccessNotify(text);
            loadData();
            closeModalUpdateEmployeeManage();
            openModalQrCodeEmployeeManage(res.data?.[0].data);
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

function closeModalUpdateEmployeeManage() {
    shortcut.remove('F4');
    shortcut.remove('ESC');
    $('#modal-update-employee-manage').modal('hide');
    reloadModalUpdateEmployeeManage()
    $('#select-branch-enjoys-permission-employee-update-employee-manage').html('');
}

function reloadModalUpdateEmployeeManage() {
    currentInputUpdateEmployeeManage = '';
    $('#id-update-employee-manage').text('');
    $('#name-update-employee-manage').val('');
    $('#email-update-employee-manage').val('');
    $('#birthday-update-employee-manage').val('');
    $('#passport-update-employee-manage').val('');
    $('#phone-update-employee-manage').val('');
    $('#select-branch-enjoys-permission-employee-update-employee-manage').val([]).trigger('change.select2');
    $('#select-area-control-update-employee-manage').val([]).trigger('change.select2');
    $('#gender-update-employee-manage input[type="radio"][value="1"]').prop('checked', true);
    $('#address-update-employee-manage').val('');
    $('#modal-update-employee-manage select').find('option:first').prop('selected', true).trigger('change.select2');
    $('#check-update-employee-permission-branch').addClass('d-none');
    isOpeningArea = false, isOpeningWork = false, isOpeningSalary = false, isOpeningRole = false, isOpeningRank = false, isOpeningDistrict = false, isOpeningWard = false, isOpeningBranch = false, isOpeningCity = false
}

async function dataSelectRole() {
    let method = 'get',
        url = 'employee-manage.data-select-role',
        branch = $('#select-branch-update-employee-manage').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-role-update-employee-manage')]);
    $('#select-role-update-employee-manage').html(res.data[0]);
}

async function dataSelectLoadUpdate() {
    let method = 'get',
        url = 'employee-manage.data-select-load-update',
        branch = $('#select-branch-update-employee-manage').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-area-update-employee-manage'),
    ]);
    $('#select-area-update-employee-manage').html(res.data[0]);
    isOpeningArea = true
}

async function dataSelectLoadUpdateChangeBrand() {
    let method = 'get',
        url = 'employee-manage.data-select-load-update',
        branch = $('#select-branch-update-employee-manage').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-area-update-employee-manage'),
        $('#select-work-update-employee-manage')
    ]);
    $('#select-area-update-employee-manage').html(res.data[0]);
    $('#select-work-update-employee-manage').html(res.data[1]);
}
