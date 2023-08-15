let checkSaveCreateBookingTableManage = 0,
    dataTableCreateFoodBookingManage,
    foodDataTableCreateBookingTable = null,
    thisFoodDataBookingTable, carouselBooking;

$(function(){
    $(document).on('change', '#select-food-create-booking-table-manage', async function () {
        let check = 0;
        let id = $(this).val();
        let name = $(this).find('option:selected').text(),
            sell_method = $(this).find('option:selected').data('weight') === 1 ? 'data-float = "1"' : 'data-number = "1"' ;
        await $('#table-food-create-booking-table-manage tr').each(function (i, v) {

            if (id === $(v).find('td:eq(0)').find('input').val()) {
                $('#select-food-create-booking-table-manage').val($('#select-food-create-booking-table-manage option:first').val()).trigger('change');
                WarningNotify(`Món [${name}] đã được chọn !`);
                check = 1;
                return false;
            }
        });
        if (check === 0) {
            let gift_symbol = ($(this).find(':selected').data('is-gift') == 1) ? '<i class="fa fa-2x fa-gift text-warning mr-2"></i>' : '',
                total_price = ($(this).find(':selected').data('is-gift') == 1) ? gift_symbol : $(this).find(':selected').data('price-format');

            addRowDatatableTemplate(dataTableCreateFoodBookingManage, {
                'avatar': '<img src="' + $(this).find(':selected').data('avatar') + '" onerror="this.src=\'/images/tms/default.jpeg\'" class="img-data-table"/>',
                'name': '<img src="' + $(this).find(':selected').data('avatar') + '" onerror="this.src=\'/images/tms/default.jpeg\'" class="img-inline-name-data-table"/>' +
                    '                            <label>' + $(this).find(':selected').data('name') + '</label><input class="d-none" data-is-gift="' + $(this).find(':selected').data('is-gift') + '" data-select="' + $(this).find(':selected').data('select') + '" value="' + $(this).find(':selected').val() + '">',
                'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                    '  <input class="form-control quantity rounded text-center border-0 w-100" '+ sell_method +' data-min="1" data-max="999" value="1" >\n' +
                    '  <label class="d-none quantity-label">1</label>\n' +
                    '</div>',
                'price': '<label class="text-center"><span>' + total_price + '</span></label>',
                'total_amount': '<label class="total-price text-center"><span>' + total_price + '</span></label>',
                'action': '<div class="btn-group-sm"><button class="tabledit-delete-button btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Xóa" onclick="removeFoodCreateBookingTableManage($(this))"><span class="icofont icofont-ui-delete"></span></button></div>',
                'keysearch': removeVietnameseStringLowerCase($(this).find(':selected').data('name') + $(this).find(':selected').data('price-format') + $(this).find(':selected').data('price'))
            });
            $('#select-food-create-booking-table-manage').find(':selected').remove();
            $('#select-food-create-booking-table-manage').val('').trigger('change.select2');
            sumCreateBookingTableManage();
        }
    });
});

