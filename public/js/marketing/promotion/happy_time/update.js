let id_update_customer_promotion,
    day_of_week_update_promotion = [],
    listMediaUploadMarketingUpdate = [],
    checkSaveUpdateHappyTime = 0;

function openModalUpdateHappyTimePromotion(id) {
    $('#modal-update-happy-time-promotion').modal('show');

    dateTimePickerHourTemplate($('#to-hour-update-happy-time-promotion'));
    dateTimePickerHourTemplate($('#from-hour-update-happy-time-promotion'));
    dateTimePickerNormalTemplate($('#from-date-update-happy-time-promotion'));
    dateTimePickerNormalTemplate($('#to-date-update-happy-time-promotion'));
    $('#modal-update-happy-time-promotion .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-happy-time-promotion')
    });
    id_update_customer_promotion = id;
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalUpdateHappyTimePromotion();
    });
    shortcut.add('F4', function () {
        saveModalUpdateHappyTimePromotion();
    });

    $('#branches-update-happy-time-promotion').select2({
        dropdownParent: $('#modal-update-happy-time-promotion'),
    });

    $('#modal-update-happy-time-promotion input[name="all-day"]').on('click', function () {
        if ($(this).prop('checked') === true) {
            $('#modal-update-hhappy-time-promotion input[name="day-of-week"]').prop('checked', true);
        } else {
            $('#modal-update-happy-time-promotion input[name="day-of-week"]').prop('checked', false);
        }
    });

    $('#name-update-happy-time-promotion').unbind('input').on('input', function () {
        this.value = this.value.toUpperCase();
    });

    $('#modal-update-happy-time-promotion input').on('click', function () {
        $(this).select();
    })

    $('#checkbox-reusable-count-update-happy-time-promotion').unbind('click').on('click', function () {
        if ($(this).is(':checked')) {
            $('#div-checkbox-reusable-count-update-happy-time-promotion').removeClass('d-none');
        } else {
            $('#div-checkbox-reusable-count-update-happy-time-promotion').addClass('d-none');
        }
    });

    $('#checkbox-limit-customer-update-happy-time-promotion').unbind('click').on('click', function () {
        if ($(this).is(':checked')) {
            $('#div-checkbox-limit-customer-update-happy-time-promotion').removeClass('d-none');
        } else {
            $('#div-checkbox-limit-customer-update-happy-time-promotion').addClass('d-none');
        }
    });

    dataUpdateHappyTimePromotion(id);
    $(document).on('click','#div-upload-media-marketing-promotion-update', function () {
        $('#upload-media-marketing-promotion-update').click();
    });
    $(document).on('change', '#upload-media-marketing-promotion-update', function () {
        jQuery.each($(this).prop('files'), function (i, v) {
            let text = '';
            if ($(v)[0].size > (5 * 1024 * 1024)) {
                text = '* Ảnh lớn hơn 5MB ';
                $(v)[0].upload = 0;
            } else {
                text = '';
                $(v)[0].upload = 1;
            }
            $('#data-upload-media-marketing-promotion-update').append(`<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 item-upload-media-marketing-promotion-update" data-id="${$(v)[0].lastModified}">
                                               <div class="item-box">
                                                   <div class="over-photo">
                                                        <a href="javascript:void(0)" class="float-right"><i class="fa fa-times remove-item-upload-media-marketing-promotion-update" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"></i></a>
                                                    </div>
                                                    <input value="${$(v)[0].name}" class="input-name-media">
                                                    <a class="strip" href="javascript:void(0)" data-strip-group="mygroup"
                                                       data-strip-group-options="loop: false">
                                                        <img src="${URL.createObjectURL($(v)[0])}" alt="" onclick="modalImageComponent('${URL.createObjectURL($(v)[0])}')">
                                                    </a>
                                                    <span class="text-warning">${text}</span>
                                                </div>
                                            </div>`);
            listMediaUploadMarketingUpdate.push($(v)[0]);
        });
    })
    $(document).on('click', '.remove-item-upload-media-marketing-promotion-update', function () {
        let index = $(this).parents('.item-upload-media-marketing-promotion-update').data('id');
        jQuery.each(listMediaUploadMarketingUpdate, function (i, v) {
            if (v.lastModified === index) {
                listMediaUploadMarketingUpdate.splice(i, 1);
            }
        });
        $(this).parents('.item-upload-media-marketing-promotion-update').remove();
    });
    $(document).on('focusout', '.input-name-media', function () {
        let index = $(this).parents('.item-upload-media-marketing-promotion-update').data('id');
        let name = $(this).val();
        jQuery.each(listMediaUploadMarketingUpdate, function (i, v) {
            if (v.lastModified === index) {
                listMediaUploadMarketingUpdate[i].name = name;
            }
        });
        console.log(123, listMediaUploadMarketingUpdate)
    });
}

