let save_create_gift;
function openModalCreateGift() {
    addLoading('gift.create', '#loading-modal-create-gift');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalCreateGift();
    });
    shortcut.add('ESC', function () {
        closeModalCreateGift();
    });
    save_create_gift = 0;
    $('#modal-create-gift').modal('show');
    $('#branch-create-gift').select2({
        dropdownParent: $('#modal-create-gift'),
    });

    $('#branch-create-gift').val($('#change_branch').val()).trigger('change')
}

async function saveModalCreateGift() {
    if(!checkValidateSave($('#loading-modal-create-gift'))) return false;
    if (save_create_gift !== 0) {
        return false;
    }
    let branch = $('#branch-create-gift').val(),
        name = $('#name-create-gift').val(),
        price = removeformatNumber($('#price-create-gift').val()),
        description = $('#description-create-gift').val();


    save_create_gift = 1;
    let method = 'post',
        url = 'gift.create',
        params = null,
        data = {
            branch: branch,
            name: name,
            price: price,
            description: description,
        };
    let res = await axiosTemplate(method, url, params, data);
    save_create_gift = 0;
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        closeModalCreateGift();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalCreateGift() {
    $('#modal-create-gift').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateGift();
    });
    $('#branch-create-gift').val('').trigger('change.select2');
    $('#name-create-gift').val('');
    $('#price-create-gift').val('0');
    $('#description-create-gift').val('');
}
