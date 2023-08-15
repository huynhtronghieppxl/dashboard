let idUpdatePaymentRecurringBill,
    saveUpdatePaymentRecurringBill = 0,
    thisUpdatePaymentRecurringBill,
    idAdditionFeeReason, idAdditionFeeReason2,idBranch;

function openModalUpdatePaymentRecurringBill(r) {
    thisUpdatePaymentRecurringBill = r;
    $('#modal-update-payment-recurring-bill').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalUpdatePaymentRecurringBill();
    });
    shortcut.add('F4', function () {
        saveModalUpdatePaymentRecurringBill();
    });
    $('#select-value-update-payment-recurring-bill,#select-type-update-payment-recurring-bill,#select-target-update-payment-recurring-bill, #select-type-recurring-update-payment-recurring-bill').select2({
        dropdownParent: $('#modal-update-payment-recurring-bill')
    });
    idUpdatePaymentRecurringBill = r.data('id');
    idBranch = r.data('branch'),
    dataUpdatePaymentRecurringBill(r.data('id'), r.data('branch'));
    $(document).on('input', '#input-recurring-update-payment-recurring-bill', function () {
        type = $('#select-type-recurring-update-payment-recurring-bill').val()
        repeatTimeUpdatePaymentCurrentBill(type)
        $('#report-error-recurring-update-payment-recurring-bill').remove();
    })

    $('#input-recurring-update-payment-recurring-bill').on('input paste keyup', function (){
        $(this).parents('.form-group').find('.error').remove();
        $(this).parents('.form-validate-input').find('.line').removeClass('border-danger');
    })

    $('#select-type-recurring-update-payment-recurring-bill').on('change', function () {
        type = $(this).val()
        repeatTimeUpdatePaymentCurrentBill(type)
        console.log('type', type)
        console.log('repetitions', repetitions)
    })
}

function repeatTimeUpdatePaymentCurrentBill(type){
    let nextTime = $('#type-date-update-payment-recurring-bill'),
        cycle_repeats_type = $('#input-recurring-update-payment-recurring-bill')
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
            nextTime.text(moment().quarter(moment().quarter() + 1).startOf('quarter').format('DD/MM/YYYY'))
            break;
        case 5:
            cycle_repeats_type.attr('data-max', 999);
            cycle_repeats_type.val((cycle_repeats_type.val() > 999 ? 999 : cycle_repeats_type.val()));
            nextTime.text(moment(new Date).year(moment().year() + 1).startOf('year').format('DD/MM/YYYY'))
            break;
    }
}

