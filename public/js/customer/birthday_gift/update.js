let image_url_birthday_gift_update,
    icon_image_url_birthday_gift_update,
    branch_id_birthday_gift_update,
    title_birthday_gift_update,
    message_birthday_gift_update,
    content_birthday_gift_update,
    id_birthday_gift_update ,
    gift_birthday_gift_update = [];


async function openModalUpdateBirthdayGift(id) {
    id_birthday_gift_update = id;

    $('#modal-update-birthday-gift').modal('show');
    // addLoading('birthday-gift.data-gift-item', '#loading-modal-update-birthday-gift');
    // addLoading('birthday-gift.update', '#loading-modal-update-birthday-gift');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalUpdateBirthdayGift();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateBirthdayGift();
    });
    $('#item-update-birthday-gift, #branch-update-birthday-gift').select2({
        dropdownParent: $('#modal-update-birthday-gift'),
    });

    dataUpdateBirthdayGift();

    $('#upload-update-birthday-logo').unbind('change').on('change', async function () {
        let img_file= await document.querySelector('#upload-update-birthday-logo').files[0];
        let url_img = URL.createObjectURL(img_file);
        $('#thumbnail-update-birthday-gift-logo').attr('src', url_img)

        let data = new FormData();
        data.append("file", img_file);

        let method = 'post',
            url = 'birthday-gift.post-img',
            params = null;
        let res = await axiosTemplate(method, url, params, data,[$("#thumbnail-update-birthday-gift-logo")]);

        if (res.status === 200){
            $('#thumbnail-update-birthday-gift-logo').attr('data-link', res.data.data[0].link_original)
        }else{
            $('#thumbnail-update-birthday-gift-logo').attr('data-link', '');
        }

        $('#upload-update-birthday-logo-img').val('').clone(true);
    })

    let method = 'get',
        url = 'birthday-gift.data-gift-for-update',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    icon_image_url_birthday_gift_update = res.data.data.icon_image_url;
    title_birthday_gift_update = res.data.title;
    message_birthday_gift_update = res.data.message;
    content_birthday_gift_update = res.data.content;
    gift_birthday_gift_update = res.data.gift;
    image_url_birthday_gift_update = res.data.data.image_url;
    branch_id_birthday_gift_update = res.data.branch_id;

    $('#thumbnail-update-birthday-gift-logo').attr('src',res.data.data.image_url);
    $('#title-update-birthday-gift').val(res.data.data.title);
    $('#message-update-birthday-gift').val(res.data.data.message);
    $('#content-update-birthday-gift').val(res.data.data.content);
    $('#item-update-birthday-gift').val(res.data.data.gift).trigger('change.select2');
    $('#branch-update-birthday-gift').val(res.data.data.branch_id).trigger('change.select2');
    $('#icon-update-birthday-gift img').each(function () {
        let src = $(this).attr("src"),
            id = $(this).attr("id");
        if (icon_image_url_birthday_gift_update === src) {
            $('#icon-update-birthday-gift #' + id).addClass('border-selected card-shadow-custom');
        }
    });
   /* let imgname = image_url_birthday_gift_update;
    let name = imgname.substr(imgname.lastIndexOf('/') + 1);
    let mockFile = {name: name, size: 12345};
    let myDropzone = new Dropzone("#uploadBirthdayGiftImg");
    myDropzone.options.addedfile.call(myDropzone, mockFile);
    myDropzone.options.thumbnail.call(myDropzone, mockFile, image_url_birthday_gift_update);*/
}

async function dataUpdateBirthdayGift() {
    let method = 'get',
        url = 'birthday-gift.data-gift-item',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#loading-modal-update-birthday-gift")]);
    $('#icon-update-birthday-gift').html(res.data[0]);
    $('#item-update-birthday-gift').html(res.data[1]);
}

async function saveModalUpdateBirthdayGift() {
    if(!checkValidateSave($('#loading-modal-update-birthday-gift'))) return false
    let branch = branch_id_birthday_gift_update,
        title = $('#title-update-birthday-gift').val(),
        message = $('#message-update-birthday-gift').val(),
        content = $('#content-update-birthday-gift').val(),
        item = $('#item-update-birthday-gift').val(),
        icon = $('#icon-update-birthday-gift img.border-selected').attr('src');

    let method = 'post',
        url = 'birthday-gift.update',
        params = null,
        data = {
            id: id_birthday_gift_update,
            img: image_url_birthday_gift_update,
            branch: branch,
            title: title,
            message: message,
            content: content,
            item: item,
            icon: icon,
        };
    let res = await axiosTemplate(method, url, params, data,$("#loading-modal-update-birthday-gift"));

    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        closeModalUpdateBirthdayGift();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalUpdateBirthdayGift() {
    $('#modal-update-birthday-gift').modal('hide');
    $('#thumbnail-update-birthday-gift-logo').attr('src', '/images/cover.jpg');
    $('#title-update-birthday-gift').val('');
    $('#message-update-birthday-gift').val('');
    $('#content-update-birthday-gift').val('');
    $('.w-img-icon-group').removeClass('border-selected card-shadow-custom');
    $('#branch-update-birthday-gift, #item-update-birthday-gift').val('').select2({
        dropdownParent: $('#modal-update-birthday-gift'),
    });
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateBirthdayGift();
    });
}
