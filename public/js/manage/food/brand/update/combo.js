let checkSaveUpdateComboFoodBrandManage = 0, dataUpdateFoodComboImageUpload,
    urlAvatarUpdateComboFood;
async function openModalComboUpdateFoodManage(){
    $('#modal-update-combo-food-brand-manage').modal('show')
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('ESC', function (){
        closeModalComboUpdateFoodManage();
    });
    shortcut.add('F4', function (){
        saveModalComboUpdateFoodManage();
    });
    await dataFoodDetail(thisRowDataFaceFoodBrandManage.data('id'));
    dataTableComboUpdateFoodBrandManage(dataTableInComboUpdateFoodBrandManage);
    $('#take-away-update-food-combo-brand-manage input[name=take-combo][value="'+ takeAwayFoodUpdateManage +'"]').prop('checked',true);
    $('#name-update-combo-food-brand-manage').val(nameFoodUpdateManage);
    $('#code-update-combo-food-brand-manage').val(codeFoodUpdateManage);
    $('#description-update-combo-food-brand-manage').val(descriptionFoodUpdateManage);
    $('#unit-update-combo-food-brand-manage').html(dataUnitFoodBrandManage);
    $('#unit-update-combo-food-brand-manage').val(unitFoodUpdateManage).trigger('change.select2')
    $('#category-update-combo-food-brand-manage').html(dataCategoryComboFoodBrandManage);
    $('#category-update-combo-food-brand-manage').val(categoryFoodUpdateManage).trigger('change.select2')
    $('#note-update-combo-food-brand-manage').html(dataFoodNoteFoodBrandManage)
    $('#picture-update-combo-food-brand-manage').attr('data-url-avt',avatarFoodUpdateManage);
    $('#picture-update-combo-food-brand-manage').attr('data-url-thumb',avatarThumpFoodUpdateManage);
    $('#picture-update-combo-food-brand-manage').attr('src',avatarLinkFoodUpdateManage);
    $('#original-update-food-combo-brand-manage').val(formatNumber(originalPriceFoodUpdateManage));
    $('#price-update-combo-brand-manage').val(priceFoodUpdateManage);
    $('#point-update-combo-food-brand-manage').text(formatNumber(pointFoodUpdateManage));
    $('#profit-update-combo-food-brand-manage').val(formatNumber(Number(removeformatNumber($('#price-update-combo-brand-manage').val())) - Number(removeformatNumber($('#original-update-food-combo-brand-manage').val()))));
    $('#review-combo-update-food-brand-manage').prop('checked', reviewFoodUpdateManage);
    $('#print-combo-update-food-brand-manage').prop('checked', printFoodUpdateManage);
    $('#profit-margin-update-combo-food-brand-manage').text(profitUpdateFoodManage +'%')
    $('#vat-update-combo-food-brand-manage').html(dataVatFoodBrandManage);
    countCharacterTextarea()
    $('#vat-update-combo-food-brand-manage').val(vatFoodUpdateManage).trigger('change.select2')
    $('#note-update-combo-food-brand-manage').val(foodNoteFoodUpdateManage).trigger('change.select2');
    $('#unit-update-combo-food-brand-manage,#category-update-combo-food-brand-manage,#note-update-combo-food-brand-manage,#vat-update-combo-food-brand-manage,#select-food-in-combo-update-food-brand-manage').select2({
        dropdownParent: $('#modal-update-combo-food-brand-manage'),
    })
    urlAvatarUpdateComboFood = $('#picture-update-combo-food-brand-manage').attr('data-url-avt');


    $('#input-picture-update-combo-food-brand-manage').unbind('change').on('change', async function() {
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        dataUpdateFoodComboImageUpload = $(this).prop('files')[0];
        switch((dataUpdateFoodComboImageUpload.type).slice(6)) {
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
        $('#picture-update-combo-food-brand-manage').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        checkSaveUpdateComboFoodBrandManage = 1
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        checkSaveUpdateComboFoodBrandManage = 0
        urlAvatarUpdateComboFood = data.data[0]
        $('#picture-update-combo-food-brand-manage').attr('data-url-thumb', data.data[1]);
        $(this).replaceWith($(this).val('').clone(true));
    });
    $('#price-combo-update-food-manage').on('change', function() {
        $('#point-combo-update-food-manage').text(formatNumber(parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())))

    });
    $('#price-update-combo-brand-manage').on('input paste', function (){
        $('#profit-update-combo-food-brand-manage').val(formatNumber(Number(removeformatNumber($('#price-update-combo-brand-manage').val())) - Number(removeformatNumber($('#original-update-food-combo-brand-manage').val()))))
        $('#point-update-combo-food-brand-manage').text(formatNumber((parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())).toFixed(0).replace('.00' , '')));
         if (removeformatNumber($(this).val()) > 0) {
            let giaBan = Number(removeformatNumber($(this).val()))
            let giaVon = Number(removeformatNumber($('#original-update-food-combo-brand-manage').val()))
            $('#profit-margin-update-combo-food-brand-manage').text(formatNumber((((giaBan - giaVon) / giaBan) * 100).toFixed(2).replace('.00', '')) + "%");
        } else {
            $('#profit-margin-update-combo-food-brand-manage').text("0%")
        }
    })
    $(document).on('input paste', '.quantity-food-combo-update' ,function (){
        $(this).parents('tr').find('td:eq(3)').text(formatNumber(Number(removeformatNumber($(this).parents('tr').find('td:eq(1)').text())) *  Number(removeformatNumber($(this).val()))));
        sumOriginalPriceUpdate();
    })
}
function closeModalComboUpdateFoodManage(){
    $('#modal-update-combo-food-brand-manage').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    resetModalFoodComboUpdateBrandManage();
    removeAllValidate();
    countCharacterTextarea()
}

