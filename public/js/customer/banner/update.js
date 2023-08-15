let idBanner, dataUpdateImageUploadBanner, checkImageUpdate = 0, type_id, result, checkSaveUpdateSetBanner = 0,
    thisBannerUpdate;
$(function () {
    $('#upload-update-set-banner-advertisement').on('change', async function () {
        dataUpdateImageUploadBanner = $(this).prop('files')[0];
        switch ((dataUpdateImageUploadBanner.type).slice(6)) {
            case 'png':
                break;
            case 'jpeg':
                break;
            case 'jpg':
                break;
            default:
                WarningNotify('Bạn chỉ được chọn đuôi ảnh là JPEG, JPG, PNG!');
                return false;
        }
        if ($(this).prop('files')[0].size > 10 * 1024 * 1024) {
            WarningNotify('Bạn chỉ được tải lên ảnh có dung lượng nhỏ hơn 10MB!');
            return false;
        }
        let reader = new FileReader();
        reader.readAsDataURL(dataUpdateImageUploadBanner);
        let image;
        reader.onload = function (e) {
            image = new Image();
            image.onload = function () {
                if (image.width != 940 || image.height != 350) {
                    checkImageUpdate = 1
                    WarningNotify('Kích thước của ảnh phải là 940x350px!');
                    $(this).val('');
                    return false;
                }
                checkImageUpdate = 0
            }
            image.src = e.target.result;
        };
        checkSaveUpdateSetBanner = 1;
        $('#btn-update-card-value').addClass('disabled');
        $('#image-update-banner-set-banner-advertisement').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        checkSaveUpdateSetBanner = 0;
        $('#btn-update-card-value').removeClass('disabled');
        $('#image-update-banner-set-banner-advertisement').attr('onclick', 'modalImageComponent(' + "'" + URL.createObjectURL($(this).prop('files')[0]) + "'" + ')');
        $('#image-update-banner-set-banner-advertisement').attr('data-src', data.data[0]);
        $('#image-update-banner-set-banner-advertisement').attr('data-thumb', data.data[1]);
        $('#image-update-banner-set-banner-advertisement').attr('data-id-img', data.data[4].data[0].media_id);
        $(this).replaceWith($(this).val('').clone(true));
    })
})

function openModalUpdateBanner(r) {
    thisBannerUpdate = r;
    $('#modal-update-set-banner-advertisement').modal('show');
    idBanner = r.data('id')
    shortcut.add('ESC', function () {
        closeModalUpdateBanner()
    })
    shortcut.add('F4', function () {
        saveModalUpdateBanner()
    })
    dataBanner()
    $('#modal-update-set-banner-advertisement .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-set-banner-advertisement'),
    });

    $('#type-update-banner-manage').on('change', function () {
        switch (Number($(this).val())) {
            case 0:
                $('#update-box-url-banner-manage').addClass('d-none');
                $('#update-box-gift-banner-manage').addClass('d-none');
                $('#update-box-url-banner-manage').val('');
                break;
            case 1:
                $('#update-box-url-banner-manage').addClass('d-none');
                $('#update-box-gift-banner-manage').removeClass('d-none');
                $('#update-box-url-banner-manage').val('');
                updateGift();
                break;
            case 2:
                $('#update-box-gift-banner-manage').addClass('d-none');
                $('#update-box-url-banner-manage').removeClass('d-none');
                break;
        }
    })
}

