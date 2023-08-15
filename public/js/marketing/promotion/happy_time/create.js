let dayOfWeekCreatePromotion = [],
    imgFilesCreateHappyTimePromotion = [],
    listImgLink = [],
    listMediaUploadMarketing = [],
    checkSaveCreateHappyTime = 0;

$(function (){
    $(document).on('click','#div-upload-media-marketing-promotion', function () {
        $('#upload-media-marketing-promotion').click();
    });
    $(document).on('change', '#upload-media-marketing-promotion', function () {
        jQuery.each($(this).prop('files'), function (i, v) {
            let text = '';
            if ($(v)[0].size > (5 * 1024 * 1024)) {
                text = '* Ảnh lớn hơn 5MB ';
                $(v)[0].upload = 0;
            } else {
                text = '';
                $(v)[0].upload = 1;
            }
            $('#data-upload-media-marketing-promotion').append(`<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 item-upload-media-marketing-promotion" data-id="${$(v)[0].lastModified}">
                                               <div class="item-box">
                                                   <div class="over-photo">
                                                        <a href="javascript:void(0)" class="float-right"><i class="fa fa-times remove-item-upload-media-marketing-promotion" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"></i></a>
                                                    </div>
                                                    <input value="${$(v)[0].name}" class="input-name-media">
                                                    <a class="strip" href="javascript:void(0)" data-strip-group="mygroup"
                                                       data-strip-group-options="loop: false">
                                                        <img src="${URL.createObjectURL($(v)[0])}" alt="" onclick="modalImageComponent('${URL.createObjectURL($(v)[0])}')">
                                                    </a>
                                                    <span class="text-warning">${text}</span>
                                                </div>
                                            </div>`);
            listMediaUploadMarketing.push($(v)[0]);
        });
    })
    $(document).on('click', '.remove-item-upload-media-marketing-promotion', function () {
        let index = $(this).parents('.item-upload-media-marketing-promotion').data('id');
        jQuery.each(listMediaUploadMarketing, function (i, v) {
            if (v.lastModified === index) {
                listMediaUploadMarketing.splice(i, 1);
            }
        });
        $(this).parents('.item-upload-media-marketing-promotion').remove();
    });
    $(document).on('focusout', '.input-name-media', function () {
        let index = $(this).parents('.item-upload-media-marketing-promotion').data('id');
        let name = $(this).val();
        jQuery.each(listMediaUploadMarketing, function (i, v) {
            if (v.lastModified === index) {
                listMediaUploadMarketing[i].name = name;
            }
        });
        console.log(123, listMediaUploadMarketing)
    });
    $(document).on('click', '#from-hour-create-happy-time-promotion', function () {
        $(this).parent('.input-group').removeClass('focus-valid');
    });
    $(document).on('click', '#to-hour-create-happy-time-promotion', function () {
        $(this).parent('.input-group').removeClass('focus-valid');
    });
})

function openModalCreateHappyTimePromotion() {
    dateTimePickerHourTemplate($('#to-hour-create-happy-time-promotion'));
    dateTimePickerHourTemplate($('#from-hour-create-happy-time-promotion'));
    dateTimePickerNotWillTemplate($('#from-date-create-happy-time-promotion'));
    dateTimePickerNotWillTemplate($('#to-date-create-happy-time-promotion'));

    $('#from-hour-create-happy-time-promotion').val($('#current-hour').text());
    $('#to-hour-create-happy-time-promotion').val($('#current-hour').text());
    $('#from-date-create-happy-time-promotion').val($('#current-date').text());
    $('#to-date-create-happy-time-promotion').val($('#current-date').text());

    $('#modal-create-happy-time-promotion').modal('show');
    // addLoading('happy-time-promotion.create', '#loading-modal-create-happy-time-promotion');
    // addLoading('promotion.upload-images', '#loading-modal-create-happy-time-promotion');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalCreateHappyTimePromotion();
    });
    shortcut.add('ESC', function () {
        closeModalCreateHappyTimePromotion();
    });

    $('#modal-create-happy-time-promotion input[name="all-day"]').on('click', function () {
        if ($(this).prop('checked') === true) {
            $('#modal-create-happy-time-promotion input[name="day-of-week"]').prop('checked', true);
        } else {
            $('#modal-create-happy-time-promotion input[name="day-of-week"]').prop('checked', false);
        }
    });

    $('#branches-create-happy-time-promotion, #type-create-promotion').select2({
        dropdownParent: $('#modal-create-happy-time-promotion'),
    });
    $('#name-create-happy-time-promotion').unbind('input').on('input', function () {
        this.value = this.value.toUpperCase();
    });

    $('#modal-create-happy-time-promotion').on('shown.bs.modal', function () {
        $('#name-create-happy-time-promotion').focus();
    });

    $('#modal-create-happy-time-promotion input').on('click', function () {
        $(this).select();
    });

    $('#checkbox-reusable-count-create-happy-time-promotion').unbind('click').on('click', function () {
        if ($(this).is(':checked')) {
            $('#div-checkbox-reusable-count-create-happy-time-promotion').removeClass('d-none');
        } else {
            $('#div-checkbox-reusable-count-create-happy-time-promotion').addClass('d-none');
        }
    });

    $('#checkbox-limit-happy-time-create-happy-time-promotion').unbind('click').on('click', function () {
        if ($(this).is(':checked')) {
            $('#div-checkbox-limit-happy-time-create-happy-time-promotion').removeClass('d-none');
        } else {
            $('#div-checkbox-limit-happy-time-create-happy-time-promotion').addClass('d-none');
        }
    });

    uploadLayoutTemplate($('.form-update-happy-time'), 'save-upload-happly-time-promotion');
}