async function dataUpdateHappyTimePromotion(id) {
    let method = 'get',
        url = 'happy-time-promotion.data-update',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#status-update-happy-time-promotion').html(res.data[0].status);
    $('#name-update-happy-time-promotion').val(res.data[0].name);
    $('#description-update-happy-time-promotion').val(res.data[0].description);
    $('#min-order-total-update-happy-time-promotion').val(res.data[0].min_order_total_amount_required);
    if (parseInt(res.data[0].discount_amount) === 0) {
        $('#discount-type-update-happy-time-promotion').val(1).trigger('change');
        $('#discount-update-happy-time-promotion').val(res.data[0].discount_percent);
        $('#div-max-happy-time-promotion-update-happy-time-promotion').removeClass('d-none');
    } else {
        $('#discount-type-update-happy-time-promotion').val(2).trigger('change');
        $('#discount-update-happy-time-promotion').val(res.data[0].discount_amount);
        $('#div-max-happy-time-promotion-update-happy-time-promotion').addClass('d-none');
        $('#max-happy-time-promotion-update-happy-time-promotion').val(res.data[0].max_promotion_amount);
    }
    if (parseInt(res.data[0].bonus_point) === 0) {
        $('#bonus-point-type-update-happy-time-promotion').val(2).trigger('change');
        $('#bonus-point-update-happy-time-promotion').val(res.data[0].bonus_point_percent);
    } else {
        $('#bonus-point-type-update-happy-time-promotion').val(1).trigger('change');
        $('#bonus-point-update-happy-time-promotion').val(res.data[0].bonus_point);
    }
    if (parseInt(res.data[0].reusable_count) === 0) {
        $('#checkbox-reusable-count-update-happy-time-promotion').prop('checked', false);
        $('#div-checkbox-reusable-count-update-happy-time-promotion').addClass('d-none');
    } else {
        $('#checkbox-reusable-count-update-happy-time-promotion').prop('checked', true);
        $('#div-checkbox-reusable-count-update-happy-time-promotion').removeClass('d-none');
        $('#reusable-count-update-happy-time-promotion').val(res.data[0].reusable_count);
    }
    $('#from-hour-update-happy-time-promotion').val(res.data[0].from_hour);
    $('#to-hour-update-happy-time-promotion').val(res.data[0].to_hour);
    $('#from-date-update-happy-time-promotion').val(res.data[0].from_date);
    $('#to-date-update-happy-time-promotion').val(res.data[0].to_date);
    $('#type-update-happy-time-promotion').val(res.data[0].type).trigger('change.select2');
    $('#apply-type-update-happy-time-promotion').val(res.data[0].apply_type).trigger('change.select2');
    $('#short-description-update-happy-time-promotion').val(res.data[0].short_description);
    $('#branches-update-happy-time-promotion').val(res.data[0].branchs_id).trigger('change.select2');

    $('#day-of-week-update-happy-time-promotion input[type="checkbox"]').each(function (i, v) {
        let value_int = parseInt($(this).val().toString());
        let day_of_weeks = res.data[0].day_of_weeks,
            day_of_week_int = parseInt(day_of_weeks.toString());
        if (value_int === day_of_week_int) {
            $(this).prop('checked', true);
            day_of_weeks.splice(0, 1);
        }
    });

    if (res.data[0].is_allow_use_with_other_promotion == 1) {
        $('#allow-uwop-update-happy-time-promotion').prop('checked', true);
    } else {
        $('#allow-uwop-update-happy-time-promotion').prop('checked', false);
    }

    if (res.data[0].banner_list != '') {
        $('#preview-update-happy-time-promotion-image').removeClass('d-none');
        $('#dropzone-content-update-happy-time-promotion').addClass('d-none');
        $('#preview-update-happy-time-promotion-image').prepend(res.data[0].banner_list);
    }

    $('.dz-remove').unbind('click').on('click', function () {
        $(this).parents('.dz-preview').remove();
        if ($("#preview-update-happy-time-promotion-image .dz-preview").length <= 0) {
            $('#preview-update-happy-time-promotion-image').addClass('d-none');
            $('#dropzone-content-update-happy-time-promotion').removeClass('d-none');
        }
    })
}

