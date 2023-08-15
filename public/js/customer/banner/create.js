let checkSaveCreateSetBanner = 0, dataCreateImageUploadBanner, checkUploadImg = 0;
$(function () {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateBanner();
    });

    $('#upload-set-banner-advertisement').on('change', async function () {
        dataCreateImageUploadBanner = $(this).prop('files')[0];
        switch ((dataCreateImageUploadBanner.type).slice(6)) {
            case 'png':
                break;
            case 'jpeg':
                break;
            case 'jpg':
                break;
            default:
                WarningNotify('Bạn chỉ được chọn đuôi ảnh là JPEG, JPG, PNG!');
                $(this).val('');
                return false;
        }
        if ($(this).prop('files')[0].size > 10 * 1024 * 1024) {
            WarningNotify('Bạn chỉ được tải lên ảnh có dung lượng nhỏ hơn 10MB!');
            $(this).val('');
            return false;
        }
        if (quantityAllowed === 5) {
            WarningNotify('Số lượng banner chờ gửi tối đa là 5. Vui lòng duyệt banner để có thể upload thêm!');
            $(this).val('');
            return false;
        }
        let reader = new FileReader();
        reader.readAsDataURL(dataCreateImageUploadBanner);
        let image;
        reader.onload = function (e) {
            image = new Image();
            image.onload = function () {
                if (image.width != 940 || image.height != 350) {
                    checkUploadImg = 1;
                    WarningNotify('Kích thước của ảnh phải là 940x350px!');
                    $(this).val('');
                    return false;
                }
                checkUploadImg = 0;
            }
            image.src = e.target.result;
        };

        checkSaveCreateSetBanner = 1;
        $('#btn-create-card-value').addClass('disabled');
        $('#image-banner-set-banner-advertisement').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        checkSaveCreateSetBanner = 0;
        $('#btn-create-card-value').removeClass('disabled');
        $('#image-banner-set-banner-advertisement').attr('onclick', 'modalImageComponent(' + "'" + URL.createObjectURL($(this).prop('files')[0]) + "'" + ')');
        $('#image-banner-set-banner-advertisement').attr('data-src', data.data[0]);
        $(this).replaceWith($(this).val('').clone(true));
    })
})

function openModalCreateBanner() {
    $('#modal-create-set-banner-advertisement').modal('show');
    shortcut.add('ESC', function () {
        closeModalCreateBanner()
    })

    shortcut.add('F4', function () {
        saveModalCreateBanner()
    })

    shortcut.remove('F2');

    $('#modal-create-set-banner-advertisement .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-set-banner-advertisement'),
    });

    $('#type-create-banner-manage').select2({
        dropdownParent: $('#modal-create-set-banner-advertisement'),
        templateResult : function (data, container){
            let span = '';
            if(data.disabled){
                span = $(`<span class="d-flex justify-content-between w-100">
                            <span class="">${data.text}</span>
                            <span class="text-danger">Vui lòng bật chiến dịch Tặng Bia</span>
                        </span>`);
            }else {
                span = $(`<span class="text-left">${data.text}</span>`);
            }
            return span;
        }
    })

    $('#type-create-banner-manage').on('change', function () {
        switch (Number($(this).val())) {
            case 0:
                $('#box-url-banner-manage').addClass('d-none');
                $('#box-gift-banner-manage').addClass('d-none');
                break;
            case 1:
                $('#box-url-banner-manage').addClass('d-none');
                $('#box-gift-banner-manage').removeClass('d-none');
                gift();
                break;
            case 2:
                $('#box-gift-banner-manage').addClass('d-none');
                $('#box-url-banner-manage').removeClass('d-none');
                break;
        }
    })
}

async function saveModalCreateBanner() {
    if (checkUploadImg === 1) {
        WarningNotify('Vui lòng chọn ảnh có kích thước đúng')
        return false
    }
    if (checkSaveCreateSetBanner === 1) return false;
    if (!checkValidateSave($('#modal-create-set-banner-advertisement'))) return false;
    let method = 'post',
        url = 'banner-advertisement.create',
        params = null,
        data = {
            name: $('#name-create-set-banner-advertisement').val(),
            image_url: $('#image-banner-set-banner-advertisement').attr('data-src'),
            landing_page_url: $('#url-create-set-banner-advertisement').val(),
            restaurant_gift_id: $('#gift-create-banner-manage').val(),
            type: $('#type-create-banner-manage').val(),
        };
    checkSaveCreateSetBanner = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-set-banner-advertisement')]);
    checkSaveCreateSetBanner = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            addRowDatatableTemplate(tableDraftBanner, {
                'image_url': res.data.data.image_url,
                'name': res.data.data.name,
                'type': res.data.data.type,
                'action': res.data.data.action,
                'keysearch': res.data.data.keysearch,
            });
            $('#total-record-draft').text(parseInt($('#total-record-draft').text()) + 1)
            closeModalCreateBanner(res.data.data);
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function gift() {
    let method = 'get',
        url = 'banner-advertisement.gift',
        params = null,
        data = {
            brand: $('#name-create-set-banner-advertisement').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$('#gift-create-banner-manage')]);
    $('#gift-create-banner-manage').html(res.data[0]);
}

function closeModalCreateBanner() {
    $('#modal-create-set-banner-advertisement').modal('hide');
    // $('#image-banner-set-banner-advertisement').attr('src', 'images/banner_default.jpg')
    $('#name-create-set-banner-advertisement').val('')
    $('#url-create-set-banner-advertisement').val('')
    $('#image-banner-set-banner-advertisement').attr('data-src', '')
    $('#image-banner-set-banner-advertisement').attr('onclick', '');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateBanner();
    });
}
