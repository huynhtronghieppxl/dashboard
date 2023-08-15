let save_assign_food_promotion = 0,
    food_data_assign_food_promotion = null;
    original_food_data_assign_food_promotion = null,
    change_promotion = 0;

async function openModalAssignFoodPromotion() {
    $('#modal-assign-food-promotion').modal('show');
    $('#modal-assign-food-promotion .js-example-basic-single').select2({
        dropdownParent: $('#modal-assign-food-promotion'),
    });

    addLoading('promotion.promotion-assign', '#loading-modal-assign-food-promotion');
    addLoading('promotion.food-assign', '#loading-modal-assign-food-promotion');
    addLoading('promotion.promotion-assign-detail', '#loading-modal-assign-food-promotion');
    addLoading('promotion.assign-food', '#loading-modal-assign-food-promotion');

    await $('#select-branch-assign-food').val(($('#change_branch').val() != '-1') ? $('#change_branch').val() : $('#select-branch-assign-food option:first').val()).trigger('change');

    $('#select-branch-assign-food').unbind('select2:select').on('select2:select', async function () {
        if ($('#table-food-assign-food-promotion tbody tr').length !== 0 || change_promotion == 1){
            let title = 'Đổi chi nhánh?',
                content = 'Sau khi đổi chi nhánh thì tất cả những dữ liệu bạn đã chọn sẽ không còn!',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    await dataPromotionAssignToPromotion();
                    clearAllDataAssignPromotion();
                }
            })
        }else{
            await dataPromotionAssignToPromotion();
        }
    });

    $('#select-promotion-assign-food').unbind('select2:select').on('select2:select', async function () {
        if ($('#table-food-assign-food-promotion tbody tr').length !== 0){
            let title = 'Đổi chương trình?',
                content = 'Sau khi đổi chương trình thì tất cả những dữ liệu bạn đã chọn sẽ không còn!',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    await clearAllDataAssignPromotion();
                    promotionDetailAssignToPromotion();
                }
            })
        }else{
            change_promotion = 1;
            promotionDetailAssignToPromotion();
        }
    });

    $('#select-food-assign-food-promotion').unbind('select2:open').on('select2:open', async function () {
        let checkSelect = checkSelectTemplate('#modal-assign-food-promotion');
        if (checkSelect === false){
            return false;
        }
    });

    $('#select-food-assign-food-promotion').unbind('select2:select').on('select2:select', async function () {
        let check = 0;
        let id = $(this).val();
        await $('#table-food-assign-food-promotion tr').each(function (i, v) {
            if (id === $(v).find('td:eq(1)').find('input').val()) {
                $('#select-food-assign-food-promotion').val($('#select-food-assign-food-promotion option:first').val()).trigger('change');
                WarningNotify('Đã có trong bảng !');
                check = 1;
                return false;
            }
        });

        if (check === 0) {
            $('#table-food-assign-food-promotion tbody').append('<tr>\n' +
                '<td class="text-center w-10"><img src="' + $(this).find(':selected').data('avatar') + '" class="img-data-table"/></td>\n' +
                '<td class="text-center w-40"><label>' + $(this).find(':selected').data('name') + '</label><input value="' + $(this).find(':selected').val() + '" data-select="' + $(this).find(':selected').data('select') + '" class="d-none "/></td>\n' +
                '<td class="text-center w-15"><label class="price">' + $(this).find(':selected').data('price-format') + '</label><input value="' + $(this).find(':selected').data('price') + '" class="d-none price-input"/></td>\n' +
                '<td class="text-center w-10">\n' +
                '<div class="btn-group-sm">\n' +
                '<button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="removeFoodAssignToPromotion(this)"><span class="icofont icofont-ui-delete"></span></button>\n' +
                '</div></td>\n' +
                '</tr>');
            $('#select-food-assign-food-promotion').find(':selected').remove();
            $('#select-food-assign-food-promotion').val('').trigger('change.select2');
        }
    });

    $('#select-category-food-assign-food-promotion').unbind('select2:selecting').on('select2:selecting', function () {
        let select_val = $('#select-food-assign-food-promotion').html();
        switch ($(this).val()) {
            case '-1':
                food_data_assign_food_promotion.all = select_val;
                break;
            case '1':
                food_data_assign_food_promotion.food_opt = select_val;
                break;
            case '2':
                food_data_assign_food_promotion.drink_opt = select_val;
                break;
            case '3':
                food_data_assign_food_promotion.other_opt = select_val;
                break;
            case '4':
                food_data_assign_food_promotion.sea_food_opt = select_val;
                break;
            case '5':
                food_data_assign_food_promotion.gift_opt = select_val;
                break;
        }
    });

    $('#select-category-food-assign-food-promotion').unbind('select2:select').on('select2:select', function () {
        if (food_data_assign_food_promotion === null){
            dataFoodAssignToPromotion();
        }else{
            switch ($(this).find('option:selected').val()) {
                case '-1':
                    $('#select-food-assign-food-promotion').html(food_data_assign_food_promotion.all);
                    break;
                case '1':
                    $('#select-food-assign-food-promotion').html(food_data_assign_food_promotion.food_opt);
                    break;
                case '2':
                    $('#select-food-assign-food-promotion').html(food_data_assign_food_promotion.drink_opt);
                    break;
                case '3':
                    $('#select-food-assign-food-promotion').html(food_data_assign_food_promotion.other_opt);
                    break;
                case '4':
                    $('#select-food-assign-food-promotion').html(food_data_assign_food_promotion.sea_food_opt);
                    break;
            }

            $('#select-food-assign-food-promotion').select2('open');
        }
    });

    await dataPromotionAssignToPromotion();
    await dataFoodAssignToPromotion();
}

    async function dataPromotionAssignToPromotion() {
    removeAllValidate();
    let method = 'get',
        url = 'promotion.promotion-assign',
        restaurant_brands_id = $('#restaurant-branch-id-selected span').attr('data-value'),
        branch_id = $('#select-branch-assign-food').val(),
        params = {restaurant_brands_id: restaurant_brands_id, branch_id: branch_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#select-promotion-assign-food').html(res.data[0]);
}

async function promotionDetailAssignToPromotion() {
    let method = 'get',
        url = 'promotion.promotion-assign-detail',
        params = {id: $('#select-promotion-assign-food').val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#status-assign-food-promotion').text(res.data[0].type_status_name);
    $('#employee-create-assign-food-promotion').text(res.data[0].employee_create.full_name);
    $('#min-order-total-assign-food-promotion').text(formatNumber(res.data[0].min_order_total_amount_required));
    if (res.data[0].discount_amount != 0){
        $('#discount-assign-food-promotion').text(formatNumber(res.data[0].discount_amount) + ' VNĐ');
        $('#div-max-promotion-assign-food-promotion').addClass('d-none');
    }else{
        $('#discount-assign-food-promotion').text(res.data[0].discount_percent + '%');
        $('#div-max-promotion-assign-food-promotion').removeClass('d-none');
        $('#max-promotion-assign-food-promotion').text(formatNumber(res.data[0].max_promotion_amount));
    }
    $('#from-time-assign-food-promotion').text(res.data[0].from_hour + ', ' + res.data[0].from_date);
    $('#to-time-assign-food-promotion').text(res.data[0].to_hour + ', ' + res.data[0].to_date);
    $('#type-assign-food-promotion').text(res.data[0].type);
    $('#day-of-week-assign-food-promotion').text(': ' + res.data[0].day_of_weeks_text);
    $('#short-description-assign-food-promotion').val(res.data[0].short_description);
    $('#description-assign-food-promotion').text(res.data[0].description);
    $('#table-food-assign-food-promotion tbody').html(res.data[1]);
}

async function dataFoodAssignToPromotion() {
    removeAllValidate();
    let method = 'get',
        url = 'promotion.food-assign',
        restaurant_brands_id = $('#restaurant-branch-id-selected span').attr('data-value'),
        params = {restaurant_brands_id: restaurant_brands_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    if (res.data[0] === 1) {
        $('#select-food-assign-food-promotion').html(res.data[1]);
    } else {
        food_data_assign_food_promotion = await res.data[1];
        original_food_data_assign_food_promotion = await res.data[1];

        switch ($('#select-category-food-assign-food-promotion').val()) {
            case '-1':
                $('#select-food-assign-food-promotion').html(res.data[1].all);
                break;
            case '1':
                $('#select-food-assign-food-promotion').html(res.data[1].food_opt);
                break;
            case '2':
                $('#select-food-assign-food-promotion').html(res.data[1].drink_opt);
                break;
            case '3':
                $('#select-food-assign-food-promotion').html(res.data[1].food_opt);
                break;
            case '4':
                $('#select-food-assign-food-promotion').html(res.data[1].sea_food_opt);
                break;
        }
    }
}

async function removeFoodAssignToPromotion(r) {
    let i = r.parentNode.parentNode.parentNode;
    let select_type = await $('#select-category-food-assign-food-promotion').find('option:selected').val(),
        avatar = $(i).find('td:eq(0)').find('img').attr('src'),
        name = $(i).find('td:eq(1)').find('label').text(),
        id = $(i).find('td:eq(1)').find('input').val(),
        is_gift = $(i).find('td:eq(1)').find('input').data('is-gift'),
        select = $(i).find('td:eq(1)').find('input').data('select'),
        price_format = $(i).find('td:eq(3)').find('label').text(),
        price = $(i).find('td:eq(3)').find('input').val();

    let opt = '<option value="' + id + '" data-avatar="' + avatar + '" data-name="' + name + '" data-price="' + price + '" data-price-format="' + price_format + '"  data-is-gift="' + is_gift + '" data-select="' + select + '">' + name + '</option>';

    if (select == select_type){
        $('#select-food-assign-food-promotion').append(opt);
    }else{
        switch (select) {
            case -1:
                food_data_assign_food_promotion.all = food_data_assign_food_promotion.all + opt;
                break;
            case 1:
                food_data_assign_food_promotion.food_opt = food_data_assign_food_promotion.food_opt + opt;
                break;
            case 2:
                food_data_assign_food_promotion.drink_opt = food_data_assign_food_promotion.drink_opt + opt;
                break;
            case 3:
                food_data_assign_food_promotion.other_opt = food_data_assign_food_promotion.other_opt + opt;
                break;
            case 4:
                food_data_assign_food_promotion.sea_food_opt = food_data_assign_food_promotion.sea_food_opt + opt;
                break;
            case 5:
                food_data_assign_food_promotion.gift_opt = food_data_assign_food_promotion.gift_opt + opt;
                break;
        }
    }

    $('#table-food-assign-food-promotion tbody tr').eq(i.rowIndex - 1).remove();
    SuccessNotify('Xóa thành công !');
}

async function clearAllDataAssignPromotion(){
    removeAllValidate();
    food_data_assign_food_promotion = await original_food_data_assign_food_promotion;
    $('#select-category-food-assign-food-promotion').val('-1').trigger('change');
    $('#select-food-assign-food-promotion').html(original_food_data_assign_food_promotion.all);
    $('#table-food-assign-food-promotion tbody').empty();
    change_promotion = 0;
    $('#status-assign-food-promotion').text('');
    $('#employee-create-assign-food-promotion').text('');
    $('#min-order-total-assign-food-promotion').text('');
    $('#max-promotion-assign-food-promotion').text('');
    $('#discount-assign-food-promotion').text('');
    $('#from-time-assign-food-promotion').text('');
    $('#to-time-assign-food-promotion').text('');
    $('#type-assign-food-promotion').text('');
    $('#day-of-week-assign-food-promotion').text(':');
    $('#short-description-assign-food-promotion').val('');
    $('#description-assign-food-promotion').text('');
}

async function saveAssignFoodPromotion() {
    if (!checkValidateSave($('#loading-modal-assign-food-happy-time-promotion'))) return false
    if ($('#table-food-assign-food-promotion tbody tr').length === 0){
        ErrorNotify('Vui lòng chọn món!');
        return false;
    }

    if (save_assign_food_promotion === 1) {
        return false;
    }
    save_assign_food_promotion = 1;

    let TableData = [];
    $('#table-food-assign-food-promotion tbody tr').each(function (row, tr) {
        TableData[row] = {
            "food_id": parseInt($(tr).find('td:eq(1)').find('input').val()),
            "is_promotion": 1
        };
    });

    let method = 'post',
        url = 'promotion.assign-food',
        params = null,
        data = {
            restaurant_brand_id: $('#restaurant-branch-id-selected span').attr('data-value'),
            promotion_id: $('#select-promotion-assign-food').val(),
            foods : TableData
        };

    let res = await axiosTemplate(method, url, params, data);
    save_assign_food_promotion = 0;
    if (res.data.status === 200) {
        SuccessNotify('Gán món thành công!');
        closeModalAssignFoodPromotion();
    } else {
        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}

async function closeModalAssignFoodPromotion() {
    $('#modal-assign-food-promotion').modal('hide');
    clearAllDataAssignPromotion();
    $('#discount-assign-food-promotion').removeClass('d-none');
    $('#div-max-promotion-assign-food-promotion').removeClass('d-none');
}
