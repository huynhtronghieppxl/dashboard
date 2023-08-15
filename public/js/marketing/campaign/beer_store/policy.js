let checkSavePolicy = 0, checkLoadDataDetailBeerStore = 0, urlBannerBeerCampaignPolicy = null;
$(function () {
    ckEditorTemplate(['tutorial-set-policy-beer-campaign', 'information-set-policy-beer-campaign' ,'description-set-policy-beer-campaign', 'term-set-policy-beer-campaign']);
    $('#upload-banner-set-policy').on('change', async function () {
        checkSavePolicy = 1;
        let imageUploadBannerPolicy = $(this).prop('files')[0];
        switch((imageUploadBannerPolicy.type).slice(6)) {
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
        if ($(this).prop('files')[0].size > 10 * 1024 * 1024) {
            WarningNotify('Bạn chỉ được tải lên ảnh có dung lượng nhỏ hơn 10MB!');
            $(this).val('');
            return false;
        }
        $('.box-image-banner-branch').prepend(themeLoading($('.box-image-banner-branch').height(), 'setting-policy-beer-campaign-loading'));
        let url_image = URL.createObjectURL($(this).prop('files')[0]);
        $('#thumbnail-banner-set-policy').attr('src', url_image);
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        checkSavePolicy = 0;
        $('.setting-policy-beer-campaign-loading').remove();
        if(!data.data[0]) {
            WarningNotify('Upload ảnh không thành công. Vui lòng thử lại !');
            $(this).val('');
        }
        urlBannerBeerCampaignPolicy = data.data[0];
    });
})
async function openModalSetPolicyBeerCampaign () {
    $('#modal-set-policy-beer-campaign').modal('show');
    dateTimePickerHourMinuteTemplate($('#hour-send-notification-campaign'));
    $('#select-category-material-beer-store-campaign').select2({
        dropdownParent: $('#modal-set-policy-beer-campaign'),
    });
    loadBeerStoreDetailCampaign();
    getFoodBeer();
}

async function getFoodBeer() {
    let brand = $('.select-brand').val();
    let method = 'get',
        url = 'beer-store.food',
        params = {
            brand : brand
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#select-category-material-beer-store-campaign")]);
    $('#select-category-material-beer-store-campaign').html(res.data[0]);
    if($('#select-category-material-beer-store-campaign option[value="' + idFoodBeerStore + '"]').val()){
        $('#select-category-material-beer-store-campaign').val(idFoodBeerStore).trigger('change.select2');
    }
}


async function loadBeerStoreDetailCampaign() {
    if(checkLoadDataDetailBeerStore) return false;
    let method = 'get',
        url = 'beer-store.get-detail',
        params = {
            brand_id: $('.select-brand').val()
        },
        data = null;
    checkLoadDataDetailBeerStore = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#index-layout-beer-store-campaign")]);
    checkLoadDataDetailBeerStore = 0;
    urlBannerBeerCampaignPolicy = res.data.data.banner_url;
    valueStatusRunningBeerStore = res.data.data.running_status;
    $('#select-category-material-beer-store-campaign').val(res.data.data.food_id).trigger('change.select2')
    CKEDITOR.instances['tutorial-set-policy-beer-campaign'].setData(res.data.data.use_guide);
    CKEDITOR.instances['term-set-policy-beer-campaign'].setData(res.data.data.term);
    CKEDITOR.instances['information-set-policy-beer-campaign'].setData(res.data.data.information);
    $('#thumbnail-banner-set-policy').attr('src', res.data.data.banner_image_url);
    $('#content-noti-beer-campaign-policy-data').val(res.data.data.notify_content_daily ? res.data.data.notify_content_daily : 'Tập thể [RESTAURANT_NAME] chúc anh/chị [CUSTOMER_NAME] bước sang một tuổi mới gặp nhiều may mắn và thành tựu, có thật nhiều hạnh phúc trong cuộc sống.');
    $('#content-noti-when-reset-beer-campaign-policy-data').val(res.data.data.notify_content_daily ? res.data.data.notify_content_reset : 'Tập thể [RESTAURANT_NAME] chúc anh/chị [CUSTOMER_NAME] bước sang một tuổi mới gặp nhiều may mắn và thành tựu, có thật nhiều hạnh phúc trong cuộc sống.');
    $('#hour-send-notification-campaign').val(res.data.data.hour_send_notify ? res.data.data.hour_send_notify : moment().format('HH:mm'));
    $('#content-noti-beer-campaign-policy-data').siblings('#char-count').find('span:eq(0)').text($('#content-noti-beer-campaign-policy-data').val().length);
    $('#content-noti-when-reset-beer-campaign-policy-data').siblings('#char-count').find('span:eq(0)').text($('#content-noti-when-reset-beer-campaign-policy-data').val().length);
}


async function saveModalSetpolicyBeerCampaign () {
    if(checkSavePolicy === 1) return false;
    let information = CKEDITOR.instances['information-set-policy-beer-campaign'].getData();
    let termDocument = CKEDITOR.instances['term-set-policy-beer-campaign'].getData();
    let tutorialDocument = CKEDITOR.instances['tutorial-set-policy-beer-campaign'].getData();
    if(!urlBannerBeerCampaignPolicy) {
        WarningNotify('Vui lòng nhập banner');
        return false;
    }else if(!information.length) {
        WarningNotify('Vui lòng nhập mô tả chương trình');
        return false;
    }else if (!termDocument.length) {
        WarningNotify('Vui lòng nhập Quy định sử dụng');
        return false;
    }else if(!tutorialDocument.length) {
        WarningNotify('Vui lòng nhập hướng dẫn sử dụng');
        return false;
    }else if(!$('#select-category-material-beer-store-campaign').val()) {
        WarningNotify('Thương hiệu chưa thiết lập món ăn thuộc loại danh mục "Nước uống"!');
        return false;
    } else if(!$('#content-noti-beer-campaign-policy-data').val().length) {
        WarningNotify('Vui lòng nhập nội dung thông báo khi tặng bia mỗi ngày cho khách hàng !');
        return false;
    }else if(!$('#content-noti-when-reset-beer-campaign-policy-data').val().length) {
        WarningNotify('Vui lòng nhập nội dung thông báo khi kho bia đến hạn reset !');
        return false;
    }
    let method = 'post',
        url = 'beer-store-policy.update',
        params = null,
        data = {
            brand_id: $('.select-brand').val(),
            banner_image_url : urlBannerBeerCampaignPolicy,
            notify_content_daily : $('#content-noti-beer-campaign-policy-data').val(),
            notify_content_reset : $('#content-noti-when-reset-beer-campaign-policy-data').val(),
            hour_send_notify : $('#hour-send-notification-campaign').val(),
            use_guide: tutorialDocument,
            term: termDocument,
            information: information,
            food_id: Number($('#select-category-material-beer-store-campaign').val()) || 0,
        };
    checkSavePolicy = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#modal-set-policy-beer-campaign")]);
    checkSavePolicy = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalSetpolicyBeerCampaign();
            loadBeerStoreCampaign()
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

function tagNotiTemplate (textAriaElm, text) {
    let templateName = [];
    templateName.push(text);
    let caretPos = textAriaElm[0].selectionStart;
    let contentNoti = textAriaElm.val();
    if(contentNoti.length === 1000 || (contentNoti.length + text.length) > 1000) return false;
    textAriaElm.focus().val(contentNoti.substring(0, caretPos) + templateName.join('') + contentNoti.substring(caretPos));
    textAriaElm.trigger('input');
}

function appendCompanyName(r) {
    let textAriaElm = r.parents('.set-notification-policy').find('textarea');
    let text = '[COMPANY_NAME]';
    tagNotiTemplate(textAriaElm, text);
}
function appendBrandName(r) {
    let textAriaElm = r.parents('.set-notification-policy').find('textarea');
    let text = '[BRAND_NAME]';
    tagNotiTemplate(textAriaElm, text);
}

function appendBranchName (r) {
    let textAriaElm = r.parents('.set-notification-policy').find('textarea');
    let text = '[BRANCH_NAME]';
    tagNotiTemplate(textAriaElm, text);
}

function appendCustomerName(r) {
    let textAriaElm = r.parents('.set-notification-policy').find('textarea');
    let text = '[CUSTOMER_NAME]';
    tagNotiTemplate(textAriaElm, text);
}
function appendBeerName(r) {
    let textAriaElm = r.parents('.set-notification-policy').find('textarea');
    let text = '[BEER_NAME]';
    tagNotiTemplate(textAriaElm, text);
}
function appendBeerUnit(r) {
    let textAriaElm = r.parents('.set-notification-policy').find('textarea');
    let text = '[BEER_UNIT]';
    tagNotiTemplate(textAriaElm, text);
}
function appendRemainingDays (r) {
    let textAriaElm = r.parents('.set-notification-policy').find('textarea');
    let text = '[REMAINING_DAYS]';
    tagNotiTemplate(textAriaElm, text);
}

function open_modal_more_information() {
    $('#modal-create-more-information').modal('show')
    $('#modal-set-policy-beer-campaign').modal('hide')
}

function close_modal_create_more_information() {
    $('#modal-create-more-information').modal('hide')
    $('#modal-set-policy-beer-campaign').modal('show')
}

function closeModalSetpolicyBeerCampaign () {
    $('#modal-set-policy-beer-campaign').modal('hide');
    urlBannerBeerCampaignPolicy = null;
    checkSavePolicy = 0;
}
