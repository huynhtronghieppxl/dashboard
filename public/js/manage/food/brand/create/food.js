let checkSaveCreateFoodBrandManage = 0;
async function saveFoodCreateFoodBrandManage(){
    if(checkSaveCreateFoodBrandManage != 0 )  {
        return false;
    }
    if (!checkValidateSave($('#tab-info-create-food-manager'))) return false;
    if ($('#category-create-food-brand-manage option:selected').data('id-category') === 2 ||
        $('#category-create-food-brand-manage option:selected').data('id-category') === 3){
        $('#time-create-food-brand-manage').attr('data-min', '');
        $('#time-create-food-brand-manage').attr('data-max','');
        $('#time-create-food-brand-manage').attr('value','0');
    }
    let brand = $('.select-brand').val(),
        name = $('#name-create-food-brand-manage').val(),
        code = $('#code-create-food-brand-manage').val(),
        unit = $('#unit-create-food-brand-manage').find('option:selected').text(),
        category_id = $('#category-create-food-brand-manage').val(),
        restaurant_vat_config_id = $('#vat-create-food-brand-manage').val(),
        category_type = $('#category-create-food-brand-manage option:selected').attr('data-id-category'),
        time_to_completed = removeformatNumber($('#time-create-food-brand-manage').val()),
        is_sell_by_weight = $('#sell-by-create-food-brand-manage').find('input[type="radio"]:checked').val(),
        is_allow_print = Number($('#print-kitchen-create-food-brand-manage').is(':checked')),
        is_allow_print_fishbowl = Number($('#print-lake-create-food-brand-manage').is(':checked')),
        price = removeformatNumber($('#price-create-food-brand-manage').val()),
        point_to_purchase = removeformatNumber($('#point-create-food-brand-manage').text()),
        is_take_away = $('#take-away-create-food-brand-manage').find('input[type="radio"]:checked').val(),
        description = $('#description-create-food-brand-manage').val(),
        all_brand = $('#brand-create-food-combo-manage').find('input[type="radio"]:checked').val(),
        food_addition_ids = $('#additional-create-food-brand-manage').val(),
        is_special_claim_point,
        is_allow_review,
        is_allow_purchase_by_point,
        is_addition = 0,
        is_combo = 0,
        is_special_gift = 0,
        is_allow_print_stamp = Number($('#print-tem-create-food-brand-manage').is(':checked')),
        food_material_type = 0,
        food_in_combo = [],
        list_branch_kitchen = [],
        is_quantitative,
        note_food = $('#note-food-brand-manage').val(),
        original_price = removeformatNumber($('#original-create-food-brand-manage').val()),
        material_id = $('#material-create-food-brand-manage').val(),
        material_unit_id = $('#material-unit-create-food-brand-manage').val();
    ($('#print-create-food-brand-manage').is(':checked') === true) ? is_special_claim_point = 1 : is_special_claim_point = 0;
    ($('#review-create-food-brand-manage').is(':checked') === true) ? is_allow_review = 1 : is_allow_review = 0;
    ($('#party-create-food-brand-manage').is(':checked') === true) ? is_allow_purchase_by_point = 1 : is_allow_purchase_by_point = 0;
    ($('#quantitative-create-food-brand-manage').is(':checked') === true) ? is_quantitative = 1 : is_quantitative = 0;
    ($('#vat-create-food-brand-manage').val() !== null) ? restaurant_vat_config_id = $('#vat-create-food-brand-manage').val() : restaurant_vat_config_id = 0;
    let material  = [];
    material.push({
        'material_id': material_id,
        'material_unit_quantification_id': material_unit_id,
        'wastage_rate': 0,
        'quantity' : 1,
        'is_use_waste_rate_private':1,
    })
    let method = 'post',
        url = 'food-brand-manage.create',
        params = null,
        data = {
            brand: brand,
            list_branch_kitchen: list_branch_kitchen,
            category_id: category_id,
            category_type_id: category_type,
            avatar: urlAvatarCreateFood == null ? '' : urlAvatarCreateFood,
            avatar_thumb: $('#picture-create-food-brand-manage').data('url-thumb'),
            description: description,
            name: name,
            price: price,
            point_to_purchase: point_to_purchase,
            time_to_completed: time_to_completed,
            unit: unit,
            is_allow_print: is_allow_print,
            is_allow_print_fishbowl: is_allow_print_fishbowl,
            code: code,
            is_special_claim_point: is_special_claim_point,
            is_sell_by_weight: is_sell_by_weight,
            is_allow_review: is_allow_review,
            is_allow_purchase_by_point: is_allow_purchase_by_point,
            is_take_away: is_take_away,
            is_addition: is_addition,
            food_material_type: food_material_type,
            food_addition_ids: food_addition_ids,
            is_combo: is_combo,
            food_in_combo: food_in_combo,
            is_special_gift: is_special_gift,
            all_brand: all_brand,
            is_quantitative: is_quantitative,
            material: material,
            material_id: material_id,
            note_food : note_food,
            original_price : original_price,
            is_allow_print_stamp : is_allow_print_stamp,
            restaurant_vat_config_id : restaurant_vat_config_id
        };
    checkSaveCreateFoodBrandManage = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-food-brand-manage')]);
    checkSaveCreateFoodBrandManage = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            drawTableCreateFoodManage(res.data.data);
            closeModalCreateFoodManage();
            urlAvatarCreateFood = '';
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}


