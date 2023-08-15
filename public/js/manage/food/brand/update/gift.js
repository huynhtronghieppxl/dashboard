async function saveModalGiftUpdateFoodManage() {
    let restaurant_brand_id = $('.select-brand').val(),
        name = $('#name-update-food-brand-manage').val(),
        code = $('#code-update-food-brand-manage').val(),
        unit = $('#unit-update-food-brand-manage').val(),
        food_category_id = category_id,
        is_bbq = $('#cook-update-food-brand-manage').find('input[type="radio"]:checked').val(),
        time_to_completed = removeformatNumber($('#time-update-food-brand-manage').val()),
        is_sell_by_weight = $('#sell-by-create-food-brand-manage').find('input[type="radio"]:checked').val(),
        price = removeformatNumber($('#price-update-food-brand-manage').val()),
        point_to_purchase = removeformatNumber($('#point-update-food-brand-manage').text()),
        is_take_away = $('#take-away-update-food-brand-manage').find('input[type="radio"]:checked').val(),
        description = $('#description-update-food-brand-manage').val(),
        food_addition_ids = $('#additional-update-food-brand-manage').val(),
        is_special_claim_point,
        is_allow_reis_allow_reviewview,
        is_allow_purchase_by_point,
        is_addition = 0,
        is_combo = 0,
        is_special_gift = 0,
        food_material_type = 0,
        food_in_combo = [],
        original_price = $('#original-price-update-food-brand-manage').val();

    ($('#print-update-food-brand-manage').is(':checked') === true) ? is_special_claim_point = 1: is_special_claim_point = 0;
    ($('#review-update-food-brand-manage').is(':checked') === true) ? is_allow_review = 1: is_allow_review = 0;
    ($('#party-update-food-brand-manage').is(':checked') === true) ? is_allow_purchase_by_point = 1: is_allow_purchase_by_point = 0;
    ($('#print-update-food-brand-manage').is(':checked') === true) ? is_allow_print = 1: is_allow_print = 0;

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
            id: id_update_food_manage,
            category_id: $('#category-update-food-brand-manage').val(),
            avatar: $('#picture-update-food-brand-manage').data('url-avt'),
            avatar_thumb: $('#picture-update-food-brand-manage').data('url-thumb'),
            description: description,
            name: name,
            status: status_update_food_manage,
            price: removeformatNumber(price),
            point_to_purchase: removeformatNumber(point_to_purchase),
            is_bbq: is_bbq,
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
            is_special_claim_point : is_special_claim_point,
            is_sell_by_weight : is_sell_by_weight,
            is_allow_purchase_by_point : is_allow_purchase_by_point,
            food_material_type : food_material_type,
            is_special_gift : is_special_gift,
            original_price : removeformatNumber(original_price)
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#tab-info-update-food-manager')
    ]);
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
            let x = String(thisRowDataFace.parents('td').data('dt-row')).slice(-2);
            thisRowDataFace.parents('.DTFC_ScrollWrapper').find('.DTFC_LeftWrapper').find('tbody tr:eq('+ x +')').find('td:eq(1)').find('img').attr('src' , res.data.data.avatar);
            thisRowDataFace.parents('.DTFC_ScrollWrapper').find('.DTFC_LeftWrapper').find('tbody tr:eq('+ x +')').find('td:eq(1)').find('img').attr('onclick' ,'modalImageComponent("'+ res.data.data.avatar +'")');
            thisRowDataFace.parents('.DTFC_ScrollWrapper').find('.DTFC_LeftWrapper').find('tbody tr:eq('+ x +')').find('td:eq(2)').text(res.data.data.name);
            thisRowDataFace.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq('+ x +')').find('td:eq(5)').text(res.data.data.original_price);
            thisRowDataFace.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq('+ x +')').find('td:eq(6)').text(res.data.data.original_revenue);
            thisRowDataFace.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq('+ x +')').find('td:eq(7)').text(res.data.data.temporary_price);
            thisRowDataFace.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq('+ x +')').find('td:eq(10)').text(res.data.data.vat);
        closeModalUpdateFoodManage();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}
