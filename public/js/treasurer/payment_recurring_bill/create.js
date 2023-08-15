let saveCreatePaymentRecurringBill = 0,
    repetitions, type;

function openModalCreatePaymentRecurringBill() {
    $('#modal-create-payment-recurring-bill').modal('show');
    $('#value-create-payment-recurring-bill').val('100');
    $('#input-recurring-create-payment-recurring-bill').val('1');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalCreatePaymentRecurringBill();
    });
    shortcut.add('F4', function () {
        saveModalCreatePaymentRecurringBill();
    });
    $('#select-branch-create-payment-recurring-bill, #select-value-create-payment-recurring-bill, #select-type-create-payment-recurring-bill,#select-target-create-payment-recurring-bill, #select-type-recurring-create-payment-recurring-bill').select2({
        dropdownParent: $('#modal-create-payment-recurring-bill')
    });
    dataReasonCreatePaymentRecurringBill();
    $(document).on('input', '#input-recurring-create-payment-recurring-bill', function () {
        $('#report-error-recurring-create-payment-recurring-bill').remove();
    })

    $('#select-type-create-payment-recurring-bill, #select-type-recurring-create-payment-recurring-bill, #select-value-create-payment-recurring-bill').on('change', function () {
        $('.btn-renew').removeClass('d-none');
    })
    $('#modal-create-payment-recurring-bill input, #modal-create-payment-recurring-bill textarea').on('input', function () {
        $('.btn-renew').removeClass('d-none');
    })

    $('#input-recurring-create-payment-recurring-bill').on('input paste keyup', function (){
        $(this).parents('.form-group').find('.error').remove();
        $(this).parents('.form-validate-input').find('.line').removeClass('border-danger');
        type = $('#select-type-recurring-create-payment-recurring-bill').val()
        repetitions = Number($(this).val())
        repeatTimeCreatePaymentCurrentBill(type)
    })
    $('#select-type-recurring-create-payment-recurring-bill').on('change', function (){
        type = $(this).val()
        repetitions = $('#input-recurring-create-payment-recurring-bill').val()
        repeatTimeCreatePaymentCurrentBill(type)
    })

}

function repeatTimeCreatePaymentCurrentBill(type){
    let nextTime = $('#type-date-create-payment-recurring-bill'),
        cycle_repeats_type = $('#input-recurring-create-payment-recurring-bill')
    switch (Number(type)){
        case 1:
            cycle_repeats_type.attr('data-max', 31);
            cycle_repeats_type.val((cycle_repeats_type.val() > 31 ? 31 : cycle_repeats_type.val()));
            nextTime.text(moment(new Date).add(1, 'days').format('DD/MM/YYYY'))
            break
        case 3:
            console.log(cycle_repeats_type.val()  , $('#input-recurring-create-payment-recurring-bill').val())
            cycle_repeats_type.attr('data-max', 12);
            cycle_repeats_type.val((cycle_repeats_type.val() > 12 ? 12 : cycle_repeats_type.val()));
            nextTime.text(moment(new Date).add(1, 'months').startOf('month').format('DD/MM/YYYY'))
            break;
        case 4:
            cycle_repeats_type.attr('data-max', 4);
            cycle_repeats_type.val((cycle_repeats_type.val() > 4 ? 4 : cycle_repeats_type.val()));
            nextTime.text(moment(new Date).quarter(moment().quarter() + 1).startOf('quarter').format('DD/MM/YYYY'))
            break;
        case 5:
            cycle_repeats_type.attr('data-max', 999);
            cycle_repeats_type.val((cycle_repeats_type.val() > 999 ? 999 : cycle_repeats_type.val()));
            nextTime.text(moment(new Date).year(moment().year() + 1).startOf('year').format('DD/MM/YYYY'))
            break;
    }
}


