let checkReplyMessage = 0, status;

$(function () {
    $('#reply-message-payroll').on('click', function () {
        replyMessage();
    });

    $('#reply-message').on('keypress', function (e) {
        let keyCode = (e.keyCode ? e.keyCode : e.which);
        if (keyCode == '13') {
            replyMessage();
        }
    })
    shortcut.add('ENTER', function () {
        replyMessage();
    });
    shortcut.add('ESC', function () {
        closeModalNotify();
    });
    $('#reply-message').val('');
    $('#reply-message').on('input',function () {
        if($(this).val() != null){
            $(this).parents('.form__group').removeClass('validate-error');
        }
    })
});
function notifyPayroll(r) {
    $('#modal-notify-payroll').modal('show');
    shortcut.add('ESC', function () {
        closeModalNotify();
    });
    status = r.data('status')
    loadDataNotify(r.data('id'));
}

async function loadDataNotify(id) {
    $('#id-employee-reply').html(id);

    if (status === 2) {
        $('#input-notify-salary').addClass('d-none')
    }else {
        $('#input-notify-salary').removeClass('d-none')
    }

    let method = 'get',
        url = 'payroll-manage.data-notify',
        time = $('#time-payroll-manage').val(),
        params = {time: time, id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
    ]);
    $('#notify-title').text($('#time-payroll-manage').val())
    $('#data-notify-payroll-manage').html(res.data[0]);
    if(res.data[0] == '') {
        let id = $('#data-notify-payroll-manage');
        nullDataImg(id);
    }
    $('#body-message-payroll').animate({
        scrollTop: $('#body-message-payroll').get(0).scrollHeight
    }, 0);
}

async function replyMessage() {
    if(checkReplyMessage === 1) return false;
    checkReplyMessage = 1;
    let id = $('#id-employee-reply').text(),
        time = $('#time-payroll-manage').val(),
        message = $('#reply-message').val(),
        method = 'post',
        url = 'payroll-manage.reply-notify',
        params = null,
        data = {id: id, time: time, message: message};

    if(message === null || message === ''){
        $('#reply-message').parents('.form__group').addClass('validate-error')
        let text = $('#post-message-error-null').text();
        WarningNotify(text);
        checkReplyMessage=0
        return false;
    }
    let res = await axiosTemplate(method, url, params, data, []);
    checkReplyMessage = 0;
    if (res.data.status === 200) {
        loadDataNotify(id);
        $('#reply-message').val('');
    } else {
        let text = $('#post-message-error').text();
        ErrorNotify(text);
    }
}

function closeModalNotify() {
    $('#modal-notify-payroll').modal('hide');
    $('#reply-message').val('');
}
