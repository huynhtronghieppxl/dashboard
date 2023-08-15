let currentPath;

$(function () {
    try {
        deleteCookieShared('config-firebase');
        firebase.auth().signOut();
    } catch (e) {

    }
    $(".restaurant_name").val(getCookieShared('auth-name-restaurant'));
    axios.interceptors.request.use((config) => {
        if (config.method == 'post' && config.url == '/login') {
            $('.card-login').loadingElement();
        }
        return config;
    }, (error) => {
        $('.loading-2022-template').remove();
        return Promise.reject(error);
    });

    $('#form-login-dashboard .toggle-verify-password').on('click', function () {
        if ($(this).hasClass('fa-eye') === true) {
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            $('#form-login-dashboard input[name="password"]').attr('type', 'password');
        } else {
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            $('#form-login-dashboard input[type="password"]').attr('type', 'text');
        }
    });

    $('.show-pass').on('click', function () {
        if ($(this).hasClass('fi-rr-eye-crossed')) {
            $(this).parents('.forgot-password').find('input').attr('type', 'text');
            $(this).removeClass('fi-rr-eye-crossed')
            $(this).addClass('fi-rr-eye')
        }else {
            $(this).parents('.forgot-password').find('input').attr('type', 'password');
            $(this).addClass('fi-rr-eye-crossed')
            $(this).removeClass('fi-rr-eye')
        }
    })

    window.addEventListener('keydown', function (e) {
        try {
            if (e.getModifierState('CapsLock')) {
                $('.alert-caplock-password').removeClass('d-none');
            } else {
                $('.alert-caplock-password').addClass('d-none');
            }
        } catch (er) {
            return true;
        }

    })

    // Đóng mở disabled button login
    $('.restaurant_name, .username, .password').on('keydown input paste', function () {
        if ($('.restaurant_name').val().length >= 2 && $('.restaurant_name').val().length < 50 &&
            $('.username').val().length >= 8 && $('.username').val().length <= 10 &&
            $('.password').val().length >= 4 && $('.password').val().length <= 20)
        {
            $('.btn_login').css('background', '#1462B0');
            $('.btn_login').removeAttr('disabled');
        } else {
            $('.btn_login').css('background', '#F1F2F5');
            $('.btn_login').attr("disabled", true);
        }
    })
    // Validate Công ty/ Nhà hàng
    $('.restaurant_name').on('focusout', function () {
        if ($(this).val().length < 2) {
            $(".txt_alert").html("Tên Công Ty/ Nhà hàng phải lớn hơn 2 ký tự");
            $(".text-validate").removeClass('d-none');
        }else if ($(this).val().length > 50) {
            $(".txt_alert").html("Tên Công Ty/ Nhà hàng phải bé hơn 50 ký tự");
            $(".text-validate").removeClass('d-none');
        }else {
            $(".text-validate").addClass('d-none');
        }
    })

    // Validate Tài khoản
    $('.username').on('focusout', function () {
        if ($(this).val().length < 8) {
            $(".txt_alert").html("Tài khoản phải lớn hơn 8 ký tự");
            $(".text-validate").removeClass('d-none');
        }else if ($(this).val().length > 10) {
            $(".txt_alert").html("Tài khoản phải bé hơn 10 ký tự");
            $(".text-validate").removeClass('d-none');
        }else {
            $(".text-validate").addClass('d-none');
        }
    })

    // Validate mật khẩu
    $('.password').on('keydown input paste', function (event) {
        let passwordValid = true;
        let vietnameseRegex = /[\u00E0\u00E1\u00E2\u00E3\u00E8\u00E9\u00EA\u00EC\u00ED\u00F2\u00F3\u00F4\u00F5\u00F9\u00FA\u00FD\u00E5\u0111\u0123\u0169\u01A1\u01B0\u1EA1\u1EA3\u1EA5\u1EA7\u1EA9\u1EAB\u1EAD\u1EAF\u1EB1\u1EB3\u1EB5\u1EB7\u1EB9\u1EBB\u1EBD\u1EBF\u1EC1\u1EC3\u1EC5\u1EC7\u1EC9\u1ECB\u1ECD\u1ECF\u1ED1\u1ED3\u1ED5\u1ED7\u1ED9\u1EDB\u1EDD\u1EDF\u1EE1\u1EE3\u1EE5\u1EE7\u1EE9\u1EEB\u1EED\u1EEF\u1EF1\u1EF3\u1EF5\u1EF7\u1EF9]/;
        // Kiểm tra nếu ký tự được nhập vào là ký tự tiếng Việt thì chặn
        if (vietnameseRegex.test($(this).val())) {
            $(".txt_alert").html("Mật khẩu không phép được nhập tiếng việt!");
            $(".text-validate").removeClass('d-none');
            passwordValid = false;
        }else if($(this).val().length > 20 || $(this).val().length < 4) {
            passwordValid = false;
            if($(this).val().length < 4){
                $(".txt_alert").html('');
                $(".text-validate").addClass('d-none');
            }else {
                $(".txt_alert").html("Mật khẩu không được lớn hơn 20 ký tự!");
                $(".text-validate").removeClass('d-none');
            }
        }else {
            $(".text-validate").addClass('d-none');
            $(".txt_alert").html('');
        }
        if(passwordValid) {
            $('.btn_login').css('background', '#1462B0');
            $('.btn_login').removeAttr('disabled');
        }else {
            $('.btn_login').css('background', '#F1F2F5');
            $('.btn_login').attr("disabled", true);
        }
    })

    // $('input[type="password"]').on('keydown input paste', function () {
    //     $(this).val($(this).val().replaceAll(' ', ''));
    // });

    axios.interceptors.response.use((response) => {
        if (response.data.code == 200) {
            setTimeout(function () {
                $('.loading-2022-template').remove();
            }, 2000)
        } else {
            $('.loading-2022-template').remove();
        }
        return response;
    }, (error) => {
        $('.loading-2022-template').remove();
        return Promise.reject(error);
    });

    $.fn.loadingElement = function () {
        $(this).append(`<div class='loading-2022-template' style='min-height: 20px; min-width: 20px; height: 50%; width: 50%; max-height: 50px; max-width: 50px;'><hr/><hr/><hr/><hr/></div>`);
    };

    axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
    let isProcessing = 1;

    const resetAlert = () => {
        $(".txt_alert").html("");
        $(".text-validate").addClass('d-none');
    };

    $("#login-form-v4 .btn-sign-in").click(async function (e) {
        await getLogin(e)
    });

    $("#login-form-v4").keypress(async function (e) {
        if (e.keyCode == 13) {
            await getLogin(e)
        }
    });

    //validate tai khoan
    $(document).on('keydown input paste', '.username', function (e){
        $(".username").val($(this).val().replace(/ /g, "").toUpperCase());
        $(".text-validate").addClass('d-none');
        if(!/\b[a-zA-Z][a-z0-9]*/g.test($(this).val()) && $(this).val() !== ''){
            $(".txt_alert").html("Kí tự đầu tiên không được phép là số <br> Không được nhập kí tự đặc biệt !");
            $(".username").val($(this).val().replace(/[0-9]/g, ''));
            $(".text-validate").removeClass('d-none');
        }else{
            $(".text-validate").addClass('d-none');
        }
    })

    // function valLoginPass(){
    //     return /^[0-9a-zA-Z\s]+$/.test($('.password').val());
    // }

    async function getLogin(e) {
        e.preventDefault();
        if (!checkValidateSave($('#form-login-dashboard'))) return false;
        if($(".restaurant_name").val() && $(".username").val() && $(".password").val() &&
            ($('.password').val().length < 4 || $('.password').val().length > 20 || ($('.btn_login').prop("disabled")) )){
            !$(".txt_alert").text() ? $(".txt_alert").html("Mật khẩu phải lớn hơn 4 ký tự!") : false;
            $(".text-validate").removeClass('d-none');
            return false;
        }else{
            $(".text-validate").addClass('d-none');
            if (isProcessing === 1) {
                    const restaurant_name = $(".restaurant_name").val();
                    const username = $(".username").val();
                    const password = $(".password").val();
                    const device_uid = $(".device_uid").val();
                    if (!restaurant_name || !username || !password) {
                        isProcessing = 1;
                        $(".txt_alert").html("Vui lòng nhập đầy đủ thông tin đăng nhập !");
                        $(".text-validate").removeClass('d-none');
                        return false;
                    }
                    isProcessing = 2;
                    resetAlert();
                    // let loginSuccess = true;
                    let method = 'post',
                        url = '/login',
                        params = {},
                        data = {
                            restaurant_name: restaurant_name,
                            username: username,
                            password: password,
                            token: getCookieShared('config-firebase'),
                            time_zone: Intl.DateTimeFormat().resolvedOptions().timeZone
                        };
                    let res = await axiosTemplate(method, url, params, data, [$('#login-form-v4')])
                    isProcessing = 1;
                    if(res.data[0]?.[0]?.status === 200 && res.data[0]?.[1]?.status === 200 && res.data[0]?.[2]?.status === 200 &&
                        res.data[0]?.[3]?.status === 200 && res.data[0]?.[4]?.status === 200 && res.data[0]?.[5]?.status === 200) {
                        deleteCookieShared('count-notify-header');
                        deleteCookieShared('list-notify-header');
                        deleteCookieShared('length-notify-header');
                        deleteCookieShared('page-notify-header');
                        saveCookieShared('auth-name-restaurant', restaurant_name);
                        window.location.href = res.data[0]?.current_path;
                    }else if(res.data.length === 3) {
                        let textFail = "Lỗi hệ thống, vui lòng thử lại !";
                        if(res.data[0].message) {
                            textFail = res.data[0].message;
                        }
                        $(".txt_alert").html(textFail);
                        $(".text-validate").removeClass('d-none');
                    }else if(res.data.length === 2) {
                        let textFail = "Công ty/Nhà hàng của bạn không có quyền truy cập trên nền tảng này !";
                        if(res.data[0].status !== 200) {
                            textFail = res.data[0].message;
                        }else if (res.data[0].web === 0) {
                            textFail = 'Tài khoản của bạn không có quyền truy cập Web';
                        }
                        $(".txt_alert").html(textFail);
                        $(".text-validate").removeClass('d-none');
                    }else if(res.data[0].status === 401) {
                        let textFail = "Lỗi hệ thống, vui lòng thử lại !";
                        if(res.data[0].message) {
                            textFail = res.data[0].message;
                        }
                        $(".txt_alert").html(textFail);
                        $(".text-validate").removeClass('d-none');
                    }else {
                        let textFail = "Lỗi hệ thống, vui lòng thử lại !";
                        if(res.data[0].message) {
                            textFail = res.data[0].message;
                        }
                        $(".txt_alert").html(textFail);
                        $(".text-validate").removeClass('d-none');
                    }
                }
        }
    }
});
