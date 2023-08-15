let checkSaveUpdatePassword = 0;

function openModalUpdatePassword() {
    $('#modal-change-password').modal('show');
    $('#new-password-update, #re-password-update').on('input paste', function () {
        $(this).val(removeVietnameseString($(this).val()));
        $(this).val($(this).val().replaceAll(' ', ''));
        if ($('#new-password-update').val() !== $('#re-password-update').val() && $('#re-password-update').val() !== '') {
            $('#error-re-password-update').text('Nhập lại mật khẩu không chính xác !');
            $('#error-re-password-update').addClass('text-danger');
        } else {
            $('#error-re-password-update').text('');
        }
    })
}

function viewPassProfile(r) {
    if (r.hasClass('fi-rr-eye') === true) {
        r.removeClass('fi-rr-eye');
        r.addClass('fi-rr-eye-crossed');
        r.parents('.form-group').find('input').attr('type', 'password');
    } else {
        r.removeClass('fi-rr-eye-crossed');
        r.addClass('fi-rr-eye');
        r.parents('.form-group').find('input').attr('type', 'text');
    }
}

async function saveUpdatePassword() {
    if (checkSaveUpdatePassword === 1) return false;
    if (!checkValidateSave($('#modal-change-password'))) return false;
    if ($('#new-password-update').val() !== $('#re-password-update').val()) return false;
    let oldPass = $('#old-password-update').val(),
        newPass = $('#new-password-update').val();
    let method = 'post',
        url = 'profile.update-password',
        params = '',
        data = {old_password: oldPass, new_password: newPass};
    checkSaveUpdatePassword = 1
    let res = await axiosTemplate(method, url, params, data, [
        $('#modal-change-password')
    ])
    checkSaveUpdatePassword = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#notify-success-update-component').text());
            closeModalPassWord();
            sweetAlertNextComponent()
            let title = 'Nhắc', content = 'Vui lòng đăng nhập lại !', icon = 'warning';
            sweetAlertNextComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    window.location.href = "/logout";
                }
            });
            break;
        case 500:
            ErrorNotify(res.data.message);
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalPassWord() {
    $('#modal-change-password').modal('hide');
    $('#modal-change-password input').val('');
}

