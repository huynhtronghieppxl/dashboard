let checkSaveUpdateGiftMarketing = 0, checkDataFoodUpdateGiftMarketing = 0, thisUpdateGiftMarketing,
    tableFoodUpdateGiftMarketing, dataUpdateImageUploadGiftMarketing, dataUpdateImageUploadBannerGiftMarketing;

$(function () {
    $('#upload-gift-banner-update-gift-marketing').on('change', async function () {
        dataUpdateImageUploadBannerGiftMarketing = $(this).prop('files')[0];
        switch((dataUpdateImageUploadBannerGiftMarketing.type).slice(6)) {
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
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        // $('#thumbnail-gift-banner-update-gift-marketing').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        $('#thumbnail-gift-banner-update-gift-marketing').attr('src', url_image);
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        $('#thumbnail-gift-banner-update-gift-marketing').attr('data-url-banner', data.data[0]);
        $(this).replaceWith($(this).val('').clone(true));
        $(this).val(null);
    })
})
async function openModalUpdateGiftMarketing(r) {
    thisUpdateGiftMarketing = r;
    $('#modal-update-gift-marketing').modal('show');
    shortcut.add('F4', function () {
        saveModalUpdateGiftMarketing();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateGiftMarketing();
    });
    $('#modal-update-gift-marketing .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-gift-marketing')
    });
    $('#modal-update-gift-marketing input').on('focus', function () {
        $(this).select();
    })

    let branchOption = $.trim($('#div-layout-gift-marketing .tab-pane.active .select-branch').html());
    $('#select-branch-update-gift-marketing').html(branchOption);

    $("#select-type-update-gift-marketing").unbind("select2:select").on("select2:select", async function () {
        if ($(this).val() == 0) {
            $('#div-value-food-update-gift-marketing').removeClass('d-none');
            $('#div-value-point-update-gift-marketing').addClass('d-none');
            drawTableFoodUpdateGiftMarketing([]);
        } else {
            $('#div-value-food-update-gift-marketing').addClass('d-none');
            $('#div-value-point-update-gift-marketing').removeClass('d-none');
        }
    });

    let x = thisUpdateGiftMarketing.parents('td').data('dt-row');

    $('#type-day-update-gift-marketing input').on('click', function () {
        if ($(this).val() === '0') {
            $('#div-type-day-update-gift-marketing').addClass('d-none');
        } else {
            $('#div-type-day-update-gift-marketing').removeClass('d-none');
        }
    })

    $('#type-hour-update-gift-marketing input').on('click', function () {
        if ($(this).val() === '0') {
            $('#div-type-hour-update-gift-marketing').addClass('d-none');
        } else {
            $('#div-type-hour-update-gift-marketing').removeClass('d-none');
        }
    })

    $('#value-food-update-gift-marketing').unbind('select2:select').on('select2:select', async function () {
        await addRowDatatableTemplate(tableFoodUpdateGiftMarketing, {
            'DT_RowIndex': tableFoodUpdateGiftMarketing.length,
            'name': $(this).find(':selected').text(),
            'quantity': '<div class="input-group border-group validate-table-validate">' +
                '  <input class="form-control adjustment text-right rounded border-0 w-100" data-max="999999999" data-min="1" data-type="currency-edit" value="1" data-float="1">' +
                '</div>',
            'action': `<div class="btn-group-sm">
                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"
                            data-toggle="tooltip" data-placement="top" data-original-title="Xóa"
                            onclick="removeFoodUpdateGiftMarketing($(this))" data-id="${$(this).find(':selected').val()}"
                            data-name="${$(this).find(':selected').text()}"><i class="fi-rr-trash"></i></button>
                        </div>`
        });
        $('#value-food-update-gift-marketing').find(':selected').remove();
        $('#value-food-update-gift-marketing').val('').trigger('change');
    })

    $('#value-food-update-gift-marketing').select2({
        dropdownParent: $('#modal-update-gift-marketing'),
        templateResult: function (idioma) {
            if (!idioma.loading && idioma.disabled && idioma.text !== 'Vui lòng chọn') {
                let $span = $(`<span>${idioma.text}</span> <span class="text-danger" style="font-weight: 500">Món ăn chưa gán bếp</span>`);
                return $span;
            } else {
                return idioma.text;
            }
        },
    });


    dateTimePickerHourTemplate($('#from-hour-update-gift-marketing'));
    dateTimePickerHourTemplate($('#to-hour-update-gift-marketing'));

    dataUpdateGiftMarketing(r.data('id'));
}