async function openModalCreateBookingTableManage(r) {
    $('#modal-create-booking-table-manage').modal('show');

    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreateBookingTableManage();
    });
    shortcut.add('F4', function () {
        saveModalCreateBookingTableManage();
    });

    await dataTableCreateFoodBooking([]);
    $('#modal-create-booking-table-manage .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-booking-table-manage'),
    });

    await dataFoodCreateBookingTableManage();

    $('#select-category-create-booking-table-manage').unbind('select2:selecting').on('select2:selecting', function () {
        let select_val = $('#select-food-create-booking-table-manage').html();
        switch ($(this).val()) {
            case '-1':
                foodDataTableCreateBookingTable.all = select_val;
                break;
            case '1':
                foodDataTableCreateBookingTable.food_opt = select_val;
                break;
            case '2':
                foodDataTableCreateBookingTable.drink_opt = select_val;
                break;
            case '3':
                foodDataTableCreateBookingTable.other_opt = select_val;
                break;
            case '4':
                foodDataTableCreateBookingTable.sea_food_opt = select_val;
                break;
            case '5':
                foodDataTableCreateBookingTable.gift_opt = select_val;
                break;
            case '6':
                foodDataTableCreateBookingTable.combo_otp = select_val;
                break;
        }
    });

    $('#select-category-create-booking-table-manage').unbind('select2:select').on('select2:select', function () {
        if (foodDataTableCreateBookingTable === null) {
            dataFoodCreateBookingTableManage();
        } else {
            switch ($(this).find('option:selected').val()) {
                case '-1':
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.all);
                    break;
                case '1':
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.food_opt);
                    break;
                case '2':
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.drink_opt);
                    break;
                case '3':
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.other_opt);
                    break;
                case '4':
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.sea_food_opt);
                    break;
                case '5':
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.gift_opt);
                    break;
                case '6':
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.combo_opt);
                    break;
            }
            $('#select-food-create-booking-table-manage').select2('open');
        }
    });

    dataGiftBooking()
    $('#icon-gift').on('click', function (){
        if($(this).parent().find('.group-gift-selected ').hasClass('d-none')){
            $(this).parent().find('.group-gift-selected ').removeClass('d-none');
        }else {
            $(this).parent().find('.group-gift-selected ').addClass('d-none');
        }
    });

    $(document).on('click', '.list-gift-create-booking-table-manage .owl-item', function (e) {
        console.log(e.target.nodeName);
        if(!(e.target.nodeName === 'A')){
            if(!$(this).find('.add-remove-frnd').find('.add-tofrndlist').hasClass('d-none')){
                $(this).find('.item').addClass('border-warning');
                $(this).find('.item').attr('data-type', 1);
                $(this).find('.add-remove-frnd').find('.add-tofrndlist').addClass('d-none')
                $(this).find('.add-remove-frnd').find('.delete-tofrndlist').removeClass('d-none')
                $('#total-gift').text(Number($('#total-gift').text()) + 1)
            }else {
                $(this).find('.item').attr('data-type', 0);
                $(this).find('.item').removeClass('border-warning');
                $(this).find('.add-remove-frnd').find('.delete-tofrndlist').addClass('d-none')
                $(this).find('.add-remove-frnd').find('.add-tofrndlist').removeClass('d-none')
                $('#total-gift').text(Number($('#total-gift').text()) - 1)
            }
        }
    })
    $(document).mouseup(function (e) {
        if ($(e.target).closest(".group-gift-selected").length === 0) {
            $(".group-gift-selected").addClass('d-none');
        }
    });

    $(document).on('click','#booking-table-create-gift li', function (e){
        if (e.target.nodeName != 'INPUT' && e.target.nodeName != 'I'){
            openModalDetailGiftMarketing($(this))
        }
    })

    $(document).on('keyup','.search-gift-booking-table', function (){
        let search_value = removeVietnameseStringLowerCase($(this).val())
        $('.group-gift-selected li .name-inline-data-table').each(function (){
            if (removeVietnameseStringLowerCase($(this).text()).includes(search_value)){
                $(this).parents('li').show()
            }
            else{
                $(this).parents('li').hide()
            }
        })
    })

    $(document).on('click', '.add-tofrndlist' , function () {
        $(this).addClass('d-none')
        $(this).parents('.add-remove-frnd').find('.delete-tofrndlist').removeClass('d-none')
        $(this).parents('.item').addClass('border-warning');
        $('#total-gift').text(Number($('#total-gift').text()) + 1)
    });

    $(document).on('click', '.delete-tofrndlist' , function () {
        console.log(2);
        $(this).addClass('d-none')
        $(this).parents('.item').removeClass('border-warning');
        $(this).parents('.add-remove-frnd').find('.add-tofrndlist').removeClass('d-none')
        $('#total-gift').text(Number($('#total-gift').text()) - 1)
    });


    checkSaveCreateBookingTableManage = 0;
    $('#modal-create-booking-table-manage .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-booking-table-manage'),
    });

    let booking_create_time = $('#hour-create-booking-table-manage').val();
    $('#hour-create-booking-table-manage').on('blur', function () {
        if ($('#hour-create-booking-table-manage').val() == '') {
            $('#hour-create-booking-table-manage').val(booking_create_time);
        }
    });

    $("#hour-create-booking-table-manage").val(moment().format('H:mm'));
    thisFoodDataBookingTable = r;
    dateTimePickerMinDateToDayTemplate($('#date-create-booking-table-manage'));
    dateFullTimePickerTemplate($('#hour-create-booking-table-manage'));
    dateTimePickerTemplate($('#birthday-create-customer-booking-table-manage'));

    $(document).on('input', 'table#table-food-create-booking-table-manage tbody input.quantity', function () {
        let quantity = removeformatNumber($(this).val()),
            price = removeformatNumber($(this).parents('tr').find('td:eq(2)').text()),
            is_gift = parseFloat($(this).parents('tr').find('td:eq(1)').find('input').data('is-gift'));
        $(this).parents('td').find('label').text(quantity);
        if (is_gift != 1) {
            $(this).parents('tr').find('label.total-price span').text(formatNumber(checkDecimal(quantity * price)));
        }
        sumCreateBookingTableManage();
    });

    $(document).on('click', 'table#table-food-create-booking-table-manage tbody input.quantity', function () {
        $(this).select();
    });

    $('#modal-create-booking-table-manage input').on('click', function () {
        $(this).select();
    });

    $('#customer-phone-create-booking-table-manage').val($('#phone-number-customer-restaurant').text());
    // searchCustomerBookingTableManage();

    $('#customer-phone-create-booking-table-manage').on('input paste', function () {
        if ($(this).val() !== "") {
            searchCustomerBookingTableManage();
        }
    });

    $('#customer-phone-create-booking-table-manage').on('keyup', function () {
        if ($(this).val() == '') {
            $('#data-search-customer-booking-table-manage').addClass('d-none');
        }
        $('#first-name-create-customer-booking-table-manage').attr("disabled", false);
        $('#last-name-create-customer-booking-table-manage').attr("disabled", false);
    });

    $(document).on('click', '.item-search-customer', function () {
        $('#data-search-customer-booking-table-manage').addClass('d-none');
        $('#customer-phone-create-booking-table-manage').val($(this).data('phone'));
        $('#customer-phone-create-booking-table-manage').data('id', $(this).data('id'));
        $('#last-name-create-customer-booking-table-manage').val($(this).data('first-name'));
        $('#first-name-create-customer-booking-table-manage').val($(this).data('last-name'));
        $('#last-name-create-customer-booking-table-manage').attr("disabled", true);
        $('#first-name-create-customer-booking-table-manage').attr("disabled", true);
    });


    $('#customer-phone-create-booking-table-manage').on('click', function () {
        if ($(this).val() !== "") {
            $('#data-search-customer-booking-table-manage').removeClass('d-none');
        }
    });

    // dataGiftBookingTableManage();
    dataGetTags();
    showButtonReloadUpdateBookingTable();
    $('#select-branch-create-booking-table-manage').text($('#select-branch-setting .brand-select-name').text());

}

