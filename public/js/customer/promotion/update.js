let id_update_customer_promotion, day_of_week_update_promotion = [];

function openModalUpdateCustomerPromotion(id) {
    $('#modal-update-customer-promotion').modal('show');

    id_update_customer_promotion = id;

    addLoading('promotion.data-update', '#loading-modal-update-customer-promotion');
    addLoading('promotion.update', '#loading-modal-update-customer-promotion');

    dateTimePickerHourTemplate($('#to-hour-update-promotion'));
    dateTimePickerHourTemplate($('#from-hour-create-promotion'));

    let date_default = moment().format('MM/DD/YYYY');
    $('#from-date-update-promotion').datetimepicker({
        defaultDate: date_default,
        format: 'DD/MM/Y',
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    $('#to-date-update-promotion').datetimepicker({
        defaultDate: date_default,
        format: 'DD/MM/Y',
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });

    $('input[name="all-day"]').on('click', function () {
        if ($(this).prop('checked') === true) {
            $('input[name="day-of-week"]').prop('checked', true);
        } else {
            $('input[name="day-of-week"]').prop('checked', false);
        }
    });

    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalUpdateCustomerPromotion();
    });
    shortcut.add('F4', function () {
        saveModalUpdateCustomerPromotion();
    });
    $('#modal-update-customer-promotion .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-customer-promotion')
    });
    $('#name-update-promotion').unbind('input').on('input', function () {
        this.value = this.value.toUpperCase();
    });

    $('#modal-update-customer-promotion').on('shown.bs.modal', function () {
        $('#name-update-promotion').focus();
    });

    $('#modal-update-customer-promotion input').on('click', function () {
        $(this).select();
    })

    $('#min-order-total-update-promotion').unbind('input').on('input', function () {
        if (removeformatNumber($(this).val()) < 0) {
            $(this).val(0);
            $(this).select();
            WarningNotify('Tối thiểu bằng 0 !');
        }
        if (removeformatNumber($(this).val()) > 1000000000) {
            $(this).val('1,000,000,000');
            $(this).select();
            WarningNotify('Tối đa bằng 1,000,000,000 !');
        }
    });
    $('#max-promotion-update-promotion').unbind('input').on('input', function () {
        if (removeformatNumber($(this).val()) < 0) {
            $(this).val(0);
            $(this).select();
            WarningNotify('Tối thiểu bằng 0 !');
        }
        // if (removeformatNumber($(this).val()) > removeformatNumber($('#min-order-total-update-promotion').val())) {
        //     $(this).val($('#min-order-total-update-promotion').val());
        //     $(this).select();
        //     WarningNotify('Khuyến mãi không vượt quá hóa đơn tối thiểu !');
        // }
    });
    $('#discount-update-promotion').unbind('input').on('input', function () {
        if ($('#discount-type-update-promotion').val() === '1') {
            if (removeformatNumber($(this).val()) < 0) {
                $(this).val(0);
                $(this).select();
                WarningNotify('Tối thiểu bằng 0% !');
            }
            if (removeformatNumber($(this).val()) > 100) {
                $(this).val(100);
                $(this).select();
                WarningNotify('Tối đa bằng 100% !');
            }
        } else {
            if (removeformatNumber($(this).val()) < 0) {
                $(this).val(0);
                $(this).select();
                WarningNotify('Tối thiểu bằng 0 !');
            }
            // if (removeformatNumber($(this).val()) > removeformatNumber($('#min-order-total-update-promotion').val())) {
            //     $(this).val($('#min-order-total-update-promotion').val());
            //     $(this).select();
            //     WarningNotify('Khuyến mãi không vượt quá hóa đơn tối thiểu !');
            // }
        }

    });
    $('#discount-type-update-promotion').unbind('change').on('change', function () {
        if ($(this).val() === '1') {
            $('#div-max-promotion-update-promotion').removeClass('d-none');
            // if (removeformatNumber($('#discount-update-promotion').val()) > 100) {
            //     $('#discount-update-promotion').val('100');
            //     $('#discount-update-promotion').select();
            //     WarningNotify('Tối đa bằng 100% !');
            // }
        } else {
            $('#div-max-promotion-update-promotion').addClass('d-none');
        }
    });
    $('#bonus-point-update-promotion').unbind('input').on('input', function () {
        if ($('#bonus-point-type-update-promotion').val() === '2') {
            if (removeformatNumber($(this).val()) < 0) {
                $(this).val(0);
                $(this).select();
                WarningNotify('Tối thiểu bằng 0% !');
            }
            if (removeformatNumber($(this).val()) > 100) {
                $(this).val(100);
                $(this).select();
                WarningNotify('Tối đa bằng 100% !');
            }
        } else {
            if (removeformatNumber($(this).val()) < 0) {
                $(this).val(0);
                $(this).select();
                WarningNotify('Tối thiểu bằng 0 !');
            }
            if (removeformatNumber($(this).val()) > 1000000) {
                $(this).val('1,000,000');
                $(this).select();
                WarningNotify('Tối đa 1,000,000 !');
            }
        }
    });
    $('#checkbox-reusable-count-update-promotion').unbind('click').on('click', function () {
        if ($(this).is(':checked')) {
            $('#div-checkbox-reusable-count-update-promotion').removeClass('d-none');
        } else {
            $('#div-checkbox-reusable-count-update-promotion').addClass('d-none');
        }
    });
    $('#limit-reusable-count-promotion').unbind('input').on('input', function () {
        if (removeformatNumber($(this).val()) < 1) {
            $(this).val(1);
            $(this).select();
            WarningNotify('Tối thiểu bằng 1 !');
        }
        if (removeformatNumber($(this).val()) > 1000000) {
            $(this).val('1,000,000');
            $(this).select();
            WarningNotify('Tối đa bằng 1,000,000 !');
        }
    });
    $('#checkbox-limit-customer-update-promotion').unbind('click').on('click', function () {
        if ($(this).is(':checked')) {
            $('#div-checkbox-limit-customer-update-promotion').removeClass('d-none');
        } else {
            $('#div-checkbox-limit-customer-update-promotion').addClass('d-none');
        }
    });
    $('#limit-customer-update-promotion').unbind('input').on('input', function () {
        if (removeformatNumber($(this).val()) < 1) {
            $(this).val(1);
            $(this).select();
            WarningNotify('Tối thiểu bằng 1 !');
        }
        if (removeformatNumber($(this).val()) > 1000000) {
            $(this).val('1,000,000');
            $(this).select();
            WarningNotify('Tối đa bằng 1,000,000 !');
        }
    });
    dataUpdateCustomerPromotion(id);

    $('#choose-file-upload-update-promotion-img').unbind('change').on('change', async function () {
        let img_file= await document.querySelector('#choose-file-upload-update-promotion-img').files;
        for (let i = 0; i < img_file.length; i++) {
            let url_img = URL.createObjectURL(img_file[i]);

            let data = new FormData();
            data.append("file", img_file[i]);

            let status,
                method = 'post',
                url = 'promotion.upload-images',
                params = null;
            let res = await axiosTemplate(method, url, params, data);

            if (res.status === 200){
                $('#preview-update-promotion-image').removeClass('d-none');
                $('#dropzone-content-update-promotion').addClass('d-none');
                status = '<span class="text-success upload-image-success">Tải ảnh thành công</span>';
            }else{
                status = '<span class="text-danger upload-image-error">Tải ảnh không thành công</span>';
            }

            $('#preview-update-promotion-image').prepend('<div class="dz-preview col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 mb-4 dz-image-preview " style="cursor: pointer;">' +
                '<div class="dz-image">' +
                '<img data-dz-thumbnail="" data-type="0" class="rounded w-100 " alt="" src="'+ url_img +'" data-url="'+ res.data.data[0].link_original +'" style="width: 25vh!important; height: 25vh!important;">' + status +
                '</div>'+
                '<a class="dz-remove"  href="javascript:undefined;"><button type="button" class="btn btn-danger btn-circle my-1 btn-remove"><span class="feather icon-trash-2"></span></button></a></div>'
            );
        }

        $('.dz-remove').unbind('click').on('click', function () {
            $(this).parents('.dz-preview').remove();
            if ($("#preview-update-promotion-image .dz-preview").length <= 0){
                $('#preview-update-promotion-image').addClass('d-none');
                $('#dropzone-content-update-promotion').removeClass('d-none');
            }
        })
    })
}