async function dataUpdatePaymentRecurringBill(id, branch) {
    let method = 'get',
        url = 'payment-recurring-bill-treasurer.data-update',
        params = {id: id, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-update-payment-recurring-bill')]);
    idAdditionFeeReason = res.data[0].addition_fee_reason_id;
    $('#input-branch-update-payment-recurring-bill').text($('#change_branch option:selected').text());
    $('#input-target-update-payment-recurring-bill').val(res.data[0].object_name);
    $('#value-update-payment-recurring-bill').val(res.data[0].amount);
    $('#select-value-update-payment-recurring-bill').val(res.data[0].payment_method_id).trigger('change.select2');
    $('#description-update-payment-recurring-bill').val(res.data[0].note);
    $('#input-recurring-update-payment-recurring-bill').val(res.data[0].repeat_time);
    $('#type-date-update-payment-recurring-bill').text(res.data[0].start_from);
    $('#accounting-update-payment-recurring-bill').prop('checked', res.data[0].is_count_to_revenue);
    $('#select-type-recurring-update-payment-recurring-bill').val(res.data[0].cycle_repeats_type).trigger('change.select2');
    // $('#select-type-update-payment-recurring-bill').html(res.data[1]);
    if(dataReasonPaymentRecurringBill) {
        $('#select-type-update-payment-recurring-bill option').each(function () {
            if(+$(this).val() === res.data[0].addition_fee_reason_id) {
                $('#select-type-update-payment-recurring-bill').val(res.data[0].addition_fee_reason_id).trigger('change.select2');
                return false;
            }else {
                $('#select-type-update-payment-recurring-bill').val(null).trigger('change.select2');
            }
        })
    }else {
        await dataReasonCreatePaymentRecurringBill();
        $('#select-type-update-payment-recurring-bill option').each(function () {
            if(+$(this).val() === res.data[0].addition_fee_reason_id) {
                $('#select-type-update-payment-recurring-bill').val(res.data[0].addition_fee_reason_id).trigger('change.select2');
                return false;
            }else {
                $('#select-type-update-payment-recurring-bill').val(null).trigger('change.select2');
            }
        })
    }
    if($('#select-type-update-payment-recurring-bill option[value="'+ res.data[0].addition_fee_reason_id +'"]').val() == undefined){
        $('#select-type-update-payment-recurring-bill').find('option:first').trigger('change.select2');
    } else {
        $('#select-type-update-payment-recurring-bill').val(res.data[0].addition_fee_reason_id).trigger('change.select2');
    }
}

async function saveModalUpdatePaymentRecurringBill() {
    if (saveUpdatePaymentRecurringBill !== 0) return false;
    let flag = 0;
    // if($('#input-recurring-update-payment-recurring-bill').val() == 0){
    //     $('#input-recurring-update-payment-recurring-bill').parents('.form-group').find('.error').remove();
    //     $('#input-recurring-update-payment-recurring-bill').parents('.form-validate-input').find('.line').addClass('border-danger');
    //     $('#input-recurring-update-payment-recurring-bill').parents('.form-group').find('.link-href').prepend(`<div class="error"><span class="text-danger">Số tối thiểu 1</span></div>`);
    //     $('#input-recurring-update-payment-recurring-bill').parents('.form-group').find('.link-href').addClass('row');
    //     flag = 1;
    // }else {
    //     $('#input-recurring-update-payment-recurring-bill').parents('.form-validate-input').find('.line').removeClass('border-danger');
    // }
    if ($('#input-recurring-update-payment-recurring-bill').val() == 0) {
        addErrorInput($('#input-recurring-update-payment-recurring-bill'), 'Số tối thiểu 1');
        return false;
    }

    if (!checkValidateSave($('#modal-update-payment-recurring-bill'))) flag = 1;

    if(flag){
        return false;
    }

    let
        type = $('#select-type-update-payment-recurring-bill').val(),
        target = $('#input-target-update-payment-recurring-bill').val(),
        value = removeformatNumber($('#value-update-payment-recurring-bill').val()),
        value_type = $('#select-value-update-payment-recurring-bill').val(),
        accounting = ($('#accounting-update-payment-recurring-bill').is(':checked') === true) ? 1 : 0,
        description = $('#description-update-payment-recurring-bill').val(),
        recurring = removeformatNumber($('#input-recurring-update-payment-recurring-bill').val()),
        type_recurring = $('#select-type-recurring-update-payment-recurring-bill').val();
    saveUpdatePaymentRecurringBill = 1;
    let method = 'post',
        url = 'payment-recurring-bill-treasurer.update',
        params = null,
        data = {
            id: idUpdatePaymentRecurringBill,
            branch: idBranch,
            addition_fee_reason_id: type,
            amount: value,
            is_count_to_revenue: accounting,
            note: description,
            payment_method_id: value_type,
            recurring: recurring,
            type_recurring: type_recurring,
            target: target,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-update-payment-recurring-bill')]);
    saveUpdatePaymentRecurringBill = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalUpdatePaymentRecurringBill();
            loadData();
            drawDataUpdatePaymentRecurringBill(res.data.data)
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

function drawDataUpdatePaymentRecurringBill(data) {
    let x = thisUpdatePaymentRecurringBill.parents('tr').data('dt-row');
    if (data.status === 0) {
        $('#total-amount-tab2-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-amount-tab2-payment-recurring-bill').text()) + data.amount));
    } else {
        $('#total-amount-tab1-payment-recurring-bill').text(formatNumber(removeformatNumber($('#total-amount-tab1-payment-recurring-bill').text()) + data.amount));
    }
    thisUpdatePaymentRecurringBill.parents('tr').find('td:eq(1)').text(data.object_name);
    thisUpdatePaymentRecurringBill.parents('tr').find('td:eq(2)').text(data.addition_fee_reason_name);
    thisUpdatePaymentRecurringBill.parents('tr').find('td:eq(3)').html(data.amount_format);
    thisUpdatePaymentRecurringBill.parents('tr').find('td:eq(4)').html(data.type);
    thisUpdatePaymentRecurringBill.parents('tr').find('td:eq(5)').html(data.note);
}

function closeModalUpdatePaymentRecurringBill() {
    $('#modal-update-payment-recurring-bill').modal('hide');
    resetModalUpdatePaymentRecurringBill();
}
 function resetModalUpdatePaymentRecurringBill(){
     $('#input-recurring-update-payment-recurring-bill').parents('.form-group').find('.error').remove();
     $('#input-recurring-update-payment-recurring-bill').parents('.form-validate-input').find('.line').removeClass('border-danger');
     $('#modal-update-payment-recurring-bill .js-example-basic-single').find('option:first').prop('selected', true).trigger('change.select2');
     $('#value-update-payment-recurring-bill').prop('disabled', false);
     $('#input-recurring-update-payment-recurring-bill').val('1');
     $('#value-update-payment-recurring-bill').val('100');
     $('#input-target-update-payment-recurring-bill').val('');
     $('#note-update-payment-recurring-bill').val('');
     $('#accounting-update-payment-recurring-bill').prop('checked', true);
 }