async function dataTableCreateFoodBooking(data) {
    let id1 = $('#table-food-create-booking-table-manage'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'name', name: 'name'},
            {data: 'quantity', name: 'quantity', className: 'text-center', width: '5%'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'}
        ], option = []
    dataTableCreateFoodBookingManage = await DatatableTemplateNew(id1, data, column, vh_of_table, fixed_left, fixed_right, option);
}

async function removeFoodCreateBookingTableManage(r) {
    r.tooltip('hide')
    dataTableCreateFoodBookingManage.row(r.parents('tr')).remove().draw(false);
    let i = r.parents('tr');
    let select_type = await $('#select-category-create-booking-table-manage').find('option:selected').val(),
        avatar = r.parents('tr').find('td:eq(0)').find('img').attr('src'),
        name = r.parents('tr').find('td:eq(0)').find('label').text(),
        is_gift = r.parents('tr').find('td:eq(0)').find('input').data('is-gift'),
        select = r.parents('tr').find('td:eq(0)').find('input').data('select'),
        id = r.parents('tr').find('td:eq(0)').find('input').attr('value'),
        price_format = r.parents('tr').find('td:eq(3)').find('label').text(),
        price = removeformatNumber(r.parents('tr').find('td:eq(3)').find('label').text());
    let opt = '<option value="' + id + '" data-avatar="' + avatar + '" data-name="' + name + '" data-price="' + price + '" data-price-format="' + price_format + '"  data-is-gift="' + is_gift + '" data-select="' + select + '">' + name + '</option>';
    if (select == select_type) {
        $('#select-food-create-booking-table-manage').append(opt);
    } else {
        switch (select) {
            case -1:
                foodDataTableCreateBookingTable.all = foodDataTableCreateBookingTable.all + opt;
                break;
            case 1:
                foodDataTableCreateBookingTable.food_opt = foodDataTableCreateBookingTable.food_opt + opt;
                break;
            case 2:
                foodDataTableCreateBookingTable.drink_opt = foodDataTableCreateBookingTable.drink_opt + opt;
                break;
            case 3:
                foodDataTableCreateBookingTable.other_opt = foodDataTableCreateBookingTable.other_opt + opt;
                break;
            case 4:
                foodDataTableCreateBookingTable.sea_food_opt = foodDataTableCreateBookingTable.sea_food_opt + opt;
                break;
            case 6:
                foodDataTableCreateBookingTable.combo_opt = foodDataTableCreateBookingTable.combo_opt + opt;
                break;
        }
    }

    $('#table-food-create-booking-table-manage tbody tr').eq(i.rowIndex - 1).remove();
    sumCreateBookingTableManage();
}

