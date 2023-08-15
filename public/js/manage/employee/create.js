let roleCreateEmployeeManage,
    rankCreateEmployeeManage,
    salaryCreateEmployeeManage,
    areaCreateEmployeeManage,
    workCreateEmployeeManage, branchIdDefaultCreateEmployeeManage = $('#select-brand-update-employee-manage').val(),
    checkSaveCreateEmployeeManage, valueBrandCreateEmployee, dataCityEmployee
checkLoadSalaryEmployee = 1,
    checkLoadDataCityCreateEmployee = 0;
$(function () {
    shortcut.remove('F2');
    shortcut.add('F2', openModalCreateEmployeeManage);

    $('#select-brand-create-employee-manage').on('select2:select', async function () {
        let title = 'Thay đổi thương hiệu ?',
            content = 'Sau khi chuyển thương hiệu, vui lòng chọn lại khu vực, ca làm việc !',
            icon = 'question';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                await getDataBranchCreateEmployeeManage()
                $('#select-branch-create-employee-manage').val($('#select-branch-create-employee-manage option:first').val()).trigger('change.select2');
                getBranchEnjoysPermissionEmployeeManage()
                getAllDataCreatEmployeeChangeBrand()
                // if ($('#select-group-create-role-data').val() === '2') {
                //     dataRankCreateEmployeeManage();
                // }
            } else {
                $('#select-brand-create-employee-manage').val(branchIdDefaultCreateEmployeeManage).trigger('change.select2');
            }
        })
    })

    $('#select-branch-create-employee-manage').on('select2:select', async function () {
        let title = 'Chuyển chi nhánh ?',
            content = 'Sau khi chuyển chi nhánh, vui lòng chọn lại khu vực!',
            icon = 'warning';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                // $('#select-branch-create-employee-manage').val($('#select-branch-create-employee-manage option:first').val()).trigger('change.select2');
                    valueBrandCreateEmployee = $('#select-branch-create-employee-manage option:selected').val()
                    $('#select-branch-enjoys-permission-employee-create-employee-manage').val(valueBrandCreateEmployee).trigger('change.select2');
                getAllDataCreatEmployeeChangeBranch()
            } else {
                $('#select-branch-create-employee-manage').val(branchIdDefaultCreateEmployeeManage).trigger('change.select2');
            }
        })
    })

    $('#select-role-create-employee-manage').on('change', function () {
        if ($('#select-role-create-employee-manage option:selected').data('pre')) {
            $('#select-branch-enjoys-permission-employee-create-employee-manage').parents('.form-group').addClass('d-none');
        } else {
            $('#select-branch-enjoys-permission-employee-create-employee-manage').parents('.form-group').removeClass('d-none');
        }
    })

    $('#birthday-create-employee-manage').on("dp.change", function () {
        if ($(this).val() === '') {
            $(this).val($(this).attr('value'));
        }
    });

    // $(document).on('select2:select', '#select-group-create-role-data', function () {
    //     dataRoleCreateEmployeeManage();
    //     if ($('#select-group-create-role-data').val() === '2') {
    //         $('#test').removeClass('d-none');
    //     } else {
    //         $('#test').addClass('d-none');
    //     }
    // });

    // $('#select-branch-create-employee-manage').on('select2:select', async function () {
    //     valueBrandCreateEmployee = $('#select-branch-create-employee-manage option:selected').val()
    //     await getAllDataCreatEmployee()
    //     $('#select-branch-enjoys-permission-employee-create-employee-manage').val(valueBrandCreateEmployee).trigger('change.select2');
    // })
    $('#select-group-create-role-data').on('change', function () {
        dataRoleCreateEmployeeManage();
        if($(this).val() === '2') {
            $('#select-rank-create-employee-manage').parents('.form-group').removeClass('d-none');
        }else {
            $('#select-rank-create-employee-manage').parents('.form-group').addClass('d-none disabled');
            $('#select-rank-create-employee-manage').attr('disabled', true);
        }
        $('#select-branch-enjoys-permission-employee-create-employee-manage').parents('.form-group').removeClass('d-none');
    })
    $('#select-role-create-employee-manage').on('change', function () {
        if($('#select-group-create-role-data').val() === '2') {
            dataRankCreateEmployeeManage();
            $('#select-rank-create-employee-manage').parents('.form-group').removeClass('disabled');
            $('#select-rank-create-employee-manage').attr('disabled', false);
        }

    })
    $('#modal-create-employee-manage input').on('keyup', function () {
        $('.btn-renew').removeClass('d-none')
    })
    $('#modal-create-employee-manage select').on('change', function () {
        $('.btn-renew').removeClass('d-none')
    })
    $('#select-city-create-employee-manage').on('change', async function () {
        await dataDistrictCreateEmployee()
        $('#select-district-create-employee-manage').attr('disabled', false)
        $('#select-district-create-employee-manage').parents('.form-group').removeClass('disabled')
        $('#select-ward-create-employee-manage').attr('disabled', true)
        $('#select-ward-create-employee-manage').parents('.form-group').addClass('disabled')
        $('#select-ward-create-employee-manage').html(`<option value="-2" selected disabled hidden>Vui lòng chọn</option>`)
    })
    $('#select-district-create-employee-manage').on('change', async function () {
        await dataWardCreateEmployee()
        $('#select-ward-create-employee-manage').attr('disabled', false)
        $('#select-ward-create-employee-manage').parents('.form-group').removeClass('disabled')
    })
    $('#select-district').on('click', function () {
        if ($('#select-district').hasClass('disabled')) {
            WarningNotify('Vui lòng chọn tỉnh/thành phố')
        }
    })
    $('#select-ward').on('click', function () {
        if ($('#select-ward').hasClass('disabled')) {
            WarningNotify('Vui lòng chọn quận/huyện')
        }
    })
})

