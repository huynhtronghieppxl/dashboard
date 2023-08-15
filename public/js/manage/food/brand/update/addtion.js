let checkSaveUpdateAdditionFoodBrandManage = 0, dataUpdateFoodAdditionImageUpload,
    urlAvatarAdditionFood;
async function openModalAdditionUpdateFoodManage(){
    $('#modal-update-addition-food-brand-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('ESC', function (){
        closeModalAdditionUpdateFoodManage();
    });
    shortcut.add('F4', function (){
        saveModalAdditionUpdateFoodManage();
    });
    $('#sell-by-update-addition-food-brand-manage input[name="sell"][value="1"]').parent().parent().addClass('d-none');
    await dataFoodDetail(thisRowDataFaceFoodBrandManage.data('id'));
    if(material_food.length > 0){
        $('#original-update-addition-food-brand-manage').attr('disabled',true);
    }else{
        $('#original-update-addition-food-brand-manage').removeAttr('disabled');
    }
    $('#category-update-addition-food-brand-manage').html(dataCategoryFoodBrandManage);
    $('#category-update-addition-food-brand-manage option').each(function () {
        if($(this).attr('data-id-category') != category_type_id){
            $(this).remove()
        }
    })
    urlAvatarAdditionFood = avatarFoodUpdateManage
    $('#category-update-addition-food-brand-manage').val(categoryFoodUpdateManage).trigger('change.select2')
    $('#name-update-addition-food-brand-manage').val(nameFoodUpdateManage);
    $('#code-update-addition-food-brand-manage').val(codeFoodUpdateManage);
    $('#description-update-addition-food-brand-manage').val(descriptionFoodUpdateManage);
    $('#unit-update-addition-food-brand-manage').html(dataUnitFoodBrandManage);
    $('#unit-update-addition-food-brand-manage').val(unitFoodUpdateManage).trigger('change.select2')
    $('#picture-update-addition-food-brand-manage').attr('data-url-avt',avatarFoodUpdateManage);
    $('#picture-update-addition-food-brand-manage').attr('data-url-thumb',avatarThumpFoodUpdateManage);
    $('#picture-update-addition-food-brand-manage').attr('src',avatarLinkFoodUpdateManage);
    $('#sell-by-update-addition-food-brand-manage input[name=sell][value='+ sellByFoodUpdateManage +']').prop('checked', true);
    $('#original-update-addition-food-brand-manage').val(formatNumber(originalPriceFoodUpdateManage));
    $('#price-update-addition-food-brand-manage').val(priceFoodUpdateManage);
    $('#point-update-addition-food-brand-manage').text(pointFoodUpdateManage);
    // $('#profit-margin-update-food-brand-manage').text(profitUpdateFoodManage)
    (isLikeUpdateFoodManage === 1) ? $('#is-like-addition-update-food-brand-manage').prop('checked', true) : $('#is-like-addition-update-food-brand-manage').prop('checked', false);
    $('#note-addition-update-food-brand-manage').val(foodNoteFoodUpdateManage).trigger('change.select2');
    $('#take-away-addition-update-food-brand-manage input[name=take][value=' + takeAwayFoodUpdateManage + ']').prop('checked', true);
    $('#time-update-addition-food-brand-manage').val(timeFoodUpdateManage);
    $('#cook-addition-update-food-brand-manage input[name=cook][value=' + cookFoodUpdateManage + ']').prop('checked', true);
    $('#review-addition-update-food-brand-manage').prop('checked', reviewFoodUpdateManage);
    $('#take-away-addition-update-food-brand-manage input[name=take][value=' + takeAwayFoodUpdateManage + ']').prop('checked', true);
    $('#print-addition-update-food-brand-manage').prop('checked', printFoodUpdateManage);
    $('#profit-update-addition-food-brand-manage').val(formatNumber(Number(removeformatNumber($('#price-update-addition-food-brand-manage').val())) - Number(removeformatNumber($('#original-update-addition-food-brand-manage').val()))));
    $('#profit-margin-update-addition-food-brand-manage').text(profitUpdateFoodManage+'%')
    $('#print-addition-update-food-brand-manage').prop('checked', printFoodUpdateManage);
    $('#print-stamp-update-food-brand-manage').prop('checked', printStampFoodUpdateManage);
    countCharacterTextarea()
    if ($('#print-addition-update-food-brand-manage').is(':checked')) {
        $('.print-stamp-update-food-brand-manage-div').removeClass('disabled');
        $('.print-stamp-update-food-brand-manage-span').removeClass('disabled');
        $('#print-stamp-update-food-brand-manage').prop('disabled', false);
    }
    else {
        $('#print-stamp-update-food-brand-manage-div, #print-lake-update-food-brand-manage-div').addClass('disabled')
        $('.print-stamp-update-food-brand-manage-div').addClass('disabled');
        $('#print-stamp-update-food-brand-manage').prop('disabled', true);
        $('#print-stamp-update-food-brand-manage').prop('checked', false);
    }
    $('#print-lake-update-food-brand-manage').prop('checked', printLakeFoodUpdateManage);
    $('#print-tem-update-food-brand-manage').prop('checked', printStampFoodUpdateManage);
    if(vatFoodUpdateManage !== 0){
        $('#vat-update-addition-food-brand-manage').html(dataVatFoodBrandManage);
    }else {
        $('#vat-update-addition-food-brand-manage').html(dataVatFoodBrandManage);
        $('#vat-update-addition-food-brand-manage').find('option:first').trigger('change.select2');
    }
    $('#vat-update-addition-food-brand-manage').val(vatFoodUpdateManage).trigger('change.select2')
    $('#unit-update-addition-food-brand-manage,#category-update-addition-food-brand-manage,#note-addition-update-food-brand-manage,#vat-update-addition-food-brand-manage').select2({
        dropdownParent: $('#modal-update-addition-food-brand-manage'),
    })
    $('#input-picture-update-addition-food-brand-manage').on('change', async function() {
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        dataUpdateFoodAdditionImageUpload = $(this).prop('files')[0];
        switch((dataUpdateFoodAdditionImageUpload.type).slice(6)) {
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
        $('#picture-update-addition-food-brand-manage').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        urlAvatarAdditionFood = data.data[0]
        $('#picture-update-addition-food-brand-manage').attr('data-url-avt', data.data[0]);
        $('#picture-update-addition-food-brand-manage').attr('data-url-thumb', data.data[1]);
        $(this).replaceWith($(this).val('').clone(true));
    });
    $('#original-update-addition-food-brand-manage').on('input paste keyup', function () {
        $('#profit-update-addition-food-brand-manage').val(formatNumber(Number(removeformatNumber($('#price-update-addition-food-brand-manage').val())) - Number(removeformatNumber($('#original-update-addition-food-brand-manage').val()))))
        if (removeformatNumber($('#price-update-addition-food-brand-manage').val()) > 0) {
            let giaBan = Number(removeformatNumber($('#price-update-addition-food-brand-manage').val()))
            let giaVon = Number(removeformatNumber($(this).val()))
            // $('#profit-margin-update-addition-food-brand-manage').text((((giaBan - giaVon) / giaBan) * 100).toFixed(2).replace('.00', '') + "%");
            $('#profit-margin-update-addition-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")
        }
    })
    $('#price-update-addition-food-brand-manage').on('input paste keyup', function () {
        $('#profit-update-addition-food-brand-manage').val(formatNumber(Number(removeformatNumber($('#price-update-addition-food-brand-manage').val())) - Number(removeformatNumber($('#original-update-addition-food-brand-manage').val()))))
        $('#point-update-addition-food-brand-manage').text(formatNumber((parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())).toFixed(0).replace('.00' , '')));
        if (removeformatNumber($(this).val()) > 0) {
            let giaBan = Number(removeformatNumber($(this).val()))
            let giaVon = Number(removeformatNumber($('#original-update-addition-food-brand-manage').val()))
            $('#profit-margin-update-addition-food-brand-manage').text((((giaBan - giaVon) / giaBan) * 100).toFixed(2).replace('.00', '') + "%");
            $('#profit-margin-update-addition-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")
        } else {
            $('#profit-margin-update-addition-food-brand-manage').text("0%")
        }

    })
    $('#print-addition-update-food-brand-manage').on('click', function () {
        if($('#print-addition-update-food-brand-manage').is(':checked')) {
            $('.print-stamp-update-food-brand-manage-div').removeClass('disabled');
            $('.print-stamp-update-food-brand-manage-span').removeClass('disabled');
            $('#print-stamp-update-food-brand-manage').prop('disabled', false);
        } else {
            $('.print-stamp-update-food-brand-manage-div').addClass('disabled');
            $('.print-stamp-update-food-brand-manage-span').addClass('disabled');
            $('#print-stamp-update-food-brand-manage').prop('disabled', true);
            $('#print-stamp-update-food-brand-manage').prop('checked', false);
        }
    })
    switch (category_type_id) {
        case 1:
            $('.class-check-food-update-brand-manage').prop('checked', true);
            $('#time-update-addition-food-brand-manage').attr('disabled', false);
            $('.class-check-food-update-brand-manage').attr('disabled', true);
            $('#option-addition-update-not-cook-drink').addClass('d-none');
            $('#option-addition-update-not-cook-other').addClass('d-none');
            $('#option-addition-update-not-cook-food').removeClass('d-none');
            $('#option-addition-update-not-cook-seafood').addClass('d-none');
            $('#check-additional-update-food-brand-manage').removeClass('d-none');
            $('#check-col-node-food-addition-update-food-brand-manage').removeClass('col-lg-12');
            $('#check-col-node-food-addition-update-food-brand-manage').addClass('col-lg-6');
            break;
        case 2:
            $('.class-check-food-update-brand-manage').prop('checked', false);
            $('#time-update-addition-food-brand-manage').attr('disabled', true);
            $('.class-check-food-update-brand-manage').attr('disabled', true);
            $('#check-additional-update-food-brand-manage').addClass('d-none');
            $('#option-addition-update-not-cook-drink').removeClass('d-none');
            $('#option-addition-update-not-cook-other').addClass('d-none');
            $('#option-addition-update-not-cook-food').addClass('d-none');
            $('#option-addition-update-not-cook-seafood').addClass('d-none');
            $('#check-col-node-food-addition-update-food-brand-manage').addClass('col-lg-12');
            $('#check-col-node-food-addition-update-food-brand-manage').removeClass('col-lg-6');
            break;
        case 3:
            $('.class-check-food-update-brand-manage').prop('checked', false);
            $('#time-update-addition-food-brand-manage').attr('disabled', true);
            $('.class-check-food-update-brand-manage').attr('disabled', true);
            $('#option-addition-update-not-cook-drink').addClass('d-none');
            $('#option-addition-update-not-cook-other').removeClass('d-none');
            $('#option-addition-update-not-cook-food').addClass('d-none');
            $('#option-addition-update-not-cook-seafood').addClass('d-none');
            $('#check-additional-update-food-brand-manage').removeClass('d-none');
            $('#check-col-node-food-addition-update-food-brand-manage').removeClass('col-lg-12');
            $('#check-col-node-food-addition-update-food-brand-manage').addClass('col-lg-6');
            break;
        case 4:
            $('.class-check-food-update-brand-manage').prop('checked', true);
            $('#time-update-addition-food-brand-manage').attr('disabled', false);
            $('.class-check-food-update-brand-manage').attr('disabled', true);
            $('#option-addition-update-not-cook-drink').addClass('d-none');
            $('#option-addition-update-not-cook-other').addClass('d-none');
            $('#option-addition-update-not-cook-food').addClass('d-none');
            $('#option-addition-update-not-cook-seafood').removeClass('d-none');
            $('#check-additional-update-food-brand-manage').removeClass('d-none');
            $('#check-col-node-food-addition-update-food-brand-manage').removeClass('col-lg-12');
            $('#check-col-node-food-addition-update-food-brand-manage').addClass('col-lg-6');
            break;
    }
}

function closeModalAdditionUpdateFoodManage(){
    $('#modal-update-addition-food-brand-manage').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    resetModalFoodAdditionUpdateBrandManage()
    removeAllValidate();
    countCharacterTextarea()
}

function resetModalFoodAdditionUpdateBrandManage(){
    $('#name-update-addition-food-brand-manage').val('');
    $('#code-update-addition-food-brand-manage').val('');
    $('#description-addition-update-food-brand-manage').val('');
    $('#original-update-addition-food-brand-manage').val(0);
    $('#price-update-addition-food-brand-manage').val(0);
    $('#profit-update-addition-food-brand-manage').val(0);
    $('#point-update-addition-food-brand-manage').text(0);
    $('#unit-update-food-brand-manage').val(null).trigger('change.select2');
    $('#category-update-food-brand-manage').val(null).trigger('change.select2');
    $('#vat-update-addition-food-brand-manage').val(null).trigger('change.select2');
    $('#note-addition-update-food-brand-manage').val([]).trigger('change.select2');
    $('#print-addition-update-food-brand-manage').prop('checked', false);
    $('#print-stamp-update-food-brand-manage').prop('checked', false);
    $('.class-check-food-update-brand-manage').prop('checked', false);
    $('#is-like-addition-update-food-brand-manage').prop('checked', false);
    $('#review-addition-update-food-brand-manage').prop('checked', false);
    $('#sell-by-update-addition-food-brand-manage input[name=sell][value="0"]').prop('checked',true);
    $('#take-away-addition-update-food-brand-manage input[name=take][value="0"]').prop('checked',true);
    $('#picture-update-food-brand-manage').attr('src', '/images/food_file.jpg');
    $('#print-stamp-update-food-brand-manage-div').addClass('disabled')
    $('.print-stamp-update-food-brand-manage-div').addClass('disabled');
    $('#print-stamp-update-food-brand-manage').prop('disabled', true);
    $('#print-stamp-update-food-brand-manage').prop('checked', false);
}

async function saveModalAdditionUpdateFoodManage() {
    if (checkSaveUpdateAdditionFoodBrandManage !== 0) return false;
    if ($('#category-update-food-brand-manage option:selected').data('id-category') === 2 ||
        $('#category-update-food-brand-manage option:selected').data('id-category') === 3){
        $('#time-update-addition-food-brand-manage').attr('data-number', '');
        $('#time-update-addition-food-brand-manage').attr('data-min', '');
        $('#time-update-addition-food-brand-manage').attr('data-max', '');
    }else if ($('#category-update-food-brand-manage option:selected').data('id-category') === 1 ||
        $('#category-update-food-brand-manage option:selected').data('id-category') === 4){
        $('#time-update-addition-food-brand-manage').attr('data-number', '1');
        $('#time-update-addition-food-brand-manage').attr('data-min', '1');
        $('#time-update-addition-food-brand-manage').attr('data-max', '1440');
    }
    if(!checkValidateSave($('#tab-info-update-addition-food-manager'))) return false;
    checkSaveUpdateAdditionFoodBrandManage = 1;
    let restaurant_brand_id = $('.select-brand').val(),
        name = $('#name-update-addition-food-brand-manage').val(),
        code = $('#code-update-addition-food-brand-manage').val(),
        unit = $('#unit-update-addition-food-brand-manage :selected').text(),
        food_category_id = $('#category-update-addition-food-brand-manage :selected').val(),
        category_type_id = $('#category-update-addition-food-brand-manage option :selected').data('id-category'),
        time_to_completed = removeformatNumber($('#time-update-addition-food-brand-manage').val()),
        is_sell_by_weight = $('#sell-by-update-addition-food-brand-manage').find('input[type="radio"]:checked').val(),
        price = removeformatNumber($('#price-update-addition-food-brand-manage').val()),
        point_to_purchase = removeformatNumber($('#point-update-addition-food-brand-manage').text()),
        is_take_away = $('#take-away-addition-update-food-brand-manage').find('input[type="radio"]:checked').val(),
        description = $('#description-update-addition-food-brand-manage').val(),
        food_addition_ids = $('#additional-update-food-brand-manage').val(),
        sale_online_status = $('#take-away-addition-update-food-brand-manage').find('input[type="radio"]:checked').val(),
        is_special_claim_point,
        is_allow_review,
        is_allow_purchase_by_point,
        is_addition = 1,
        is_combo = 0,
        is_special_gift = 0,
        food_material_type = 0,
        food_in_combo = [],
        original_price = $('#original-update-addition-food-brand-manage').val(),
        is_addition_like_food = ($('#is-like-addition-update-food-brand-manage').is(':checked')) ? 1 : 0,
        noteFoods = $('#note-addition-update-food-brand-manage').val();

    ($('#review-addition-update-food-brand-manage').is(':checked') === true) ? is_allow_review = 1: is_allow_review = 0;
    ($('#party-update-food-brand-manage').is(':checked') === true) ? is_allow_purchase_by_point = 1: is_allow_purchase_by_point = 0;
    ($('#print-addition-update-food-brand-manage').is(':checked') === true) ? is_allow_print = 1: is_allow_print = 0;

    let noteInsertFoods = noteFoods.filter(o1 => !foodNoteFoodUpdateManage.some(o2 => o1 == o2));
    let noteDeleteFoods = foodNoteFoodUpdateManage.filter(o1 => !noteFoods.some(o2 => o1 == o2));
    let noteUpdateAdditionFoodBrandManage = $('#note-addition-update-food-brand-manage').val().map(Number);
    ($('#print-stamp-update-food-brand-manage').is(':checked') === true) ? is_allow_print_stamp = 1: is_allow_print_stamp = 0;
    if(nameFoodUpdateManage == name
        && unitFoodUpdateManage == unit
        && categoryFoodUpdateManage == $('#category-update-addition-food-brand-manage :selected').val()
        && compareArray(foodNoteFoodUpdateManage,noteUpdateAdditionFoodBrandManage)
        && descriptionFoodUpdateManage == description
        && reviewFoodUpdateManage == is_allow_review
        && printFoodUpdateManage == is_allow_print
        && isLikeUpdateFoodManage == is_addition_like_food
        && printStampFoodUpdateManage == is_allow_print_stamp
        && originalPriceFoodUpdateManage == removeformatNumber(original_price)
        && pointFoodUpdateManage == point_to_purchase
        && takeAwayFoodUpdateManage == sale_online_status
        && avatarFoodUpdateManage == $('#picture-update-addition-food-brand-manage').attr('data-url-avt')
        && ($('#vat-update-addition-food-brand-manage').val() == null || vatFoodUpdateManage == $('#vat-update-addition-food-brand-manage').val()) ) {
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalAdditionUpdateFoodManage();
        checkSaveUpdateAdditionFoodBrandManage = 0;
        return false;
    }

    switch (typeUpdateFoodBrandManage) {
        case 2:
            is_combo = 1;
            food_addition_ids = [];
            $('#table-food-combo-combo-update-food-manage tbody tr').each(function(row, tr) {
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
            category_id: food_category_id,
            category_type_id: category_type_id,
            avatar: urlAvatarAdditionFood,
            avatar_thumb: $('#picture-update-food-brand-manage').data('url-thumb'),
            description: description,
            name: name,
            status: status_update_food_brand_manage,
            price: removeformatNumber(price),
            point_to_purchase: removeformatNumber(point_to_purchase),
            is_addition_like_food: is_addition_like_food,
            unit: unit,
            code: code,
            is_allow_review: is_allow_review,
            is_take_away: is_take_away,
            is_addition: is_addition,
            food_addition_ids: food_addition_ids,
            is_combo: is_combo,
            food_in_combo: food_in_combo,
            time_to_completed: time_to_completed,
            is_allow_print : is_allow_print,
            is_allow_print_stamp : Number($('#print-stamp-update-food-brand-manage').is(':checked')),
            is_special_claim_point : is_special_claim_point,
            is_sell_by_weight : is_sell_by_weight,
            is_allow_purchase_by_point : is_allow_purchase_by_point,
            food_material_type : food_material_type,
            is_special_gift : is_special_gift,
            note_food : noteInsertFoods,
            restaurant_vat_config_id : $('#vat-update-addition-food-brand-manage ').val(),
            original_price : removeformatNumber(original_price),
            delete_Foods: noteDeleteFoods,
            sale_online_status :sale_online_status
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-update-addition-food-brand-manage')
    ]);
    checkSaveUpdateAdditionFoodBrandManage = 0
    switch (res.data.status){
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            let x = String(thisRowDataFaceFoodBrandManage.parents('td').data('dt-row')).slice(-2);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.DTFC_LeftWrapper').find('tbody tr:eq(' + x + ')').find('td:eq(1)').find('img').attr('src', res.data.data.avatar);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.DTFC_LeftWrapper').find('tbody tr:eq(' + x + ')').find('td:eq(1)').find('img').attr('onclick', 'modalImageComponent("' + res.data.data.avatar + '")');
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.DTFC_LeftWrapper').find('tbody tr:eq(' + x + ')').find('td:eq(2)').text(res.data.data.name);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(4)').text(res.data.data.category_name);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(5)').text(res.data.data.original_price);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(6)').text(res.data.data.price);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(8)').text(res.data.data.original_revenue);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(7)').text(res.data.data.temporary_price);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(9)').html(res.data.data.vat);
            closeModalAdditionUpdateFoodManage();
            window.location.pathname === '/food-data' ? foodBuildData() : loadDataEnableFoodBrandManage()
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}
