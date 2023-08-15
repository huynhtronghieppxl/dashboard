let checkSaveComboFoodMange = 0, dataCreateFoodComboImageUpload,checkNoteFoodComboBrandManage = 0;

$(function () {
    $('#price-create-combo-brand-manage').on('input', function () {
        $('#profit-create-combo-food-brand-manage').val(formatNumber(removeformatNumber($(this).val()) - removeformatNumber($('#original-create-food-combo-brand-manage').val())));
        if (removeformatNumber($(this).val()) > 0) {
            let giaBan = Number(removeformatNumber($(this).val()))
            let giaVon = Number(removeformatNumber($('#original-create-food-combo-brand-manage').val()))
            $('#profit-margin-create-combo-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")

        } else {
            $('#profit-margin-create-combo-food-brand-manage').text("0%")
        }
    });

    $(document).on('input', '#modal-create-food-combo-brand-manage input[type="text"]', function () {
        $('#modal-create-food-combo-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('input', '#modal-create-food-combo-brand-manage textarea', function () {
        $('#modal-create-food-combo-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('change', '#modal-create-food-combo-brand-manage select', function () {
        $('#modal-create-food-combo-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('change', '#modal-create-food-combo-brand-manage input[type="checkbox"]', function () {
        $('#modal-create-food-combo-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('change', '#modal-create-food-combo-brand-manage input[type="radio"]', function () {
        $('#modal-create-food-combo-brand-manage .btn-renew').removeClass('d-none');
    })

    $('#unit-create-food-brand-manage').on('change', function () {
        if ($(this).val() !== null) {
            $('#unit-create-food-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
        }
    })
    $('#category-create-food-brand-manage').on('change', function () {
        if ($(this).val() !== null) {
            $('#category-create-food-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
        }
    })

    $('#vat-create-food-brand-manage').on('change', function () {
        if ($(this).val() !== null) {
            $('#vat-create-food-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
        }
    })

    $('#unit-create-food-combo-brand-manage').on('change', function () {
        if ($(this).val() !== null) {
            $('#unit-create-food-combo-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
        }
    })

    $('#vat-create-combo-food-combo-brand-manage').on('change', function () {
        if ($(this).val() !== null) {
            $('#vat-create-combo-food-combo-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
        }
    })

    $('#category-create-food-combo-brand-manage').on('change', function () {
        if ($(this).val() !== null) {
            $('#category-create-food-combo-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
        }
    })

});

async function openModalCreateFoodComboManage() {
    shortcut.remove('F2');
    resetModalCreateFoodComboManage()
    $('#modal-create-food-combo-brand-manage').modal('show');
    shortcut.add('F4', function () {
        saveComboFoodCreateFoodBrandManage();
    });
    shortcut.add('ESC', function () {
        closeModalCreateFoodComboManage();
    });
    $('#unit-create-food-combo-brand-manage, #category-create-food-combo-brand-manage, #select-food-in-combo-create-food-brand-manage, #vat-create-combo-food-combo-brand-manage, #note-combo-food-brand-manage').select2({
        dropdownParent: $('#modal-create-food-combo-brand-manage'),
    });
    $('#price-create-combo-brand-manage').val('1,000')
    $('#unit-create-food-combo-brand-manage').html(dataUnitFoodData);
    $('#category-create-food-combo-brand-manage').html(dataCategoryFoodNotDrinkOtherData);
    $('#select-food-in-combo-create-food-brand-manage').html(dataListFood);
    await dataComboFoodBrandManage();
    if(checkNoteFoodComboBrandManage == 1) return false;
    await foodNote();
    checkNoteFoodComboBrandManage = 1;
    dataCreateFoodManage();
    if (!$('#additional-create-food-brand-manage').length)
        $('#additional-create-food-brand-manage').html(dataAdditionFoodCreateFoodManage);
    $('#note-combo-food-brand-manage').html(dataFoodNote);
    $('#vat-create-combo-food-combo-brand-manage').html(dataVatFoodData);
    $('#select-food-in-combo-create-food-brand-manage').unbind('select2:select').on('select2:select', function () {
        let sell_by_weight = $(this).find(':selected').data('weight') == 1 ? 'data-float="1"' : 'data-number="1"'
        addRowDatatableTemplate(dataTableComboFoodBrandManage, {
            'name': '<label>' + $(this).find(':selected').text() + '</label><input value="' + $(this).find(':selected').val() + '" class="d-none"/>',
            'quantity': '<div class="input-group border-group validate-table-validate">' +
                '<input data-value="1" value="1" ' + sell_by_weight + ' data-min="1" data-max="50" class="form-control adjustment text-center quantity-food-combo border-0 w-100 rounded"/>' +
                '</div>',
            'original_price': '<label>' + $(this).find(':selected').data('original-price') + '</label>',
            'total_price': '<label>' + $(this).find(':selected').data('original-price') + '</label>',
            'action': '<div class="btn-group btn-group-sm text-center">' +
                '    <button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="removeFoodDetailComboCreateFoodManage($(this))" data-toggle="tooltip" data-original-title="Xoá" data-placement="top"><span class="fi-rr-trash"></span></button>' +
                '</div> ',
            'keysearch': removeVietnameseStringLowerCase($(this).find(':selected').text() + $(this).find(':selected').data('original-price'))
        });
        $('#select-food-in-combo-create-food-brand-manage').find(':selected').remove();
        $('#select-food-in-combo-create-food-brand-manage').val('').trigger('change.select2');
        sumOriginalPrice();
    });
    $(document).on('input', '.quantity-food-combo', function () {
        $(this).parents('tr').find('td:eq(3)').find('label').text(formatNumber(Number(removeformatNumber($(this).parents('tr').find('td:eq(1)').text())) * Number(removeformatNumber($(this).val()))));
        sumOriginalPrice();
    })
    $('#price-create-combo-brand-manage').on('input paste', function () {
        let original = removeformatNumber($('#original-create-food-combo-brand-manage').val());
        let price = removeformatNumber($('#price-create-combo-brand-manage').val());
        $('#profit-create-combo-food-brand-manage').val(formatNumber(Number(price) - Number(original)));
        // $('#point-create-combo-food-brand-manage').text(formatNumber(parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())));
        $('#point-create-combo-food-brand-manage').text(formatNumber((parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())).toFixed(0).replace('.00' , '')));

    })
    $('#input-picture-create-food-combo-brand-manage').on('change', async function () {
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        dataCreateFoodComboImageUpload = $(this).prop('files')[0];
        switch ((dataCreateFoodComboImageUpload.type).slice(6)) {
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
        $('#picture-create-food-combo-brand-manage').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        urlAvatarCreateFood = data.data[0]
        // $('#picture-create-food-combo-brand-manage').attr('data-url-avt', data.data[0]);
        $('#picture-create-food-combo-brand-manage').attr('data-url-thumb', data.data[1]);
        $(this).replaceWith($(this).val('').clone(true));
    });
    $('#name-create-food-combo-brand-manage').on('input paste', function () {
        let code = removeVietnameseStringLowerCase($(this).val());
        $('#code-create-food-combo-brand-manage').val(code.toUpperCase());
        $('#code-create-food-combo-brand-manage').parent().removeClass('validate-error');
        $('#code-create-food-combo-brand-manage').parents('.form-group').find('.error').remove();
    });
    $('#code-create-food-combo-brand-manage').on('input paste keyup', function () {
        let code = removeVietnameseStringLowerCase($(this).val());
        $(this).val(code.toUpperCase());
    })
    $('#point-create-combo-food-brand-manage').text(formatNumber(parseFloat(removeformatNumber($('#price-create-combo-brand-manage').val())) / parseFloat($('#point-ratio-food-server').val())));
    let giaBan = Number(removeformatNumber($('#price-create-combo-brand-manage').val()))
    let giaVon = Number(removeformatNumber($('#original-create-food-combo-brand-manage').val()))
    // $('#profit-margin-create-combo-food-brand-manage').text((((giaBan - giaVon) / giaBan) * 100).toFixed(2).replace('.00', '') + "%");
    $('#profit-margin-create-combo-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")

}

async function dataComboFoodBrandManage() {
    let id = $('#table-food-combo-create-food-brand-manage'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'original_price', name: 'original_price', className: 'text-right'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'total_price', name: 'total_price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ];
    dataTableComboFoodBrandManage = await DatatableTemplateNew(id, [], column, '20vh', fixed_left, fixed_right);
}

async function sumOriginalPrice() {
    let total = 0;
    await dataTableComboFoodBrandManage.rows().every(function () {
        let row = $(this.node());
        total += Number(removeformatNumber(row.find('td:eq(3)').find('label').text()));
    })
    $('#original-create-food-combo-brand-manage').val(formatNumber(total));
    let original = removeformatNumber($('#original-create-food-combo-brand-manage').val());
    let price = removeformatNumber($('#price-create-combo-brand-manage').val());
    // $('#profit-margin-create-combo-food-brand-manage').text((((price - original) / price) * 100).toFixed(2).replace('.00', '') + "%");
    $('#profit-margin-create-combo-food-brand-manage').text(formatNumber(((price - original) / price * 100).toFixed(2).replace('.00', ''))+ "%")
    $('#profit-create-combo-food-brand-manage').val(formatNumber(Number(price) - Number(original)));
    $('#tab-info-create-food-combo-manager #point-create-combo-food-brand-manage').val(formatNumber(parseFloat(removeformatNumber($('#tab-info-create-food-combo-manager #price-create-combo-brand-manage').val())) / parseFloat($('#point-ratio-food-server').val())));
}

function removeFoodDetailComboCreateFoodManage(r) {
    let name = r.parents('tr').find('td:eq(0)').find('label').text(),
        id = r.parents('tr').find('td:eq(0)').find('input').val(),
        original_price = r.parents('tr').find('td:eq(1)').find('label').text();
    $('#select-food-in-combo-create-food-brand-manage').append('<option value="' + id + '" data-original-price="' + original_price + '">' + name + '</option>');
    dataTableComboFoodBrandManage.row(r.parents('tr')).remove().draw(false);
    sumOriginalPrice();
}

async function closeModalCreateFoodComboManage() {
    $('#modal-create-food-combo-brand-manage').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateFoodComboManage();
    });
    dataTableComboFoodBrandManage.clear().draw(false);
    resetModalCreateFoodComboManage();
    countCharacterTextarea()
}

function resetModalCreateFoodComboManage() {
    $('#select-food-in-combo-create-food-brand-manage option').each(function () {
        if ($(this).attr('data-unit-type') == 'Kg') {
            $(this).remove();
        }
    })
    $('#point-create-combo-food-brand-manage').text('0');
    $("#take-away-create-food-combo-brand-manage input[type='radio'][value='0']").prop('checked', true);
    $('#profit-create-combo-food-brand-manage').val("1,000");
    $('#vat-create-combo-food-combo-brand-manage').val(null).trigger("change");
    $('#note-combo-food-brand-manage').val(null).trigger("change");
    $('#price-create-combo-brand-manage').val('0');
    $('#original-create-food-combo-brand-manage').val('0');
    if (!$('#additional-create-food-brand-manage').length)
        $('#additional-create-food-brand-manage').html(dataAdditionFoodCreateFoodManage);
    if (!$('#note-combo-food-brand-manage option').length)
        $('#note-combo-food-brand-manage').html(dataFoodNote);
    $('#name-create-food-combo-brand-manage').val('');
    $('#code-create-food-combo-brand-manage').val('');
    $('#description-create-food-combo-brand-manage').val('');
    $('#picture-create-food-combo-brand-manage').attr('src', 'images/food_file.jpg');
    $('#unit-create-food-combo-brand-manage').val(null).trigger('change');
    $('#category-create-food-combo-brand-manage').val(null).trigger('change');
    $('#select-food-in-combo-create-food-brand-manage').val(null).trigger('change');
    $('.btn-renew').addClass('d-none')
}


async function saveComboFoodCreateFoodBrandManage() {
    if (!checkValidateSave($('#tab-info-create-food-combo-manager'))) return false;
    if (checkSaveComboFoodMange != 0) return false;
    let food_in_combo = [];
    dataTableComboFoodBrandManage.rows().every(function () {
        let row = $(this.node());
        food_in_combo.push({
            "id": row.find('td:eq(0)').find('input').val(),
            "quantity": removeformatNumber(row.find('td:eq(2)').find('input').val()),
        });
    });

    let material = [];
    material.push({
        'material_id': $('#material-create-food-brand-manage').val(),
        'quantity': 1
    })
    let restaurant_vat_config_id = ($('#vat-create-combo-food-combo-brand-manage').val() !== null) ? $('#vat-create-combo-food-combo-brand-manage').val() : 0;
    let method = 'post',
        url = 'food-brand-manage.create',
        params = null,
        data = {
            brand: $('.select-brand').val(),
            list_branch_kitchen: [],
            category_id: $('#category-create-food-combo-brand-manage').val(),
            category_type: $('#category-create-food-combo-brand-manage option:selected').attr('data-id-category'),
            avatar: urlAvatarCreateFood,
            avatar_thumb: $('#picture-create-food-combo-brand-manage').data('url-thumb'),
            description: $('#description-create-food-combo-brand-manage').val(),
            name: $('#name-create-food-combo-brand-manage').val(),
            price: removeformatNumber($('#price-create-combo-brand-manage').val()),
            point_to_purchase: removeformatNumber($('#point-create-combo-food-brand-manage').text()),
            time_to_completed: removeformatNumber($('#time-create-food-brand-manage').val()),
            unit: $('#unit-create-food-combo-brand-manage').find('option:selected').text(),
            is_allow_print: $('#print-create-food-brand-manage').find('input[type="checkbox"]:checked').val(),
            code: $('#code-create-food-combo-brand-manage').val(),
            is_special_claim_point: Number($('#print-create-food-brand-manage').is(':checked')),
            is_sell_by_weight: $('#sell-by-create-food-brand-manage').find('input[type="radio"]:checked').val(),
            is_allow_review: Number($('#review-create-food-brand-manage').is(':checked')),
            is_allow_purchase_by_point: Number($('#party-create-food-brand-manage').is(':checked')),
            is_take_away: $('#take-away-create-food-combo-brand-manage').find('input[type="radio"]:checked').val(),
            is_addition: 0,
            food_material_type: 0,
            food_addition_ids: [],
            is_combo: 1,
            food_in_combo: food_in_combo,
            is_special_gift: 0,
            all_brand: $('#brand-create-food-combo-manage').find('input[type="radio"]:checked').val(),
            is_quantitative: Number($('#quantitative-create-food-brand-manage').is(':checked')),
            material: material,
            note_food: $('#note-combo-food-brand-manage').val(),
            original_price: removeformatNumber($('#original-create-food-combo-brand-manage').val()),
            restaurant_vat_config_id: restaurant_vat_config_id,
        };
    checkSaveComboFoodMange = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-food-combo-brand-manage')]);
    checkSaveComboFoodMange = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            await drawTableCreateFoodComboManage(res.data.data);
            closeModalCreateFoodComboManage();
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}

function drawTableCreateFoodComboManage(data) {
    let table = '';
    if (data.is_combo == 1) {
        $('#total-record-combo').text(formatNumber(Number($('#total-record-combo').text()) + 1));
        $('#tab-food-combo-data-5').click();
        table = dataTableFoodCombo;
    }
    addRowDatatableTemplate(table, {
        'name_avatar': '<img onerror="imageDefaultOnLoadError($(this))" src="' + url_image + '" class="img-inline-name-data-table">' +
            '<label class="name-inline-data-table">' + data.name + '<br>' +
            '<label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' + data.code + '</label>' +
            '</label>',
        'category_name': data.category_name,
        'price': '<label class="font-weight-bold">' + formatNumber(data.price) + '</label></br>' +
            '<label class="number-order"> Gốc: ' + data.original_price +
            '</label>',
        'vat': data.restaurant_vat_config_percent + '%',
        'original_revenue': '<label class="font-weight-bold">' + data.original_revenue_percent + '%</label></br>' +
            '<label class="number-order">TT: ' + data.original_revenue + '</label>',
        'profit_rate_by_original_price': data.profit_rate_by_original_price,
        'profit_rate_by_price': data.profit_rate_by_price,
        'keysearch': data.keysearch,
        'action': data.action,
    });
}
