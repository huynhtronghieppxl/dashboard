let checkSaveCreateBookingTableManage = 0,
    dataTableCreateFoodBookingManage,
    foodDataTableCreateBookingTable = null,
    thisFoodDataBookingTable, idFoodSe,
    numberMinuteAllowBookingBeforeOpenOrder;
$(function () {
    $('#icon-gift').on('click', function () {
        if ($(this).parents('.group-icon-gift').find('.group-gift-selected').hasClass('d-none')) {
            $(this).parents('.group-icon-gift').find('.group-gift-selected').removeClass('d-none');
        } else {
            $(this).parents('.group-icon-gift').find('.group-gift-selected').addClass('d-none');
        }
    })
    shortcut.add("F2", function () {
        openModalCreateBookingTableManage();
    })
    $(document).on('click', '#booking-table-create-gift li', function (e) {
        if (e.target.nodeName != 'INPUT' && e.target.nodeName != 'I') {
            openModalDetailGiftMarketing($(this))
        }
    })
    $(document).on('keyup', '.search-gift-booking-table', function () {
        let search_value = removeVietnameseStringLowerCase($(this).val())
        $('.group-gift-selected li .name-inline-data-table').each(function () {
            if (removeVietnameseStringLowerCase($(this).text()).includes(search_value)) {
                $(this).parents('li').show()
            } else {
                $(this).parents('li').hide()
            }
        })
    })
    $(document).click(function (event) {
        if (!$(event.target).closest('#icon-gift').length && !$(event.target).closest('.group-gift-selected').length) {
            $('#icon-gift').parents('.group-icon-gift').find('.group-gift-selected').addClass('d-none');
        }
    });
    numberMinuteAllowBookingBeforeOpenOrder = $('#hour-create-booking-table-manage').data('booking-before-open-order');
})

