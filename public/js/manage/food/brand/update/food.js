let checkSaveUpdateFoodBrandManage = 0,
    urlAvatarFood;

async function openModalUpdateFoodBrandManage(r) {
    $('#modal-update-food-brand-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('ESC', function () {
        closeModalUpdateFoodBrandManage()
    })
    shortcut.add('F4', function () {
        saveModalFoodUpdateFoodManage();
    });
    await dataFoodDetail(thisRowDataFaceFoodBrandManage.data('id'));
    if (material_food.length > 0) {
        $('#original-update-food-brand-manage').attr('disabled', true);
    } else {
        $('#original-update-food-brand-manage').removeAttr('disabled');
    }
    $('#print-kitchen-update-food-brand-manage').on('click', function () {
        if ($('#print-kitchen-update-food-brand-manage').is(':checked')) {
            $('#print-lake-update-food-brand-manage-div').removeClass('disabled')
            $('.print-lake-update-food-brand-manage-span').removeClass('disabled')
            $('#print-lake-update-food-brand-manage').prop('disabled', false)
        } else {
            $('.print-lake-update-food-brand-manage-span').addClass('disabled')
            $('#print-lake-update-food-brand-manage-div').addClass('disabled')
            $('#print-lake-update-food-brand-manage').prop('disabled', true)
            $('#print-lake-update-food-brand-manage').prop('checked', false)
        }
    })
    $('#additional-update-food-brand-manage').html(await foodOptionAdditionUpdate(categoryFoodUpdateManage));

    $('#picture-update-food-brand-manage').attr('data-url-avt', avatarFoodUpdateManage);
    $('#picture-update-food-brand-manage').attr('data-url-thumb', avatarThumpFoodUpdateManage);
    $('#picture-update-food-brand-manage').attr('src', avatarLinkFoodUpdateManage);
    $('#name-update-food-brand-manage').val(nameFoodUpdateManage);
    $('#price-update-food-brand-manage').val(priceFoodUpdateManage);
    $('#point-update-food-brand-manage').text(pointFoodUpdateManage);
    $('#time-update-food-brand-manage').val(timeFoodUpdateManage);
    $('#code-update-food-brand-manage').val(codeFoodUpdateManage);
    $('#update-cook-food-brand-manage input[name=cook][value=' + cookFoodUpdateManage + ']').prop('checked', true);
    $('#print-kitchen-update-food-brand-manage').prop('checked', printFoodUpdateManage);
    if ($('#print-kitchen-update-food-brand-manage').is(':checked')) {
        $('#print-tem-update-food-brand-manage-div, #print-lake-update-food-brand-manage-div').removeClass('disabled')
        $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').prop('disabled', false);
        $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').css('cursor', 'pointer');
        $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').removeClass('disabled')
    }
    else {
        $('#print-tem-update-food-brand-manage-div, #print-lake-update-food-brand-manage-div').addClass('disabled')
        $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').prop('disabled', true);
        $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').css('cursor', 'no-drop');
        $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').prop('checked', false);
    }
    $('#print-lake-update-food-brand-manage').prop('checked', printLakeFoodUpdateManage);
    $('#print-tem-update-food-brand-manage').prop('checked', printStampFoodUpdateManage);
    urlAvatarFood = avatarFoodUpdateManage
    if (sellByFoodUpdateManage === 0) {
        $('input[name=sell][value="1"]').parent().find('i').addClass('disabled');
        $('input[name=sell][value="0"]').parent().find('i').removeClass('disabled');
        $('input[name=sell][value="1"]').prop('disabled', true);
        $('input[name=sell][value="0"]').prop('disabled', false);
    } else {
        $('input[name=sell][value="0"]').parent().find('i').addClass('disabled');
        $('input[name=sell][value="1"]').parent().find('i').removeClass('disabled');
        $('input[name=sell][value="0"]').prop('disabled', true);
        $('input[name=sell][value="1"]').prop('disabled', false);
    }
    if (vatFoodUpdateManage !== 0) {
        $('#vat-update-food-brand-manage').val(vatFoodUpdateManage).trigger('change.select2');
    } else {
        $('#vat-update-food-brand-manage').html();
        $('#vat-update-food-brand-manage').find('option:first').trigger('change.select2');
    }
    $('#additional-update-food-brand-manage').val(foodListAdditionFoodUpdateManage).trigger('change.select2');
    $('#take-away-update-food-brand-manage input[name=take-food][value=' + takeAwayFoodUpdateManage + ']').prop('checked', true);
    $('#original-update-food-brand-manage').val(formatNumber(originalPriceFoodUpdateManage));
    $('#review-update-food-brand-manage').prop('checked', reviewFoodUpdateManage);
    $('#unit-update-food-brand-manage').val(unitFoodUpdateManage).trigger('change.select2');
    if ($('#unit-update-food-brand-manage').val() === null) {
        $('#unit-update-food-brand-manage').val(null).trigger('change.select2');
    }
    $('#combo-update-food-manage').text(unitFoodUpdateManage);
    $('#print-tem-update-food-brand-manage').prop('checked', printStampFoodUpdateManage)

    $('#description-update-food-brand-manage').val(descriptionFoodUpdateManage);
    countCharacterTextarea()
    $('#sell-by-update-food-brand-manage input[name=sell][value=' + sellByFoodUpdateManage + ']').prop('checked', true);
    if (sellByFoodUpdateManage == 1) {
        $('#print-lake-update-food-brand-manage-div').removeClass('d-none')
    } else {
        $('#print-lake-update-food-brand-manage-div').addClass('d-none')
    }
    $('#note-update-food-brand-manage').val(foodNoteFoodUpdateManage).trigger('change.select2');
    $('#category-update-food-brand-manage option').each(function () {
        if ($(this).attr('data-id-category') != category_type_id) {
            $(this).remove()
        }
    })
    if (categoryFoodUpdateManage !== 0)
        $('#category-update-food-brand-manage').val(categoryFoodUpdateManage).trigger('change.select2');
    $('#profit-update-food-brand-manage').val(formatNumber(Number(removeformatNumber($('#price-update-food-brand-manage').val())) - Number(removeformatNumber($('#original-update-food-brand-manage').val()))))
    $('#price-update-food-manage').on('input', function () {
        $('#point-update-food-manage').text((parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())).toFixed(0))
    });
    $('#price-update-food-brand-manage').on('input paste keyup', function () {
        // $('#point-update-food-brand-manage').text(formatNumber(parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())));
        $('#point-update-food-brand-manage').text(formatNumber((parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())).toFixed(0).replace('.00' , '')));
        $('#profit-update-food-brand-manage').val(formatNumber(parseFloat(removeformatNumber($(this).val())) - removeformatNumber($('#original-update-food-brand-manage').val())))
        if (removeformatNumber($('#price-update-food-brand-manage').val()) > 0) {
            let giaVon = Number(removeformatNumber($('#original-update-food-brand-manage').val()))
            let giaBan = Number(removeformatNumber($(this).val()))
            $('#profit-margin-update-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")
        }
    })
    $('#original-update-food-brand-manage').on('input paste keyup', function () {
        $('#profit-update-food-brand-manage').val(formatNumber(removeformatNumber($('#price-update-food-brand-manage').val()) - removeformatNumber($('#original-update-food-brand-manage').val())));
        if (removeformatNumber($('#original-update-food-brand-manage').val()) > 0) {
            let giaBan = Number(removeformatNumber($('#price-update-food-brand-manage').val()))
            let giaVon = Number(removeformatNumber($(this).val()))
            $('#profit-margin-update-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")
        }

    })
    let giaVon = Number(removeformatNumber($('#original-update-food-brand-manage').val()))
    let giaBan = Number(removeformatNumber($('#price-update-food-brand-manage').val()))
     $('#profit-margin-update-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")
    $('#point-update-food-brand-manage').text(formatNumber((parseFloat(giaBan) / parseFloat($('#point-ratio-food-server').val())).toFixed(0)));
    switch (category_type_id) {
        case 1:
            $('.class-check-food-update-brand-manage').prop('checked', true);
            $('#time-update-food-brand-manage').attr('disabled', false);
            $('#time-update-addition-food-brand-manage').attr('disabled', false);
            $('.class-check-food-update-brand-manage').attr('disabled', true);
            $('#option-update-not-cook-drink').addClass('d-none');
            $('#option-update-not-cook-other').addClass('d-none');
            $('#option-update-not-cook-food').removeClass('d-none');
            $('#option-update-not-cook-seafood').addClass('d-none');
            $('#option-addition-update-not-cook-drink').addClass('d-none');
            $('#option-addition-update-not-cook-other').addClass('d-none');
            $('#option-addition-update-not-cook-food').removeClass('d-none');
            $('#option-addition-update-not-cook-seafood').addClass('d-none');
            $('#check-additional-update-food-brand-manage').removeClass('d-none');
            $('#check-col-node-food-addition-update-food-brand-manage').removeClass('col-lg-12');
            $('#check-col-node-food-addition-update-food-brand-manage').addClass('col-lg-6');
            $('#sell-by-update-food-brand-manage').find('div:last-child').removeClass('d-none');
            $('#sell-by-update-food-brand-manage').parents('.class-addition-create-food-manage').removeClass('d-none');

            break;
        case 2:
            $('.class-check-food-update-brand-manage').prop('checked', false);
            $('#time-update-food-brand-manage').attr('disabled', true);
            $('#time-update-addition-food-brand-manage').attr('disabled', true);
            $('.class-check-food-update-brand-manage').attr('disabled', true);
            $('#option-update-not-cook-drink').removeClass('d-none');
            $('#check-additional-update-food-brand-manage').addClass('d-none');
            $('#option-update-not-cook-other').addClass('d-none');
            $('#option-update-not-cook-food').addClass('d-none');
            $('#option-update-not-cook-seafood').addClass('d-none');
            $('#option-addition-update-not-cook-drink').removeClass('d-none');
            $('#option-addition-update-not-cook-other').addClass('d-none');
            $('#option-addition-update-not-cook-food').addClass('d-none');
            $('#option-addition-update-not-cook-seafood').addClass('d-none');
            $('#check-col-node-food-addition-update-food-brand-manage').addClass('col-lg-12');
            $('#check-col-node-food-addition-update-food-brand-manage').removeClass('col-lg-6');
            $('#sell-by-update-food-brand-manage').find('div:last-child').addClass('d-none');
            $('#sell-by-update-food-brand-manage').parents('.class-addition-create-food-manage').addClass('d-none');
            break;
        case 3:
            $('.class-check-food-update-brand-manage').prop('checked', false);
            $('#time-update-food-brand-manage').attr('disabled', true);
            $('#time-update-addition-food-brand-manage').attr('disabled', true);
            $('.class-check-food-update-brand-manage').attr('disabled', true);
            $('#option-update-not-cook-drink').addClass('d-none');
            $('#option-update-not-cook-other').removeClass('d-none');
            $('#option-update-not-cook-food').addClass('d-none');
            $('#option-update-not-cook-seafood').addClass('d-none');
            $('#option-addition-update-not-cook-drink').addClass('d-none');
            $('#option-addition-update-not-cook-other').removeClass('d-none');
            $('#option-addition-update-not-cook-food').addClass('d-none');
            $('#option-addition-update-not-cook-seafood').addClass('d-none');
            $('#check-additional-update-food-brand-manage').removeClass('d-none');
            $('#check-col-node-food-addition-update-food-brand-manage').removeClass('col-lg-12');
            $('#check-col-node-food-addition-update-food-brand-manage').addClass('col-lg-6');
            $('#sell-by-update-food-brand-manage').find('div:last-child').addClass('d-none');
            $('#sell-by-update-food-brand-manage').parents('.class-addition-create-food-manage').addClass('d-none');
            break;
        case 4:
            $('.class-check-food-update-brand-manage').prop('checked', true);
            $('#time-update-food-brand-manage').attr('disabled', false);
            $('#time-update-addition-food-brand-manage').attr('disabled', false);
            $('.class-check-food-update-brand-manage').attr('disabled', true);
            $('#option-update-not-cook-drink').addClass('d-none');
            $('#option-update-not-cook-other').addClass('d-none');
            $('#option-update-not-cook-food').addClass('d-none');
            $('#option-update-not-cook-seafood').removeClass('d-none');
            $('#option-addition-update-not-cook-drink').addClass('d-none');
            $('#option-addition-update-not-cook-other').addClass('d-none');
            $('#option-addition-update-not-cook-food').addClass('d-none');
            $('#option-addition-update-not-cook-seafood').removeClass('d-none');
            $('#check-additional-update-food-brand-manage').removeClass('d-none');
            $('#check-col-node-food-addition-update-food-brand-manage').removeClass('col-lg-12');
            $('#check-col-node-food-addition-update-food-brand-manage').addClass('col-lg-6');
            $('#sell-by-update-food-brand-manage').find('div:last-child').removeClass('d-none');
            $('#sell-by-update-food-brand-manage').parents('.class-addition-create-food-manage').removeClass('d-none');
            break;
    }

}

function closeModalUpdateFoodBrandManage() {
    $('#modal-update-food-brand-manage').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    resetModalFoodUpdateBrandManage();
    removeAllValidate();
    countCharacterTextarea()
}

function resetModalFoodUpdateBrandManage() {
    $('#name-update-food-brand-manage').val('');
    $('#code-update-food-brand-manage').val('');
    $('#description-update-food-brand-manage').val('');
    $('#time-update-food-brand-manage').val(0);
    $('#original-update-food-brand-manage').val(0);
    $('#price-update-food-brand-manage').val(0);
    $('#profit-update-food-brand-manage').val(0);
    $('#unit-update-food-brand-manage').val(null).trigger('change.select2');
    $('#category-update-food-brand-manage').val(null).trigger('change.select2');
    $('#vat-update-food-brand-manage').val(null).trigger('change.select2');
    $('#note-update-food-brand-manage').val([]).trigger('change.select2');
    $('#additional-update-food-brand-manage').val([]).trigger('change.select2');
    $('#print-kitchen-update-food-brand-manage').prop('checked', false);
    $('#print-tem-update-food-brand-manage').prop('checked', false);
    $('#review-update-food-brand-manage').prop('checked', false);
    $('.class-check-food-update-brand-manage').prop('checked', false);
    $('#sell-by-update-food-brand-manage input[name=sell][value="0"]').prop('checked', true);
    $('#take-away-update-food-brand-manage input[name=take-food][value="0"]').prop('checked', true);
    $('#picture-update-food-brand-manage').attr('src', '/images/food_file.jpg')

}

async function saveModalFoodUpdateFoodManage() {
    if (checkSaveUpdateFoodBrandManage !== 0) return false;
    if ($('#category-update-food-brand-manage option:selected').data('id-category') === 2 ||
        $('#category-update-food-brand-manage option:selected').data('id-category') === 3) {
        $('#time-update-food-brand-manage').attr('data-number', '');
        $('#time-update-food-brand-manage').attr('data-min', '');
        $('#time-update-food-brand-manage').attr('data-max', '');
    } else if ($('#category-update-food-brand-manage option:selected').data('id-category') === 1 ||
        $('#category-update-food-brand-manage option:selected').data('id-category') === 4) {
        $('#time-update-food-brand-manage').attr('data-number', '1');
        $('#time-update-food-brand-manage').attr('data-min', '');
        $('#time-update-food-brand-manage').attr('data-max', '1440');
    }
    let noteUpdateFoodBrandManage = $('#note-update-food-brand-manage').val().map(Number);
    let additionalUpdateFoodBrandManage = $('#additional-update-food-brand-manage').val().map(Number);
    if (!checkValidateSave($('#tab-info-update-food-manager'))) return false;
    checkSaveUpdateFoodBrandManage = 1;
    let restaurant_brand_id = $('.select-brand').val(),
        name = $('#name-update-food-brand-manage').val(),
        code = $('#code-update-food-brand-manage').val(),
        unit = $('#unit-update-food-brand-manage :selected').text(),
        category_id = $('#category-update-food-brand-manage').val(),
        category_type_id = $('#category-update-food-brand-manage option:selected').data('id-category'),
        time_to_completed = removeformatNumber($('#time-update-food-brand-manage').val()),
        is_sell_by_weight = $('#sell-by-update-food-brand-manage').find('input[type="radio"]:checked').val(),
        price = removeformatNumber($('#price-update-food-brand-manage').val()),
        point_to_purchase = removeformatNumber($('#point-update-food-brand-manage').text()),
        description = $('#description-update-food-brand-manage').val(),
        food_addition_ids = $('#additional-update-food-brand-manage').val(),
        sale_online_status = $('#take-away-update-food-brand-manage').find('input[type="radio"]:checked').val(),
        is_special_claim_point,
        is_allow_purchase_by_point,
        is_addition = 0,
        is_combo = 0,
        is_special_gift = 0,
        is_allow_print_stamp = Number($('#print-tem-update-food-brand-manage').is(':checked')),
        food_material_type = 0,
        food_in_combo = [],
        original_price = $('#original-update-food-brand-manage').val(),
        noteFoods = $('#note-update-food-brand-manage').val();
    ($('#print-kitchen-update-food-brand-manage').is(':checked') === true) ? is_special_claim_point = 1 : is_special_claim_point = 0;
    ($('#review-update-food-brand-manage').is(':checked') === true) ? is_allow_review = 1 : is_allow_review = 0;
    ($('#party-update-food-brand-manage').is(':checked') === true) ? is_allow_purchase_by_point = 1 : is_allow_purchase_by_point = 0;
    ($('#print-kitchen-update-food-brand-manage').is(':checked') === true) ? is_allow_print = 1 : is_allow_print = 0;
    ($('#print-lake-update-food-brand-manage').is(':checked') === true) ? is_allow_print_fishbowl = 1 : is_allow_print_fishbowl = 0;
    let noteInsertFoods = noteFoods.filter(o1 => !foodNoteFoodUpdateManage.some(o2 => o1 == o2));
    let interestFoods = noteInsertFoods.map(function (str) {
        return parseInt(str);
    })
    let noteDeleteFoods = foodNoteFoodUpdateManage.filter(o1 => !noteFoods.some(o2 => o1 == o2));
    if(nameFoodUpdateManage == name
        && unitFoodUpdateManage == unit
        && categoryFoodUpdateManage == $('#category-update-food-brand-manage option:selected').val()
        && compareArray(foodNoteFoodUpdateManage,noteUpdateFoodBrandManage)
        && compareArray(foodListAdditionFoodUpdateManage,additionalUpdateFoodBrandManage)
        && timeFoodUpdateManage == $('#time-update-food-brand-manage').val()
        && descriptionFoodUpdateManage == description
        && sellByFoodUpdateManage == is_sell_by_weight
        && originalPriceFoodUpdateManage == removeformatNumber(original_price)
        && removeformatNumber(priceFoodUpdateManage) == price
        && pointFoodUpdateManage == point_to_purchase
        && reviewFoodUpdateManage == is_allow_review
        && dataTableInComboUpdateFoodBrandManage.data[0].category_type_id == category_type_id
        && printStampFoodUpdateManage == is_allow_print_stamp
        && printFoodUpdateManage == is_special_claim_point
        && takeAwayFoodUpdateManage == sale_online_status
        && printLakeFoodUpdateManage == is_allow_print_fishbowl
        && avatarFoodUpdateManage == $('#picture-update-food-brand-manage').attr('data-url-avt')
        && ($('#vat-update-food-brand-manage').val() == null || vatFoodUpdateManage == $('#vat-update-food-brand-manage').val())){
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalUpdateFoodBrandManage();
        checkSaveUpdateFoodBrandManage = 0;
        return false;
    }

    switch (typeUpdateFoodBrandManage) {
        case 2:
            is_combo = 1;
            food_addition_ids = [];
            $('#table-food-combo-combo-update-food-manage tbody tr').each(function (row, tr) {
                food_in_combo[row] = {
                    "id": $(tr).find('td:eq(0)').find('input').val(),
                    "quantity": $(tr).find('td:eq(1)').find('input').val(),
                };
            });
            break;
        case 3:
            is_addition = 1;
            food_addition_ids = [];
            break;
        case 4:
            is_special_gift = 1;
            food_addition_ids = [];
            break;
    }
    let method = 'post',
        url = 'food-brand-manage.update',
        params = null,
        data = {
            restaurant_brand_id: restaurant_brand_id,
            list_branch_kitchen_update: list_branch_kitchen,
            id: id_update_food_brand_manage,
            category_id: category_id,
            avatar: urlAvatarFood,
            avatar_thumb: $('#picture-update-food-brand-manage').data('url-thumb'),
            description: description,
            name: name,
            status: status_update_food_brand_manage,
            price: removeformatNumber(price),
            point_to_purchase: removeformatNumber(point_to_purchase),
            unit: unit,
            code: code,
            is_allow_review: is_allow_review,
            is_addition: is_addition,
            food_addition_ids: food_addition_ids,
            is_combo: is_combo,
            food_in_combo: food_in_combo,
            time_to_completed: time_to_completed,
            is_allow_print: is_allow_print,
            is_allow_print_fishbowl: is_allow_print_fishbowl,
            is_special_claim_point: is_special_claim_point,
            is_sell_by_weight: is_sell_by_weight,
            is_allow_purchase_by_point: is_allow_purchase_by_point,
            food_material_type: food_material_type,
            is_special_gift: is_special_gift,
            note_food: interestFoods,
            restaurant_vat_config_id: $('#vat-update-food-brand-manage ').val(),
            original_price: removeformatNumber(original_price),
            delete_Foods: noteDeleteFoods,
            category_type_id: category_type_id,
            sale_online_status: sale_online_status,
            is_allow_print_stamp: is_allow_print_stamp,
            temporary_price_from_date: temporaryPriceFromDate,
            temporary_price_to_date: temporaryPriceToDate,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#tab-info-update-food-manager')
    ]);
    checkSaveUpdateFoodBrandManage = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            let x = String(thisRowDataFaceFoodBrandManage.parents('td').data('dt-row')).slice(-2);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.DTFC_LeftWrapper').find('tbody tr:eq(' + x + ')').find('td:eq(1)').find('img').attr('src', res.data.data.avatar);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.DTFC_LeftWrapper').find('tbody tr:eq(' + x + ')').find('td:eq(1)').find('img').attr('onclick', 'modalImageComponent("' + res.data.data.avatar + '")');
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.DTFC_LeftWrapper').find('tbody tr:eq(' + x + ')').find('td:eq(2)').text(res.data.data.name);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(4)').text(res.data.data.category_name);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(5)').text(res.data.data.original_price);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(6)').text(res.data.data.price);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(7)').text(res.data.data.point_to_purchase);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(8)').html(res.data.data.vat);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(9)').html(res.data.data.original_revenue);
            closeModalUpdateFoodBrandManage();
            window.location.pathname === '/food-data' ? foodBuildData() : loadDataEnableFoodBrandManage()

            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}

function compareArray(arr1, arr2) {
    if (arr1.length !== arr2.length) {
        return false;
    }

    var areEqual = true;
    $.each(arr1, function(index, value) {
        if (value !== arr2[index]) {
            areEqual = false;
            return false;
        }
    });
    return true;
}