async function openModalCreateEmployeeManage() {
    $('#modal-create-employee-manage').modal('show');
    shortcut.add('ESC', closeModalCreateEmployeeManage);
    shortcut.remove('F4');
    shortcut.add('F4', saveModalCreateEmployeeManage);
    dataRoleCreateEmployeeManage();
    if (checkSaveCreateEmployeeManage === 0) {
        return false;
    }
    checkSaveCreateEmployeeManage = 0;
    roleCreateEmployeeManage = undefined;
    areaCreateEmployeeManage = undefined;
    workCreateEmployeeManage = undefined;
    $('#select-rank-create-employee-manage').addClass('d-none');
    $("#gender-create-employee-manage input[type='radio'][value='1']").prop('checked', true);
    dateTimePickerTemplate($('#birthday-create-employee-manage'), null, null);
    $('#select-group-create-role-data,#select-branch-create-employee-manage ,#select-brand-create-employee-manage ,#select-role-create-employee-manage, #select-rank-create-employee-manage, #select-salary-create-employee-manage, #select-area-create-employee-manage, #select-work-create-employee-manage, #select-area-control-create-employee-manage, #select-branch-enjoys-permission-employee-create-employee-manage, #select-city-create-employee-manage,  #select-district-create-employee-manage,  #select-ward-create-employee-manage').select2({
        dropdownParent: $('#modal-create-employee-manage'),
    });
    if (parseInt($('#level-template').val()) > 3) {
        await dataRankCreateEmployeeManage();
    }

    $('#select-brand-create-employee-manage').val($('.select-brand option:selected').val()).trigger('change.select2')
    await getDataBranchCreateEmployeeManage()
    getAllDataCreatEmployee()
    getBranchEnjoysPermissionEmployeeManage()
    if(checkLoadDataCityCreateEmployee == 0) {
        dataCityCreateEmployee();
        checkLoadDataCityCreateEmployee = 1;
    }
}

