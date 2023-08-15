let usernameForgotPassword, restaurantForgotPassword;

$(function () {
    //*** forgot password step 1 section
    $('#form-forgot-password-step-one').on('keydown input paste', '.username, .restaurant_name', function () {
        if ($('.username').val().length >= 8 && $('.username').val().length <= 30 &&
            $('.restaurant_name').val().length >= 2 && $('.restaurant_name').val().length <= 50) {
            $('.send-otp').css({
                'background': '#1462B0',
                'color': '#fff',
                'cursor': 'pointer'
            })
            $('.send-otp').removeAttr('disabled');
        }else {
            $('.send-otp').css({
                'background': '#F1F2F5',
                'color': '#fff',
                'cursor': 'default'
            })
            $('.send-otp').attr("disabled");
        }
    })

    // Validate Công ty/ Nhà hàng
    $('#form-forgot-password-step-one').on('focusout', '.restaurant_name', function () {
        if ($(this).val().length < 2) {
            $(".validation-auth-forgot-password-server").html("Tên Công Ty/ Nhà hàng phải lớn hơn 2 ký tự");
            $(".validate-input").removeClass('d-none');
        }else if ($(this).val().length > 50) {
            $(".validation-auth-forgot-password-server").html("Tên Công Ty/ Nhà hàng phải bé hơn 50 ký tự");
            $(".validate-input").removeClass('d-none');
        }else {
            $(".validate-input").addClass('d-none');
        }
    })

    // Validate Tài khoản
    $('#form-forgot-password-step-one').on('focusout', '.username', function () {
        if ($(this).val().length < 8) {
            $(".validation-auth-forgot-password-server").html("Tài khoản phải lớn hơn 8 ký tự");
            $(".validate-input").removeClass('d-none');
        }else if ($(this).val().length > 30) {
            $(".validation-auth-forgot-password-server").html("Tài khoản phải bé hơn 30 ký tự");
            $(".validate-input").removeClass('d-none');
        }else {
            $(".validate-input").addClass('d-none');
        }
    })

    $('#form-forgot-password-step-one').on('keydown input paste', '.username', function (e) {
        $(".username").val($(this).val().replace(/ /g, "").toUpperCase());
    })

    $('#form-forgot-password-step-one .send-otp').on('click', function (e) {
        e.preventDefault();
        if (!$('#form-forgot-password-step-one .username').val() || !$('#form-forgot-password-step-one .restaurant_name').val()) {
            $('#form-forgot-password-step-one .username').addClass('input-warning-validate');
            $('#form-forgot-password-step-one .validation-auth-user-name').removeClass('d-none');
        } else {
            $('#form-forgot-password-step-one .validation-auth-user-name').addClass('d-none');
            stepOneForgotPassword();
        }
    });

    //** Verify OTP section
    $('#form-verify-opt-code').on('click', '.verify-otp-code-btn', function (e) {
        e.preventDefault();
        verifyCode();
    })
    $('#form-verify-opt-code').on('input keydown', 'input', function (e) {
        if($(this).val().length > 1) {
            $(this).val($(this).val()[$(this).val().length - 1]);
        }
        $(this).parents().find('#form-verify-opt-code .validation-auth-two-forgot-password-server').addClass('d-none');
        $('#otp-forgot-password input').each((function () {
            if($(this).val()) {
                $('.verify-otp-code-btn').css({
                    'background': '#1462B0',
                    'color': '#fff',
                    'cursor': 'pointer'
                }).removeAttr('disabled');
            }else {
                $('.verify-otp-code-btn').css({
                    'background': '#F1F2F5',
                    'color': '#fff',
                    'cursor': 'default'
                }).attr("disabled");
            }
        }))
        $('#form-verify-opt-code .validation-otp-code').addClass('d-none');
    })

    OTPInputForgotPassword();

    // ** Change password section
    $('.password, .verify-password').on('input', function () {
        $('#form-forgot-password-step-two .text-validations').addClass('d-none');
        if ($('.password').val() === $('.verify-password').val()) {
            $('.send').css({
                'background': '#1462B0',
                'color': '#fff'
            }).removeAttr('disabled')
        }else {
            $('.send').css({
                'background': '#F1F2F5',
                'color': '#fff',
                'cursor': 'default'
            }).attr("disabled", true)
        }
    })

    $('#form-forgot-password-step-two .update-password-btn').on('click', function (e) {
        e.preventDefault();
        let check = 0;
        if (!$('#form-forgot-password-step-two .password').val()) {
            $(this).addClass('input-warning-validate');
            $('#popup-forgot-password-auth .validation-auth-password').removeClass('d-none');
            check = 1;
        }
        if (!$('#form-forgot-password-step-two .verify-password').val() || ($('#form-forgot-password-step-two .verify-password').val() !== $('#form-forgot-password-step-two .password').val())) {
            $(this).addClass('input-warning-validate');
            $('#popup-forgot-password-auth .text-error-3').removeClass('d-none');
            check = 1;
        }
        if (check === 0) {
            stepTwoForgotPassword();
        }
    });

    // $('#btn-forgot-password').on('click', function () {
    //     $('#popup-forgot-password-auth').addClass('active');
    // });


    $('#popup-forgot-password-auth .user-name').on('input', function () {
        $('#popup-forgot-password-auth .user-name').val($(this).val().toUpperCase())
        if (!$(this).val()) {
            $(this).addClass('input-warning-validate');
            $('#popup-forgot-password-auth .validation-auth-date').removeClass('d-none');
        } else {
            $(this).removeClass('input-warning-validate');
            $('#popup-forgot-password-auth .validation-auth-user-name').addClass('d-none');
        }
    });

    // Listen field to change password
    // $('#form-forgot-password-step-two .password').on('input', function () {
    //     if ($(this).val() === "" || $(this).val().length > 20 || $(this).val().length < 4) {
    //         $(this).addClass('input-warning-validate');
    //         $('#popup-forgot-password-auth .validation-auth-password').removeClass('d-none');
    //         $('.error-message-pass-forgot-password').text('Vui lòng nhập mật khẩu (4-20 ký tự)');
    //         return false;
    //     } else {
    //         $(this).removeClass('input-warning-validate');
    //         $('#popup-forgot-password-auth .validation-auth-password').addClass('d-none');
    //     }
    // });
    // Validate mật khẩu
    $('#form-forgot-password-step-two').on('keydown input paste', '.password, .verify-password' , function (event) {
        let passwordValid = true;
        let vietnameseRegex = /[\u00E0\u00E1\u00E2\u00E3\u00E8\u00E9\u00EA\u00EC\u00ED\u00F2\u00F3\u00F4\u00F5\u00F9\u00FA\u00FD\u00E5\u0111\u0123\u0169\u01A1\u01B0\u1EA1\u1EA3\u1EA5\u1EA7\u1EA9\u1EAB\u1EAD\u1EAF\u1EB1\u1EB3\u1EB5\u1EB7\u1EB9\u1EBB\u1EBD\u1EBF\u1EC1\u1EC3\u1EC5\u1EC7\u1EC9\u1ECB\u1ECD\u1ECF\u1ED1\u1ED3\u1ED5\u1ED7\u1ED9\u1EDB\u1EDD\u1EDF\u1EE1\u1EE3\u1EE5\u1EE7\u1EE9\u1EEB\u1EED\u1EEF\u1EF1\u1EF3\u1EF5\u1EF7\u1EF9]/;
        // Kiểm tra nếu ký tự được nhập vào là ký tự tiếng Việt thì chặnhaf
        console.log($(this).siblings('.validation-auth-password'))
        if (vietnameseRegex.test($(this).val())) {
            $(this).siblings('.validation-auth-password').removeClass('d-none');
            $(this).siblings('.validation-auth-password').find('.error-message-pass-forgot-password').text('Mật khẩu không phép được nhập tiếng việt!');
            passwordValid = false;
        }else if($(this).val().length > 20 || $(this).val().length < 4) {
            passwordValid = false;
            if($(this).val().length < 4) {
                $(this).removeClass('input-warning-validate');
                $(this).siblings('.validation-auth-password').addClass('d-none');
                $(this).siblings('.validation-auth-password').find('.error-message-pass-forgot-password').text('');
            }else {
                $(this).addClass('input-warning-validate');
                $(this).siblings('.validation-auth-password').removeClass('d-none');
                $(this).siblings('.validation-auth-password').find('.error-message-pass-forgot-password').text('Vui lòng nhập mật khẩu (4-20 ký tự)');
            }
        }else if ($(this).val().length > 4 && $('.password').val() && ($('.verify-password').val().length > $('.password').val().length)
            && ($('.password').val() !== $('.verify-password').val())) {
            passwordValid = false;
            $('.verify-password').siblings('.validation-auth-password').removeClass('d-none');
            $('.verify-password').siblings('.validation-auth-password').find('.error-message-pass-forgot-password').text('Nhập lại mật khẩu không khớp!');
        }else {
            $(this).removeClass('input-warning-validate');
            $(this).siblings('.validation-auth-password').addClass('d-none');
            $(this).siblings('.validation-auth-password').find('.error-message-pass-forgot-password').text('');
        }
        if(passwordValid) {
            $('#form-forgot-password-step-two .update-password-btn').css('background', '#1462B0');
            $('#form-forgot-password-step-two .update-password-btn').removeAttr('disabled');
        }else {
            $('#form-forgot-password-step-two .update-password-btn').css('background', '#F1F2F5');
            $('#form-forgot-password-step-two .update-password-btn').attr("disabled", true);
        }
    })
    // $('#form-forgot-password-step-two .verify-password').on('keydown input paste', function () {
    //     if ($(this).val() === "" || $(this).val().length > 20 || $(this).val().length < 4) {
    //         $(this).addClass('input-warning-validate');
    //         $('#popup-forgot-password-auth .validation-auth-verify-password').removeClass('d-none');
    //         return false;
    //     } else {
    //         $(this).removeClass('input-warning-validate');
    //         $('#popup-forgot-password-auth .validation-auth-verify-password').addClass('d-none');
    //     }
    // });
    $('#send-step-two-forgot-password').on('click', function () {
        reSendOtpForgotPassword();
        $('#form-verify-opt-code input').val('');
        $('#form-verify-opt-code input:first').focus();
    });

    // Listen and handle when user press enter
    $('#popup-forgot-password-auth input').on('keypress', function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            $('#form-forgot-password-step-two .text-validations').addClass('d-none');
            if (!$('#form-forgot-password-step-one').hasClass('d-none')) {
                stepOneForgotPassword();
            }else if(!$('#form-verify-opt-code').hasClass('d-none')) {
                verifyCode();
                $('#form-verify-opt-code input:first').focus();
            } else if(!$('#form-forgot-password-step-two').hasClass('d-none')) {
                stepTwoForgotPassword();
            }
        }
    });
});

