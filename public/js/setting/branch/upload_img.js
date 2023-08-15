let listImagePreview = [];
$(function () {
    $("#image-viewer .close").click(function () {
        $('#image-viewer').hide();
    });
    shortcut.add('ESC', function () {
        $('#image-viewer').hide();
    });

    $(document).on('change', '.upload-image-branch', async function () {
        $('#select-upload-more').remove();
        await jQuery.each($(this).prop('files'), async function (i, v) {
            let data = await uploadMediaTemplate($(v)[0], 0);
            if (data.status === 200) {
                $('#list-image-branch-preview').append(`
                    <li>
                        <img class="img-responsive" src="${URL.createObjectURL($(v)[0])}" data-url="${data.data[0]}" data-type="1" alt="">
                        <i class="fa fa-check"></i>
                        <i class="fa fa-close" onclick="removeImageUpload($(this))"></i>
                    </li>
                    `);
            } else {
                $('#list-image-branch-preview').append(`
                    <li>
                        <img class="img-responsive" src="${URL.createObjectURL($(v)[0])}" data-url="${data.data[0]}" data-type="0" alt="">
                        <i class="fa fa-times"></i>
                        <i class="fa fa-close" onclick="removeImageUpload($(this))"></i>
                    </li>
                `);
            }
            listImagePreview.push(data.data[0]);
            $('#form-update-image-branch').addClass('d-none');
            $('.sugested-photos').removeClass('d-none');
        });
        drawGalleryUpload();

        $('#list-image-branch-preview').prepend(`<li id="select-upload-more" class="pointer">
                                                   <div class="smal-box" style="padding: 0; height: 120px">
                            <label class="fileContainer">
                                <i class="ti-layout-media-center-alt"></i>
                                <input type="file" multiple class="upload-image-branch" name="file[]" accept="image/*">
                                <em>Upload New</em>
                                <span>Choose form Computer</span>
                            </label>
                        </div>
             </li>`);
        $(this).replaceWith($(this).val('').clone(true));
    });
})

function openUploadImageBranch() {
    $('#modal-upload-image-branch').modal('show');
    shortcut.add('ESC', function () {
        $('#image-viewer').hide();
        closeModalUploadImageBranch();
    });
}

async function updateListImageBranchSetting() {
    let image_preview = [];
    $('#list-image-branch-preview li').each(function (i, v) {
        if ($(this).find('img').length > 0 && $(this).find('img').data('type')) {
            image_preview[i] = {
                'src': $(this).find('img').attr('src'), 'data-url': $(this).find('img').data('url')
            };
        }
    })
    let list_image_upload = listImage.concat(listImagePreview)
    let method = 'POST', url = 'branch-setting.update-list-image', params = '', data = {
        "branch_id": branchSettingId, "image_urls": list_image_upload,
    };
    let res = await axiosTemplate(method, url, params, data);
    if (res.data.status === 200) {
        let text = 'Cập nhật ảnh thành công';
        templateItemImage(image_preview);
        SuccessNotify(text);
        closeModalUploadImageBranch();
        drawGallery();
        $(".animated-thumbnails-gallery").data('lightGallery').destroy(true);
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}


function removeImageUpload(r) {
    r.parents('li').remove();
    let url = r.parents('li').find('img').data('url');
    listImagePreview = listImagePreview.filter(item => item !== url);
    if (listImagePreview.length === 0) {
        $('#form-update-image-branch').removeClass('d-none');
        $('.sugested-photos').addClass('d-none');
    }
}

function closeModalUploadImageBranch() {
    $('#modal-upload-image-branch').modal('hide');
    $('#list-image-branch-preview').html('');
    listImagePreview = [];
    $('.upload-image-branch').val('');
    $('#form-update-image-branch').removeClass('d-none');
    $('.sugested-photos').addClass('d-none');
}

function templateItemImage(data) {
    for (let index = 1; index < data.length; index++) {
        $('#animated-thumbnails-gallery').prepend(`<div class="group-image">
                                                    <div style="position: relative;" class="image-preview">
                                                        <div class="btn-move-image more" onclick="removeImage($(this))">
                                                            <div class="more-option-image">
                                                                <i class="fa fa-trash"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="position: relative;color: #fff !important;" class="is_check_all_image d-none">
                                                    <div class="checkbox-fade fade-in-info checkbox_image_all_branch">
                                                        <label>
                                                            <input type="checkbox" value="" name="check-all-image">
                                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-info"></i></span>
                                                        </label>
                                                    </div>
                                                    </div>
                                                        <a class="gallery-item" style="padding: 5px;" data-url="${data[index]['data-url']}" data-src="${data[index]['src']}" data-sub-html="">
                                                            <img alt="" class="img-responsive" src="${data[index]['src']}" />
                                                        </a>
                                                    </div>`);
    }
    drawGallery();
}

function showViewer(r) {
    $("#full-image").attr("src", r.attr("src"));
    $('#image-viewer').show();
}

function drawGalleryUpload() {
    $('#list-image-branch-preview').unbind();
    jQuery("#list-image-branch-preview")
        .justifiedGallery({
            captions: false, rowHeight: 100, maxRowsCount: 0, margins: 10
        });
}