async function getDataBranchCreateEmployeeManage() {
    let brandId = $('#select-brand-create-employee-manage option:selected').val()
    let method = 'get',
        url = 'employee-manage.get-branch',
        params = {
            brand_id: brandId,
            status: 1,
            is_office: -1
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-branch-create-employee-manage')]);
    $('#select-branch-create-employee-manage').html(res.data[0]);
    $('#select-branch-create-employee-manage').val($('.select-branch option:selected').val()).trigger('change.select2')
}

async function dataCityCreateEmployee() {
    let method = 'get',
        url = 'employee-manage.cities-data',
        params = {country_id: 1},
        data = '';
    let res = await axiosTemplate(method, url, params, data, [$("#select-city-create-employee-manage")]);
    dataCityEmployee = res.data[0]
    $('#select-city-create-employee-manage').html(res.data[0]);
}

async function dataDistrictCreateEmployee() {
    let city_id = await $('#select-city-create-employee-manage').val();
    let method = 'get',
        url = 'employee-manage.districts-data',
        params = {city_id: city_id},
        data = '';
    let res = await axiosTemplate(method, url, params, data, [$("#select-district-create-employee-manage")]);
    $('#select-district-create-employee-manage').html(res.data[0]);
}

async function dataWardCreateEmployee() {
    let district_id = await $('#select-district-create-employee-manage').val();
    let method = 'get',
        url = 'employee-manage.wards-data',
        params = {district_id: district_id},
        data = '';
    let res = await axiosTemplate(method, url, params, data, [$("#select-ward-create-employee-manage")]);
    $('#select-ward-create-employee-manage').html(res.data[0]);
}

async function getBranchEnjoysPermissionEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.get-branch',
        params = {
            brand_id: -1,
            status: 1,
            is_office: -1
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-branch-enjoys-permission-employee-create-employee-manage')]);
    $('#select-branch-enjoys-permission-employee-create-employee-manage').html(res.data[0]);
    if ($('#select-branch-create-employee-manage option:selected').attr('data-is-office') == 0) {
        $('#select-branch-enjoys-permission-employee-create-employee-manage option[data-is-office="1"]').remove()
    } else {
        $('#select-branch-enjoys-permission-employee-create-employee-manage').val($('#select-branch-update-employee-manage :selected').val()).trigger('change.select2');
    }
    await $('#select-branch-enjoys-permission-employee-create-employee-manage').val($('#select-branch-create-employee-manage :selected').val()).trigger('change.select2');
    if ($('#check-permission-create-employee-manage').text() === '0') {
        $('#select-branch-enjoys-permission-employee-create-employee-manage').attr('disabled', true)
        $('#select-branch-enjoys-permission-employee-create-employee-manage').parents('.form-group').addClass('disabled')
    } else {
        $('#select-branch-enjoys-permission-employee-create-employee-manage').attr('disabled', false)
        $('#select-branch-enjoys-permission-employee-create-employee-manage').parents('.form-group').removeClass('disabled')
    }
}

async function dataRoleCreateEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.role',
        branch = $('#change_branch').val(),
        params = {
            branch: branch,
            type: $('#select-group-create-role-data').val()
        },
        data = null
    let res = await axiosTemplate(method, url, params, data, [$('#select-role-create-employee-manage')]);
    $('#select-role-create-employee-manage').html(res.data[0]);
}

async function dataRankCreateEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.rank',
        role = $('#select-role-create-employee-manage').val(),
        brand = $('#select-brand-create-employee-manage').val(),
        params = {brand: brand, role: role},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-rank-create-employee-manage')]);
    rankCreateEmployeeManage = res.data[0];
    $('#select-rank-create-employee-manage').html(res.data[0]);
}

async function dataSalaryCreateEmployeeManage() {
    if (salaryCreateEmployeeManage) return false;
    let method = 'get',
        url = 'employee-manage.salary',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    salaryCreateEmployeeManage = res.data[0];
    $('#select-salary-create-employee-manage').html(res.data[0]);
}

async function dataAreaCreateEmployeeManage() {
    let method = 'get',
        url = 'employee-manage.area',
        branch = $('#select-branch-create-employee-manage').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-area-create-employee-manage')]);
    areaCreateEmployeeManage = res.data[0];
    $('#select-area-create-employee-manage').html(res.data[0]);
    $('#select-area-control-create-employee-manage').html(res.data[1]);
}

async function dataWorkCreateEmployeeManage() {
    if (workCreateEmployeeManage) return false;
    let method = 'get',
        url = 'employee-manage.work',
        branch = $('#change_branch').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    workCreateEmployeeManage = res.data[0];
    $('#select-work-create-employee-manage').html(res.data[0]);
}


