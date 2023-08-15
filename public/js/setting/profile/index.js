let nameProfile,
    phoneNumberProfile,
    birthdayProfile,
    placeBirthProfile,
    addressProfile,
    avatarProfile,
    emailProfile,
    genderProfile, checkUpdateProfile = 0, checkUpdateLogoBranchSetting = 0;

$(function () {
    dateTimePickerFomartTemplate($('#birthday-label'));
    getProfile();
    let element1 = $('#upload-avatar'),
        view1 = $('#thumbnail-profile-logo'),
        type = 0;
    // window.addEventListener('keydown', function (e) {
    //     if (e.getModifierState('CapsLock')) {
    //         $('.alert-caplock-password').removeClass('d-none');
    //     } else {
    //         $('.alert-caplock-password').addClass('d-none');
    //     }
    // })
    // $('input[type="password"]').on('keydown input paste', function () {
    //     $(this).val($(this).val().replaceAll(' ', ''));
    // });
    $(element1).on('change', function () {
        // if (!checkValidateSave($('#boxlist-index-profile-setting'))) return false;
        // if (view1.attr('src')) {
        //     URL.revokeObjectURL(view1.attr('src'));
        // }
    })
    uploadMediaCropTemplate(element1, view1, type, updateLogoBranchSetting);
    $('#select-city-update-profile').on('change', async function (){
        await dataDistrictUpdateProfile()
        $('#select-ward-update-profile').attr('disabled', true)
        $('#select-ward-update-profile').parents('.form-group').addClass('disabled')
        $('#select-ward-update-profile').html(`<option value="-2" selected disabled hidden>Vui lòng chọn</option>`)
    })
    $('#select-district-update-profile').on('change', async function (){
        $('#select-ward-update-profile').attr('disabled', false)
        $('#select-ward-update-profile').parents('.form-group').removeClass('disabled')
        await dataWardUpdateProfile()
    })

    $('#select-ward-profile').on('click',   function (){
        if($('#select-ward-profile').hasClass('disabled')){
            WarningNotify('Vui lòng chọn quận/huyện')
        }
    })

});

/**
 * Get data profile of employee
 */

async function getProfile() {
    let method = 'get',
        url = 'profile.data',
        params = "",
        data = '';
    let res = await axiosTemplate(method, url, params, data, [
        $('#boxlist-index-profile-setting'),
        $('#thumbnail-profile-logo')
    ]);
    $('#name-label').val(res.data['name']);
    $('#gender-label input[type="radio"]').each(function () {
        if (parseInt($(this).val()) === res.data['gender']) $(this).prop('checked', true);
    });
    $('#birthday-label').val(res.data['birthday']);
    $('#place-birth-label').val(res.data['birth_place']);
    $('#phone-label').val(res.data['phone']);
    $('#email-label').val(res.data['email']);
    $('#level-label').text(res.data['current_rank']);
    $('#current-point-label').text(formatNumber(res.data['current_point']));
    $('#total-point-label').text(formatNumber(res.data['total_point']));
    $('#address-label').val(res.data['street_name']);
    $('#thumbnail-profile-logo').attr('src', res.data['avatar']);
    $('#thumbnail-profile-logo').attr('data-url', res.data['url_avatar']);
    nameProfile = res.data['name'];
    phoneNumberProfile = res.data['phone'];
    birthdayProfile = res.data['birthday'];
    placeBirthProfile = res.data['birth_place'];
    addressProfile = res.data['address'];
    avatarProfile = res.data['url_avatar'];
    emailProfile = res.data['email'];
    genderProfile = res.data['gender'];
    await dataCityUpdateProfile()
    $('#select-city-update-profile').val(res.data.city_id).trigger('change.select2');
    await dataDistrictUpdateProfile()
    $('#select-district-update-profile').val(res.data.district_id).trigger('change.select2');
    await dataWardUpdateProfile()
    $('#select-ward-update-profile').val(res.data.ward_id).trigger('change.select2');
}
async function dataCityUpdateProfile() {
    let method = 'get',
        url = 'employee-manage.cities-data',
        params = {country_id: 1},
        data = '';
    let res = await axiosTemplate(method, url, params, data,[$("#select-city-update-profile")]);
    $('#select-city-update-profile').html(res.data[0]);
}
async function dataDistrictUpdateProfile() {
    let city_id = await $('#select-city-update-profile').val();
    let method = 'get',
        url = 'employee-manage.districts-data',
        params = {city_id: city_id},
        data = '';
    let res = await axiosTemplate(method, url, params, data,[$("#select-district-update-profile")]);

    $('#select-district-update-profile').html(res.data[0]);
}
async function dataWardUpdateProfile() {
    let district_id = await $('#select-district-update-profile').val();
    let method = 'get',
        url = 'employee-manage.wards-data',
        params = {district_id: district_id},
        data = '';
    let res = await axiosTemplate(method, url, params, data,[$("#select-ward-update-profile")]);
    $('#select-ward-update-profile').html(res.data[0]);
}
/**
 * update proFile
 */