async function dataUpdateGiftMarketing(id) {
    let method = 'get',
        url = 'gift-marketing.data-update',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#select-branch-update-gift-marketing"),
        $("#thumbnail-gift-logo-update-gift-marketing"),
        $("#value-food-update-gift-marketing"),
        $("#table-food-update-gift-marketing"),

    ]);
    $('#name-update-gift-marketing').val(res.data.data.name);
    $('#description-update-gift-marketing').val(res.data.data.description);
    $('#day-update-gift-marketing').val(formatNumber(res.data.data.day));
    // $('#thumbnail-gift-logo-update-gift-marketing').attr('src', res.data.data.domain + res.data.data.logo);
    // $('#thumbnail-gift-logo-update-gift-marketing').attr('data-url-logo', res.data.data.logo);
    $('#thumbnail-gift-banner-update-gift-marketing').attr('data-url-banner', res.data.data.banner_url);
    $('#thumbnail-gift-banner-update-gift-marketing').attr('src', res.data.data.domain + res.data.data.banner_url);
    $('#select-type-update-gift-marketing').val(res.data.data.type).trigger('change.select2');
    $('#select-branch-update-gift-marketing').val(res.data.data.branches_id).trigger('change.select2');
    CKEDITOR.instances['description-update-gift-marketing'].setData(res.data.data.description);
    CKEDITOR.instances['content-update-gift-marketing'].setData(res.data.data.content);
    CKEDITOR.instances['term-update-gift-marketing'].setData(res.data.data.term);
    CKEDITOR.instances['use-guide-update-gift-marketing'].setData(res.data.data.use_guide);
    if (res.data.data.day_of_weeks.length === 0) {
        $('#type-day-update-gift-marketing input[value="0"]').click();
        $('#div-type-day-update-gift-marketing').addClass('d-none');
    } else {
        $('#type-day-update-gift-marketing input[value="1"]').click();
        $('#div-type-day-update-gift-marketing').removeClass('d-none');
        $('#day-of-week-update-gift-marketing').val(res.data.data.day_of_weeks).trigger('change.select2');
    }
    if (res.data.data.from_hour === res.data.data.to_hour) {
        $('#type-hour-update-gift-marketing input[value="0"]').click();
        $('#div-type-hour-update-gift-marketing').addClass('d-none');
    } else {
        $('#type-hour-update-gift-marketing input[value="1"]').click();
        $('#div-type-hour-update-gift-marketing').removeClass('d-none');
        $('#from-hour-update-gift-marketing').val(res.data.data.from_hour);
        $('#to-hour-update-gift-marketing').val(res.data.data.to_hour);
    }
    if (res.data.data.type == 0) {
        // await loadDataFoodUpdateGiftMarketing();
        $('#value-food-update-gift-marketing').html(foodsInit);
        let foodSelected = res.data.data.foods.map(v => v.id);
        $('#value-food-update-gift-marketing').find('option').each((i, v) => {
            if($.inArray(Number($(v).val()), foodSelected) !== -1) {
                $(v).remove();
            }
        })
        $('#value-food-update-gift-marketing').val('').trigger('change');
        $('#div-value-point-update-gift-marketing').addClass('d-none');
        $('#div-value-food-update-gift-marketing').removeClass('d-none');
        $('#value-food-update-gift-marketing').val(res.data.data.food_id).trigger('change.select2');
        drawTableFoodUpdateGiftMarketing(res.data.data.food.original.data);
    } else {
        $('#div-value-food-update-gift-marketing').addClass('d-none');
        $('#div-value-point-update-gift-marketing').removeClass('d-none');
        $('#value-point-update-gift-marketing').val(formatNumber(res.data.data.gift_object_value
        ));
    }
}

