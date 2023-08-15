let checkSaveCreateGiftMarketing = 0, checkDataFoodCreateGiftMarketing = 0, tableFoodCreateGiftMarketing;
let dataCreateImageUploadGiftMarketing, dataCreateImageUploadBannerGiftMarketing;
$(function () {
    ckEditorTemplate(['detail-create-one-get-one-campaign']);
    $('#upload-gift-banner-create-gift-marketing').on('change', async function () {
        dataCreateImageUploadBannerGiftMarketing = $(this).prop('files')[0];
        switch((dataCreateImageUploadBannerGiftMarketing.type).slice(6)) {
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
        $('#thumbnail-gift-banner-create-gift-marketing').attr('src', url_image);
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        $('#thumbnail-gift-banner-create-gift-marketing').attr('data-url-avt', data.data[0]);
        $('#thumbnail-gift-banner-create-gift-marketing').attr('data-url-thumb', data.data[1]);
        $(this).replaceWith($(this).val('').clone(true));
    })
})
function openModalCreateGiftMarketing() {
    $('#modal-create-gift-marketing').modal('show');
    shortcut.add('F4', function () {
        saveModalCreateGiftMarketing();
    });
    shortcut.add('ESC', function () {
        closeModalCreateGiftMarketing();
    });
    $('#modal-create-gift-marketing .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-gift-marketing')
    });
    let branchOption = $.trim($('#div-layout-gift-marketing .tab-pane.active .select-branch').html());
    $('#select-branch-create-gift-marketing').html(branchOption);
    $('#select-branch-create-gift-marketing').val('').trigger('select2:select');
    $("#select-type-create-gift-marketing").unbind("select2:select").on("select2:select", function () {
        if ($(this).val() == 0) {
            $('#div-value-point-create-gift-marketing').addClass('d-none');
            $('#div-value-food-create-gift-marketing').removeClass('d-none');
        } else {
            $('#div-value-food-create-gift-marketing').addClass('d-none');
            $('#div-value-point-create-gift-marketing').removeClass('d-none');
        }
    });

    $('#modal-create-gift-marketing input').on('focus', function () {
        $(this).select();
    })

    $('#type-day-create-gift-marketing input').on('change', function () {
        if ($(this).val() === '0') {
            $('#div-type-day-create-gift-marketing').addClass('d-none');
        } else {
            $('#div-type-day-create-gift-marketing').removeClass('d-none');
        }
    })
    $('#div-type-hour-create-gift-marketing input').prop('disabled', true);
    $('#type-hour-create-gift-marketing input').on('change', function () {
        if ($(this).val() === '0') {
            $('#div-type-hour-create-gift-marketing input').prop('disabled', true);
        } else {
            $('#div-type-hour-create-gift-marketing input').prop('disabled', false);
        }
    })

    $('#value-food-create-gift-marketing').unbind('select2:select').on('select2:select', async function () {
        let idSelected = $(this).find(':selected').val();
        await addRowDatatableTemplate(tableFoodCreateGiftMarketing, {
            'DT_RowIndex': tableFoodCreateGiftMarketing.length,
            'name': $(this).find(':selected').text(),
            'quantity': '<div class="input-group border-group validate-table-validate">' +
                '  <input class="form-control adjustment text-right rounded border-0 w-100" data-max=”1000000” data-value-min-value-of=”1” data-type="currency-edit" value="1" data-float="1" data-table="1">' +
                '</div>',
            'action': `<div class="btn-group-sm">
                            <button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light"
                            data-toggle="tooltip" data-placement="top" data-original-title="Xóa"
                            onclick="removeFoodCreateGiftMarketing($(this))" data-id="${idSelected}"
                            data-name="${$(this).find(':selected').text()}"><i class="fi-rr-trash"></i></button>
                        </div>`
        });
        $(this).find('option').each((i, v) => {
            if (Number($(v).val()) === +idSelected) {
                $(v).remove();
                $('#value-food-create-gift-marketing').val('').trigger('chosen:update');
            }
        });
        // $('#day-create-gift-marketing').scrollIntoView()
        // $('#value-food-create-gift-marketing').find(':selected').remove();
        // $('#value-food-create-gift-marketing').val('').trigger('change');
    })

    $('#value-food-create-gift-marketing').select2({
        dropdownParent: $('#modal-create-gift-marketing'),
        templateResult: function (idioma) {
            if (!idioma.loading && idioma.disabled && idioma.text !== 'Vui lòng chọn') {
                let $span = $(`<span>${idioma.text}</span> <span class="text-danger" style="font-weight: 500">Món ăn chưa gán bếp</span>`);
                return $span;
            } else {
                return idioma.text;
            }
        },
    });

    dateTimePickerHourTemplate($('#from-hour-create-gift-marketing'));
    dateTimePickerHourTemplate($('#to-hour-create-gift-marketing'));
    drawTableFoodCreateGiftMarketing()
    // loadDataFoodCreateGiftMarketing();
}