async function sumCreateBookingTableManage() {
    let total = 0;

    await dataTableCreateFoodBookingManage.rows().every(function () {
        let row = $(this.node());
        total += parseFloat(removeformatNumber(row.find('td:eq(3)').find('label').find('span').text()));
    })
    $('#total-create-booking-table-manage').text(formatNumber(total));
}

/** Get list food branch restaurant **/
async function dataFoodCreateBookingTableManage() {
    let method = 'get',
        url = 'booking-table-manage.food',
        category = $('#select-category-create-booking-table-manage').val(),
        params = {branch: $('#change_branch').val(), category: category, restaurant_brands_id: $('#restaurant-branch-id-selected').find('span.d-none').data('value')},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-food-create-booking-table-manage'), $('#boxlist-create-booking-table-manage')]);
    if (res.data[0] === 1) {
        $('#select-food-create-booking-table-manage').html(res.data[1]);
    } else {
        foodDataTableCreateBookingTable = await res.data[1];

        switch ($('#select-category-create-booking-table-manage').val()) {
            case '-1':
                $('#select-food-create-booking-table-manage').html(res.data[1].all);
                break;
            case '1':
                $('#select-food-create-booking-table-manage').html(res.data[1].food_opt);
                break;
            case '2':
                $('#select-food-create-booking-table-manage').html(res.data[1].drink_opt);
                break;
            case '3':
                $('#select-food-create-booking-table-manage').html(res.data[1].food_opt);
                break;
            case '4':
                $('#select-food-create-booking-table-manage').html(res.data[1].sea_food_opt);
                break;
            case '5':
                $('#select-food-create-booking-table-manage').html(res.data[1].gift_opt);
                break;
            case '6':
                $('#select-food-create-booking-table-manage').html(res.data[1].combo_opt);
                break;
        }
    }
}

async function saveModalCreateBookingTableManage() {
    if (!checkValidateSave($('#modal-create-booking-table-manage'))) return false;
    if (checkSaveCreateBookingTableManage === 1) return false;
    let customer_id = $('#customer-phone-create-booking-table-manage').data('id');
    let customer_phone = $('#customer-phone-create-booking-table-manage').val(),
        deposit_amount = $('#deposit-amount-create-booking-table-manage').val(),
        deposit_payment_method = $('#deposit-amount-payment-method-create-booking-table-manage').val(),
        orther_requirements = $('#other-requirements-create-booking-table-manage').val(),
        note = $('#note-create-booking-table-manage').val(),
        number_slot = $('#number-create-booking-table-manage').val(),
        time = $('#hour-create-booking-table-manage').val() + ':00',
        date = $('#date-create-booking-table-manage').val(),
        booking_type = 3,
        employee_id = '',
        TableData = [],
        customer_last_name = $('#last-name-create-customer-booking-table-manage').val(),
        customer_first_name = $('#first-name-create-customer-booking-table-manage').val(),
        gift = [];
    dataTableCreateFoodBookingManage.rows().every(function () {
        let row = $(this.node());
        TableData.push({
            "food_id": row.find('td:eq(0)').find('input').attr('value'),
            "quantity": row.find('td:eq(1)').find('input').val(),
            "is_gift": row.find('td:eq(0)').find('input').data('is-gift')
        });
    });
    let list_gift_create_booking_table = [];
    $('#booking-table-create-gift li').each(function(index, item ) {
        if($(this).find('input[type="checkbox"]').is(':checked')){
            list_gift_create_booking_table.push($( this ).find('input[type="checkbox"]').data('id'))
        }
    });
    console.log(list_gift_create_booking_table)
    checkSaveCreateBookingTableManage = 1;
    let method = 'post',
        url = 'booking-table-manage.create',
        params = null,
        data = {
            branch: $('#change_branch').val(),
            customer_id: customer_id,
            customer_last_name: customer_last_name,
            customer_first_name: customer_first_name,
            customer_phone: customer_phone,
            orther_requirements: orther_requirements,
            note: note,
            number_slot: number_slot,
            booking_time: date + ' ' + time,
            booking_type: booking_type,
            employee_id: employee_id,
            TableData: TableData,
            deposit_payment_method: deposit_payment_method,
            deposit_amount: removeformatNumber(deposit_amount),
            list : $('#hashtag-create-customer-booking-table-manage').val(),
            gift: list_gift_create_booking_table,
        };
    let res = await axiosTemplate(method, url   , params, data, [
        $('#loading-modal-create-booking-table-manage')
    ]);
    checkSaveCreateBookingTableManage = 0;
    let text;
    switch (res.data.status){
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            closeModalCreateBookingTableManage();
            loadData();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text)
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text)
    }
}