async function saveModalCreateHappyTimePromotion() {
    if (!checkValidateSave($('#modal-create-happy-time-promotion'))) return false;
    if (checkSaveCreateHappyTime !== 0) return false;
    checkSaveCreateHappyTime = 1;
    shortcut.remove('F4');
    $('#modal-create-happy-time-promotion input[name="day-of-week"]:checked').each(function (i, v) {
        dayOfWeekCreatePromotion[i] = $(this).val();
    });

    let branch_ids = $('#branches-create-happy-time-promotion').val(),
        name = $('#name-create-happy-time-promotion').val(),
        description = $('#description-create-happy-time-promotion').val(),
        min_order_total_amount_required = removeformatNumber($('#min-order-total-create-happy-time-promotion').val()),
        day_of_week = dayOfWeekCreatePromotion,
        from_hour = $('#from-hour-create-happy-time-promotion').val(),
        to_hour = $('#to-hour-create-happy-time-promotion').val(),
        from_date = $('#from-date-create-happy-time-promotion').val(),
        to_date = $('#to-date-create-happy-time-promotion').val(),
        type = $('#type-create-happy-time-promotion').val(),
        checkSelect = checkSelectTemplate('#modal-create-happy-time-promotion'),
        check_empty = checkEmptyTemplate('#modal-create-happy-time-promotion');
    if (check_empty === false || checkSelect === false) {
        $('#btn-create-happy-time-promotion').prop('disabled', false);
        shortcut.add('F4', function () {
            saveModalCreateHappyTimePromotion();
        });
        return false;
    }

    let discount_percent, discount_amount, max_promotion_amount;
    if ($('#discount-type-create-happy-time-promotion').val() === '1') {
        discount_percent = $('#discount-create-happy-time-promotion').val();
        discount_amount = '0';
        max_promotion_amount = removeformatNumber($('#max-promotion-create-happy-time-promotion').val());
    } else {
        discount_percent = '0';
        discount_amount = removeformatNumber($('#discount-create-happy-time-promotion').val());
        max_promotion_amount = '0';
    }

    let banner_image_urls = [];
    $('.item-upload-media-marketing-promotion').each(function () {
        banner_image_urls.push($(this).find('img').attr('src'));
    })
    checkSaveCreateHappyTime = 0;
    let method = 'post',
        url = 'happy-time-promotion.create',
        params = null,
        data = {
            restaurant_brand_ids: $('#restaurant-branch-id-selected span').attr('data-value'),
            branch_ids: branch_ids,
            name: name,
            short_description: $('#short-description-create-happy-time-promotion').val(),
            description: description,
            min_order_total_amount_required: min_order_total_amount_required,
            max_promotion_amount: max_promotion_amount,
            discount_percent: discount_percent,
            discount_amount: discount_amount,
            day_of_week: day_of_week,
            from_hour: from_hour,
            to_hour: to_hour,
            from_date: from_date,
            to_date: to_date,
            type: type,
            is_allow_use_with_other_promotion: $('#allow-uwop-create-happy-time-promotion:checked').length,
            banner_image_urls: banner_image_urls
        };

    let res = await axiosTemplate(method, url, params, data,[
        $("#loading-modal-create-customer-promotion"),
    ]);

    if (res.data.status === 200) {
        shortcut.add('F4', function () {
            saveModalCreateHappyTimePromotion();
        });
        SuccessNotify($('#success-create-data-to-server').text());
        closeModalCreateHappyTimePromotion();
        loadDataHappyTimePromotion();

    } else {
        let error = (res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text();
        ErrorNotify(error);
    }
}

function closeModalCreateHappyTimePromotion() {
    $('#modal-create-happy-time-promotion').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add("F2", function () {
        openModalCreateHappyTimePromotion();
    });
    imgFilesCreateHappyTimePromotion = [];
    listImgLink = [];
    $('#preview-promotion-image').find('.dz-preview').remove();
    $('#choose-file-upload-promotion-img').val('').clone(true);
    $('#preview-promotion-image').addClass('d-none');
    $('#dropzone-content').removeClass('d-none');
    $('#branches-create-happy-time-promotion').val('');
    $('#name-create-happy-time-promotion').val('');
    $('#description-create-happy-time-promotion').val('');
    $('#short-description-create-happy-time-promotion').val('');
    $('#min-order-total-create-happy-time-promotion').val('');
    $('#max-promotion-create-happy-time-promotion').val('');
    $('#type-create-happy-time-promotion option:first').trigger('change.select2');
    $('#discount-create-happy-time-promotion').val('');
    $('#from-hour-create-happy-time-promotion').val('');
    $('#to-hour-create-happy-time-promotion').val('');
    $('#from-date-create-happy-time-promotion').val('');
    $('#to-date-create-happy-time-promotion').val('');
    $('input[name="day-of-week"]').prop('checked', false);
    $('#allow-uwop-create-happy-time-promotion').prop('checked', false);

    $('#data-upload-media-marketing-promotion .item-upload-media-marketing-promotion').remove();
}