async function saveModalCreateEmployeeManage() {
    if (checkSaveCreateEmployeeManage === 1) return false;
    if (!checkValidateSave($('#modal-create-employee-manage'))) return false;
    checkSaveCreateEmployeeManage = 1;
    let branch_ids = [$('#select-branch-create-employee-manage').val()];
    if ($('#select-branch-enjoys-permission-employee-create-employee-manage').length > 0) {
        if ($('#select-branch-enjoys-permission-employee-create-employee-manage').val().length === 0) {
            branch_ids = [];
            branch_ids.push(
                $('#select-branch-create-employee-manage :selected').val()
            )
        } else {
            branch_ids = $('#select-branch-enjoys-permission-employee-create-employee-manage').val();
        }
    }
    let nameRole = $('#select-group-create-role-data').val(),
        name = $('#name-create-employee-manage').val(),
        mail = $('#email-create-employee-manage').val(),
        birth_day = $('#birthday-create-employee-manage').val(),
        birth_place = $('#birthday-place-create-employee-manage').val(),
        passport = $('#passport-create-employee-manage').val(),
        phone = $('#phone-create-employee-manage').val(),
        address = $('#address-create-employee-manage').val(),
        branch = $('#select-branch-create-employee-manage').val(),
        brand = $('#select-brand-create-employee-manage').val(),
        role = $('#select-role-create-employee-manage').val(),
        area = $('#select-area-create-employee-manage').val(),
        working = $('#select-work-create-employee-manage').val(),
        area_control = ($('#select-area-control-create-employee-manage').val() === undefined) ? [] : $('#select-area-control-create-employee-manage').val(),
        gender = $('#gender-create-employee-manage').find('input[type="radio"]:checked').val(),
        rank = ($('#select-rank-create-employee-manage').val() === undefined) ? 0 : $('#select-rank-create-employee-manage').val(),
        salary = ($('#select-salary-create-employee-manage').val() === undefined) ? 0 : $('#select-salary-create-employee-manage').val(),
        restaurant_brand_id = $('#restaurant-branch-id-selected span').attr('data-value'),
        is_owner = $('#select-role-create-employee-manage').find('option:selected').attr('data-pre'),
        ward_id = $('#select-ward-create-employee-manage').val(),
        district_id = $('#select-district-create-employee-manage').val(),
        city_id = $('#select-city-create-employee-manage').val(),
        method = 'post',
        url = 'employee-manage.create',
        params = null,
        data = {
            url: window.location.pathname,
            name_role: nameRole,
            name: name,
            email: mail,
            phone: phone,
            address: address,
            gender: gender,
            role_id: role,
            rank_id: rank,
            passport: passport,
            birthday: birth_day,
            birth_place: birth_place,
            salary_level_id: salary,
            area_id: area,
            working_session_id: working,
            branch_id: branch,
            manage_area_ids: area_control,
            restaurant_brand_id: restaurant_brand_id,
            branch_ids: branch_ids,
            is_owner: is_owner,
            ward_id: ward_id,
            district_id: district_id,
            city_id: city_id,
        };

    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-employee-manage')]);
    checkSaveCreateEmployeeManage = 0;
    switch (res.data[0].status) {
        case 200:
            let text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            closeModalCreateEmployeeManage();

            if ($('.select-brand').val() == brand
                && $('.select-branch').val() == branch) {
                drawDatatableCreateEmployee(res.data[0].data)
            }

            openModalQrCodeEmployeeManage(res.data[0].data);
            shortcut.add('F2', function () {
                openModalCreateEmployeeManage();
            })
            shortcut.remove('F4');
            shortcut.remove('ESC');
            break;
        case 500:
            ErrorNotify(res.data[0].message);
            break;
        default:
            WarningNotify(res.data[0].message)
    }
}