async function updateProfile() {
    if(checkUpdateProfile === 1) return false;
    if (!checkValidateSave($('#boxlist-index-profile-setting'))) return false;

    let currentYear = new Date().getFullYear()
    let birthDay = $('#birthday-label').val()
    let yearBirth = birthDay.split('/')[2]

    if (currentYear - yearBirth < 16) {
        WarningNotify('Bạn phải lớn hơn 16')
        return false
    }
    let phone_number = $('#phone-label').val(),
        name = $('#name-label').val(),
        place_birth = $('#place-birth-label').val(),
        birthday = $('#birthday-label').val(),
        email = $('#email-label').val(),
        gender = $('#gender-label').find('input[type="radio"]:checked').val(),
        address = $('#address-label').val() ,
        ward_id=$('#select-ward-update-profile').val(),
        district_id=$('#select-district-update-profile').val(),
        city_id=$('#select-city-update-profile').val();
    checkUpdateProfile = 1;
    let method = 'post',
        url = 'profile.change-profile',
        params = '',
        data = {
            name: name,
            phone_number: phone_number,
            birthday: birthday,
            place_birth: place_birth,
            address: address,
            avatar: avatarProfile,
            email: email,
            gender: gender,
            ward_id:ward_id,
            district_id:district_id,
            city_id:city_id
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#boxlist-index-profile-setting'),
    ]);
    checkUpdateProfile = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            nameProfile = name;
            phoneNumberProfile = phone_number;
            birthdayProfile = birthday;
            placeBirthProfile = place_birth;
            addressProfile = address;
            emailProfile = email;
            genderProfile = gender;
            SuccessNotify($('#notify-success-update-component').text());
            $('#upload-avatar').val('');
            break;
        case 400:
            ErrorNotifyProfile('Vui lòng kiểm tra lại')
            break;
        case 500:
            ErrorNotify(res.data.message)
            break;
        default:
            WarningNotify(res.data.message)
    }
}

async function updateLogoBranchSetting(file) {
    if(checkUpdateLogoBranchSetting === 1) return false;
    if (!checkValidateSave($('#boxlist-index-profile-setting'))) return false;

    let currentYear = new Date().getFullYear()
    let birthDay = $('#birthday-label').val()
    let yearBirth = birthDay.split('/')[2]

    if (currentYear - yearBirth <= 16) {
        WarningNotify('Độ tuổi thấp nhất là 16 vui lòng nhập lại !')
        return false
    }
    // $('#thumbnail-profile-logo').data('url', file);
    let avatar = $('#thumbnail-profile-logo').data('src'),
        ward_id=$('#select-ward-update-profile').val(),
        district_id=$('#select-district-update-profile').val(),
        city_id=$('#select-city-update-profile').val();
    checkUpdateLogoBranchSetting = 1;
    let method = 'post',
        url = 'profile.change-profile',
        params = '',
        data = {
            name: nameProfile,
            phone_number: phoneNumberProfile,
            birthday: birthdayProfile,
            place_birth: placeBirthProfile,
            address: addressProfile,
            avatar: avatar,
            email: emailProfile,
            gender: genderProfile,
            ward_id:ward_id,
            district_id:district_id,
            city_id:city_id
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#thumbnail-profile-logo')
    ]);
    checkUpdateLogoBranchSetting = 0;
    switch(res.data.status) {
        case 200:
            avatarProfile = avatar;
            $('#current-avatar').attr('src', res.data.data['avatar']);
            SuccessNotify($('#success-upload-data-to-server').text());
            $('#upload-avatar').val('')
            break;
        case 500:
            ErrorNotify(res.data.message)
            break;
        default:
            WarningNotify(res.data.message)
    }
}
