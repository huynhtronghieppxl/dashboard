let idUpdateCardValue,
    statusUpdateCardValue,
    saveUpdateCardValue;
$(function (){
    $(document).on('input paste','#amount-update-card-value',function (){
        let amount =  removeformatNumber($('#amount-update-card-value').val());
        $('#total-amount-update-card-value').text(formatNumber(amount*10000));
    })
    $('#name-update-card-value').on('keyup input', function () {
        $(this).val($(this).val().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, ''));
    })
})
function openModalUpdateCardValue(r) {
    $('#modal-update-card-value').modal('show');

    $('#btn-update-card-value').prop('disabled', false);
    shortcut.remove('F4');
    $('#modal-update-card-value').on('click', function () {
        $('#btn-update-card-value').prop('disabled', false);
    })
    shortcut.add('F4', function () {
        saveModalUpdateCardValue();
    });

    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalUpdateCardValue();
    });
    saveUpdateCardValue = 0;
    idUpdateCardValue = r.data('id');
    statusUpdateCardValue = r.data('status');
    $('#name-update-card-value').val(r.data('name'));
    $('#amount-update-card-value').val(r.data('amount'));
    $('#bonus-update-card-value').val(r.data('bonus'));
    $('#modal-update-card-value input').on('click', function () {
        $(this).select()
    })

    $('#modal-update-card-value').on('shown.bs.modal', function () {
        $('#name-update-card-value').focus();
    });
    let amount =  removeformatNumber($('#amount-update-card-value').val());
    $('#total-amount-update-card-value').text(formatNumber(amount*10000));
}

async function saveModalUpdateCardValue() {
    if ( saveUpdateCardValue === 1) return false;
    if(!checkValidateSave($('#modal-update-card-value'))) return false
    let name = $('#name-update-card-value').val(),
        amount = removeformatNumber($('#amount-update-card-value').val()),
        bonus = removeformatNumber($('#bonus-update-card-value').val());
    saveUpdateCardValue = 1;
    let method = 'post',
        url = 'card-value.update',
        params = null,
        data = {
            status: statusUpdateCardValue,
            id: idUpdateCardValue,
            name: name,
            amount: amount,
            bonus: bonus,
        };

    await $('#btn-update-card-value').prop('disabled', true);
    shortcut.remove('F4');

    let res = await axiosTemplate(method, url, params, data,[$("#loading-modal-update-card-value-customer")]);
    saveUpdateCardValue = 0;
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        closeModalUpdateCardValue();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
        $('#btn-update-card-value').prop('disabled', false);
        shortcut.add('F4', function () {
            saveModalUpdateCardValue();
        });
    }
}

function closeModalUpdateCardValue() {
    $('#modal-update-card-value').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    resetModalUpdateCardValue();
}

function resetModalUpdateCardValue() {
    $('#modal-update-card-value input').val('');
    $('#btn-update-card-value').prop('disabled', false);
    removeAllValidate();
}