function drawDatatableCreateEmployee(data) {
    let newRowDataManager = {
        name: data.employee_avatar,
        username: data.username,
        gender: data.gender,
        phone: data.phone,
        branch_name: data.branch_name,
        action: data.action,
        keysearch: data.keysearch,
    };
    let newRowDataBuildData = {
        employee_avatar: data.employee_avatar,
        username: data.username,
        gender: data.gender,
        phone: data.phone,
        branch_name: data.branch_name,
        action: data.action,
        keysearch: data.keysearch,
    };
    if (parseInt($('#level-template').val()) > 1) {
        switch (data.type) {
            case 1:
                if (typeof(tableCheckInEmployeeManage) != "undefined" && tableCheckInEmployeeManage !== null) {
                    addRowDatatableTemplate(tableCheckInEmployeeManage, newRowDataManager)
                } else {
                    addRowDatatableTemplate(tableCheckInEmployee, newRowDataBuildData)
                }
                $('#total-record-check-in-employee').text(parseInt($('#total-record-check-in-employee').text()) + 1);
                break;
            case 2:
                if (typeof(tableNotCheckInEmployeeManage) != "undefined" && tableNotCheckInEmployeeManage !== null) {
                    addRowDatatableTemplate(tableNotCheckInEmployeeManage, newRowDataManager)
                } else {
                    addRowDatatableTemplate(tableNotCheckInEmployee, newRowDataBuildData)
                }
                $('#total-record-not-check-in-employee').text(parseInt($('#total-record-not-check-in-employee').text()) + 1);
                break;
            case 3:
                if (typeof(tableByPassCheckInEmployeeManage) != "undefined" && tableByPassCheckInEmployeeManage !== null) {
                    addRowDatatableTemplate(tableByPassCheckInEmployeeManage, newRowDataManager)
                } else {
                    addRowDatatableTemplate(tableByPassCheckInEmployee, newRowDataBuildData)
                }
                $('#total-record-bypass-employee').text(parseInt($('#total-record-bypass-employee').text()) + 1);
                break;
            case 4:
                addRowDatatableTemplate(tableOffEmployeeManage, newRowData)
                $('#total-record-employee-off').text(parseInt($('#total-record-employee-off').text()) + 1);
                break;
            case 5:
                addRowDatatableTemplate(tableQuitJobEmployeeManage, newRowData)
                $('#total-record-employee-quit-job').text(parseInt($('#total-record-employee-quit-job').text()) + 1);
                break;
        }
    } else {
        addRowDatatableTemplate(tableAllEmployee, newRowDataBuildData)
    }
}

function closeModalCreateEmployeeManage() {
    console.log(12)
    checkSaveCreateEmployeeManage = 1;
    $('#modal-create-employee-manage').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', openModalCreateEmployeeManage);
    reloadModalCreateEmployeeManage()
}

function reloadModalCreateEmployeeManage() {
    $('#name-create-employee-manage').val('');
    $('#phone-create-employee-manage').val('');
    $('#passport-create-employee-manage').val('');
    $('#email-create-employee-manage').val('');
    $('#address-create-employee-manage').val('');
    $('#birthday-place-create-employee-manage').val('');
    $('#birthday-create-employee-manage').val($('#current-date-employee-birthday').text());
    $('#select-salary-create-employee-manage, #select-area-create-employee-manage, #select-work-create-employee-manage , #select-city-create-employee-manage').val('').trigger('change.select2');
    $('#select-rank-create-employee-manage option:first').trigger('change.select2');
    $('#select-city-create-employee-manage').val(-2).trigger('change.select2');
    $('#select-group-create-role-data').val(-2).trigger('change.select2');
    $('#select-role-create-employee-manage').html('<option value="0" disabled selected>--- Vui lòng chọn ---</option>');
    $('#select-area-control-create-employee-manage').val([]).trigger('change.select2');
    $('#select-branch-enjoys-permission-employee-create-employee-manage').val([]).trigger('change.select2');
    $('#test').addClass('d-none');
    $('.btn-renew').addClass('d-none');
    removeAllValidate();
}

function openModalQrCodeEmployeeManage(data) {
    let data_detail = JSON.parse(data.qr_code);
    $('#modal-qr-create-employee-manage').modal('show');
    $('#name-qr-employee-manage').text(data.name);
    $('#restaurant-qr-employee-manage').text(data_detail.restaurant_name);
    $('#username-qr-employee-manage').text(data_detail.username);
    $('#password-qr-employee-manage').text(data_detail.password);
    $('#code-qr-employee-manage').qrcode({
        "render": "canvas",
        "width": 200,
        "height": 200,
        "top": 2,
        "ecLevel": 'L',
        "colorDark": "#000000",
        "colorLight": "#ffffff",
        "text": data.qr_code,
    });
    shortcut.add('ESC', function () {
        closeModalQrCodeEmployeeManage();
    });
}

