let checkSaveUploadCreateImgAdvMarketing = 0;

function openModalCreateImageMarketing() {
    $('#modal-create-image-adv-marketing').modal('show');
    shortcut.add('F4', function () {
        saveUploadCreateImageAdvMarketing();
    });
    shortcut.add('ESC', function () {
        closeModalCreateImageAdvMarketing();
    });
    $('#div-upload-banner-adv-marketing').unbind('click').on('click', function () {
        $('#upload-banner-adv-marketing').click();
    });

    $(document).on('change', '#upload-banner-adv-marketing', async function () {
        jQuery.each($(this).prop('files'), async function (i, v) {
            switch((v.type).slice(6)) {
                case 'png':
                    break;
                case 'jpeg':
                    break;
                case 'jpg':
                    break;
                case 'webp':
                    break;
                default:
                    WarningNotify('Bạn chỉ được chọn đuôi ảnh là JPEG, JPG, PNG, WEBP!');
                    return false;
            }
            if ($(v)[0].size > (10 * 1024 * 1024)) {
                WarningNotify('Bạn chỉ được tải lên ảnh có dung lượng nhỏ hơn 10MB!');
            } else {
                let data = await uploadMediaTemplate($(v)[0], 0);
                $('#data-upload-banner-adv-marketing').append(`<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 item-upload-banner-adv-marketing">
                                                                   <div class="item-box">
                                                                       <div class="over-photo">
                                                                            <a href="javascript:void(0)" class="float-right"><i class="fa fa-times remove-item-upload-banner-adv-marketing" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"></i></a>
                                                                        </div>
                                                                        <input value="${$(v)[0].name}" class="input-name-media">
                                                                        <a class="strip" href="javascript:void(0)" data-strip-group="mygroup"
                                                                           data-strip-group-options="loop: false">
                                                                            <img src="${URL.createObjectURL($(v)[0])}" alt="" data-src="${data.data[0]}">
                                                                        </a>
                                                                        <span class="text-warning"></span>
                                                                    </div>
                                                                </div>`);
            }
        });
        $(this).replaceWith($(this).val('').clone(true));
    })
    $(document).on('click', '.remove-item-upload-banner-adv-marketing', function () {
        $(this).parents('.item-upload-banner-adv-marketing').remove();
    });
}

async function saveUploadCreateImageAdvMarketing() {
    if (checkSaveUploadCreateImgAdvMarketing === 1) return false;
    if($('.item-box').length === 1){
        WarningNotify("Vui lòng chọn hình ảnh");
        return false;
    }
    let media = [],
        brand = $('.select-brand').val();
    $('#data-upload-banner-adv-marketing .item-upload-banner-adv-marketing').each(function () {
        media.push({
            name: $(this).find('input').val(),
            media_url: $(this).find('img').data('src'),
            media_length_by_second: 0,
        })
    });
    checkSaveUploadCreateImgAdvMarketing = 1;
    let method = 'post',
        url = 'media-restaurant-marketing.create',
        params = null,
        data = {media: media, brand: brand, type: 1};
    let res = await axiosTemplate(method, url, params, data);
    checkSaveUploadCreateImgAdvMarketing = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreateImageAdvMarketing();
            loadData();
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

function closeModalCreateImageAdvMarketing() {
    $('#modal-create-image-adv-marketing').modal('hide');
    $('#data-upload-banner-adv-marketing').find('.item-upload-banner-adv-marketing').remove();
    $('#upload-banner-adv-marketing').replaceWith($('#upload-banner-adv-marketing').val('').clone(true));
}


