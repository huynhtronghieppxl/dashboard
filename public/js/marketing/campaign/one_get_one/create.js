let checkSaveCreateOneGetOne = 0, dataCreateImageUploadOneToOne, urlBannerCreate = null;

$(function () {
    ckEditorTemplate(['detail-create-one-get-one-campaign']);

    $('#upload-banner-one-get-one-campaign').on('change', async function () {
        dataCreateImageUploadOneToOne = $(this).prop('files')[0];
        switch((dataCreateImageUploadOneToOne.type).slice(6)) {
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
                $(this).val('');
                return false;
        }
        if ($(this).prop('files')[0].size > 10 * 1024 * 1024) {
            WarningNotify('Bạn chỉ được tải lên ảnh có dung lượng nhỏ hơn 10MB!');
            $(this).val('');
            return false;
        }
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        $('#thumbnail-one-get-one-campaign').attr('src', url_image);
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        urlBannerCreate = data.data[0];
        $(this).replaceWith($(this).val('').clone(true));
    });
})

function openCreateOneGetOneMarketing() {
    typeTabIndexCampaign = 7;
    updateCookie();
    $('#modal-create-one-get-one-campaign').modal('show');
    $('#modal-update-one-get-one-campaign .btn-renew').addClass('d-none');
    shortcut.add('F4', function () {
        saveCreateOneGetOneMarketing();
    });
    shortcut.add('ESC', function () {
        closeCreateOneGetOneMarketing();
    });
    $('#branches-create-one-get-one-campaign').select2({
        dropdownParent: $('#modal-create-one-get-one-campaign'),
    });
    let branchOption = $.trim($('#div-layout-one-get-one-campaign .tab-pane.active .select-branch').html());
    $('#branches-create-one-get-one-campaign').html(branchOption);
    $('#branches-create-one-get-one-campaign').val('').trigger('select2.select');
    $('#modal-create-one-get-one-campaign input[name="all-day"]').on('click', function () {
        if ($(this).prop('checked') === true) {
            $('#modal-create-one-get-one-campaign input[name="day-of-week"]').prop('checked', true);
        } else {
            $('#modal-create-one-get-one-campaign input[name="day-of-week"]').prop('checked', false);
        }
    });
    dateTimePickerHourTemplate($('#from-hour-create-one-get-one-campaign'));
    dateTimePickerHourTemplate($('#to-hour-create-one-get-one-campaign'));
    dateTimePickerNotWillFromToDate($('#from-date-create-one-get-one-campaign'), $('#to-date-create-one-get-one-campaign'));
    $('#modal-create-one-get-one-campaign input').on('keyup', function () {
        $('#modal-create-one-get-one-campaign .btn-renew').removeClass('d-none');
    })
    $('#modal-create-one-get-one-campaign textarea').on('input', function () {
        $('#modal-create-one-get-one-campaign .btn-renew').removeClass('d-none');
    })
    $('#modal-create-one-get-one-campaign select').on('change', function () {
        $('#modal-create-one-get-one-campaign .btn-renew').removeClass('d-none');
    })
    $('#modal-create-one-get-one-campaign input').on('dp.change', function () {
        $('#modal-create-one-get-one-campaign .btn-renew').removeClass('d-none');
    })
    $('#modal-create-one-get-one-campaign input[type="checkbox"]').on('click', function () {
        $('#modal-create-one-get-one-campaign .btn-renew').removeClass('d-none');
    })

    CKEDITOR.instances['detail-create-one-get-one-campaign'].on('change', function () {
        $('#modal-create-one-get-one-campaign .btn-renew').removeClass('d-none');
    })

}