function resetModalFoodComboUpdateBrandManage(){
    $('#name-update-food-brand-manage').val('');
    $('#code-update-food-brand-manage').val('');
    $('#description-update-food-brand-manage').val('');
    $('#original-update-food-combo-brand-manage').val(0);
    $('#price-update-combo-brand-manage').val(0);
    $('#profit-update-combo-food-brand-manage').val(0);
    $('#point-update-combo-food-brand-manage').text(0);
    $('#unit-update-food-brand-manage').val(null).trigger('change.select2');
    $('#note-combo-update-food-brand-manage').val([]).trigger('change.select2');
    $('#category-update-food-brand-manage').val(null).trigger('change.select2');
    $('#select2-vat-update-combo-food-brand-manage-container').val(null).trigger('change.select2');
    $('#take-away-update-food-combo-brand-manage input[name=take-combo][value="0"]').prop('checked',true);
    tableFoodInComboFoodBrandManage.clear().draw(false)
}

async function saveModalComboUpdateFoodManage() {
    if (checkSaveUpdateComboFoodBrandManage !== 0) return false;
    if(!checkValidateSave($('#tab-info-update-combo-food-manager'))) return false;
    checkSaveUpdateComboFoodBrandManage = 1;
    let restaurant_brand_id = $('.select-brand').val(),
        name = $('#name-update-combo-food-brand-manage').val(),
        code = $('#code-update-combo-food-brand-manage').val(),
        unit = $('#unit-update-combo-food-brand-manage :selected').text(),
        category_type_id = $('#category-update-combo-food-brand-manage option:selected').data('id-category'),
        time_to_completed = removeformatNumber($('#time-update-combo-food-brand-manage').val()),
        is_sell_by_weight = $('#sell-by-create-food-brand-manage').find('input[type="radio"]:checked').val(),
        price = removeformatNumber($('#price-update-combo-brand-manage').val()),
        point_to_purchase = removeformatNumber($('#point-update-combo-food-brand-manage').text()),
        sale_online_status = $('#take-away-update-food-combo-brand-manage').find('input[type="radio"]:checked').val(),
        description = $('#description-update-combo-food-brand-manage').val(),
        food_addition_ids = [],
        is_special_claim_point,
        is_allow_purchase_by_point,
        is_addition = 0,
        is_combo = 1,
        is_special_gift = 0,
        food_material_type = 0,
        food_in_combo = [],
        noteFoods = $('#note-update-combo-food-brand-manage').val(),
        original_price = $('#original-update-food-combo-brand-manage').val();
    $('#print-update-food-brand-manage').is(':checked') === true ? is_special_claim_point = 1: is_special_claim_point = 0;
    $('#review-update-food-brand-manage').is(':checked') === true ? is_allow_review = 1: is_allow_review = 0;
    $('#party-update-food-brand-manage').is(':checked') === true ? is_allow_purchase_by_point = 1: is_allow_purchase_by_point = 0;
    $('#print-update-food-brand-manage').is(':checked') === true ? is_allow_print = 1: is_allow_print = 0;
    let noteInsertFoods = noteFoods.filter(o1 => !foodNoteFoodUpdateManage.some(o2 => o1 == o2));
    let noteDeleteFoods = foodNoteFoodUpdateManage.filter(o1 => !noteFoods.some(o2 => o1 == o2));
    let noteUpdateComboFoodBrandManage = $('#note-update-combo-food-brand-manage').val().map(Number);
    food_in_combo = [];
    tableFoodInComboFoodBrandManage.rows().every(function (){
        let row = $(this.node());
        food_in_combo.push({
            "id": row.find('td:eq(0)').find('input').val(),
            "quantity": row.find('td:eq(2)').find('input').val(),
        });
    })

    if(nameFoodUpdateManage == name
        && unitFoodUpdateManage == unit
        && categoryFoodUpdateManage == $('#category-update-combo-food-brand-manage option:selected').val()
        && compareArray(foodNoteFoodUpdateManage,noteUpdateComboFoodBrandManage)
        && descriptionFoodUpdateManage == description
        && originalPriceFoodUpdateManage == removeformatNumber(original_price)
        && pointFoodUpdateManage == point_to_purchase
        && reviewFoodUpdateManage == is_allow_review
        && dataTableInComboUpdateFoodBrandManage.data[0].category_type_id == category_type_id
        && printFoodUpdateManage == is_special_claim_point
        && takeAwayFoodUpdateManage == sale_online_status
        && tableFoodInComboFoodBrandManage.data().count() == food_in_combo.length
        && urlAvatarUpdateComboFood == $('#picture-update-combo-food-brand-manage').attr('data-url-avt')
        && ($('#vat-update-combo-food-brand-manage').val() == null || vatFoodUpdateManage == $('#vat-update-combo-food-brand-manage').val())) {
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalComboUpdateFoodManage();
        checkSaveUpdateComboFoodBrandManage = 0;
        return false;
    }

    let method = 'post',
        url = 'food-brand-manage.update',
        params = null,
        data = {
            restaurant_brand_id: restaurant_brand_id,
            list_branch_kitchen_update: list_branch_kitchen,
            id: id_update_food_brand_manage,
            category_id: $('#category-update-combo-food-brand-manage :selected').val(),
            category_type_id: category_type_id,
            avatar: urlAvatarUpdateComboFood,
            avatar_thumb: $('#picture-update-combo-food-brand-manage').data('url-thumb'),
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
            is_allow_print : is_allow_print,
            is_special_claim_point : is_special_claim_point,
            is_sell_by_weight : is_sell_by_weight,
            is_allow_purchase_by_point : is_allow_purchase_by_point,
            food_material_type : food_material_type,
            is_special_gift : is_special_gift,
            note_food : noteInsertFoods,
            delete_Foods: noteDeleteFoods,
            original_price : removeformatNumber(original_price),
            restaurant_vat_config_id : $('#vat-update-combo-food-brand-manage ').val(),
            sale_online_status :sale_online_status
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-update-combo-food-brand-manage')
    ]);
    checkSaveUpdateComboFoodBrandManage = 0;
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
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(8)').html(res.data.data.vat);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(9)').text(res.data.data.original_revenue);
            thisRowDataFaceFoodBrandManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(7)').text(res.data.data.temporary_price);
            window.location.pathname === '/food-data' ? foodBuildData() : loadDataEnableFoodBrandManage()

            closeModalComboUpdateFoodManage();
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}