async function drawTableFoodCreateGiftMarketing() {
    let id = $('#table-food-create-gift-marketing'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'restaurant_material_name', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    tableFoodCreateGiftMarketing = await DatatableTemplateNew(id, [], column, '40vh', fixed_left, fixed_right);
}

function removeFoodCreateGiftMarketing(r) {
    $('#value-food-create-gift-marketing').append(`<option value="${r.data('id')}">${r.data('name')}</option>`);
    removeRowDatatableTemplate(tableFoodCreateGiftMarketing, r, true);
}

// async function loadDataFoodCreateGiftMarketing() {
//     if (checkDataFoodCreateGiftMarketing === 0) {
//         let brand = $('#restaurant-branch-id-selected span').attr('data-value');
//         let method = 'get',
//             url = 'gift-marketing.food',
//             params = {
//                 brand: brand,
//             },
//             data = null;
//         let res = await axiosTemplate(method, url, params, data,[
//             $("#select-branch-create-gift-marketing"),
//             $("#value-food-create-gift-marketing"),
//             $("#table-food-create-gift-marketing"),
//         ]);
//         checkDataFoodCreateGiftMarketing = 1;
//         $('#value-food-create-gift-marketing').html(res.data[0]);
//     }
// }

async function saveModalCreateGiftMarketing() {
    if (checkSaveCreateGiftMarketing === 1) return false;
    if (!checkValidateSave($('#modal-create-gift-marketing'))) return false;
    // let brand = $('#restaurant-branch-id-selected span').attr('data-value'),
    let brand = $('.select-brand').val(),
        name = $('#name-create-gift-marketing').val(),
        type = $('#select-type-create-gift-marketing').val(),
        value = $('#value-point-create-gift-marketing').val(),
        day = removeformatNumber($('#day-create-gift-marketing').val()),
        description = CKEDITOR.instances['description-create-gift-marketing'].getData(),
        logo = !$('#thumbnail-gift-logo-create-gift-marketing').attr('data-url-avt') ? '/images/tms/default.jpeg' : $('#thumbnail-gift-logo-create-gift-marketing').attr('data-url-avt') ,
        banner = !$('#thumbnail-gift-banner-create-gift-marketing').attr('data-url-avt') ? '/images/tms/default.jpeg' : $('#thumbnail-gift-banner-create-gift-marketing').attr('data-url-avt'),
        branch = $('#select-branch-create-gift-marketing').val(),
        day_of_weeks = $('#day-of-week-create-gift-marketing').val(),
        from_hour = $('#from-hour-create-gift-marketing').val(),
        to_hour = $('#to-hour-create-gift-marketing').val(),
        content = CKEDITOR.instances['content-create-gift-marketing'].getData(),
        term = CKEDITOR.instances['term-create-gift-marketing'].getData(),
        guide = CKEDITOR.instances['use-guide-create-gift-marketing'].getData(),
        foods = [];
    if ($('#type-day-create-gift-marketing :checked').val() === '0') {
        day_of_weeks = [];
    }
    if ($('#type-hour-create-gift-marketing :checked').val() === '0') {
        from_hour = '';
        to_hour = '';
    }
    if (type == 0) {
        await tableFoodCreateGiftMarketing.rows().every(function (index, element) {
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
        value = removeformatNumber($('#value-point-create-gift-marketing').val());
    }
    let method = 'post',
        url = 'gift-marketing.create',
        params = null,
        data = {
            brand: brand,
            name: name,
            type: type,
            value: value,
            day: day,
            description: description,
            logo: logo,
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
    checkSaveCreateGiftMarketing = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#loading-create-gift-marketing")]);
    checkSaveCreateGiftMarketing = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            drawDataCreateGiftMarketing(res.data.data);
            closeModalCreateGiftMarketing();
            $('#value-food-create-gift-marketing').html(foodsInit);
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

function drawDataCreateGiftMarketing(data) {
    $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
    addRowDatatableTemplate(tableEnableGiftMarketing, {
        'logo': data.logo,
        // 'name': data.name,
        'type': data.type,
        'value': data.value == 1 ? formatNumber(data.gift_object_quantity) : data.value,
        'day': data.day,
        'action': data.action,
        'keysearch': data.keysearch,
    });
}

function closeModalCreateGiftMarketing() {
    $('#modal-create-gift-marketing').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    reloadModalCreateGiftMarketing()
}

function reloadModalCreateGiftMarketing(){
    $('#name-create-gift-marketing').val('')
    $('#select-type-create-gift-marketing').val($('#select-type-create-gift-marketing').find('option:first-child').val()).trigger('change.select2')
    $('#value-food-create-gift-marketing').val($('#value-food-create-gift-marketing').find('option:first-child').val()).trigger('change.select2')
    $('#day-create-gift-marketing').val('')
    $('#value-point-create-gift-marketing').val('')
    $('#from-hour-create-gift-marketing').val('00')
    $('#to-hour-create-gift-marketing').val('00')
    $('#day-create-gift-marketing').val(1)
    $('#day-of-week-create-gift-marketing').val([]).trigger('change.select2');
    $('#div-type-day-create-gift-marketing').addClass('d-none');
    // $('#div-type-hour-create-gift-marketing').addClass('d-none')
    $('#div-value-point-create-gift-marketing').addClass('d-none')
    $('#div-value-food-create-gift-marketing').removeClass('d-none');
    tableFoodCreateGiftMarketing.clear().draw(false);
    $('#thumbnail-gift-logo-create-gift-marketing').attr('src', '');
    $('#thumbnail-gift-banner-create-gift-marketing').attr('data-url-avt', '');
    $('#thumbnail-gift-banner-create-gift-marketing').attr('data-url-thumb', '');
    $('#thumbnail-gift-banner-create-gift-marketing').attr('src', '');
    $('#select-branch-create-gift-marketing').val([]).trigger('change.select2');
    $('#type-day-create-gift-marketing input[name="day-create"][value="0"]').prop("checked",true)
    $('#type-hour-create-gift-marketing input[name="hour-create"][value="0"]').prop("checked",true)
    CKEDITOR.instances['description-create-gift-marketing'].setData('');
    CKEDITOR.instances['content-create-gift-marketing'].setData('');
    CKEDITOR.instances['use-guide-create-gift-marketing'].setData('');
    CKEDITOR.instances['term-create-gift-marketing'].setData('');
    $('#value-food-create-gift-marketing').html(foodsInit);
}