async function dataUpdateCustomerPromotion(id) {
    let method = 'get',
        url = 'promotion.data-update',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#status-update-promotion').html(res.data[0].status);
    $('#name-update-promotion').val(res.data[0].name);
    $('#description-update-promotion').val(res.data[0].description);
    $('#min-order-total-update-promotion').val(res.data[0].min_order_total_amount_required);
    if (parseInt(res.data[0].discount_amount) === 0) {
        $('#discount-type-update-promotion').val(1).trigger('change');
        $('#discount-update-promotion').val(res.data[0].discount_percent);
        $('#div-max-promotion-update-promotion').removeClass('d-none');
    } else {
        $('#discount-type-update-promotion').val(2).trigger('change');
        $('#discount-update-promotion').val(res.data[0].discount_amount);
        $('#div-max-promotion-update-promotion').addClass('d-none');
        $('#max-promotion-update-promotion').val(res.data[0].max_promotion_amount);
    }
    if (parseInt(res.data[0].bonus_point) === 0) {
        $('#bonus-point-type-update-promotion').val(2).trigger('change');
        $('#bonus-point-update-promotion').val(res.data[0].bonus_point_percent);
    } else {
        $('#bonus-point-type-update-promotion').val(1).trigger('change');
        $('#bonus-point-update-promotion').val(res.data[0].bonus_point);
    }
    if (parseInt(res.data[0].reusable_count) === 0) {
        $('#checkbox-reusable-count-update-promotion').prop('checked', false);
        $('#div-checkbox-reusable-count-update-promotion').addClass('d-none');
    } else {
        $('#checkbox-reusable-count-update-promotion').prop('checked', true);
        $('#div-checkbox-reusable-count-update-promotion').removeClass('d-none');
        $('#reusable-count-update-promotion').val(res.data[0].reusable_count);
    }
    $('#from-hour-update-promotion').val(res.data[0].from_hour);
    $('#to-hour-update-promotion').val(res.data[0].to_hour);
    $('#from-date-update-promotion').val(res.data[0].from_date);
    $('#to-date-update-promotion').val(res.data[0].to_date);
    $('#type-update-promotion').val(res.data[0].type).trigger('change.select2');
    $('#apply-type-update-promotion').val(res.data[0].apply_type).trigger('change.select2');
    $('#short-description-update-promotion').val(res.data[0].short_description);
    $('#branches-update-promotion').val(res.data[0].branchs_id).trigger('change.select2');

    $('#day-of-week-update-promotion input[type="checkbox"]').each(function (i,v) {
        let value_int = parseInt($(this).val().toString());
        let day_of_weeks = res.data[0].day_of_weeks,
            day_of_week_int = parseInt(day_of_weeks.toString());
        if (value_int === day_of_week_int){
            $(this).prop('checked', true);
            day_of_weeks.splice(0, 1);
        }
    });

    if (res.data[0].is_allow_use_with_other_promotion == 1){
        $('#allow-uwop-update-promotion').prop('checked', true);
    }else{
        $('#allow-uwop-update-promotion').prop('checked', false);
    }

    if (res.data[0].banner_list != ''){
        $('#preview-update-promotion-image').removeClass('d-none');
        $('#dropzone-content-update-promotion').addClass('d-none');
        $('#preview-update-promotion-image').prepend(res.data[0].banner_list);
    }

    $('.dz-remove').unbind('click').on('click', function () {
        $(this).parents('.dz-preview').remove();
        if ($("#preview-update-promotion-image .dz-preview").length <= 0){
            $('#preview-update-promotion-image').addClass('d-none');
            $('#dropzone-content-update-promotion').removeClass('d-none');
        }
    })
}

