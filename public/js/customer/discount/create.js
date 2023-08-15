let save_create_card_value;

function openModalCreateDiscount() {
    $('#modal-create-discount').modal('show');
    addLoading('discount.create', '#loading-modal-create-discount');
    shortcut.remove('F4');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalCreateDiscount();
    });
    $('.js-example-basic-single').select2({
        dropdownParent: $('#modal-create-discount'),
    });
    save_create_card_value = 0;
}

async function saveModalCreateDiscount() {
    if(!checkValidateSave($('#loading-modal-create-discount-customer'))) return false;
    if (save_create_card_value === 1) return false;
    let name = $('#name-create-discount').val(),
        amount = removeformatNumber($('#amount-create-discount').val()),
        bonus = removeformatNumber($('#bonus-create-discount').val());

    save_create_card_value = 1;
    let method = 'post',
        url = 'discount.create',
        params = null,
        data = {
            name: name,
            amount: amount,
            bonus: bonus,
        };
    let res = await axiosTemplate(method, url, params, data);
    save_create_card_value = 0;
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        closeModalCreateDiscount();
        addRowDatatableTemplate(data_table_card_enable, {
            'name': res.data.data.name,
            'amount': formatNumber(Number(res.data.data.amount)),
            'bonus_amount': formatNumber(Number(res.data.data.bonus_amount)),
            'action': '<div class="btn-group btn-group-sm text-center">' +
                '<button type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light" onclick="openModalUpdateDiscount($(this))" data-id="' + res.data.data.id + '"  data-amount="' + res.data.data.amount + '" data-name="' + res.data.data.name + '" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"><span class="icofont icofont-ui-edit"></span></button>' +
                '<button type="button" class="tabledit-edit-button btn btn-danger waves-effect waves-light" onclick="changeStatusDiscount($(this))" data-id="' + res.data.data.id + '"  data-amount="' + res.data.data.amount + '" data-name="' + res.data.data.name + '"  data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><span class="icofont icofont-ui-close"></span></button>' +
                '</div>',
        });
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalCreateDiscount() {
    $('#modal-create-discount').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateDiscount();
    });
    $('#modal-create-discount input').val('');
    $('#select-material-create-in-inventory-manage').val('');
    removeAllValidate();
}

function reloadModalCreateDiscount() {
    $('#from-date-in-inventory-manage').val('')
    $('#to-date-in-inventory-manage').val('')
    $('#select-material-create-in-inventory-manage').val($('#select-material-create-in-inventory-manage').find('option:first-child').val()).trigger('change.select2')
}
