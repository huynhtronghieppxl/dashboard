let idUpdateOneGetOneCampaign, checkSaveUpdateOneGetOne = 0, dataUpdateImageUploadOneToOne, urlBannerUpdate = null;
$(function (){
    ckEditorTemplate(['detail-update-one-get-one-campaign']);
    dateTimePickerNotWillFromToDate($('#from-date-update-one-get-one-campaign'), $('#to-date-update-one-get-one-campaign'))
    dateTimePickerHourTemplate($('#from-hour-update-one-get-one-campaign'))
    dateTimePickerHourTemplate($('#to-hour-update-one-get-one-campaign'))

    $('#upload-update-banner-one-get-one-campaign').on('change', async function () {
        dataUpdateImageUploadOneToOne = $(this).prop('files')[0];
        switch((dataUpdateImageUploadOneToOne.type).slice(6)) {
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
        $('#thumbnail-update-one-get-one-campaign').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        urlBannerUpdate = data.data[0];
        $(this).replaceWith($(this).val('').clone(true));
    });
})

function openModalUpdateOneGetOneCampaign(r){
    idUpdateOneGetOneCampaign = r.data('id');
    $('#modal-update-one-get-one-campaign').modal('show');
    shortcut.add('F4', function () {
        saveUpdateOneGetOneCampaign();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateOneGetOneCampaign();
    });
    let branchOption = $.trim($('#div-layout-one-get-one-campaign .tab-pane.active .select-branch').html());
    $('#branches-update-one-get-one-campaign').html(branchOption);
    dataDetail();
    $('#branches-update-one-get-one-campaign').select2({
        dropdownParent: $('#modal-update-one-get-one-campaign'),
    });

    $('#modal-update-one-get-one-campaign input[name="all-day"]').on('change', function () {
        if ($(this).prop('checked') === true) {
            $('#modal-update-one-get-one-campaign input[name="day-of-week"]').prop('checked', true);
        } else {
            $('#modal-update-one-get-one-campaign input[name="day-of-week"]').prop('checked', false);
        }
    });
}

async function dataDetail(){
    let method = 'get',
        url = 'one-get-one-campaign.detail',
        params = {
            id:  idUpdateOneGetOneCampaign,
        },
        body = {};
    let res = await axiosTemplate(method, url, params, body,[$('#modal-update-one-get-one-campaign')]);
    $('#thumbnail-update-one-get-one-campaign').attr('src', res.data.data.banner_image_src);
    $('#name-update-one-get-one-campaign').val(res.data.data.name);
    CKEDITOR.instances['detail-update-one-get-one-campaign'].setData(res.data.data.information);
    $('#branches-update-one-get-one-campaign').val(res.data.data.branches_id).trigger('change.select2');
    $('#from-hour-update-one-get-one-campaign').val(res.data.data.from_hour);
    $('#to-hour-update-one-get-one-campaign').val(res.data.data.to_hour);
    $('#from-date-update-one-get-one-campaign').val(res.data.data.from_date);
    $('#to-date-update-one-get-one-campaign').val(res.data.data.to_date);
    for(const data  of res.data.data.day_of_weeks ){
        $('#day-of-week-update-one-get-one-campaign input[name="day-of-week"][value='+ data +']').prop('checked', true);
    }
}

async function loadDataOneGetOne(){
    let method = 'get',
        url = 'one-get-one-campaign.data',
        params = {
            'brand_id' : $('.select-brand').val(),
            'form' : $('#from-date-one-get-one-campaign').val(),
            'to' : $('#to-date-one-get-one-campaign').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,
        [$('#div-layout-one-get-one-campaign')]);
    dataTableVoucherPromotion(res);
    $('#total-record-applying-one-get-one-marketing').text(res.data[3].total_running);
    $('#total-record-pending-one-get-one-marketing').text(res.data[3].total_not_running);
    $('#total-record-expired-one-get-one-marketing').text(res.data[3].total_not_active);
}

async function saveUpdateOneGetOneCampaign(){
    if(checkSaveUpdateOneGetOne !== 0) return false;
    if(!checkValidateSave($('#modal-update-one-get-one-campaign'))) return false;
    if(!$('#modal-update-one-get-one-campaign input[name="day-of-week"]:checked').length) {
        WarningNotify('Vui lòng chọn ngày áp dụng khuyến mãi');
        return false;
    }
    let dayOfWeekUpdateVoucherPromotion = [];
    $('#modal-update-one-get-one-campaign input[name="day-of-week"]:checked').each(function (i, v) {
        dayOfWeekUpdateVoucherPromotion[i] = $(this).val();
    });
    let method = 'post',
        url = 'one-get-one-campaign.update',
        params = {},
        body = {
            id:  idUpdateOneGetOneCampaign,
            restaurant_brand_id : $('.select-brand').val(),
            image : urlBannerUpdate,
            name : $('#name-update-one-get-one-campaign').val(),
            detail : CKEDITOR.instances['detail-update-one-get-one-campaign'].getData(),
            branch : $('#branches-update-one-get-one-campaign').val(),
            form_hour : $('#from-hour-update-one-get-one-campaign').val(),
            to_hour : $('#to-hour-update-one-get-one-campaign').val(),
            form_date : $('#from-date-update-one-get-one-campaign').val(),
            to_date : $('#to-date-update-one-get-one-campaign').val(),
            day_of_week : dayOfWeekUpdateVoucherPromotion
        };
    checkSaveUpdateOneGetOne = 1;
    let res = await axiosTemplate(method, url, params, body,[$('#modal-update-one-get-one-campaign')]);
    checkSaveUpdateOneGetOne = 0;
    let text = '';
    switch (res.data.status){
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            loadDataOneGetOne();
            closeModalUpdateOneGetOneCampaign();
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

function closeModalUpdateOneGetOneCampaign() {
    $('#modal-update-one-get-one-campaign').modal('hide');
    reloadModalUpdateOneGetOneCampaign();
}

function reloadModalUpdateOneGetOneCampaign(){
    $('#thumbnail-update-one-get-one-campaign').attr('src', '');
    $('#name-update-one-get-one-campaign').val('');
    $('#branches-update-one-get-one-campaign').val([]);
    $('#from-hour-update-one-get-one-campaign').val(moment().format('HH'));
    $('#to-hour-update-one-get-one-campaign').val(moment().format('HH'));
    $('#from-date-update-one-get-one-campaign').val(moment().format('DD/MM/YYYY'));
    $('#to-date-update-one-get-one-campaign').val(moment().format('DD/MM/YYYY'));
    CKEDITOR.instances['detail-update-one-get-one-campaign'].setData('');
    $('#modal-update-one-get-one-campaign input[name="day-of-week"]').prop('checked', false);
    // $('#upload-update-banner-one-get-one-campaign').replaceWith($(this).val('').clone(true));
}
