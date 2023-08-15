let saveCreateCardValue;

$(function (){
    $('#modal-create-card-value input').on('input',function (){
        $('#modal-create-card-value .btn-renew').removeClass('d-none');
    })
    $('#modal-create-card-value .btn-renew').on('click',function (){
        $(this).addClass('d-none');
    })
    $(document).on('input paste','#amount-create-card-value',function (){
      let amount =  removeformatNumber($('#amount-create-card-value').val());
        $('#total-amount-create-card-value').text(formatNumber(amount*10000));
    })
    $('#name-create-card-value').on('keyup input', function () {
        $(this).val($(this).val().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, ''));
    })

})

function openModalCreateCardValue() {
    $('#modal-create-card-value').modal('show');

    $('#btn-create-card-value').prop('disabled', false);
    shortcut.remove('F4');
    $('#modal-create-card-value').on('click', function () {
        $('#btn-create-card-value').prop('disabled', false);
    })
    $('#amount-create-card-value').val(0);
    $('#bonus-create-card-value').val(0);
    shortcut.add('F4', function () {
        saveModalCreateCardValue();
    });

    $('#modal-create-card-value input').on('click', function () {
        $(this).select();
    })

    $('#modal-create-card-value').on('shown.bs.modal', function () {
        $('#name-create-card-value').focus();
    });

    shortcut.add('ESC', function () {
        closeModalCreateCardValue();
    });
    saveCreateCardValue = 0;
}

async function saveModalCreateCardValue() {
    if ( saveCreateCardValue === 1) return false;
    if(!checkValidateSave($('#modal-create-card-value'))) return false;
    let name = $('#name-create-card-value').val(),
        amount = removeformatNumber($('#amount-create-card-value').val()),
        bonus = removeformatNumber($('#bonus-create-card-value').val());
    saveCreateCardValue = 1;
    let method = 'post',
        url = 'card-value.create',
        params = null,
        data = {
            name: name,
            amount: amount,
            bonus: bonus,
        };
    await $('#btn-create-card-value').prop('disabled', true);
    shortcut.remove('F4');
    let res = await axiosTemplate(method, url, params, data,[$("#loading-modal-create-card-value-customer")]);
    saveCreateCardValue = 0;
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        closeModalCreateCardValue();
        loadData();
        addRowDatatableTemplate(dataTableCardValueEnable, {
            'name': res.data.data.name,
            'amount': formatNumber(Number(res.data.data.amount)),
            'bonus_amount': formatNumber(Number(res.data.data.bonus_amount)) ,
            'action': '<div class="btn-group btn-group-sm text-center">' +
                '<button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" id="aaa" onclick="changeStatusCardValue($(this))" data-id="' + res.data.data.id + '"  data-amount="'+ res.data.data.amount  +'" data-name="'+ res.data.data.name +'"  data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><span class="icofont icofont-ui-close"></span></button>' +
                '<button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateCardValue($(this))" data-id="' + res.data.data.id + '"  data-amount="'+ res.data.data.amount  +'" data-name="'+ res.data.data.name +'" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"><span class="icofont icofont-ui-edit"></span></button>' +
                        '</div>',
            'keysearch' : res.data.data.keysearch
        });
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        WarningNotify(text);
        $('#btn-create-card-value').prop('disabled', false);
        shortcut.remove('F4');
    }
}

function closeModalCreateCardValue() {
    $('#modal-create-card-value').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    reloadModalCreateCardValue();
}

function reloadModalCreateCardValue() {
    $('#modal-create-card-value input').val('');
    $('#amount-create-card-value').val(0);
    $('#bonus-create-card-value').val(0);
    $('#total-amount-create-card-value').text(0);
    $('#btn-create-card-value').prop('disabled', false);
    removeAllValidate();
}
