let saveAssignFoodHappyTimePromotion = 0,
    foodDataAssignFoodHappyTimePromotion = null,
    originalFoodDataAssignFoodHappyTimePromotion = null,
    changeHappyTimePromotion = 0,
    tableFoodAssignFood;

async function openModalAssignFoodHappyTimePromotion() {
    $('#modal-assign-food-happy-time-promotion').modal('show');
    $('#modal-assign-food-happy-time-promotion .js-example-basic-single').select2({
        dropdownParent: $('#modal-assign-food-happy-time-promotion'),
    });

    addLoading('happy-time-promotion.happy-time-promotion-assign', '#loading-modal-assign-food-happy-time-promotion');
    addLoading('happy-time-promotion.food-assign', '#loading-modal-assign-food-happy-time-promotion');
    addLoading('happy-time-promotion.happy-time-promotion-assign-detail', '#loading-modal-assign-food-happy-time-promotion');
    addLoading('happy-time-promotion.assign-food', '#loading-modal-assign-food-happy-time-promotion');

    await $('#select-branch-assign-food').val(($('#change_branch').val() != '-1') ? $('#change_branch').val() : $('#select-branch-assign-food option:first').val()).trigger('change');

    $('#select-branch-assign-food').unbind('select2:select').on('select2:select', async function () {
        if ($('#table-food-assign-food-happy-time-promotion tbody tr').length !== 0 || changeHappyTimePromotion == 1){
            let title = 'Đổi chi nhánh?',
                content = 'Sau khi đổi chi nhánh thì tất cả những dữ liệu bạn đã chọn sẽ không còn!',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    await dataHappyTimePromotionAssignToHappyTimePromotion();
                    clearAllDataAssignHappyTimePromotion();
                }
            })
        }else{
            await dataHappyTimePromotionAssignToHappyTimePromotion();
        }
    });

    $('#select-happy-time-promotion-assign-food').unbind('select2:select').on('select2:select', async function () {
        if ($('#table-food-assign-food-happy-time-promotion tbody tr').length !== 0){
            let title = 'Đổi chương trình?',
                content = 'Sau khi đổi chương trình thì tất cả những dữ liệu bạn đã chọn sẽ không còn!',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    await clearAllDataAssignHappyTimePromotion();
                    happyTimePromotionDetailAssignToHappyTimePromotion();
                }
            })
        }else{
            changeHappyTimePromotion = 1;
            happyTimePromotionDetailAssignToHappyTimePromotion();
        }
    });

    $('#select-food-assign-food-happy-time-promotion').unbind('select2:open').on('select2:open', async function () {
        let checkSelect = checkSelectTemplate('#modal-assign-food-happy-time-promotion');
        if (checkSelect === false){
            return false;
        }
    });


    $('#select-food-assign-food-happy-time-promotion').unbind('select2:select').on('select2:select', async function () {
        await addRowDatatableTemplate(tableFoodAssignFood, {
            'DT_RowIndex': tableFoodAssignFood.length,
            'avatar': `<img onerror="this.src='/images/tms/default.jpeg'" style="width: 41%" src="${$(this).find(':selected').attr('data-avatar')}" />`,
            'name': $(this).find(':selected').text(),
            'price': formatNumber($(this).find(':selected').attr('data-price')),
            'action': `<div class="btn-group-sm">
                            <button class="btn btn-danger waves-effect waves-light" onclick="removeFoodAssignFoodHappyTimePromotion($(this))" data-price="${$(this).find(':selected').attr('data-price')}" data-avatar="${$(this).find(':selected').attr('data-avatar')}" data-id="${$(this).find(':selected').val()}" data-name="${$(this).find(':selected').text()}"><span class="icofont icofont-ui-delete"></span></button>
                        </div>`
        });
        $('#select-food-assign-food-happy-time-promotion').find(':selected').remove();
        $('#select-food-assign-food-happy-time-promotion').val('').trigger('change');
    })


    $('#select-category-food-assign-food-happy-time-promotion').unbind('select2:selecting').on('select2:selecting', function () {
        let select_val = $('#select-food-assign-food-happy-time-promotion').html();
        switch ($(this).val()) {
            case '-1':
                foodDataAssignFoodHappyTimePromotion.all = select_val;
                break;
            case '1':
                foodDataAssignFoodHappyTimePromotion.food_opt = select_val;
                break;
            case '2':
                foodDataAssignFoodHappyTimePromotion.drink_opt = select_val;
                break;
            case '3':
                foodDataAssignFoodHappyTimePromotion.other_opt = select_val;
                break;
            case '4':
                foodDataAssignFoodHappyTimePromotion.sea_food_opt = select_val;
                break;
            case '5':
                foodDataAssignFoodHappyTimePromotion.gift_opt = select_val;
                break;
        }
    });

    $('#select-category-food-assign-food-happy-time-promotion').unbind('select2:select').on('select2:select', function () {
        if (foodDataAssignFoodHappyTimePromotion === null){
            dataFoodAssignToHappyTimePromotion();
        }else{
            switch ($(this).find('option:selected').val()) {
                case '-1':
                    $('#select-food-assign-food-happy-time-promotion').html(foodDataAssignFoodHappyTimePromotion.all);
                    break;
                case '1':
                    $('#select-food-assign-food-happy-time-promotion').html(foodDataAssignFoodHappyTimePromotion.food_opt);
                    break;
                case '2':
                    $('#select-food-assign-food-happy-time-promotion').html(foodDataAssignFoodHappyTimePromotion.drink_opt);
                    break;
                case '3':
                    $('#select-food-assign-food-happy-time-promotion').html(foodDataAssignFoodHappyTimePromotion.other_opt);
                    break;
                case '4':
                    $('#select-food-assign-food-happy-time-promotion').html(foodDataAssignFoodHappyTimePromotion.sea_food_opt);
                    break;
            }
            $('#select-food-assign-food-happy-time-promotion').select2('open');
        }
    });

    await dataHappyTimePromotionAssignToHappyTimePromotion();
    await dataFoodAssignToHappyTimePromotion();
    drawTableFoodAssignFoodHappyTimePromotion()
}