function OTPInputForgotPassword() {
    const inputs = document.querySelectorAll('#otp-forgot-password > *[id]');
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('keydown', function (event) {
            if (event.key === "Backspace") {
                inputs[i].value = '';
                if (i !== 0)
                    inputs[i - 1].focus();
            } else {
                if (i === inputs.length - 1 && inputs[i].value !== '') {
                    return true;
                } else if (event.keyCode > 47 && event.keyCode < 58 || event.keyCode > 95 && event.keyCode < 106) {
                    inputs[i].value = event.key;
                    if (i !== inputs.length - 1)
                        inputs[i + 1].focus();
                    event.preventDefault();
                } else {
                    event.preventDefault();
                }
            }
            if (inputs[0].value.length === 1 && inputs[1].value.length === 1 && inputs[2].value.length === 1 && inputs[3].value.length === 1 ) {
                // $('#form-forgot-password-step-two .main-btn').add('disabled', false);
                $('#form-forgot-password-step-two .password').click();
            } else {
                // $('#form-forgot-password-step-two .main-btn').prop('disabled', true);
            }
        });
    }
}

function reSendOtpForgotPassword() {
    $('#send-step-two-forgot-password').addClass('d-none');
    $('#form-verify-opt-code .validation-otp-code').addClass('d-none');
    $('.loading-data').removeClass('d-none');
    axios.post("forgot-password", {
        restaurant: restaurantForgotPassword,
        username: usernameForgotPassword,
    }).then(res => {
        $('.loading-data').addClass('d-none');
        if (res.data.status === 200) {
            $('#opt-forgot-password #first').focus();
            let timeleft = 60;
            let downloadTimer = setInterval(function () {
                if (timeleft <= 0) {
                    $('#send-step-two-forgot-password').removeClass('d-none');
                    clearInterval(downloadTimer);
                }
                $('#time-step-two-forgot-password').text(timeleft);
                timeleft--;
            }, 1000);
            $('#popup-forgot-password-auth .icofont-ui-close').on('click', function () {
                clearInterval(downloadTimer);
            });
        } else {
            $('#popup-forgot-password-auth .validation-auth-forgot-password-server').text(res.data.message);
            $('#popup-forgot-password-auth .validate-input').removeClass('d-none');
        }
    }).catch(error => {
        console.log(error);
    });
}

