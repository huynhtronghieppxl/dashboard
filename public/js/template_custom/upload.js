/**
 * @param element $('#id')
 * @param view id view image when upload $('#id')
 * @param type
 * @param functionJava call when upload
 * @returns {Promise<void>}
 */
async function uploadMediaCropTemplate(element, view, type, functionJava) {
    try {
        let uploadCropAvatar, tempFilename, rawImg;
        $('#modal-upload-avatar-croppie').remove();
        $('body').append('<div id="modal-upload-avatar-croppie" class="modal fade upload-crop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
            '<div class="modal-dialog" style="top:20vh">' +
            '<div class="modal-content">' +
            '<div class="modal-body">' +
            '<div class="upload-view-croppie center-block"></div>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-grd-disabled" data-dismiss="modal">Hủy</button>' +
            '<button type="button" class="btn btn-grd-primary">Cập nhật</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>')
        // $('#modal-upload-avatar-croppie').modal('show');
        uploadCropAvatar = $('#modal-upload-avatar-croppie').find('.upload-view-croppie').croppie({
            viewport: {width: 200, height: 200, type: "square"},
            showZoomer: true,
            enableOrientation: true,
        });

        element.on('change', function () {
            console.log(element.val());
            tempFilename = $(this).val();
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#modal-upload-avatar-croppie').modal('show');
                rawImg = e.target.result;
                console.log(rawImg)
            };
            reader.readAsDataURL(this.files[0]);
        });

        $('#modal-upload-avatar-croppie').on('shown.bs.modal', function () {
            uploadCropAvatar.croppie('bind', {url: rawImg})
        });

        $('#modal-upload-avatar-croppie').find('.btn-grd-primary').on('click', function (ev) {
            uploadCropAvatar.croppie('result', {
                type: 'base64', format: 'jpeg', size: {width: 500, height: 500}
            }).then(async function (resp) {
                let file = await base64ImageToFile(resp, element);
                view.attr('src', URL.createObjectURL(file));
                $('#modal-upload-avatar-croppie').modal('hide');
                return uploadMediaTemplate(file, type);
            }).then(function (res) {
                if (res.status === 200) {
                    view.attr('data-src', res.data[0]);
                    view.attr('data-media-id', res.data[4].data[0].media_id);
                    if (functionJava && functionJava !== "") {
                        functionJava(res.data[0]);
                    }
                } else {
                    console.log('Upload error');
                }
            })
        });
    } catch (e) {
        // console.log(element, view, type, functionJava, e);
    }
}

/**
 * @param element $('#id')
 * @param view id view image when upload $('#id')
 * @param type
 * @param functionJava call when upload
 * @returns {Promise<void>}
 */
async function uploadBannerCropTemplate(element, view, type, functionJava) {
    let uploadCropBanner, tempFilenameBanner, rawImgBanner;
    $('#modal-upload-banner-croppie').remove();
    $('body').append('<div id="modal-upload-banner-croppie" class="modal fade upload-crop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
        '<div class="modal-dialog" style="top:20vh; max-width: 50vw">' +
        '<div class="modal-content">' +
        '<div class="modal-body">' +
        '<div class="upload-view-croppie center-block"></div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-grd-disabled" data-dismiss="modal">Hủy</button>' +
        '<button type="button" class="btn btn-grd-primary">Cập nhật</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>');
    uploadCropBanner = $('#modal-upload-banner-croppie .upload-view-croppie').croppie({
        viewport: {width: 520, height: 200, type: "square"},
        showZoomer: true,
        enableOrientation: true,
    });

    $('#modal-upload-banner-croppie').on('shown.bs.modal', function () {
        uploadCropBanner.croppie('bind', {url: rawImgBanner})
    });
    element.on('change', function () {
        tempFilenameBanner = $(this).val();
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#modal-upload-banner-croppie').modal('show');
            rawImgBanner = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });

    $('#modal-upload-banner-croppie .btn-grd-primary').on('click', function (ev) {
        uploadCropBanner.croppie('result', {
            type: 'base64', format: 'jpeg', size: {width: 1300, height: 500}
        }).then(async function (resp) {
            let file = await base64ImageToFile(resp, element);
            view.attr('src', URL.createObjectURL(file));
            $('#modal-upload-banner-croppie').modal('hide');
            return uploadMediaTemplate(file, type);
        }).then(function (res) {
            if (res.status === 200) {
                view.attr('data-src', res.data[0]);
                if (functionJava && functionJava !== "") {
                    functionJava(res.data[0]);
                }
            } else {
                console.log('Upload error');
            }
        })
    });
}


