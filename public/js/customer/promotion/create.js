let day_of_week_create_promotion = [],
    img_files = [],
    list_img_link = [];

function openModalCreateCustomerPromotion() {
    dateTimePickerHourTemplate($('#to-hour-create-promotion'));
    dateTimePickerHourTemplate($('#from-hour-create-promotion'));

    dateTimePickerNotWillTemplate($('#from-date-create-promotion'));
    dateTimePickerNotWillTemplate($('#to-date-create-promotion'));

    $('#from-hour-create-promotion').val($('#current-hour').text());
    $('#to-hour-create-promotion').val($('#current-hour').text());
    $('#from-date-create-promotion').val($('#current-date').text());
    $('#to-date-create-promotion').val($('#current-date').text());

    $('#modal-create-customer-promotion').modal('show');
    addLoading('promotion.create', '#loading-modal-create-customer-promotion');
    // addLoading('promotion.upload-images', '#loading-modal-create-customer-promotion');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalCreateCustomerPromotion();
    });
    shortcut.add('ESC', function () {
        closeModalCreateCustomerPromotion();
    });

    $('input[name="all-day"]').on('click', function () {
        if ($(this).prop('checked') === true) {
            $('input[name="day-of-week"]').prop('checked', true);
        } else {
            $('input[name="day-of-week"]').prop('checked', false);
        }
    });

    $('#modal-create-customer-promotion .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-customer-promotion')
    });
    $('#name-create-promotion').unbind('input').on('input', function () {
        this.value = this.value.toUpperCase();
    });

    $('#modal-create-customer-promotion').on('shown.bs.modal', function () {
        $('#name-create-promotion').focus();
    });

    $('#modal-create-customer-promotion input').on('click', function () {
        $(this).select();
    })

    $('#min-order-total-create-promotion').unbind('input').on('input', function () {
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
    $('#max-promotion-create-promotion').unbind('input').on('input', function () {
        if (removeformatNumber($(this).val()) < 0) {
            $(this).val(0);
            $(this).select();
            WarningNotify('Tối thiểu bằng 0 !');
        }
        // if (removeformatNumber($(this).val()) > removeformatNumber($('#min-order-total-create-promotion').val())) {
        //     $(this).val($('#min-order-total-create-promotion').val());
        //     $(this).select();
        //     alertify.notify('Khuyến mãi không vượt quá hóa đơn tối thiểu !', 'error', 5);
        // }
    });
    $('#discount-create-promotion').unbind('input').on('input', function () {
        if ($('#discount-type-create-promotion').val() === '1') {
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
            // if (removeformatNumber($(this).val()) > removeformatNumber($('#min-order-total-create-promotion').val())) {
            //     $(this).val($('#min-order-total-create-promotion').val());
            //     $(this).select();
            //     alertify.notify('Khuyến mãi không vượt quá hóa đơn tối thiểu !', 'error', 5);
            // }
        }

    });
    $('#discount-type-create-promotion').unbind('change').on('change', function () {
        if ($(this).val() === '1') {
            $('#div-max-promotion-create-promotion').removeClass('d-none');
            if (removeformatNumber($('#discount-create-promotion').val()) > 100) {
                $('#discount-create-promotion').val('100');
                $('#discount-create-promotion').select();
                WarningNotify('Tối đa bằng 100% !');
            }
        } else {
            $('#div-max-promotion-create-promotion').addClass('d-none');
        }
    });
    $('#bonus-point-create-promotion').unbind('input').on('input', function () {
        if ($('#bonus-point-type-create-promotion').val() === '2') {
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
    $('#checkbox-reusable-count-create-promotion').unbind('click').on('click', function () {
        if ($(this).is(':checked')) {
            $('#div-checkbox-reusable-count-create-promotion').removeClass('d-none');
        } else {
            $('#div-checkbox-reusable-count-create-promotion').addClass('d-none');
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
    $('#checkbox-limit-customer-create-promotion').unbind('click').on('click', function () {
        if ($(this).is(':checked')) {
            $('#div-checkbox-limit-customer-create-promotion').removeClass('d-none');
        } else {
            $('#div-checkbox-limit-customer-create-promotion').addClass('d-none');
        }
    });
    $('#limit-customer-create-promotion').unbind('input').on('input', function () {
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

    $('#choose-file-upload-promotion-img').unbind('change').on('change', async function () {
        let img_file = await document.querySelector('#choose-file-upload-promotion-img').files;
        for (let i = 0; i < img_file.length; i++) {
            let url_img = URL.createObjectURL(img_file[i]);

            let data = new FormData();
            data.append("file", img_file[i]);

            let status,
                method = 'post',
                url = 'promotion.upload-images',
                params = null;
            let res = await axiosTemplate(method, url, params, data);

            if (res.status === 200) {
                $('#preview-promotion-image').removeClass('d-none');
                $('#dropzone-content').addClass('d-none');
                status = '<span class="text-success upload-image-success">Tải ảnh thành công</span>';
            } else {
                status = '<span class="text-danger upload-image-error">Tải ảnh không thành công</span>';
            }

            $('#preview-promotion-image').prepend('<div class="dz-preview col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 mb-4 dz-image-preview " style="cursor: pointer;">' +
                '<div class="dz-image">' +
                '<img data-dz-thumbnail="" data-type="0" class="rounded w-100 " alt="" src="' + url_img + '" data-url="' + res.data.data[0].link_original + '" style="width: 25vh!important; height: 25vh!important;">' + status +
                '</div>' +
                '<a class="dz-remove"  href="javascript:undefined;"><button type="button" class="btn btn-danger btn-circle my-1 btn-remove"><span class="feather icon-trash-2"></span></button></a></div>'
            );
        }

        $('.dz-remove').unbind('click').on('click', function () {
            $(this).parents('.dz-preview').remove();
            if ($("#preview-promotion-image .dz-preview").length <= 0) {
                $('#preview-promotion-image').addClass('d-none');
                $('#dropzone-content').removeClass('d-none');
            }
        })
    })
}

async function saveModalCreateCustomerPromotion() {
    $('#btn-create-customer-promotion').prop('disabled', true);
    shortcut.remove('F4');

    $('input[name="day-of-week"]:checked').each(function (i, v) {
        day_of_week_create_promotion[i] = $(this).val();
    });

    let branch_ids = $('#branches-create-promotion').val(),
        name = $('#name-create-promotion').val(),
        description = $('#description-create-promotion').val(),
        min_order_total_amount_required = removeformatNumber($('#min-order-total-create-promotion').val()),
        day_of_week = day_of_week_create_promotion,
        from_hour = $('#from-hour-create-promotion').val(),
        to_hour = $('#to-hour-create-promotion').val(),
        from_date = $('#from-date-create-promotion').val(),
        to_date = $('#to-date-create-promotion').val(),
        type = $('#type-create-promotion').val(),
        checkSelect = checkSelectTemplate('#modal-create-customer-promotion'),
        check_empty = checkEmptyTemplate('#modal-create-customer-promotion');
    if (check_empty === false || checkSelect === false) {
        $('#btn-create-customer-promotion').prop('disabled', false);
        shortcut.add('F4', function () {
            saveModalCreateCustomerPromotion();
        });
        return false;
    }

    let discount_percent, discount_amount, max_promotion_amount;
    if ($('#discount-type-create-promotion').val() === '1') {
        discount_percent = $('#discount-create-promotion').val();
        discount_amount = '0';
        max_promotion_amount = removeformatNumber($('#max-promotion-create-promotion').val());
    } else {
        discount_percent = '0';
        discount_amount = removeformatNumber($('#discount-create-promotion').val());
        max_promotion_amount = '0';
    }

    let banner_image_urls = [];
    $("#preview-promotion-image .dz-preview").each(function () {
        let link = $(this).find('.dz-image img').data('url');
        if (link !== undefined) {
            banner_image_urls.push($(this).find('.dz-image img').data('url'))
        }
    });

    let method = 'post',
        url = 'promotion.create',
        params = null,
        data = {
            restaurant_brand_ids: $('#restaurant-branch-id-selected span').attr('data-value'),
            branch_ids: branch_ids,
            name: name,
            short_description: $('#short-description-create-promotion').val(),
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
            is_allow_use_with_other_promotion: $('#allow-uwop-create-promotion:checked').length,
            banner_image_urls: banner_image_urls
        };

    let res = await axiosTemplate(method, url, params, data);

    $('#btn-create-customer-promotion').prop('disabled', false);
    shortcut.add('F4', function () {
        saveModalCreateCustomerPromotion();
    });

    if (res.data.status === 200) {
        SuccessNotify($('#success-create-data-to-server').text());
        closeModalCreateCustomerPromotion();
        loadData();
    } else {
        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}

function closeModalCreateCustomerPromotion() {
    $('#modal-create-customer-promotion').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add("F2", function () {
        openModalCreateCustomerPromotion();
    });
    img_files = [];
    list_img_link = [];
    $('#preview-promotion-image').find('.dz-preview').remove()
    $('#choose-file-upload-promotion-img').val('').clone(true);
    $('#preview-promotion-image').addClass('d-none');
    $('#dropzone-content').removeClass('d-none');
    $('#branches-create-promotion').val('');
    $('#name-create-promotion').val('');
    $('#description-create-promotion').val('');
    $('#short-description-create-promotion').val('');
    $('#min-order-total-create-promotion').val('')
    $('#max-promotion-create-promotion').val('')
    $('#type-create-promotion option:first').trigger('change.select2');
    $('#discount-create-promotion').val('');
    $('#from-hour-create-promotion').val('');
    $('#to-hour-create-promotion').val('');
    $('#from-date-create-promotion').val('');
    $('#to-date-create-promotion').val('');
    $('input[name="day-of-week"]').prop('checked', false);
    $('#allow-uwop-create-promotion').prop('checked', false);
}