async function saveModalUpdateHappyTimePromotion() {
    $('#btn-update-customer-promotion').prop('disabled', true);
    shortcut.remove('F4');

    $('input[name="day-of-week"]:checked').each(function(i,v) {
        day_of_week_update_promotion[i] = $(this).val();
    });

    let branch_ids = $('#branches-update-promotion').val(),
        name = $('#name-update-promotion').val(),
        description = $('#description-update-promotion').val(),
        min_order_total_amount_required = removeformatNumber($('#min-order-total-update-promotion').val()),
        day_of_week = day_of_week_update_promotion,
        from_hour = $('#from-hour-update-promotion').val(),
        to_hour = $('#to-hour-update-promotion').val(),
        from_date = $('#from-date-update-promotion').val(),
        to_date = $('#to-date-update-promotion').val(),
        type = $('#type-update-promotion').val(),
        checkSelect = checkSelectTemplate('#modal-update-customer-promotion'),
        check_empty = checkEmptyTemplate('#modal-update-customer-promotion');
    if (check_empty === false || checkSelect === false){
        $('#btn-update-customer-promotion').prop('disabled', false);
        shortcut.add('F4', function () {
            saveModalCreateCustomerPromotion();
        });
        return false;
    }

    let discount_percent, discount_amount, max_promotion_amount;
    if ($('#discount-type-update-promotion').val() === '1') {
        discount_percent = $('#discount-update-promotion').val();
        discount_amount = '0';
        max_promotion_amount = removeformatNumber($('#max-promotion-update-promotion').val());
    } else {
        discount_percent = '0';
        discount_amount = removeformatNumber($('#discount-update-promotion').val());
        max_promotion_amount = '0';
    }

    let banner_image_urls = [];
    $( "#preview-update-promotion-image .dz-preview" ).each(function() {
        let link = $(this).find('.dz-image img').data('url');
        if (link !== undefined){
            banner_image_urls.push($(this).find('.dz-image img').data('url'))
        }
    });

    let method = 'post',
        url = 'promotion.update',
        params = null,
        data = {
            id: id_update_customer_promotion,
            restaurant_brand_ids: $('#restaurant-branch-id-selected span').attr('data-value'),
            branch_ids: branch_ids,
            name: name,
            short_description: $('#short-description-update-promotion').val(),
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
            is_allow_use_with_other_promotion: $('#allow-uwop-update-promotion:checked').length,
            banner_image_urls: banner_image_urls
        };

    let res = await axiosTemplate(method, url, params, data);

    $('#btn-update-customer-promotion').prop('disabled', false);
    shortcut.add('F4', function () {
        saveModalUpdateCustomerPromotion();
    });

    if (res.data.status === 200) {
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalUpdateCustomerPromotion();
        loadData();
    } else {
        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}


function closeModalUpdateCustomerPromotion() {
    $('#modal-update-customer-promotion').modal('hide');
    $('#preview-update-promotion-image').find('.dz-preview').remove()
    $('#choose-file-upload-update-promotion-img').val('').clone(true);
    $('#preview-update-promotion-image').addClass('d-none');
    $('#dropzone-content-update-promotion').removeClass('d-none');
    shortcut.remove('ESC');
    shortcut.add("F2", function () {
        openModalUpdateCustomerPromotion();
    });
    $('input[name="day-of-week"]').prop('checked',false);

}