function stepOneForgotPassword() {
    $('#popup-forgot-password-auth .text-validations').addClass('d-none');
    let restaurant = $('#popup-forgot-password-auth .restaurant_name').val(),
        username = $('#popup-forgot-password-auth .username').val();
    axios.post("forgot-password", {
        restaurant: restaurant,
        username: username,
    }).then(res => {
        if (res.data.status === 200) {
            restaurantForgotPassword = restaurant;
            usernameForgotPassword = username;
            $('#form-forgot-password-step-one').addClass('d-none');
            $('#form-verify-opt-code').removeClass('d-none');
            $('#opt-forgot-password #first').focus();
            let timeleft = 60;
            let downloadTimer = setInterval(function () {
                if (timeleft <= 0) {
                    $('#send-step-two-forgot-password').removeClass('d-none');
                    clearInterval(downloadTimer);
                }
                $('#time-step-two-forgot-password').text(timeleft);
                timeleft--;
            }, 1000);
            $('#popup-forgot-password-auth .icofont-ui-close').on('click', function () {
                clearInterval(downloadTimer);
            });
        } else {
            $('#popup-forgot-password-auth .validation-auth-forgot-password-server').text(res.data.message);
            $('#popup-forgot-password-auth .validate-input').removeClass('d-none');
        }
    }).catch(error => {
        return false;
    });
}