function openModalCreateBookingTableManage(r) {
    $('#modal-create-booking-table-manage').modal('show');
    if (checkLoadDataCreateBooking == 0) {
        dataGetTags();
        dataGiftBooking();
        dataFoodCreateBookingTableManage();
        checkLoadDataCreateBooking = 1;
    }
    checkSaveCreateBookingTableManage = 0;
    $('#modal-create-booking-table-manage .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-booking-table-manage'),
    });

    let booking_create_time = $('#hour-create-booking-table-manage').val();
    $('#hour-create-booking-table-manage').on('blur', function () {
        if ($('#hour-create-booking-table-manage').val() == '') {
            $('#hour-create-booking-table-manage').val(booking_create_time);
        }
    })
    thisFoodDataBookingTable = r;
    dateTimePickerMinDateToDayTemplate($('#date-create-booking-table-manage'));
    dateFullTimePickerTemplate($('#hour-create-booking-table-manage'));
    dateTimePickerTemplate($('#birthday-create-customer-booking-table-manage'));
    shortcut.remove('ESC');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalCreateBookingTableManage();
    });
    shortcut.add('F4', function () {
        saveModalCreateBookingTableManage();
    });
    if (getCookieShared('booking-table-manage-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('booking-table-manage-user-id-' + idSession));
        $('#select-branch-create-booking-table-manage').text(dataCookie.nameBranch);
    }
    dataTableCreateFoodBooking([]);

    $('#select-food-create-booking-table-manage').unbind('select2:select').on('select2:select', async function () {
        let check = 0;
        let id = $(this).val();
        let name = $(this).find('option:selected').text(),
            sell_method = $(this).find('option:selected').data('weight') === 1 ? 'data-float = "1"' : 'data-number = "1"';
        // await $('#table-food-create-booking-table-manage tr').each(function (i, v) {
        //     if (id === $(v).find('td:eq(0)').find('input').val()) {
        //         $('#select-food-create-booking-table-manage').val($('#select-food-create-booking-table-manage option:first').val()).trigger('change');
        //         WarningNotify(`Món [${name}] đã được chọn !`);
        //         check = 1;
        //         return false;
        //     }
        // });
        if (check === 0) {
            let gift_symbol = ($(this).find(':selected').data('is-gift') == 1) ? '<i class="fa fa-2x fa-gift text-warning mr-2"></i>' : '',
                total_price = ($(this).find(':selected').data('is-gift') == 1) ? gift_symbol : $(this).find(':selected').data('price-format');
            let value_selected = $('#select-food-create-booking-table-manage').find(':selected').val()
            let value_category = $('#select-food-create-booking-table-manage').find(':selected').attr('data-category')
            addRowDatatableTemplate(dataTableCreateFoodBookingManage, {
                'avatar': '<img src="' + $(this).find(':selected').data('avatar') + '" onerror="this.src=\'/images/tms/default.jpeg\'" class="img-data-table"/>',
                'name': '<img src="' + $(this).find(':selected').data('avatar') + '" onerror="this.src=\'/images/tms/default.jpeg\'" class="img-inline-name-data-table"/>' +
                    '                            <label>' + $(this).find(':selected').data('name') + '</label><input class="d-none" data-is-gift="' + $(this).find(':selected').data('is-gift') + '" data-select="' + $(this).find(':selected').data('select') + '" value="' + $(this).find(':selected').val() + '">',
                'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                    '  <input style="font-size: 14px !important;" class="form-control quantity rounded text-center border-0 w-100" ' + sell_method + ' data-min="1" data-max="999" value="1" >\n' +
                    '  <label class="d-none quantity-label">1</label>\n' +
                    '</div>',
                'price': '<label class="right"><span class="seemt-fz-14">' + total_price + '</span></label>',
                'total_amount': '<label class="total-price right"><span class="seemt-fz-14">' + total_price + '</span></label>',
                'action': '<div class="btn-group-sm"><button data-value="' + value_selected + '" data-category="' + value_category + '"  class="tabledit-delete-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Xóa" onclick="removeFoodCreateBookingTableManage($(this))"><span class="fi-rr-trash"></span></button></div>',
                'keysearch': removeVietnameseStringLowerCase($(this).find(':selected').data('name') + $(this).find(':selected').data('price-format') + $(this).find(':selected').data('price'))
            });
            switch (value_category) {
                case '1':
                    $('#select-food-create-booking').find('option[value="' + value_selected + '"]').remove();
                    foodDataTableCreateBookingTable.food_opt = $('#select-food-create-booking').html();
                    break;
                case '2':
                    $('#select-drink-create-booking').find('option[value="' + value_selected + '"]').remove();
                    foodDataTableCreateBookingTable.drink_opt = $('#select-drink-create-booking').html();
                    break;
                case '3':
                    $('#select-other-create-booking').find('option[value="' + value_selected + '"]').remove();
                    foodDataTableCreateBookingTable.other_opt = $('#select-other-create-booking').html();
                    break;
                case '6':
                    $('#select-combo-create-booking').find('option[value="' + value_selected + '"]').remove();
                    foodDataTableCreateBookingTable.combo_opt = $('#select-combo-create-booking').html();
                    break;
            }
            $('#select-all-create-booking').find('option[value="' + value_selected + '"]').remove()
            foodDataTableCreateBookingTable.all = $('#select-all-create-booking').html();
            $('#select-food-create-booking-table-manage').find(':selected').remove();
            $('#select-food-create-booking-table-manage').val('').trigger('change.select2');
            sumCreateBookingTableManage();
        }
    });

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

    $('#customer-phone-create-booking-table-manage').on('input paste', function () {
        $('#full-name-create-customer-booking-table-manage').attr("disabled", false);
        if ($(this).val() !== "") {
            searchCustomerBookingTableManage();
            $('#data-search-customer-booking-table-manage').removeClass('d-none');
        } else {
            $('#full-name-create-customer-booking-table-manage').val('');
        }
    })
    $('#modal-create-booking-table-manage').on('click focus', function () {
        $('#data-search-customer-booking-table-manage').addClass('d-none');
    })
    $(document).on('click', '.item-search-customer', function () {
        $('#data-search-customer-booking-table-manage').addClass('d-none');
        $('#customer-phone-create-booking-table-manage').val($(this).data('phone'));
        $('#customer-phone-create-booking-table-manage').data('id', $(this).data('id'));
        $('#full-name-create-customer-booking-table-manage').val($(this).data('name'));
        $('#full-name-create-customer-booking-table-manage').attr("disabled", true);
    })


    $('#customer-phone-create-booking-table-manage').on('click', function () {
        if ($(this).val() !== "") {
            $('#data-search-customer-booking-table-manage').removeClass('d-none');
        }
    })
    $('#select-category-create-booking-table-manage').unbind('select2:select').on('select2:select', function () {
        if (foodDataTableCreateBookingTable === null) {
            dataFoodCreateBookingTableManage();
        } else {
            switch ($(this).find('option:selected').val()) {
                case '-1':
                    foodDataTableCreateBookingTable.all = $('#select-all-create-booking').html();
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.all);
                    break;
                case '1':
                    foodDataTableCreateBookingTable.food_opt = $('#select-food-create-booking').html();
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.food_opt);
                    break;
                case '2':
                    foodDataTableCreateBookingTable.drink_opt = $('#select-drink-create-booking').html();
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.drink_opt);
                    break;
                case '3':
                    foodDataTableCreateBookingTable.other_opt = $('#select-other-create-booking').html();
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.other_opt);
                    break;
                case '6':
                    foodDataTableCreateBookingTable.combo_opt = $('#select-combo-create-booking').html();
                    $('#select-food-create-booking-table-manage').html(foodDataTableCreateBookingTable.combo_opt);
                    break;
            }
            $('#select-food-create-booking-table-manage').select2('open');
        }
    });
    showButtonReloadUpdateBookingTable()
}