async function saveModalCreatePaymentRecurringBill() {
    let flag = 0;
    if (saveCreatePaymentRecurringBill !== 0) return false;
    // if($('#input-recurring-create-payment-recurring-bill').val() == 0){
    //     $('#input-recurring-create-payment-recurring-bill').parents('.form-group').find('.error').remove();
    //     $('#input-recurring-create-payment-recurring-bill').parents('.form-validate-input').find('.line').addClass('border-danger');
    //     $('#input-recurring-create-payment-recurring-bill').parents('.form-group').find('.link-href').prepend(`<div class="error"><span class="text-danger">Số tối thiểu 1</span></div>`);
    //     $('#input-recurring-create-payment-recurring-bill').parents('.form-group').find('.link-href').addClass('row');
    //     flag = 1;
    // }else {
    //     $('#input-recurring-create-payment-recurring-bill').parents('.form-validate-input').find('.line').removeClass('border-danger');
    // }
    if ($('#input-recurring-create-payment-recurring-bill').val() == 0) {
        addErrorInput($('#input-recurring-create-payment-recurring-bill'), 'Số tối thiểu 1');
        return false;
    }

    if (!checkValidateSave($('#modal-create-payment-recurring-bill'))) flag = 1;


    if(flag){
        return false;
    }
    let branch = $('.select-branch').val(),
        type = $('#select-type-create-payment-recurring-bill').val(),
        target = $('#input-target-create-payment-recurring-bill').val(),
        value = removeformatNumber($('#value-create-payment-recurring-bill').val()),
        value_type = $('#select-value-create-payment-recurring-bill').val(),
        accounting = ($('#accounting-create-payment-recurring-bill').is(':checked') === true) ? 1 : 0,
        description = $('#description-create-payment-recurring-bill').val(),
        recurring = removeformatNumber($('#input-recurring-create-payment-recurring-bill').val()),
        type_recurring = $('#select-type-recurring-create-payment-recurring-bill').val();
    saveCreatePaymentRecurringBill = 1;
    let method = 'post',
        url = 'payment-recurring-bill-treasurer.create',
        params = null,
        data = {
            branch: branch,
            addition_fee_reason_id: type,
            amount: value,
            is_count_to_revenue: accounting,
            note: description,
            payment_method_id: value_type,
            recurring: recurring,
            type_recurring: type_recurring,
            target: target,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-create-payment-recurring-bill')]);
    saveCreatePaymentRecurringBill = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreatePaymentRecurringBill();
            drawCreatePaymentRecurringBill(res.data.data)
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            WarningNotify(text);
    }
}

function drawCreatePaymentRecurringBill(data) {
    $('#nav-tab-payment-recurring-bill li:eq(0) a').click();
    $('#total-record-tab1-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-record-tab1-payment-recurring-bill').text()) + 1));
    $('#total-amount-tab1-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-amount-tab1-payment-recurring-bill').text()) + data.amount));
    addRowDatatableTemplate(tableEnablePaymentRecurringBillTreasurer, {
        'object_name': data.object_name,
        'addition_fee_reason_name': data.addition_fee_reason_name,
        'amount': data.amount_format,
        'type': data.type,
        'note': data.note,
        'action': data.action,
        'keysearch': data.keysearch,
    });
}

function closeModalCreatePaymentRecurringBill() {
    $('#modal-create-payment-recurring-bill .js-example-basic-single').find('option:first').prop('selected', true).trigger('change.select2');
    reloadModalCreatePaymentRecurringBill();
    $('#modal-create-payment-recurring-bill').modal('hide');
}

function reloadModalCreatePaymentRecurringBill(){
    $('#input-recurring-create-payment-recurring-bill').parents('.form-group').find('.error').remove();
    $('#input-recurring-create-payment-recurring-bill').parents('.form-validate-input').find('.line').removeClass('border-danger');
    $('#modal-create-payment-recurring-bill .js-example-basic-single').find('option:first').prop('selected', true).trigger('change.select2');
    $('#select-type-create-payment-recurring-bill').val($('#select-type-create-payment-recurring-bill').find('option:first-child').val()).trigger('change.select2');
    $('#input-recurring-create-payment-recurring-bill').val(1);
    $('#value-create-payment-recurring-bill').val(100);
    $('#input-target-create-payment-recurring-bill').val('');
    $('#description-create-payment-recurring-bill').val('');
    $('#value-create-payment-recurring-bill').prop('disabled',false);
    $('#accounting-create-payment-recurring-bill').prop('checked', true);
    $('#select-type-recurring-create-payment-recurring-bill').val(1).trigger('change.select2');
    $('#select-value-create-payment-recurring-bill').val(1).trigger('change.select2');
    $('#description-create-payment-recurring-bill').val('');
    $('.btn-renew').addClass('d-none');
}