async function verifyCode () {
    let code = $('#otp-forgot-password #first').val() + $('#otp-forgot-password #second').val() + $('#otp-forgot-password #third').val() + $('#otp-forgot-password #fourth').val();
        let method = 'post',
            url = 'verify-code',
            params = {},
            data = {
                'restaurant_name' : $('.restaurant_name').val(),
                'use_name' : $('.username').val(),
                'code' : code,
            };
        let res = await axiosTemplate(method, url, params, data, [$('#loading-form-verify-otp-code')]);
        if(res.data.status === 200) {
            $('#popup-forgot-password-auth #form-verify-opt-code').addClass('d-none');
            $('#popup-forgot-password-auth #form-forgot-password-step-two').removeClass('d-none');
            stepTwoForgotPassword();
        }else {
            let text = 'Mã OTP không chính xác!';
            if (res.data.message) {
                text = res.data.message;
            }
            $('#form-verify-opt-code .validation-otp-code').removeClass('d-none').text(text);
            $('#otp-forgot-password #first').val('');
            $('#otp-forgot-password #second').val('');
            $('#otp-forgot-password #third').val('');
            $('#otp-forgot-password #fourth').val('');
        }
    }
async function stepTwoForgotPassword() {
    let code = $('#otp-forgot-password #first').val() + $('#otp-forgot-password #second').val() + $('#otp-forgot-password #third').val() + $('#otp-forgot-password #fourth').val(),
        password = $('#form-forgot-password-step-two .password').val(),
        verifyPassword = $('#form-forgot-password-step-two .verify-password').val();
        // regex = /^[a-zA-Z0-9!@#$%^&*]{4,50}$/g ;
    $('#form-forgot-password-step-two .text-validations').addClass('d-none');
    if (password.length > 20 || password.length < 4 || $('.update-password-btn').prop('disabled') || (password !== verifyPassword)) {

        return false;
    }
    // $('.loading-data').removeClass('d-none');
    let method = 'post',
        url = 'change-password',
        params = {},
        data = {
            username: usernameForgotPassword,
            code: code,
            password: password,
            access_token : '',
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-forgot-password-step-two')]);
    let text = '';
    if(res?.data?.status === 200) {
        text = 'Đổi mật khẩu thành công !';
        alertify.notify('<b> Done: </b> <br> ' + text, 'success', Math.floor(text.length / 5));
        window.location.href = '/login';
    }else {
        text = 'Lỗi hệ thống, vui lòng thử lại !';
        alertify.notify('<b> Error: </b> <br> ' + text, '', Math.floor(text.length / 5));
        $('#popup-forgot-password-auth .validation-auth-two-forgot-password-server').text(text);
        $('#popup-forgot-password-auth .validation-auth-two-forgot-password-server').removeClass('d-none');
    }
}