async function dataTableCreateFoodBooking(data) {
    let id1 = $('#table-food-create-booking-table-manage'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'name', name: 'name'},
            {data: 'quantity', name: 'quantity', className: 'text-center', width: '5%'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
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
        is_gift = r.parents('tr').find('td:eq(0)').find('input').attr('data-is-gift'),
        select = r.parents('tr').find('td:eq(0)').find('input').attr('data-select'),
        id = r.parents('tr').find('td:eq(0)').find('input').attr('value'),
        price_format = r.parents('tr').find('td:eq(3)').find('label').text(),
        price = removeformatNumber(r.parents('tr').find('td:eq(3)').find('label').text()),
        category = r.parents('tr').find('td:eq(4)').find('button').attr('data-category');
    let opt = '<option value="' + id + '" data-category="' + category + '" data-avatar="' + avatar + '" data-name="' + name + '" data-price="' + price + '" data-price-format="' + price_format + '"  data-is-gift="' + is_gift + '" data-select="' + select + '">' + name + '</option>';
    if (category == select_type || select_type == -1) {
        $('#select-food-create-booking-table-manage').find('option:first').after(opt);
    }
    foodDataTableCreateBookingTable.all = foodDataTableCreateBookingTable.all + opt;
    $('#select-all-create-booking').html(foodDataTableCreateBookingTable.all)
    switch (parseInt(category)) {
        case 1:
            foodDataTableCreateBookingTable.food_opt = foodDataTableCreateBookingTable.food_opt + opt;
            $('#select-food-create-booking').html(foodDataTableCreateBookingTable.food_opt)
            break;
        case 2:
            foodDataTableCreateBookingTable.drink_opt = foodDataTableCreateBookingTable.drink_opt + opt;
            $('#select-drink-create-booking').html(foodDataTableCreateBookingTable.drink_opt)
            break;
        case 3:
            foodDataTableCreateBookingTable.other_opt = foodDataTableCreateBookingTable.other_opt + opt;
            $('#select-other-create-booking').html(foodDataTableCreateBookingTable.other_opt)
            break;
        case 6:
            foodDataTableCreateBookingTable.combo_opt = foodDataTableCreateBookingTable.combo_opt + opt;
            $('#select-combo-create-booking').html(foodDataTableCreateBookingTable.combo_opt)
            break;
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

async function dataFoodCreateBookingTableManage() {
    let method = 'get',
        url = 'booking-table-manage.food',
        restaurant_brands_id = $('.select-brand').val(),
        category = $('#select-category-create-booking-table-manage').val(),
        params = {branch: branchIdBookingTableManage, category: category, restaurant_brands_id: restaurant_brands_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-food-create-booking-table-manage'),
        $('#boxlist-create-booking-table-manage')
    ]);
    if (res.data[0] === 1) {
        $('#select-food-create-booking-table-manage').html(res.data[1]);
    } else {
        foodDataTableCreateBookingTable = await res.data[1];
        $('#select-all-create-booking').html(res.data[1].all)
        $('#select-food-create-booking').html(res.data[1].food_opt)
        $('#select-drink-create-booking').html(res.data[1].drink_opt)
        $('#select-other-create-booking').html(res.data[1].other_opt)
        $('#select-combo-create-booking').html(res.data[1].combo_opt)
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
        deposit_amount = $('#deposit-amount-create-table-manage').val(),
        deposit_payment_method = $('#deposit-amount-payment-method-create-booking-table-manage').val(),
        orther_requirements = $('#other-requirements-create-booking-table-manage').val(),
        note = $('#note-create-booking-table-manage').val(),
        number_slot = $('#number-create-booking-table-manage').val(),
        time = $('#hour-create-booking-table-manage').val() + ':00',
        date = $('#date-create-booking-table-manage').val(),
        booking_type = 3,
        employee_id = '',
        TableData = [],
        customer_full_name = $('#full-name-create-customer-booking-table-manage').val(),
        from,
        to;
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
    $('#booking-table-create-gift li').each(function (index, item) {
        if ($(this).find('input[type="checkbox"]').is(':checked')) {
            list_gift_create_booking_table.push($(this).find('input[type="checkbox"]').data('id'))
        }
    });
    checkSaveCreateBookingTableManage = 1;
    let method = 'post',
        url = 'booking-table-manage.create',
        params = null,
        data = {
            branch: branchIdBookingTableManage,
            customer_id: customer_id,
            customer_full_name: customer_full_name,
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
            list: $('#hashtag-create-customer-booking-table-manage').val(),
            gift: list_gift_create_booking_table,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-create-booking-table-manage')
    ]);
    checkSaveCreateBookingTableManage = 0;
    let text;
    switch (res.data.status) {
        case 200:
            let from = $('.select-type-booking-table-manage option:selected').data('from'),
                to = $('.select-type-booking-table-manage option:selected').data('to'),
                totalDepositAmountBookingManage;

            if (moment(from, 'DD/MM/YYYY').format('YYYY-MM-DD') <= moment(date, 'DD/MM/YYYY').format('YYYY-MM-DD') && moment(date, 'DD/MM/YYYY').format('YYYY-MM-DD') <= moment(to, 'DD/MM/YYYY').format('YYYY-MM-DD')) {
                text = $('#success-create-data-to-server').text(),
                SuccessNotify(text);
                addRowDatatableTemplate(dataTableProcessingBookingManage, {
                    'customer_name': res.data.data.customer_name,
                    'customer_phone': res.data.data.customer_phone,
                    'booking_type_name': res.data.data.booking_type_name,
                    'employee_create_name': res.data.employee_create_name,
                    'deposit_amount': formatNumber(res.data.data.deposit_amount),
                    'return_deposit_amount': res.data.return_deposit_amount,
                    'number_slot': res.data.data.number_slot,
                    'booking_time': res.data.data.booking_time,
                    'status_text': res.data.status_text,
                    'action': res.data.action,
                    'keysearch': res.data.keysearch
                })
                totalDepositAmountBookingManage = removeformatNumber($('#total-deposit-amount-booking-manage-in-processing-table').text()) + res.data.data.deposit_amount;
                $('#total-record-processing').text(parseInt($('#total-record-processing').text()) + 1);
                $('#total-deposit-amount-booking-manage-in-processing-table').text(formatNumber(totalDepositAmountBookingManage));
            }
            closeModalCreateBookingTableManage();
            $('.branch-booking-table-box').length ? totalBookingPressing() : false;
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

function totalGiftCreateBookingTable(r) {
    if (r.is(':checked') === true) {
        r.parents('li').css({
            'background-color': '#ecf1f5',
            'border-bottom': '1px solid #fff'
        });
    } else {
        r.parents('li').attr('style', '');
    }
    $('#total-gift-create-booking-table').text($('#booking-table-create-gift').find('input[type="checkbox"]:checked').length)
    $('#total-gift-update-booking-table').text($('#booking-table-update-gift').find('input[type="checkbox"]:checked').length)
}

function closeModalCreateBookingTableManage() {
    $('#modal-create-booking-table-manage').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add("F2", function () {
        openModalCreateBookingTableManage();
    })
    removeAllValidate();
    reloadModalCreateBookingTable();
    $('.group-icon-gift label').text(0);
    $('.group-gift-selected').addClass('d-none')
    $('#hashtag-create-customer-booking-table-manage').val([]).trigger('change.select');
    dataListGiftBooking = [];
    checkDataGiftCreateFoodBooking = 0;
    checkLoadDataCreateBooking = 0;
    countCharacterTextarea()
}


async function dataGetTags() {
    let method = 'get',
        url = 'booking-table-manage.tags',
        params = {},
        data = null;
    let res = await axiosTemplate(method, url, params, data, []);
    $('#hashtag-create-customer-booking-table-manage').html(res.data[0]);
}

/**
 * Customer
 */
let checkSearchCustomerBookingTableManage = 0;

async function searchCustomerBookingTableManage() {
    if (checkSearchCustomerBookingTableManage === 1) return false;
    $('#customer-phone-create-booking-table-manage').data('id', 0);
    $('#full-name-create-customer-booking-table-manage').val('');

    let method = 'get',
        url = 'booking-table-manage.search-customer',
        phone = $('#customer-phone-create-booking-table-manage').val(),
        params = {phone: phone, branch_id: branchIdBookingTableManage},
        data = null;
    checkSearchCustomerBookingTableManage = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkSearchCustomerBookingTableManage = 0;
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
function reloadModalCreateBookingTable() {
    removeAllValidate();
    dataTableCreateFoodBookingManage.clear().draw(false);
    $('#select-category-create-booking-table-manage').val(-1).trigger('change.select2')
    $("#hour-create-booking-table-manage").val(moment().add(numberMinuteAllowBookingBeforeOpenOrder, 'minutes').format('H:mm'));
    $('#total-gift').text(0)
    $('#hashtag-create-customer-booking-table-manage').val(-1).trigger('change.select2');
    $('#date-create-booking-table-manage').val(moment(new Date).format('DD/MM/YYYY'));
    $('#full-name-create-customer-booking-table-manage').val('');
    $('#customer-phone-create-booking-table-manage').val('');
    $('#customer-phone-create-booking-table-manage').attr('data-id', 0);
    $('#customer-name-create-booking-table-manage').text('');
    $('#total-create-booking-table-manage').text(0);
    $('#number-create-booking-table-manage').val(1);
    $('#deposit-amount-create-table-manage').val(0);
    $('#modal-create-booking-table-manage textarea').val('');
    $('#customer-name-create-booking-table-manage').data('lastname', '');
    $('#customer-name-create-booking-table-manage').data('firstname', '');
    $('#deposit-amount-payment-method-create-booking-table-manage').val('1').trigger('change');
    $('#data-search-customer-booking-table-manage').addClass('d-none');
    $('.list-gift-create-booking-table-manage').html('');
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