async function dataBanner() {
    let method = 'get',
        url = 'banner-advertisement.data-update',
        params = {
            id: idBanner,
        },
        data = null
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-set-banner-advertisement')]);
    $('#image-update-banner-set-banner-advertisement').attr('src', res.data[1].domain + res.data[1].image_url)
    $('#image-update-banner-set-banner-advertisement').attr('data-src', res.data[1].image_url)
    $('#name-update-set-banner-advertisement').val(res.data[1].name)
    $('#url-update-set-banner-advertisement').val(res.data[1].landing_page_url)
    switch (res.data[1].type) {
        case 0:
            $('#type-update-banner-manage').val(res.data[1].type).trigger('change.select2')
            $('#update-box-url-banner-manage').addClass('d-none');
            $('#update-box-gift-banner-manage').addClass('d-none');
            $('#gift-update-banner-manage').html(res.data[2]);
            $('#update-box-url-banner-manage').val('');
            break;
        case 1:
            $('#update-box-url-banner-manage').addClass('d-none');
            $('#update-box-gift-banner-manage').removeClass('d-none');
            $('#type-update-banner-manage').val(res.data[1].type).trigger('change.select2')
            $('#gift-update-banner-manage').html(res.data[2]);
            $('#gift-update-banner-manage').val(res.data[1].restaurant_gift_id).trigger('change.select2');
            $('#update-box-url-banner-manage').val('');
            break;
        case 2:
            $('#type-update-banner-manage').val(res.data[1].type).trigger('change.select2')
            $('#update-box-gift-banner-manage').addClass('d-none');
            $('#update-box-url-banner-manage').removeClass('d-none');
            $('#gift-update-banner-manage').html(res.data[2]);
            $('#update-box-url-banner-manage').val('');


    }
}

async function updateGift() {
    let method = 'get',
        url = 'banner-advertisement.gift',
        params = null,
        data = {
            brand: $('#name-update-set-banner-advertisement').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$('#gift-update-banner-manage')]);
    $('#gift-update-banner-manage').html(res.data[0]);
}

async function saveModalUpdateBanner() {
    if (checkSaveUpdateSetBanner === 1) return false;
    if (checkImageUpdate === 1) {
        WarningNotify('Vui lòng chọn ảnh có kích thước đúng')
        return false
    }
    if (!checkValidateSave($('#modal-update-set-banner-advertisement'))) return false;
    result = Number($('#type-update-banner-manage').val());
    type_id = result !== 1 ? 0 : $('#gift-update-banner-manage').val();
    let method = 'post',
        url = 'banner-advertisement.update',
        params = null,
        data = {
            id: idBanner,
            name: $('#name-update-set-banner-advertisement').val(),
            image_url: $('#image-update-banner-set-banner-advertisement').attr('data-src'),
            landing_page_url: $('#url-update-set-banner-advertisement').val(),
            restaurant_gift_id: type_id,
            type: $('#type-update-banner-manage').val(),
        };
    checkSaveUpdateSetBanner = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-set-banner-advertisement')]);
    checkSaveUpdateSetBanner = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalUpdateBanner();
            drawDatatableUpdateBanner(res.data.data);
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function drawDatatableUpdateBanner(data) {
    switch (thisBannerUpdate.parents('table').attr('id')) {
        case 'table-draft-banner-advertisement':
            thisBannerUpdate.parents('tr').find('td:eq(1)').html(data.image_url)
            thisBannerUpdate.parents('tr').find('td:eq(2)').html(data.name)
            thisBannerUpdate.parents('tr').find('td:eq(3)').html(data.type)
            thisBannerUpdate.parents('tr').find('td:eq(4)').html(data.action)
            thisBannerUpdate.parents('tr').find('td:eq(5)').html(data.keysearch)
            break;
        case 'table-pendding-banner-advertisement':
            removeRowDatatableTemplate(tablePendingBanner, thisBannerUpdate, true)
            addRowDatatableTemplate(tableDraftBanner, {
                'image_url': data.image_url,
                'name': data.name,
                'type': data.type,
                'action': data.action,
                'keysearch': data.keysearch,
            })
            $('#total-record-draft').text(parseInt($('#total-record-draft').text()) + 1)
            $('#total-record-pending').text(parseInt($('#total-record-pending').text()) - 1)
            break;
        case 'table-approved-banner-advertisement':
            removeRowDatatableTemplate(tableApprovedBanner, thisBannerUpdate, true)
            addRowDatatableTemplate(tableDraftBanner, {
                'image_url': data.image_url,
                'name': data.name,
                'type': data.type,
                'action': data.action,
                'keysearch': data.keysearch,
            })
            $('#total-record-draft').text(parseInt($('#total-record-draft').text()) + 1)
            $('#total-record-approved').text(parseInt($('#total-record-approved').text()) - 1)
            break;
    }
}

function closeModalUpdateBanner() {
    $('#modal-update-set-banner-advertisement').modal('hide');
    shortcut.remove('ESC')
    $('#image-update-banner-set-banner-advertisement').attr('data-src', '')
    $('#name-update-set-banner-advertisement').val('')
}