function base64ImageToFile(str, element) {
    let pos = str.indexOf(';base64,');
    let type = str.substring(5, pos);
    let b64 = str.substr(pos + 8);
    let name_file = 'croppie-img-' + element.prop('files')[0].name.split('.')[0] + '.' + type.split('/')[1];
    let imageContent = atob(b64);
    let buffer = new ArrayBuffer(imageContent.length);
    let view = new Uint8Array(buffer);
    for (let n = 0; n < imageContent.length; n++) {
        view[n] = imageContent.charCodeAt(n);
    }
    let blob = new Blob([buffer], {type: type});
    return new File([blob], name_file, {type: type, lastModified: new Date().getTime()});
}

/**
 * @param file - file media input
 * @param type
 //'USER_AVATAR' => '1',
 //'BRANCH' => '2',
 //'KAIZEN' => '3',
 //'FOOD' => '4',
 //'NEW_FEED' => '5',
 //'REWARD' => '6',
 //'PUNISH' => '7',
 //'BIRTHDAY' => '8',
 * @returns {Promise<*>}
 */
function uploadMediaTemplate(file, type) {
    /**
     * Type
     * 0-ảnh
     * 1-video
     * 2-audio
     * 3-file
     */
    if (![0, 1, 2, 3].includes(type)) {
        console.log('Media type không hợp lệ !')
        return false;
    }
    let data = new FormData();
    data.append("file", file);
    data.append("type", type);
    let method = 'post',
        url = 'upload-media-template',
        params = null;
    return axiosFileTemplate(method, url, params, data);
}

/**
 *  @param element - id modal
 *  @param id - id button
 *
 *
 * */

async function uploadLayoutTemplate(element, id) {
    $(element).html('');
    $(element).append('<div class="form-upload-template"> ' +
        '                       <div class="popup-wraper5">' +
        '                           <div class="popup">' +
        '                               <div class="popup-meta">' +
        '                                   <div class="upload-boxes">' +
        '                                       <div class="row d-flex">' +
        '                                           <div class="col-lg-6 col-md-6 col-sm-6 edit-flex-auto-fill">' +
        '                                               <div class="smal-box flex-sub">' +
        '                                                   <label class="fileContainer pointer">' +
        '                                                       <i class=" ti-layout-media-center-alt"></i>' +
        '                                                       <input type="file" class="upload-file" multiple>' +
        '                                                       <em>Chọn hình</em>' +
        '                                                       <span>Ảnh từ máy tính</span>' +
        '                                                   </label>' +
        '                                               </div>' +
        '                                           </div>' +
        '                                           <div class="col-lg-6 col-md-6 col-sm-6 edit-flex-auto-fill">' +
        '                                                <div class="smal-box flex-sub">' +
        '                                                   <div class="from-gallery">' +
        '                                                       <i class="ti-layout-grid2"></i>' +
        '                                                       <em>Kho hình ảnh</em>' +
        '                                                       <span>Hình ảnh được tải lên</span>' +
        '                                                   </div>' +
        '                                               </div>' +
        '                                           </div>' +
        '                                   </div>' +
        '                                   <div class="sugested-photos">' +
        '                                       <div class="title-upload">' +
        '                                           <h5>Danh sách hình ảnh</h5>' +
        '                                       </div>' +
        '                                       <ul class="sugestd-photo-caro list-image">' +
        '                                       </ul>' +
        '                                   </div>' +
        '                           </div>' +
        '                       </div>' +
        '               </div>');

    // Sự kiên upload hình ảnh
    let listImage = [];
    $('.upload-file').on('change', async function () {
        if ($(this).prop('files')[0].size > 5 * 1024 * 1024) {
            return false;
        }

        for (let i = 0; i < $(this).prop('files').length; i++) {
            let data = await uploadMediaTemplate($(this).prop('files')[i], 4);
            $('.form-upload-template .list-image').append('<li class="item "><img src="' + URL.createObjectURL($(this).prop('files')[i]) + '" data-src-image="' + data.data[0] + '" data-src-thumb="' + data.data[1] + '" alt=""></li>');
            // listImage[$(this).prop('files').length] = data.data[2];
            // listImage[i] = data.data[0];
        }
        $(this).replaceWith($(this).val('').clone(true));
    })
}