async function drawTableFoodUpdateGiftMarketing(data) {
    let id = $('#table-food-update-gift-marketing'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'restaurant_material_name', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    tableFoodUpdateGiftMarketing = await DatatableTemplateNew(id, data, column, '40vh', fixed_left, fixed_right);
}

function removeFoodUpdateGiftMarketing(r) {
    $('#value-food-update-gift-marketing').append(`<option value="${r.data('id')}">${r.data('name')}</option>`);
    removeRowDatatableTemplate(tableFoodUpdateGiftMarketing, r, true);
}

// async function loadDataFoodUpdateGiftMarketing() {
//     if (checkDataFoodUpdateGiftMarketing === 0) {
//         let brand = $('#restaurant-branch-id-selected span').attr('data-value');
//         // if (checkEmptyTemplate() === false) return false;
//         let method = 'get',
//             url = 'gift-marketing.food',
//             params = null,
//             data = {
//                 brand: brand,
//             };
//         let res = await axiosTemplate(method, url, params, data);
//         checkDataFoodUpdateGiftMarketing = 1;
//         $('#value-food-update-gift-marketing').html(res.data[0]);
//     }
// }

async function saveModalUpdateGiftMarketing() {
    if (checkSaveUpdateGiftMarketing === 1) return false;
    if (!checkValidateSave($('#modal-update-gift-marketing'))) return false;
    let name = $('#name-update-gift-marketing').val(),
        type = $('#select-type-update-gift-marketing :selected').val(),
        value = removeformatNumber($('#value-point-update-gift-marketing').val()),
        brand = $('.select-brand').val(),
        day = removeformatNumber($('#day-update-gift-marketing').val()),
        logo = $('#thumbnail-gift-logo-update-gift-marketing').data('url-logo'),
        banner = $('#thumbnail-gift-banner-update-gift-marketing').attr('data-url-banner'),
        description = CKEDITOR.instances['description-update-gift-marketing'].getData(),
        content = CKEDITOR.instances['content-update-gift-marketing'].getData(),
        term = CKEDITOR.instances['term-update-gift-marketing'].getData(),
        guide = CKEDITOR.instances['use-guide-update-gift-marketing'].getData(),
        branch = $('#select-branch-update-gift-marketing').val(),
        day_of_weeks = $('#day-of-week-update-gift-marketing').val(),
        from_hour = $('#from-hour-update-gift-marketing').val(),
        to_hour = $('#to-hour-update-gift-marketing').val(),
        foods = [];
    if ($('#type-day-update-gift-marketing :checked').val() === '0') {
        day_of_weeks = [];
    }
    if ($('#type-hour-update-gift-marketing :checked').val() === '0') {
        from_hour = '';
        to_hour = '';
    }
    if (type == 0) {
        await tableFoodUpdateGiftMarketing.rows().every(function (index, element) {
            let x = $(this.node());
            foods.push({
                'food_id': x.find('td:eq(3) button').data('id'),
                'quantity': removeformatNumber(x.find('td:eq(2) input').val()),
            });
        });
        if (foods.length === 0) {
            WarningNotify('Vui lòng chọn món ăn để tặng !');
            return false;
        }
    } else {
        value = removeformatNumber($('#value-point-update-gift-marketing').val());
    }
    let method = 'post',
        url = 'gift-marketing.update',
        params = null,
        data = {
            id: thisUpdateGiftMarketing.data('id'),
            name: name,
            type: type,
            value: value,
            day: day,
            description: description,
            logo: logo,
            brand: brand,
            banner: banner,
            content: content,
            term: term,
            guide: guide,
            branch_ids: branch,
            day_of_weeks: day_of_weeks,
            from_hour: from_hour,
            to_hour: to_hour,
            foods: foods,
        };
    checkSaveUpdateGiftMarketing = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#loading-update-gift-marketing")]);
    checkSaveUpdateGiftMarketing = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            drawDataUpdateGiftMarketing(res.data.data);
            closeModalUpdateGiftMarketing();
            $('#value-food-update-gift-marketing').html(foodsInit);
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

function drawDataUpdateGiftMarketing(data) {
    let x = thisUpdateGiftMarketing.parents('tr')
    x.find('td:eq(1)').html(data.name)
    x.find('td:eq(2)').html(data.type)
    x.find('td:eq(3)').html(data.value)
    x.find('td:eq(4)').html(data.day)
    x.find('td:eq(5)').html(data.action)

}

function closeModalUpdateGiftMarketing() {
    $('#modal-update-gift-marketing').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateGiftMarketing();
    });
    $('#name-update-gift-marketing').val('');
    $('#select-type-update-gift-marketing').val(0).trigger('change.select2');
    $('#value-point-update-gift-marketing').val('0')
    $('#day-update-gift-marketing').val('1');
    $('#from-hour-update-gift-marketing').val('1');
    $('#to-hour-update-gift-marketing').val('1');
    $('#modal-update-gift-marketing textarea').val('');
    CKEDITOR.instances['description-update-gift-marketing'].setData('');
    CKEDITOR.instances['content-update-gift-marketing'].setData('');
    CKEDITOR.instances['term-update-gift-marketing'].setData('');
    CKEDITOR.instances['use-guide-update-gift-marketing'].setData('');
    $('#modal-update-gift-marketing .js-example-basic-single').val([]).trigger('change.select2');
    $('#value-food-update-gift-marketing').val('').trigger('change.select2');
    $('#type-day-update-gift-marketing input[value="0"]').click();
    $('#div-type-day-update-gift-marketing').addClass('d-none');
    $('#type-hour-update-gift-marketing input[value="0"]').click();
    // $('#div-type-hour-update-gift-marketing').addClass('d-none');
    // tableFoodUpdateGiftMarketing.clear().draw(false);
    $('#thumbnail-gift-banner-update-gift-marketing').attr('src', '');
    $('#thumbnail-gift-banner-update-gift-marketing').attr('data-url-banner', '');
    $('#value-food-update-gift-marketing').html(foodsInit);
}
