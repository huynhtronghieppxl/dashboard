let dayOfWeekCreateVoucherPromotion = [],
    imgFilesCreateVoucherPromotion = [],
    listImgLinkCreateVoucherPromotion = [],
    listMediaUploadMarketing = [],
    checkSaveCreateVoucher = 0;

$(function () {
        $(document).on('click', '#div-upload-media-marketing-voucher-promotion', function () {
            $('#upload-media-marketing-voucher-promotion').click();
        });
        $(document).on('change', '#upload-media-marketing-voucher-promotion', async function () {
            jQuery.each($(this).prop('files'), function (i, v) {
                let text = '';
                if ($(v)[0].size > (5 * 1024 * 1024)) {
                    text = '* Ảnh lớn hơn 5MB ';
                    $(v)[0].upload = 0;
                } else {
                    text = '';
                    $(v)[0].upload = 1;
                }
                $('#data-upload-media-marketing-voucher-promotion').append(`<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 item-upload-media-marketing-voucher-promotion" data-id="${$(v)[0].lastModified}">
                                           <div class="item-box">
                                               <div class="over-photo">
                                                    <a href="javascript:void(0)" class="float-right"><i class="fa fa-times remove-item-upload-media-marketing-voucher-promotion" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"></i></a>
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
        });
        $(document).on('click', '.remove-item-upload-media-marketing-voucher-promotion', function () {
            let index = $(this).parents('.item-upload-media-marketing-voucher-promotion').data('id');
            jQuery.each(listMediaUploadMarketing, function (i, v) {
                if (v.lastModified === index) {
                    listMediaUploadMarketing.splice(i, 1);
                }
            });
            $(this).parents('.item-upload-media-marketing-voucher-promotion').remove();
        });
        $(document).on('focusout', '.input-name-media', function () {
            let index = $(this).parents('.item-upload-media-marketing-voucher-promotion').data('id');
            let name = $(this).val();
            jQuery.each(listMediaUploadMarketing, function (i, v) {
                if (v.lastModified === index) {
                    listMediaUploadMarketing[i].name = name;
                }
            });
        });
    })

function openModalCreateVoucherPromotion() {
    $('#modal-create-voucher-promotion').modal('show');
    dateTimePickerHourTemplate($('#to-hour-create-voucher-promotion'));
    dateTimePickerHourTemplate($('#from-hour-create-voucher-promotion'));
    dateTimePickerNotWillTemplate($('#from-date-create-voucher-promotion'));
    dateTimePickerNotWillTemplate($('#to-date-create-voucher-promotion'));

    shortcut.remove('F2');
    shortcut.add('F4', function () {
        saveModalCreateVoucherPromotion();
    });
    shortcut.add('ESC', function () {
        closeModalCreateVoucherPromotion();
    });

    $('#modal-create-voucher-promotion input[name="all-day"]').on('click', function () {
        if ($(this).prop('checked') === true) {
            $('#modal-create-voucher-promotion input[name="day-of-week"]').prop('checked', true);
        } else {
            $('#modal-create-voucher-promotion input[name="day-of-week"]').prop('checked', false);
        }
    });
    $('#modal-create-voucher-promotion .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-voucher-promotion')
    });
    $('#name-create-voucher-promotion').unbind('input').on('input', function () {
        this.value = this.value.toUpperCase();
    });
    $('#discount-type-create-voucher-promotion').unbind('change').on('change', function () {
        if ($(this).val() === '1') {
            $('#div-max-promotion-create-voucher-promotion').removeClass('d-none');
            if (removeformatNumber($('#discount-create-voucher-promotion').val()) > 100) {
                $('#discount-create-voucher-promotion').val('100');
                $('#discount-create-voucher-promotion').select();
                WarningNotify('Tối đa bằng 100% !');
            }
        } else {
            $('#div-max-promotion-create-voucher-promotion').addClass('d-none');
        }
    });
    ckEditorTemplate(['detail-create-voucher-promotion']);
}

async function saveModalCreateVoucherPromotion() {
    if (checkSaveCreateVoucher !== 0) return false;
    $('#modal-create-voucher-promotion input[name="day-of-week"]:checked').each(function (i, v) {
        dayOfWeekCreateVoucherPromotion[i] = $(this).val();
    });

    let branch_ids = $('#branches-create-voucher-promotion').val(),
        name = $('#name-create-voucher-promotion').val(),
        information = $('#description-create-voucher-promotion').val(),
        min_order_total_amount_required = removeformatNumber($('#min-order-total-create-voucher-promotion').val()),
        day_of_weeks = dayOfWeekCreateVoucherPromotion,
        from_hour = $('#from-hour-create-voucher-promotion').val(),
        to_hour = $('#to-hour-create-voucher-promotion').val(),
        from_date = $('#from-date-create-voucher-promotion').val(),
        to_date = $('#to-date-create-voucher-promotion').val(),
        category_types = $('#type-create-voucher-promotion').val(),
        checkSelect = checkSelectTemplate('#modal-create-voucher-promotion'),
        check_empty = checkEmptyTemplate('#modal-create-voucher-promotion');
    if (check_empty === false || checkSelect === false) {
        return false;
    }

    let discount_percent, discount_amount, max_promotion_amount;
    if ($('#discount-type-create-voucher-promotion').val() === '1') {
        discount_percent = $('#discount-create-voucher-promotion').val();
    } else {
        discount_percent = '0';
    }
    let banner_image_urls = [];

    checkSaveCreateVoucher = 1;
    let method = 'post',
        url = 'voucher-promotion.create',
        params = null,
        data = {
            promotion_campaign_id: promotion_campaign_id,
            restaurant_brand_ids: $('#restaurant-branch-id-selected span').attr('data-value'),
            branch_ids: branch_ids,
            name: name,
            information: information,
            discount_percent: discount_percent,
            day_of_weeks: day_of_weeks,
            from_hour: from_hour,
            to_hour: to_hour,
            from_date: from_date,
            to_date: to_date,
            category_types: category_types,
            maximum_use_time_per_voucher: maximum_use_time_per_voucher,
            banner_image_urls: banner_image_urls
        };

    let res = await axiosTemplate(method, url, params, data);
    checkSaveCreateVoucher = 0;
    if (res.data.status === 200) {
        SuccessNotify($('#success-create-data-to-server').text());
        closeModalCreateVoucherPromotion();
        loadData();
    } else {
        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}

function closeModalCreateVoucherPromotion() {
    $('#modal-create-voucher-promotion').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add("F2", function () {
        openModalCreateVoucherPromotion();
    });
    imgFilesCreateVoucherPromotion = [];
    listImgLinkCreateVoucherPromotion = [];
    $('#dropzone-content-upload-create-voucher-promotion').removeClass('d-none');
    $('#branches-create-voucher-promotion').val('');
    $('#name-create-voucher-promotion').val('');
    $('#description-create-voucher-promotion').val('');
    $('#short-description-create-voucher-promotion').val('');
    $('#min-order-total-create-voucher-promotion').val('');
    $('#max-promotion-create-voucher-promotion').val('');
    $('#type-create-voucher-promotion option:first').trigger('change.select2');
    $('#discount-create-voucher-promotion').val('');
    $('#from-hour-create-voucher-promotion').val(moment().format('H'));
    $('#to-hour-create-voucher-promotion').val(moment().format('H'));
    $('#from-date-create-voucher-promotion').val(moment().format('DD/MM/YYYY'));
    $('#to-date-create-voucher-promotion').val(moment().format('DD/MM/YYYY'));
    $('#modal-create-voucher-promotion input[name="day-of-week"]').prop('checked', false);

    $('#data-upload-media-marketing-voucher-promotion .item-upload-media-marketing-voucher-promotion').remove();
}

function resetModalCreateVoucherPromotion() {
    $('#dropzone-content-upload-create-voucher-promotion').removeClass('d-none');
    $('#branches-create-voucher-promotion').val('');
    $('#name-create-voucher-promotion').val('');
    $('#description-create-voucher-promotion').val('');
    $('#short-description-create-voucher-promotion').val('');
    $('#min-order-total-create-voucher-promotion').val('');
    $('#max-promotion-create-voucher-promotion').val('');
    $('#type-create-voucher-promotion option:first').trigger('change.select2');
    $('#discount-create-voucher-promotion').val('');
    $('#from-hour-create-voucher-promotion').val(moment().format('H'));
    $('#to-hour-create-voucher-promotion').val(moment().format('H'));
    $('#from-date-create-voucher-promotion').val(moment().format('DD/MM/YYYY'));
    $('#to-date-create-voucher-promotion').val(moment().format('DD/MM/YYYY'));
    $('#detail-create-voucher-promotion').val('');
    $('#modal-create-voucher-promotion input[name="day-of-week"]').prop('checked', false);

    $('#data-upload-media-marketing-voucher-promotion .item-upload-media-marketing-voucher-promotion').remove();
}
