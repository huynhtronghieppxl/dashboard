let checkSaveUploadCreateImgAdvMarketing = 0;
$(function (){
    $('#div-upload-image-create-display').on('click', function () {
        $('#upload-image-display').click();
    });
    $('#upload-image-display').unbind('change').on('change', function () {
        console.log($('#data-upload-image-create-display').length)
        // if($(this).prop('files').length < 6){
            jQuery.each($(this).prop('files'), async function (i, v) {
                // if($('#data-upload-image-create-display').length <= 5) {
                    if ($(v)[0].size <= (5 * 1024 * 1024)) {
                        let data = await uploadMediaTemplate($(v)[0], 0);
                        $('#data-upload-image-create-display').append(`<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 item-upload-banner-adv-marketing">
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
                    } else {
                        WarningNotify('Ảnh ' + $(v)[0].name + ' vượt quá kích thước 5MB !');
                    }
                // }else {
                //     WarningNotify('Chỉ tối đa 5 ảnh');
                // }
            });
        // }else {
        //     WarningNotify('Chỉ tối đa 5 ảnh');
        // }
    });
    $(document).on('click', '.remove-item-upload-banner-adv-marketing', function () {
        $(this).parents('.item-upload-banner-adv-marketing').remove();
    });
})

function openModalUploadImageDisplay() {
    $('#modal-upload-image-display').modal('show');

    shortcut.add("F4", function () {
        saveUploadCreateImageDisplay();
    });
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalUploadImageDisplay();
    });
}

async function saveUploadCreateImageDisplay() {
    if (checkSaveUploadCreateImgAdvMarketing === 1) return false;
    if($('.item-box').length === 1){
        WarningNotify("Vui lòng chọn hình ảnh");
        return false;
    }
    let media = [],
        brand = idBrandaddClass;
    $('#data-upload-image-create-display .item-upload-banner-adv-marketing').each(function () {
        media.push({
            name: $(this).find('input').val(),
            media_url: $(this).find('img').data('src'),
            media_length_by_second: 0,
            is_running : 1
        })
    });
    checkSaveUploadCreateImgAdvMarketing = 1;
    let method = 'post',
        url = 'display-secondary-pos.create',
        params = null,
        data = {media: media, brand: brand, type: 1};
    let res = await axiosTemplate(method, url, params, data, [$('#modal-upload-image-display')]);
    checkSaveUploadCreateImgAdvMarketing = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalUploadImageDisplay();
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


function closeModalUploadImageDisplay() {
    $('#modal-upload-image-display').modal('hide');
    $('#data-upload-image-create-display .item-upload-banner-adv-marketing').remove();
}
