let checkSaveUploadVideoAdvMarketing = 0;

function openModalCreateVideoMarketing() {
    $('#modal-create-video-adv-marketing').modal('show');
    shortcut.add('F4', saveUploadVideoAdvMarketing);
    shortcut.add('ESC', closeModalCreateVideoAdvMarketing);
    $("#name-video-adv-marketing").focusin(function () {
        let that = $(this)
        if (that.val() == '' || that.val() == null){
            that.blur();
            $('#div-upload-video-adv-marketing, #name-video-adv-marketing').unbind('click').on('click', function () {
                $('#upload-video-adv-marketing').click();
            })
        } else {
            $('#div-upload-video-adv-marketing').unbind('click').on('click', function () {
                $('#upload-video-adv-marketing').click();
            })
            $('#name-video-adv-marketing').off('click')
        }
    })
    $('#upload-video-adv-marketing').on('change', async function () {
        checkSaveUploadVideoAdvMarketing = 1;
        if($(this).prop('files')[0].type !== 'video/mp4'){
            WarningNotify('Bạn chỉ được chọn Video có định dạng là MP4 !');
            $(this).val('');
            return false;
        }
        if($(this).prop('files')[0].size > 200 * 1024 * 1024) {
            WarningNotify('Video có dung lương lớn hơn 200MB, vui lòng kiểm tra lại !');
            $(this).val('');
            return false;
        }
        $('#modal-create-video-adv-marketing .modal-content').prepend(themeLoading($('#data-upload-video-adv-marketing').height(), 'upload-video-media-restaurant-loading'));
        $('#data-upload-video-adv-marketing').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        $('#name-video-adv-marketing').val($(this).prop('files')[0].name);
        $('#btn-save-upload-video-adv-marketing').prop('disabled', true);
        $('#btn-save-upload-video-adv-marketing').addClass('disabled');
        let data = await uploadMediaTemplate($(this).prop('files')[0], 1);
        $('.upload-video-media-restaurant-loading').remove();
        checkSaveUploadVideoAdvMarketing = 0;
        if(!data?.data?.[0]) {
            WarningNotify('Upload video không thành công. Vui lòng thử lại !');
            $(this).val('');
            $("#name-video-adv-marketing").val('');
            return false;
        }
        $('#data-upload-video-adv-marketing').attr('data-src', data.data[0]);
        $('#btn-save-upload-video-adv-marketing').prop('disabled', false);
        $('#btn-save-upload-video-adv-marketing').removeClass('disabled');
        $(this).replaceWith($(this).val('').clone(true));
    });
}

async function saveUploadVideoAdvMarketing() {
    if (checkSaveUploadVideoAdvMarketing === 1) return false;
    if (!checkValidateSave($('#modal-create-video-adv-marketing'))) return false;
    let media = [];
    media.push({
        name: $('#name-video-adv-marketing').val(),
        media_url: $('#data-upload-video-adv-marketing').attr('data-src'),
        media_length_by_second: Math.ceil(document.getElementById("data-upload-video-adv-marketing").duration),
    })
    let method = 'post',
        url = 'media-restaurant-marketing.create',
        params = null,
        data = {media: media, brand: $('.select-brand').val(), type: 0};
    checkSaveUploadVideoAdvMarketing = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkSaveUploadVideoAdvMarketing = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreateVideoAdvMarketing();
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

function closeModalCreateVideoAdvMarketing() {
    checkSaveUploadVideoAdvMarketing = 0;
    $('#name-video-adv-marketing').val('');
    $('#data-upload-video-adv-marketing').attr('src', '');
    $('#data-upload-video-adv-marketing').attr('data-src', '');
    $('#modal-create-video-adv-marketing').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
}


