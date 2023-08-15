let  dataUnitGift = '',
    dataCategoryGift = '',
    dataFoodNoteGift = '';

function openModalCreateGiftFoodBradManage(){
    addLoading('food-brand-manage.create');
    addLoading('food-brand-manage.food-note');
    addLoading('food-brand-manage.category');
    addLoading('food-brand-manage.unit');
    $('#modal-create-gift-food-brand-manage').modal('show');
    $('#unit-create-gift-food-brand-manage, #category-create-gift-food-brand-manage, #note-gift-food-brand-manage').select2({
        dropdownParent: $('#modal-create-gift-food-brand-manage'),
    })
    $('#input-picture-create-gift-food-brand-manage').on('change', async function () {
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        $('#picture-create-gift-food-brand-manage').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        let data = await uploadMediaTemplate($(this).prop('files')[0], 4);
        $('#picture-create-gift-food-brand-manage').attr('data-url-avt', data.data[0]);
        $('#picture-create-gift-food-brand-manage').attr('data-url-thumb', data.data[1]);
        $(this).replaceWith($(this).val('').clone(true));
    });

    $('#name-create-gift-food-brand-manage').on('change', function() {
        let code = removeVietnameseStringLowerCase($(this).val());
        $('#code-create-gift-food-brand-manage').val(code.toUpperCase());
        $('#code-create-gift-food-brand-manage').parents('.form-validate-input').removeClass('validate-error');
        $('#code-create-gift-food-brand-manage').parents('.validate-group').find('.error').remove();
    });


    $('#category-create-gift-food-brand-manage').on('select2:open', function () {
        if (dataCategoryGift === '') {
            categoryGift();
        } else {
            if ($('#category-create-gift-food-brand-manage').length === 0)
                $('#category-create-gift-food-brand-manage').html(dataCategoryGift);
        }
    });

    foodNoteGift();
    unitGift();
}
// Danh sách món ăn
async function foodNoteGift() {
    let method = 'get',
        url = 'food-brand-manage.food-note',
        brand = $('.select-brand').val(),
        params = {
            brand: brand
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataFoodNoteGift = res.data[0];
    $('#note-gift-food-brand-manage').html(dataFoodNoteGift);
}

async function unitGift() {
    let method = 'get',
        url = 'food-brand-manage.unit',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataUnitGift = res.data[0];
    $('#unit-create-gift-food-brand-manage').html(dataUnitGift);
}


async function categoryGift() {
    let method = 'get',
        url = 'food-brand-manage.category',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataCategoryGift = res.data[0];
    $('#category-create-gift-food-brand-manage').html(dataCategoryGift);
    $("#category-create-gift-food-brand-manage").select2('close');
    $("#category-create-gift-food-brand-manage").select2('open');
}

async function saveGiftFoodCreateFoodBrandManage(){
    if(!checkValidateSave($('#modal-create-gift-food-brand-manage'))) return false;
    let  material  = [];
    material.push({
        'material_id': $('#material-create-gift-food-brand-manage').val(),
        'quantity' : 1
    })

    let method = 'post',
        url = 'food-brand-manage.create',
        params = null,
        data = {
            brand: $('.select-brand').val(),
            list_branch_kitchen: [],
            category_id: $('#category-create-gift-food-brand-manage').val(),
            category_type: $('#category-create-gift-food-brand-manage option:selected').attr('data-category-type'),
            avatar: $('#picture-create-gift-food-brand-manage').data('url-avt'),
            avatar_thumb: $('#picture-create-gift-food-brand-manage').data('url-thumb'),
            description: $('#description-create-gift-food-brand-manage').val(),
            name: $('#name-create-gift-food-brand-manage').val(),
            price: removeformatNumber($('#price-create-gift-food-brand-manage').val()),
            point_to_purchase: removeformatNumber($('#point-create-gift-food-brand-manage').text()),
            time_to_completed: removeformatNumber($('#time-create-gift-food-brand-manage').val()),
            is_bbq: $('#cook-create-gift-food-brand-manage').find('input[type="radio"]:checked').val(),
            unit: $('#unit-create-gift-food-brand-manage').find('option:selected').text(),
            is_allow_print: $('#print-create-gift-food-brand-manage').find('input[type="checkbox"]:checked').val(),
            code: $('#code-create-gift-food-brand-manage').val(),
            is_special_claim_point: Number($('#print-create-gift-food-brand-manage').is(':checked')),
            is_sell_by_weight: $('#sell-by-create-gift-food-brand-manage').find('input[type="radio"]:checked').val(),
            is_allow_review: Number($('#review-create-gift-food-brand-manage').is(':checked')),
            is_allow_purchase_by_point: Number($('#party-create-gift-food-brand-manage').is(':checked')),
            is_take_away: $('#take-away-create-gift-food-brand-manage').find('input[type="radio"]:checked').val(),
            is_addition: 0,
            food_material_type: 0,
            food_addition_ids: [],
            is_combo: 0,
            food_in_combo: [],
            is_special_gift: 1,
            all_brand: $('#brand-create-food-combo-manage').find('input[type="radio"]:checked').val(),
            is_quantitative: Number($('#quantitative-create-gift-food-brand-manage').is(':checked')),
            material:  material,
            note_food : $('#note-gift-food-brand-manage').val(),
            original_price : removeformatNumber($('#original-create-gift-food-brand-manage').val()),
            restaurant_vat_config_id : $('#vat-create-gift-food-brand-manage').val()
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-food-brand-manage')]);
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        drawTableCreateFoodManage(res.data.data);
        closeModalCreateGiftFoodBradManage();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) text = res.data.message;
        ErrorNotify(text);
    }
}

function closeModalCreateGiftFoodBradManage(){
    $('#modal-create-gift-food-brand-manage').modal('hide');
    $('#name-create-gift-food-brand-manage').val('');
    $('#code-create-gift-food-brand-manage').val('');
    $("#category-create-gift-food-brand-manage").find('option:first').prop('selected', true).trigger('change.select2');
    $("#unit-create-gift-food-brand-manage").find('option:first').prop('selected', true).trigger('change.select2');
    $('#time-create-gift-food-brand-manage').val(1);
    $('#modal-create-gift-food-brand-manage img').attr('src', '/images/food_file.jpg');
    $('#note-gift-food-brand-manage').val(null).trigger("change");
}
