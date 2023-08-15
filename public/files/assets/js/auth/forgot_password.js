let s = 30;
let  timeout = null;
let uid = null;
let phone = '' ;
$(document).ready(function() {
    var firebaseConfig = {
        apiKey: "AIzaSyAHkqsK1wlVrc_S2T1hhZLoYLMi3sCTn0M",
        authDomain: "testfirebase-87aed.firebaseapp.com",
        projectId: "testfirebase-87aed",
        storageBucket: "testfirebase-87aed.appspot.com",
        messagingSenderId: "533244178107",
        appId: "1:533244178107:web:0c7d5d52c2772a5ffb039e",
        measurementId: "G-117WLRDS4N"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'invisible',
        'callback': function (response) {
            // reCAPTCHA solved, allow signInWithPhoneNumber.
            console.log('recaptcha resolved');
        }
    });
    onSignInSubmit();
});


function time_out(){
    if (s == -1){
        $('#repeat_get_code').prop('disabled', false);
        $('#time').text('');
        clearTimeout(timeout);
        return false;
    }
    $('#time').text(s+"s");
    timeout = setTimeout(function(){
    s--;
        time_out();
    }, 1000);
}

$('#codeToVerify').on('input',function(){
    if($(this).val().length === 6){
        $('#btn_capcha').prop('disabled', false);
    }
});

// Lấy số điện thoại
async function get_phone(){
    let username = $('.user_name').val(),
    restaurant_name = $('.restaurant_name').val(),
    phoneNo = null;
    await axios.post("/get-phone", {
        username : username,
        restaurant_name : restaurant_name
    }).then(res => {
        if(res.status == '200'){
            phoneNo = res.data.data;
            return phoneNo;
        }
    })
}


async function get_otp(){
    let username = $('.user_name').val(),
    restaurant_name = $('.restaurant_name').val(),
    phoneNo = null;
    await axios.post("/get-phone", {
        username : username,
        restaurant_name : restaurant_name
    }).then(res => {
        if(res.status == '200'){
            phoneNo = res.data.data;
        }
    })
    while(phoneNo.charAt(0) === '0')
    {
        phoneNo = phoneNo.substr(1);
    }
    phoneNo = "+84"+phoneNo;
    var appVerifier = window.recaptchaVerifier;
    console.log(appVerifier);
    phone = phoneNo;
    firebase.auth().signInWithPhoneNumber(phoneNo, appVerifier)
    .then(function (confirmationResult) {
        $('#capcha').css('display','');
        $('#btn_capcha').css('display','');
        $('.get_otp').css('display','none');
        time_out();
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        console.log(coderesult);
    }).catch(function (error) {
        console.log(error)
    });
}

function onSignInSubmit() {
    $('#btn_capcha').on('click', function() {
        let phoneNo = '';
        var code = $('#codeToVerify').val();
        console.log(code);
        $(this).attr('disabled', 'disabled');
        $(this).text('Đang xác thực..');
        confirmationResult.confirm(code).then(function (result) {
            var user = result.user;
            console.log(user.uid);
            $('#formForgot').css('display','');
            $('#formGetCode').css('display','none');
            $('#repeat_get_code').prop('disabled', true);
            $(this).attr('onclick','OnChangePassword()');
            $(this).text('Đổi mật khẩu');
            $(this).prop('disabled', false);
        }.bind($(this))).catch(function (error) {
            console.log(error);
            $(this).removeAttr('disabled');
            $(this).text('Mã không đúng');
            $('#btn_capcha').prop('disabled', true);
            setTimeout(() => {
                $('#btn_capcha').prop('disabled', false);
                $(this).text('Xác thực lại');
            }, 2000);
        }.bind($(this)));
    });
}

function reGetCode(){
    phoneNo = phone;
    console.log(phoneNo);
    return false;
    var appVerifier = window.recaptchaVerifier;
    console.log(appVerifier);
    firebase.auth().signInWithPhoneNumber(phoneNo, appVerifier)
        .then(function (confirmationResult) {
            $('#capcha').css('display','');
            $('#btn_capcha').css('display','');
            $('.get_otp').css('display','none');
            time_out();
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            console.log(coderesult);
        }).catch(function (error) {
        console.log(error)
    });
}

async function OnChangePassword(){
    let newPass =  $('.Password_New').val();
    let ConfPass =  $('.Confirm_password').val();
    if(ConfPass !== newPass){
        $('.txt_alert_error').css('display','');
        $('.txt_alert_error').text('Xác nhận mật khẩu không đúng');
        return false;
    }
    $('.txt_alert_error').css('display','none');
    await axios.post("change-password", {
        newPass : newPass,
        uid : uid,
    }).then(res => {
        if(res.data.status === 200){
            setTimeout(() => {
                window.location.href = "/login";
            }, 2000);
        }
    })
}