async function getAllDataCreatEmployeeChangeBrand() {
    let method = 'get',
        url = 'employee-manage.get-data-create-employee',
        restaurant_brand_id = $('#select-brand-create-employee-manage').val(),
        branch = $('#select-branch-create-employee-manage').val(),
        params = {branch: branch, brand: restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-area-control-create-employee-manage'),
        $('#select-area-create-employee-manage'),
        $('#select-work-create-employee-manage')
    ]);
    $('#select-area-create-employee-manage').html(res.data[1]);
    $('#select-work-create-employee-manage').html(res.data[2]);
    $('#select-area-control-create-employee-manage').html(res.data[3]);
}

async function getAllDataCreatEmployeeChangeBranch() {
    let method = 'get',
        url = 'employee-manage.get-data-create-employee',
        restaurant_brand_id = $('#select-brand-create-employee-manage').val(),
        branch = $('#select-branch-create-employee-manage').val(),
        params = {branch: branch, brand: restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-area-create-employee-manage'),]);
    $('#select-area-create-employee-manage').html(res.data[1]);
    $('#select-area-control-create-employee-manage').html(res.data[3]);
}



async function getAllDataCreatEmployee() {
    let method = 'get',
        url = 'employee-manage.get-data-create-employee',
        restaurant_brand_id = $('#select-brand-create-employee-manage').val(),
        branch = $('#select-branch-create-employee-manage').val(),
        params = {branch: branch, brand: restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-area-create-employee-manage')]);
    $('#select-salary-create-employee-manage').html(res.data[0]);
    $('#select-work-create-employee-manage').html(res.data[2]);
    $('#select-area-create-employee-manage').html(res.data[1]);
    $('#select-area-control-create-employee-manage').html(res.data[3]);
}

function closeModalQrCodeEmployeeManage() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-qr-create-employee-manage').modal('hide');
    $('#code-qr-employee-manage').html('');
    reloadModalCreateEmployeeManage()
    checkLoadSalaryEmployee = 1
}

function reloadModalCreateEmployeeManage() {
    $('#name-create-employee-manage').val('');
    $('#phone-create-employee-manage').val('');
    $('#passport-create-employee-manage').val('');
    $('#email-create-employee-manage').val('');
    $('#address-create-employee-manage').val('');
    $('#birthday-place-create-employee-manage').val('');
    $('#birthday-create-employee-manage').val(moment().format('DD/MM/YYYY'));
    $('#select-branch-create-employee-manage').val(($('#change_branch').val() !== '-1') ? $('#change_branch').val() : $('#select-branch-create-employee-manage option:first').val()).trigger('change');
    $('#select-area-create-employee-manage').val($('#select-area-create-employee-manage').find('option:first-child').val()).trigger('change.select2');
    $('#select-work-create-employee-manage').val($('#select-work-create-employee-manage').find('option:first-child').val()).trigger('change.select2');
    $('#select-salary-create-employee-manage').val($('#select-salary-create-employee-manage').find('option:first-child').val()).trigger('change.select2');
    $('#select-group-create-role-data').val($('#select-group-create-role-data').find('option:first-child').val()).trigger('change.select2');
    $('#select-role-create-employee-manage').val($('#select-role-create-employee-manage').find('option:first-child').val()).trigger('change.select2');
    // $('#select-brand-create-employee-manage').val($('.select-brand').val()).trigger('change.select2');
    // $('#select-branch-enjoys-permission-employee-create-employee-manage').val([]).trigger('change.select2');
    $('#select-area-control-create-employee-manage').val([]).trigger('change.select2');
    $('#select-rank-create-employee-manage').val($('#select-rank-create-employee-manage').find('option:first-child').val()).trigger('change.select2');
    $('#select-rank-create-employee-manage').parents('.form-group').addClass('d-none');
    $('#gender-create-employee-manage input[name="gender"][value="1"]').prop('checked', true);
    $('#modal-create-employee-manage .btn-renew').addClass('d-none');
    $('#check-employee-permission-branch').removeClass('d-none');
    $('#select-district-create-employee-manage').parents('.form-group').addClass('disabled')
    $('#select-district-create-employee-manage').html(`<option value="-2" selected disabled hidden>Vui lòng chọn</option>`)
    $('#select-ward-create-employee-manage').parents('.form-group').addClass('disabled')
    $('#select-ward-create-employee-manage').html(`<option value="-2" selected disabled hidden>Vui lòng chọn</option>`)
    $('#select-city-create-employee-manage').html(dataCityEmployee)
    removeAllValidate();
}
