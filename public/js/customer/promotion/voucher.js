let id_voucher_customer_promotion;

function openModalVoucherCustomerPromotion(id) {
    $('#modal-voucher-customer-promotion').modal('show');
    addLoading('promotion.voucher', '#loading-modal-voucher-customer-promotion');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalVoucherCustomerPromotion();
    });
    shortcut.add('F4', function () {
        saveModalVoucherCustomerPromotion();
    });
    id_voucher_customer_promotion = id;
    $('#code-voucher-promotion').unbind('input').on('input', function () {
        if ($(this).val().length > 10) {
            $(this).val($(this).val().slice(0, 10));
            $(this).select();
            alertify.notify('Tối đa 10 ký tự !', 'error', 5);
        } else {
            $(this).val(removeVietnameseStringLowerCase($(this).val()));
        }
    });
    $('#checkbox-reusable-voucher-promotion').unbind('click').on('click', function () {
        if ($(this).is(':checked')) {
            $('#div-checkbox-reusable-voucher-promotion').removeClass('d-none');
        } else {
            $('#div-checkbox-reusable-voucher-promotion').addClass('d-none');
        }
    });
    $('#reusable-voucher-promotion').unbind('input').on('input', function () {
        if (removeformatNumber($(this).val()) < 1) {
            $(this).val(1);
            $(this).select();
            alertify.notify('Tối thiểu bằng 1 !', 'error', 5);
        }
        if (removeformatNumber($(this).val()) > 1000000) {
            $(this).val('1,000,000');
            $(this).select();
            alertify.notify('Tối đa bằng 1,000,000 !', 'error', 5);
        }
    });
    $('#checkbox-max-use-voucher-promotion').unbind('click').on('click', function () {
        if ($(this).is(':checked')) {
            $('#div-checkbox-max-use-voucher-promotion').removeClass('d-none');
        } else {
            $('#div-checkbox-max-use-voucher-promotion').addClass('d-none');
        }
    });
    $('#max-use-voucher-promotion').unbind('input').on('input', function () {
        if (removeformatNumber($(this).val()) < 1) {
            $(this).val(1);
            $(this).select();
            alertify.notify('Tối thiểu bằng 1 !', 'error', 5);
        }
        if (removeformatNumber($(this).val()) > 1000000) {
            $(this).val('1,000,000');
            $(this).select();
            alertify.notify('Tối đa bằng 1,000,000 !', 'error', 5);
        }
    });
    $('#branch-voucher-promotion').val(['-123']).trigger('change.select2');
    $('#modal-voucher-customer-promotion .js-example-basic-single').select2({
        dropdownParent: $('#modal-voucher-customer-promotion')
    });
}

async function saveModalVoucherCustomerPromotion() {
    let code = $('#code-voucher-promotion').val(),
        branch = $('#branch-voucher-promotion').val(),
        max_use,
        reusable,
        check_code = checkRequire('Mã khuyến mãi', code),
        check_branch = checkChangeMultiple('chi nhánh', branch);
    if (check_code === false || check_branch === false) {
        return false;
    }
    if (code.length < 4) {
        alertify.notify('Code tối thiểu 4 ký tự !', 'error', 5);
        return false;
    }
    if ($('#checkbox-max-use-voucher-promotion').is(':checked')) {
        max_use = removeformatNumber($('#max-use-voucher-promotion').val());
    } else {
        max_use = '-1';
    }
    if ($('#checkbox-reusable-voucher-promotion').is(':checked')) {
        reusable = removeformatNumber($('#reusable-voucher-promotion').val());
    } else {
        reusable = '-1';
    }
    await jQuery.each(branch, function (i, v) {
        if (v === '-123') {
            branch = [];
        }
    });
    let method = 'post',
        url = 'promotion.voucher',
        params = null,
        data = {id: id_voucher_customer_promotion, code: code, branch: branch, max_use: max_use, reusable: reusable};
    let res = await axiosTemplate(method, url, params, data);
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        closeModalVoucherCustomerPromotion();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalVoucherCustomerPromotion() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateCustomerPromotion();
    });
    $('#code-voucher-promotion').val('');
    $('#modal-voucher-customer-promotion input[type="checkbox"]').prop('checked', false);
    $('#div-checkbox-max-use-voucher-promotion, #div-checkbox-reusable-voucher-promotion').addClass('d-none');
    $('#max-use-voucher-promotion, #reusable-voucher-promotion').val('1');
    $('#modal-voucher-customer-promotion').modal('hide')
}