function totalGiftCreateBookingTable(r){
    if (r.is(':checked') === true){
        r.parents('li').css({
            'background-color': '#ecf1f5',
            'border-bottom': '1px solid #fff'
        });
    }
    else{
        r.parents('li').attr('style','');
    }
    $('#total-gift-create-booking-table').text($('#booking-table-create-gift').find('input[type="checkbox"]:checked').length)
    $('#total-gift-update-booking-table').text($('#booking-table-update-gift').find('input[type="checkbox"]:checked').length)
}

function closeModalCreateBookingTableManage() {
    shortcut.remove('F4');
    $('#modal-create-booking-table-manage').modal('hide');
    removeAllValidate();
    reloadModalCreateBookingTable();
    $('.group-icon-gift label').text(0);
    $('.group-gift-selected').addClass('d-none')
    dataListGiftBooking = [];
    checkDataGiftCreateFoodBooking = 0;
}


async function dataGetTags(){
    let method = 'get',
        url = 'booking-table-manage.tags',
        params = {},
        data = null;
    let res = await axiosTemplate(method, url   , params, data, [
        $('#hashtag-create-customer-booking-table-manage')
    ]);
    $('#hashtag-create-customer-booking-table-manage').html(res.data[0]);
}

/**
 * Customer
 */
let checkSearchCustomerBookingTableManage = 0;