async function saveCreateOneGetOneMarketing() {
    if(checkSaveCreateOneGetOne === 1) return false;
    if (!checkValidateSave($('#modal-create-one-get-one-campaign'))) return false;
    if(!$('#modal-create-one-get-one-campaign input[name="day-of-week"]:checked').length) {
        WarningNotify('Vui lòng chọn ngày áp dụng khuyến mãi');
        return false;
    }
    if(!urlBannerCreate) {
        WarningNotify('Vui lòng chọn ảnh banner cho chương trình khuyến mãi');
        return false;
    }
    let dayOfWeekCreateVoucherPromotion = [];
    $('#modal-create-one-get-one-campaign input[name="day-of-week"]:checked').each(function (i, v) {
        dayOfWeekCreateVoucherPromotion[i] = $(this).val();
    });

    let restaurant_brand_id = $('.select-brand').val(),
        name = $('#name-create-one-get-one-campaign').val(),
        detail = CKEDITOR.instances['detail-create-one-get-one-campaign'].getData(),
        branch = $('#branches-create-one-get-one-campaign').val(),
        banner = urlBannerCreate,
        form_hour = $('#from-hour-create-one-get-one-campaign').val(),
        to_hour = $('#to-hour-create-one-get-one-campaign').val(),
        form_date = $('#from-date-create-one-get-one-campaign').val(),
        to_date = $('#to-date-create-one-get-one-campaign').val() ;
        // image = $('#thumbnail-one-get-one-campaign').attr('data-url-avt');

    let method = 'post',
        url = 'one-get-one-campaign.create',
        params = null,
        body = {
            'restaurant_brand_id': restaurant_brand_id,
            'banner': banner,
            'name': name,
            'detail': detail,
            'branch': branch,
            'form_hour': form_hour,
            'to_hour': to_hour,
            'form_date': form_date,
            'to_date': to_date,
            'day_of_week': dayOfWeekCreateVoucherPromotion,
            'banner_image_url': urlBannerCreate
        };
    checkSaveCreateOneGetOne = 1;
    let res = await axiosTemplate(method, url, params, body, [$('#modal-create-one-get-one-campaign')]);
    checkSaveCreateOneGetOne = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeCreateOneGetOneMarketing();
            loadDataOneGetOne();
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

function closeCreateOneGetOneMarketing() {
    $('#modal-create-one-get-one-campaign').modal('hide');
    reloadModalCreateOneGetOneCampaign();
}
function reloadModalCreateOneGetOneCampaign(){
    console.log('reload')
    urlBannerCreate = '';
    $('#thumbnail-one-get-one-campaign').attr('src', '/images/tms/default.jpeg');
    $('#name-create-one-get-one-campaign').val('');
    $('#branches-create-one-get-one-campaign').val([]).trigger('change.select2');
    $('#from-hour-create-one-get-one-campaign').val(moment().format('HH'));
    $('#to-hour-create-one-get-one-campaign').val(moment().format('HH'));
    $('#from-date-create-one-get-one-campaign').val(moment().format('DD/MM/YYYY'));
    $('#to-date-create-one-get-one-campaign').val(moment().format('DD/MM/YYYY'));
    $('#modal-create-one-get-one-campaign input[name="day-of-week"]').prop('checked', false);
    $('#modal-create-one-get-one-campaign input[type="checkbox"]').prop('checked', false);
    CKEDITOR.instances['detail-create-one-get-one-campaign'].setData('');
    $('#from-hour-create-one-get-one-campaign').val(moment().format('HH'));
    $('#to-hour-create-one-get-one-campaign').val(moment().format('HH'));
    $('#from-date-create-one-get-one-campaign').val(moment().format('DD/MM/YYYY'));
    $('#to-date-create-one-get-one-campaign').val(moment().format('DD/MM/YYYY'));
    $('#modal-create-one-get-one-campaign input[name="day-of-week"]').prop('checked', false);
    CKEDITOR.instances['detail-create-one-get-one-campaign'].setData('');
    $('#name-create-one-get-one-campaign').val('');
    $('#branches-create-one-get-one-campaign').val([]);
    CKEDITOR.instances['detail-create-one-get-one-campaign'].setData('');
    $('#modal-create-one-get-one-campaign .btn-renew').addClass('d-none');
}