async function saveModalUpdateHappyTimePromotion() {
    $('#btn-update-happy-time-promotion').prop('disabled', true);
    shortcut.remove('F4');

    $('input[name="day-of-week"]:checked').each(function (i, v) {
        day_of_week_update_promotion[i] = $(this).val();
    });
    if (checkSaveUpdateHappyTime !== 0) return false;
    checkSaveUpdateHappyTime = 1;

    let branch_ids = $('#branches-update-happy-time-promotion').val(),
        name = $('#name-update-happy-time-promotion').val(),
        description = $('#description-update-happy-time-promotion').val(),
        min_order_total_amount_required = removeformatNumber($('#min-order-total-update-happy-time-promotion').val()),
        day_of_week = day_of_week_update_promotion,
        from_hour = $('#from-hour-update-happy-time-promotion').val(),
        to_hour = $('#to-hour-update-happy-time-promotion').val(),
        from_date = $('#from-date-update-happy-time-promotion').val(),
        to_date = $('#to-date-update-happy-time-promotion').val(),
        type = $('#type-update-happy-time-promotion').val(),
        checkSelect = checkSelectTemplate('#modal-update-happy-time-promotion'),
        check_empty = checkEmptyTemplate('#modal-update-happy-time-promotion');
    if (check_empty === false || checkSelect === false) {
        $('#btn-update-happy-time-promotion').prop('disabled', false);
        shortcut.add('F4', function () {
            saveModalCreateHappyTimePromotion();
        });
        return false;
    }

    let discount_percent, discount_amount, max_promotion_amount;
    if ($('#discount-type-update-happy-time-promotion').val() === '1') {
        discount_percent = $('#discount-update-happy-time-promotion').val();
        discount_amount = '0';
        max_promotion_amount = removeformatNumber($('#max-happy-time-promotion-update-happy-time-promotion').val());
    } else {
        discount_percent = '0';
        discount_amount = removeformatNumber($('#discount-update-happy-time-promotion').val());
        max_promotion_amount = '0';
    }

    let banner_image_urls = [];
    $("#preview-update-happy-time-promotion-image .dz-preview").each(function () {
        let link = $(this).find('.dz-image img').data('url');
        if (link !== undefined) {
            banner_image_urls.push($(this).find('.dz-image img').data('url'))
        }
    });

    let method = 'post',
        url = 'happy-time-promotion.update',
        params = null,
        data = {
            id: id_update_customer_promotion,
            restaurant_brand_ids: $('#restaurant-branch-id-selected span').attr('data-value'),
            branch_ids: branch_ids,
            name: name,
            short_description: $('#short-description-update-happy-time-promotion').val(),
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
            is_allow_use_with_other_promotion: $('#allow-uwop-update-happy-time-promotion:checked').length,
            banner_image_urls: banner_image_urls
        };
    let res = await axiosTemplate(method, url, params, data,[
        $("#loading-modal-update-happy-time-promotion"),
    ]);
    checkSaveUpdateHappyTime = 0;

    $('#btn-update-happy-time-promotion').prop('disabled', false);
    shortcut.add('F4', function () {
        saveModalUpdateHappyTimePromotion();
    });

    if (res.data.status === 200) {
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalUpdateHappyTimePromotion();
        loadData();
    } else {
        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}


function closeModalUpdateHappyTimePromotion() {
    $('#modal-update-happy-time-promotion').modal('hide');
    $('#preview-update-happy-time-promotion-image').find('.dz-preview').remove()
    $('#choose-file-upload-update-happy-time-promotion-img').val('').clone(true);
    $('#preview-update-happy-time-promotion-image').addClass('d-none');
    $('#dropzone-content-update-happy-time-promotion').removeClass('d-none');
    shortcut.remove('ESC');
    shortcut.add("F2", function () {
        openModalUpdateHappyTimePromotion();
    });
    $('input[name="day-of-week"]').prop('checked', false);

}