async function searchCustomerBookingTableManage() {
    if (checkSearchCustomerBookingTableManage === 1) return false;
    $('#customer-phone-create-booking-table-manage').data('id', 0);
    $('#last-name-create-customer-booking-table-manage').val('');
    $('#first-name-create-customer-booking-table-manage').val('');
    let method = 'get',
        url = 'booking-table-manage.search-customer',
        phone = $('#customer-phone-create-booking-table-manage').val(),
        params = {phone: phone, branch_id: $('#change_branch').val()},
        data = null;
    checkSearchCustomerBookingTableManage = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkSearchCustomerBookingTableManage = 0;
    console.log('res', res)
    if (res.data[1].status === 200) {
        $('#data-search-customer-booking-table-manage').removeClass('d-none');
        $('#data-search-customer-booking-table-manage').html(res.data[0]);
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

/**
 * Quà tặng
 */

let checkDataGiftBookingTableManage = 0;

// async function dataGiftBookingTableManage() {
//
//     if (checkDataGiftBookingTableManage === 1) return false;
//     let method = 'get',
//         url = 'booking-table-manage.data-gift',
//         brand = $('#restaurant-branch-id-selected span').attr('data-value'),
//         params = {branch: brand},
//         data = null;
//     checkDataGiftBookingTableManage = 1;
//     let res = await axiosTemplate(method, url, params, data);
//     checkDataGiftBookingTableManage = 0;
//     if (res.data[1].status === 200) {
//         $('.list-gift-create-booking-table-manage').html(res.data[0]);
//         carouselBooking = $('.list-gift-create-booking-table-manage').owlCarousel({
//             margin: 10,
//             dot: false,
//             nav: true,
//             responsive: {
//                 0: {
//                     items: 2
//                 },
//                 600: {
//                     items: 5
//                 },
//                 1000: {
//                     items: 10
//                 }
//             }
//         })
//     } else {
//         let text = $('#error-post-data-to-server').text();
//         if (res.data.message !== null) {
//             text = res.data.message;
//         }
//         ErrorNotify(text);
//     }
// }

function reloadModalCreateBookingTable() {
    // carouselBooking.destroy();
    removeAllValidate();
    dataTableCreateFoodBookingManage.clear().draw(false);
    $('#select-category-create-booking-table-manage').val(-1).trigger('change.select2')
    $("#hour-create-booking-table-manage").val(moment().format('H:mm'));
    $('#total-gift').text(0)
    $('#date-create-booking-table-manage').val(moment(new Date).format('DD/MM/YYYY'));
    $('#last-name-create-customer-booking-table-manage').val('');
    $('#first-name-create-customer-booking-table-manage').val('');
    $('#customer-phone-create-booking-table-manage').val('');
    $('#customer-phone-create-booking-table-manage').attr('data-id', 0);
    $('#customer-name-create-booking-table-manage').text('');
    $('#total-create-booking-table-manage').text(0);
    $('#number-create-booking-table-manage').val(1);
    $('#deposit-amount-create-booking-table-manage').val(0);
    $('#modal-create-booking-table-manage textarea').val('');
    $('#customer-name-create-booking-table-manage').data('lastname', '');
    $('#customer-name-create-booking-table-manage').data('firstname', '');
    $('#deposit-amount-payment-method-create-booking-table-manage').val('1').trigger('change');
    $('#data-search-customer-booking-table-manage').addClass('d-none');
    // $('.list-gift-create-booking-table-manage .owl-item .item').each(function () {
    //     $(this).find('.deleteFriendBookingTableBtn').addClass('d-none')
    //     $(this).find('.addFriendBookingTableBtn').removeClass('d-none')
    // })
    $('.list-gift-create-booking-table-manage').html('');
    // $('.list-gift-create-booking-table-manage').owlCarousel('destroy');
    $('#modal-create-booking-table-manage .btn-renew').addClass('d-none')
    checkSaveCreateBookingTableManage = 0;
    foodDataTableCreateBookingTable = null;
}

function showButtonReloadUpdateBookingTable() {
    $('#modal-create-booking-table-manage select').change(function () {
        $('#modal-create-booking-table-manage .btn-renew').removeClass('d-none')
    })
    $('#modal-create-booking-table-manage input').on('keyup', function () {
        $('#modal-create-booking-table-manage .btn-renew').removeClass('d-none')
    })

    $('#date-create-booking-table-manage').on('dp.change', function () {
        $('#modal-create-booking-table-manage .btn-renew').removeClass('d-none')
    })
    $('#hour-create-booking-table-manage').on('dp.change', function () {
        $('#modal-create-booking-table-manage .btn-renew').removeClass('d-none')
    })
}

let checkConfirmDepositBookingDataTableManageFacebook = 0;
function confirmDepositBookingDataTableManageFacebook(r) {
    if (checkConfirmDepositBookingDataTableManageFacebook === 1) return false;
    checkConfirmDepositBookingDataTableManageFacebook = 1;
    let title = 'Xác nhận cọc ?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'booking-table-manage.confirm-deposit',
                params = null,
                data = {
                    booking_id: r.data('id'),
                };
            let res = await axiosTemplate(method, url, params, data);
            checkConfirmDepositBookingDataTableManageFacebook = 0;
            let text = '';
            switch(res.data.status) {
                case 200:
                    SuccessNotify('Xác nhận cọc thành công!');
                    r.parents('tr').find('td:eq(9)').html(res.data.data.status_text)
                    r.parents('.btn-group').html(res.data.data.action);
                    break;
                case 500:
                    text = 'Xác nhận cọc không thành công!';
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    return false;
                    break;
                default:
                    text = 'Xác nhận cọc không thành công!';
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
                    return false;
            }
        } else {
            checkConfirmDepositBookingDataTableManageFacebook = 0;
        }
    });
}

let checkConfirmBookingTableManageFacebook = 0;

async function confirmBookingTableManageFacebook(r) {
    if (checkConfirmBookingTableManageFacebook === 1) return false;
    checkConfirmBookingTableManageFacebook = 1;
    let title = 'Xác nhận đặt bàn ?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'booking-table-manage.confirm',
                params = null,
                data = {
                    id: r.data('id'),
                };
            let res = await axiosTemplate(method, url, params, data, [
                $('#loading-modal-confirm-booking-table-manage')
            ]);
            checkConfirmBookingTableManageFacebook = 0;
            let text = '';
            switch(res.data.status) {
                case 200:
                    text = $('#success-confirm-data-to-server ').text();
                    SuccessNotify(text);
                    r.parents('tr').find('td:eq(9)').html(String(res.data.data.status_text));
                    r.parents('.btn-group').html(res.data.data.action);
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        } else {
            checkConfirmBookingTableManageFacebook = 0;
        }
    })
}
