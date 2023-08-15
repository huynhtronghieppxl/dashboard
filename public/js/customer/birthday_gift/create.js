
function openModalCreateBirthdayGift() {
    // addLoading('birthday-gift.data-gift-item', '#loading-modal-create-birthday-gift');
    // addLoading('birthday-gift.create', '#loading-modal-create-birthday-gift');

    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalCreateBirthdayGift();
    });
    shortcut.add('ESC', function () {
        closeModalCreateBirthdayGift();
    });

    $('#modal-create-birthday-gift').modal('show');
    $('#item-create-birthday-gift').select2({
        dropdownParent: $('#modal-create-birthday-gift'),
    });

    $('#branch-create-birthday-gift').val(($('#change_branch').val() != '-1') ? $('#change_branch').val() : $('#branch-create-birthday-gift option:first').val()).trigger('change')

    // $('#branch-create-birthday-gift').on('change' , function (){
    //     dataCreateBirthdayGift();
    // })

    dataCreateBirthdayGift();
    $('#upload-create-birthday-logo').unbind('change').on('change', async function () {
        let img_file= await document.querySelector('#upload-create-birthday-logo').files[0];
        let url_img = URL.createObjectURL(img_file);
        $('#thumbnail-create-birthday-gift-logo').attr('src', url_img)

        let data = new FormData();
        data.append("file", img_file);

        let method = 'post',
            url = 'birthday-gift.post-img',
            params = null;
        let res = await axiosTemplate(method, url, params, data,[$("#thumbnail-create-birthday-gift-logo")]);

        if (res.status === 200){
            $('#thumbnail-create-birthday-gift-logo').attr('data-link', res.data.data[0].link_original)
        }else{
            $('#thumbnail-create-birthday-gift-logo').attr('data-link', '');
        }

        $('#upload-create-birthday-logo-img').val('').clone(true);
    })
}

async function dataCreateBirthdayGift() {
    let method = 'get',
        url = 'birthday-gift.data-gift-item',
        params = {
            branch : $('#branch-create-birthday-gift').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#loading-modal-create-birthday-gift")]);
    $('#icon-create-birthday-gift').html(res.data[0]);
    $('#item-create-birthday-gift').html(res.data[1]);
}

async function saveModalCreateBirthdayGift() {
    if(!checkValidateSave($('#loading-modal-create-birthday-gift'))) return false;
    let branch = $('#branch-create-birthday-gift').val(),
        title = $('#title-create-birthday-gift').val(),
        message = $('#message-create-birthday-gift').val(),
        content = $('#content-create-birthday-gift').val(),
        item = $('#item-create-birthday-gift').val(),
        icon = $('#icon-create-birthday-gift img.border-selected').attr('original-link'),
        img = $('#thumbnail-create-birthday-gift-logo').data('link');

    let method = 'post',
        url = 'birthday-gift.create',
        params = null,
        data = {
            img: img,
            branch: branch,
            title: title,
            message: message,
            content: content,
            item: item,
            icon: icon,
        };

    let res = await axiosTemplate(method, url, params, data,[$("#loading-modal-create-birthday-gift")]);

    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        closeModalCreateBirthdayGift();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalCreateBirthdayGift() {
    $('#modal-create-birthday-gift').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateBirthdayGift();
    });
    $('#modal-create-birthday-gift input').val('');
    $('#modal-create-birthday-gift textarea').val('');
    $('#modal-create-birthday-gift select').val('').trigger('change');
    $('#thumbnail-create-birthday-gift-logo').attr('src', '/images/cover.jpg');
    $('#thumbnail-create-birthday-gift-logo').attr('data-link', '');
    removeAllValidate()
}
