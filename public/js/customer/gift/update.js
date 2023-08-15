let save_update_gift,
    id_update_gift,
    status_update_gift;

function openModalUpdateGift(r) {
    // addLoading('gift.update', '#loading-modal-update-gift');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalUpdateGift();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateGift();
    });
    save_update_gift = 0;
    $('#branch-update-gift').val(r.data('branch')).trigger('change.select2');
    $('#name-update-gift').val(r.data('name'));
    $('#price-update-gift').val(r.data('price'));
    $('#description-update-gift').val(r.data('description'));
    id_update_gift = r.data('id');
    status_update_gift = r.data('status');
    $('#modal-update-gift').modal('show');
    $('#branch-update-gift').select2({
        dropdownParent: $('#modal-update-gift'),
    });
}

async function saveModalUpdateGift() {
    if(!checkValidateSave($('#loading-modal-update-gift'))) return false
    if (save_update_gift !== 0) {
        return false;
    }
    // let branch = $('#branch-update-gift').val(),
    //     name = $('#name-update-gift').val(),
    //     price = removeformatNumber($('#price-update-gift').val()),
    //     description = $('#description-update-gift').val();
    // save_update_gift = 1;

    // Tạm thời truyền lên 1 chi nhánh
    let branch = $('#branch-update-gift').val(),
            name = $('#name-update-gift').val(),
            price = removeformatNumber($('#price-update-gift').val()),
            description = $('#description-update-gift').val();
        save_update_gift = 1;
    let method = 'post',
        url = 'gift.update',
        params = null,
        data = {
            id: id_update_gift,
            status: status_update_gift,
            branch: branch,
            name: name,
            price: price,
            description: description,
        };
    let res = await axiosTemplate(method, url, params, data,[$("#loading-modal-update-gift")]);
    save_update_gift = 0;
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        closeModalUpdateGift();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalUpdateGift() {
    $('#modal-update-gift').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalUpdateGift();
    });
    $('#name-update-gift').val('');
    $('#price-update-gift').val('0');
    $('#description-update-gift').val('');
}
