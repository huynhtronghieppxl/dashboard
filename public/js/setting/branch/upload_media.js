let listMediaUploadBranch = [], checkUploadMediaBranch = 0, checkUpdateNameMediaBranch = 0;

$(function () {
    $('#div-upload-media-setting-branch').on('click', function () {
        $('#upload-media-setting-branch').click();
    });
    $(document).on('change', '#upload-media-setting-branch', function () {
        jQuery.each($(this).prop('files'), function (i, v) {
            let text = '';
            if ($(v)[0].size > (5 * 1024 * 1024)) {
                text = '* Ảnh lớn hơn 5MB ';
                $(v)[0].upload = 0;
            } else {
                text = '';
                $(v)[0].upload = 1;
            }
            $('#data-upload-media-setting-branch').append(`<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 item-upload-media-setting-branch" data-id="${$(v)[0].lastModified}">
                                               <div class="item-box">
                                                   <div class="over-photo" style="width: fit-content;top: 8px;right: 0;left: unset;bottom: unset;padding-right: 6px">
                                                        <a href="javascript:void(0)" class="float-right d-none save-name-media" style="margin-right: 3px"><i class="fa fa-pencil-square-o save-item-upload-media-setting-branch" data-toggle="tooltip" data-placement="top" data-original-title="Cập nhật"></i></a>
                                                        <a href="javascript:void(0)" class="float-right update-name-media" style="margin-right: 3px" data-id="' . $db['_id'] . '"><i class="fa fa-pencil-square-o  update-item-upload-media-setting-branch" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"></i></a>
                                                        <a href="javascript:void(0)" class="float-right"><i class="fa fa-times remove-item-upload-media-setting-branch" data-toggle="tooltip" data-placement="top" data-original-title="Xóa"></i></a>
                                                    </div>
                                                    <input readonly value="${$(v)[0].name}" class="input-name-media">
                                                    <a class="strip" href="javascript:void(0)" data-strip-group="mygroup"
                                                       data-strip-group-options="loop: false">
                                                        <img src="${URL.createObjectURL($(v)[0])}" alt="" onclick="modalImageComponent('${URL.createObjectURL($(v)[0])}')">
                                                    </a>
                                                    <span class="text-warning">${text}</span>
                                                </div>
                                            </div>`);
            listMediaUploadBranch.push($(v)[0]);
        });
    })
    $(document).on('click', '.remove-item-upload-media-setting-branch', function () {
        let index = $(this).parents('.item-upload-media-setting-branch').data('id');
        jQuery.each(listMediaUploadBranch, function (i, v) {
            if (v.lastModified === index) {
                listMediaUploadBranch.splice(i, 1);
            }
        });
        $(this).parents('.item-upload-media-setting-branch').remove();
    });
    $(document).mouseup(function (e){
        if(e.target.className == 'float-right save-name-media d-none' || e.target.className == 'icofont icofont-check save-item-upload-media-setting-branch' || e.target.className == "input-name-media"){
            return false
        }
        else{
            $('.input-name-media').each(function (){
                $(this).val($(this).attr('data-name'))
                $(this).attr('readonly', '')
                $(this).parent().find('.save-name-media').addClass('d-none')
                $(this).parent().find('.update-name-media').removeClass('d-none')
            })
        }
    })

    $(document).on('click', '.update-name-media', function (){
        $(this).addClass('d-none')
        $(this).parent().find('.save-name-media').removeClass('d-none')
        $(this).parents('.item-box').find('.input-name-media').removeAttr('readonly')
    })
    $(document).on('click', '.save-name-media', function (){
        $(this).addClass('d-none')
        $(this).parent().find('.update-name-media').removeClass('d-none')
        $(this).parents('.item-box').find('.input-name-media').attr('readonly','')
    })
});

async function saveModalUploadMediaBranch() {
    await jQuery.each(listMediaUploadBranch, function (i, v) {
        uploadMediaBranch(v);
    });
}

async function removeMediaBranch(r) {
    let method = 'post',
        url = 'branch-setting.remove-media',
        params = null,
        data = {media_id: r.data('id')};
    let res = await axiosTemplate(method, url, params, data);
    let text = '';
    switch(res.data.status) {
        case 200:
            text = 'Xóa thành công';
            SuccessNotify(text);
            dataMediaBranch();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            return false;
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
            return false;
    }
}

async function updateNameMediaBranch(r) {
    if(checkUpdateNameMediaBranch === 1) return false;
    if(r.parents('.item-box').find('.input-name-media').val() === ''){
        ErrorNotify('Không được để trống');
        r.parents('.item-box').find('.input-name-media').val(r.parents('.item-box').find('.input-name-media').attr('data-name'))
        return false
    }
    else if(r.parents('.item-box').find('.input-name-media').val() === r.parents('.item-box').find('.input-name-media').attr('data-name')){
        return false
    }
    else{
        checkUpdateNameMediaBranch = 1;
        let method = 'post',
            url = 'branch-setting.update-name-media',
            params = null,
            data = {
                category_id: r.parents('.item-folder-setting-branch').data('id'),
                media_id: r.data('id'),
                media_name: r.parents('.item-box').find('.input-name-media').val()
            };
        let res = await axiosFileTemplate(method, url, params, data);
        checkUpdateNameMediaBranch = 0;
        let text = '';
        switch(res.data.status) {
            case 200:
                text = 'Cập nhật thành công';
                r.parents('.item-box').find('.input-name-media').attr('data-name', res.data.data.file_name);
                SuccessNotify(text);
                break;
            case 500:
                text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                ErrorNotify(text);
                return false;
                break;
            default:
                text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                WarningNotify(text);
                return false;
        }
    }
}

async function uploadMediaBranch(file) {
    let data = new FormData(), folder = $('#name-folder-media-setting-branch').data('id');
    data.append("file", file);
    data.append("name", file.name);
    data.append("folder", folder);
    let method = 'post', url = 'branch-setting.upload-media', params = null;
    let res = await axiosFileTemplate(method, url, params, data);
    if (res.data.status !== 200) {
        $('#data-upload-media-setting-branch').find('.item-upload-media-setting-branch[data-id="' + file.lastModified + '"]').find('.text-warning').text(res.data.message);
    } else {
        checkUploadMediaBranch = 1;
        $('#data-upload-media-setting-branch').find('.item-upload-media-setting-branch[data-id="' + file.lastModified + '"]').remove();
        jQuery.each(listMediaUploadBranch, function (i, v) {
            if (v.lastModified === file.lastModified) {
                listMediaUploadBranch[i].upload = 0;
            }
        });
        if ($('#data-upload-media-setting-branch .item-box').length === 1) {
            let text = 'Cập nhật thành công';
            SuccessNotify(text);
            closeModalUploadMediaBranch();
            currentPageMedia = 1;
            dataMediaBranch();
        }
    }
}

function closeModalUploadMediaBranch() {
    listMediaUploadBranch = [];
    $('#modal-create-media-setting-branch').modal('hide');
    $('#data-upload-media-setting-branch .item-upload-media-setting-branch').remove();
    if (checkUploadMediaBranch === 1) {
        currentPageMedia = 1;
        dataMediaBranch();
    }
}