async function dataHappyTimePromotionAssignToHappyTimePromotion() {
    removeAllValidate();
    let method = 'get',
        url = 'happy-time-promotion.promotion-assign',
        restaurant_brands_id = $('#restaurant-branch-id-selected span').attr('data-value'),
        branch_id = $('#select-branch-assign-food').val(),
        params = {restaurant_brands_id: restaurant_brands_id, branch_id: branch_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#select-branch-assign-food")]);
    $('#select-happy-time-promotion-assign-food').html(res.data[0]);
}

async function drawTableFoodAssignFoodHappyTimePromotion() {
    let id = $('#table-food-assign-food-happy-time-promotion'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'restaurant_material_name', className: 'text-center', width: '5%'},
            {data: 'name', name: 'restaurant_material_name', className: 'text-center'},
            {data: 'price', name: 'quantity', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    tableFoodAssignFood = await DatatableTemplate(id, [], column, '40vh', fixed_left, fixed_right);
}

function removeFoodAssignFoodHappyTimePromotion(r) {
    $('#select-food-assign-food-happy-time-promotion').append(`<option data-avatar="${r.data('avatar')}" data-price="${r.data('price')}" value="${r.data('id')}">${r.data('name')}</option>`);
    removeRowDatatableTemplate(tableFoodAssignFood, r, true);
}

async function happyTimePromotionDetailAssignToHappyTimePromotion() {
    let method = 'get',
        url = 'happy-time-promotion.promotion-assign-detail',
        params = {id: $('#select-happy-time-promotion-assign-food').val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#select-happy-time-promotion-assign-food")]);
    $('#status-assign-food-happy-time-promotion').text(res.data[0].type_status_name);
    $('#employee-create-assign-food-happy-time-promotion').text(res.data[0].employee_create.full_name);
    $('#min-order-total-assign-food-happy-time-promotion').text(formatNumber(res.data[0].min_order_total_amount_required));

    if (res.data[0].discount_amount != 0){
        $('#discount-assign-food-happy-time-promotion').text(formatNumber(res.data[0].discount_amount) + ' VNĐ');
        $('#div-max-happy-time-promotion-assign-food-happy-time-promotion').addClass('d-none');
    }else{
        $('#discount-assign-food-happy-time-promotion').text(res.data[0].discount_percent + '%');
        $('#div-max-happy-time-promotion-assign-food-happy-time-promotion').removeClass('d-none');
        $('#max-happy-time-promotion-assign-food-happy-time-promotion').text(formatNumber(Number(res.data[0].max_happy_time_promotion_amount)));
    }
    $('#from-time-assign-food-happy-time-promotion').text(res.data[0].from_hour + ', ' + res.data[0].from_date);
    $('#to-time-assign-food-happy-time-promotion').text(res.data[0].to_hour + ', ' + res.data[0].to_date);
    $('#type-assign-food-happy-time-promotion').text(res.data[0].type);
    $('#day-of-week-assign-food-happy-time-promotion').text(': ' + res.data[0].day_of_weeks_text);
    $('#short-description-assign-food-happy-time-promotion').val(res.data[0].short_description);
    $('#description-assign-food-happy-time-promotion').text(res.data[0].description);
    $('#table-food-assign-food-happy-time-promotion tbody').html(res.data[1]);
}

async function dataFoodAssignToHappyTimePromotion() {
    removeAllValidate();
    let method = 'get',
        url = 'happy-time-promotion.food-assign',
        restaurant_brands_id = $('#restaurant-branch-id-selected span').attr('data-value'),
        params = {restaurant_brands_id: restaurant_brands_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#select-food-assign-food-happy-time-promotion")]);
    if (res.data[0] === 1) {
        $('#select-food-assign-food-happy-time-promotion').html(res.data[1]);
    } else {
        foodDataAssignFoodHappyTimePromotion = await res.data[1];
        originalFoodDataAssignFoodHappyTimePromotion = await res.data[1];

        switch ($('#select-category-food-assign-food-happy-time-promotion').val()) {
            case '-1':
                $('#select-food-assign-food-happy-time-promotion').html(res.data[1].all);
                break;
            case '1':
                $('#select-food-assign-food-happy-time-promotion').html(res.data[1].food_opt);
                break;
            case '2':
                $('#select-food-assign-food-happy-time-promotion').html(res.data[1].drink_opt);
                break;
            case '3':
                $('#select-food-assign-food-happy-time-promotion').html(res.data[1].food_opt);
                break;
            case '4':
                $('#select-food-assign-food-happy-time-promotion').html(res.data[1].sea_food_opt);
                break;
        }
    }
}

async function removeFoodAssignToHappyTimePromotion(r) {
    let i = r.parentNode.parentNode.parentNode;
    let select_type = await $('#select-category-food-assign-food-happy-time-promotion').find('option:selected').val(),
        avatar = $(i).find('td:eq(0)').find('img').attr('src'),
        name = $(i).find('td:eq(1)').find('label').text(),
        id = $(i).find('td:eq(1)').find('input').val(),
        is_gift = $(i).find('td:eq(1)').find('input').data('is-gift'),
        select = $(i).find('td:eq(1)').find('input').data('select'),
        price_format = $(i).find('td:eq(3)').find('label').text(),
        price = $(i).find('td:eq(3)').find('input').val();

    let opt = '<option value="' + id + '" data-avatar="' + avatar + '" data-name="' + name + '" data-price="' + price + '" data-price-format="' + price_format + '"  data-is-gift="' + is_gift + '" data-select="' + select + '">' + name + '</option>';

    if (select == select_type){
        $('#select-food-assign-food-happy-time-promotion').append(opt);
    }else{
        switch (select) {
            case -1:
                foodDataAssignFoodHappyTimePromotion.all = foodDataAssignFoodHappyTimePromotion.all + opt;
                break;
            case 1:
                foodDataAssignFoodHappyTimePromotion.food_opt = foodDataAssignFoodHappyTimePromotion.food_opt + opt;
                break;
            case 2:
                foodDataAssignFoodHappyTimePromotion.drink_opt = foodDataAssignFoodHappyTimePromotion.drink_opt + opt;
                break;
            case 3:
                foodDataAssignFoodHappyTimePromotion.other_opt = foodDataAssignFoodHappyTimePromotion.other_opt + opt;
                break;
            case 4:
                foodDataAssignFoodHappyTimePromotion.sea_food_opt = foodDataAssignFoodHappyTimePromotion.sea_food_opt + opt;
                break;
            case 5:
                foodDataAssignFoodHappyTimePromotion.gift_opt = foodDataAssignFoodHappyTimePromotion.gift_opt + opt;
                break;
        }
    }

    $('#table-food-assign-food-happy-time-promotion tbody tr').eq(i.rowIndex - 1).remove();
}

async function clearAllDataAssignHappyTimePromotion(){
    removeAllValidate();
    foodDataAssignFoodHappyTimePromotion = await originalFoodDataAssignFoodHappyTimePromotion;
    $('#select-category-food-assign-food-happy-time-promotion').val('-1').trigger('change');
    $('#select-food-assign-food-happy-time-promotion').html(originalFoodDataAssignFoodHappyTimePromotion.all);
    tableFoodAssignFood.clear().draw(false)
    changeHappyTimePromotion = 0;
    $('#status-assign-food-happy-time-promotion').text('');
    $('#employee-create-assign-food-happy-time-promotion').text('');
    $('#min-order-total-assign-food-happy-time-promotion').text('');
    $('#max-happy-time-promotion-assign-food-happy-time-promotion').text('');
    $('#discount-assign-food-happy-time-promotion').text('');
    $('#from-time-assign-food-happy-time-promotion').text('');
    $('#to-time-assign-food-happy-time-promotion').text('');
    $('#type-assign-food-happy-time-promotion').text('');
    $('#day-of-week-assign-food-happy-time-promotion').text(':');
    $('#short-description-assign-food-happy-time-promotion').val('');
    $('#description-assign-food-happy-time-promotion').text('');
}

async function saveAssignFoodHappyTimePromotion() {
    if ($('#table-food-assign-food-happy-time-promotion tbody tr').length === 0){
        ErrorNotify('Vui lòng chọn món!');
        return false;
    }

    if (saveAssignFoodHappyTimePromotion === 1) {
        return false;
    }
    saveAssignFoodHappyTimePromotion = 1;

    let TableData = [];
    $('#table-food-assign-food-happy-time-promotion tbody tr').each(function (row, tr) {
        TableData[row] = {
            "food_id": parseInt($(tr).find('td:eq(1)').find('input').val()),
            "is_promotion": 1
        };
    });

    let method = 'post',
        url = 'happy-time-promotion.assign-food',
        params = null,
        data = {
            restaurant_brand_id: $('#restaurant-branch-id-selected span').attr('data-value'),
            promotion_id: $('#select-happy-time-promotion-assign-food').val(),
            foods : TableData
        };

    let res = await axiosTemplate(method, url, params, data,[
        $("#select-happy-time-promotion-assign-food"),
        $("#loading-modal-assign-food-happy-time-promotion")
    ]);
    saveAssignFoodHappyTimePromotion = 0;
    if (res.data.status === 200) {
        SuccessNotify('Gán món thành công!');
        closeModalAssignFoodHappyTimePromotion();
    } else {
        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}

async function closeModalAssignFoodHappyTimePromotion() {
    $('#modal-assign-food-happy-time-promotion').modal('hide');
    clearAllDataAssignHappyTimePromotion();
    $('#discount-assign-food-happy-time-promotion').removeClass('d-none');
    $('#div-max-happy-time-promotion-assign-food-happy-time-promotion').removeClass('d-none');
    $('#status-assign-food-happy-time-promotion').text('---')
    $('#employee-create-assign-food-happy-time-promotion').text('---')
    $('#min-order-total-assign-food-happy-time-promotion').text('---')
    $('#discount-assign-food-happy-time-promotion').text('---')
    $('#max-promotion-assign-food-happy-time-promotion').text('---')
    $('#from-time-assign-food-happy-time-promotion').text('---')
    $('#to-time-assign-food-happy-time-promotion').text('---')
    $('#type-assign-food-happy-time-promotion').text('---')
    $('#day-of-week-assign-food-happy-time-promotion').text('---')
}


