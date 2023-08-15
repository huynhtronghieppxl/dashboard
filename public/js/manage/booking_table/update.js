let branchUpdateBookingTableManage, depositUpdateBookingTableManage, idCustomerUpdateBookingTableManage,
    depositPaymentMethodUpdateBookingTableManage, statusUpdateBookingTable,
    idUpdateBookingTableManage, areaUpdateBookingTableManage, tablesIdUpdateBookingTableManage,
    foodDataUpdateBooking = null, giftActiveBookingTableManage,
    checkChangeBookingTableManage = 0, dataTableFoodBookingManage, checkSaveUpdateBooking = 0,
    idCustomerBookingTableManage, checkSaveCancelBookingTableManage = 0,
    checkSaveDepositAmountBooking = 0,
    thisRowDataBookingManage,numberUpdateBookingTableManage,hashUpdateTagBookingTableManage,bookingTimeUpdateBookingTableManagebookingUpdateBookingTableManage,bookingTimeUpdateBookingTableManage,
    depositAmountPaymentMethodUpdateBooking,noteUpdateBookingTableManage,ortherRequirementsUpdateBookingTableManage,totalRowTableFoodUpdateBookingManage;
$(function () {
    $(document).on('change', '#branch-update-booking-table-manage', async function () {
        if (statusUpdateBookingTable == 2) {
            await getDataAreaBookingUpdate($(this).val());
            getTableBookingUpdate($(this).val(), idUpdateBookingTableManage)
        }
    })
})

async function openModalUpdateBookingTableManage(r) {
    $('#modal-update-booking-table-manage').modal('show');
    $('#modal-update-booking-table-manage .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-booking-table-manage'),
    });
    checkSaveDepositAmountBooking = 0;
    numberUpdateBookingTableManage =
    $('#deposit-amount-update-booking-table-manage').prop('disabled', true).focus();
    $('.edit-deposit-amount-btn').removeClass('d-none');
    $('.save-deposit-amount-btn').addClass('d-none');
    dateTimePickerMinDateToDayTemplate($('#booking-update-booking-table-manage'));
    dateTimePickerHourMinuteTemplate($('#booking-time-update-booking-table-manage'));
    dataGiftBooking()
    thisRowDataBookingManage = r;
    idCustomerUpdateBookingTableManage = r.data('customer');
    let booking_update = $('#booking-update-booking-table-manage').val();
    $('#booking-update-booking-table-manage').on('blur', function () {
        if ($('#booking-update-booking-table-manage').val() === '') {
            $(this).val(booking_update);
        }
    })

    shortcut.remove('ESC');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalUpdateBookingTableManage();
    });
    shortcut.add('F4', function () {
        saveModalUpdateBookingTableManage();
    });

    idUpdateBookingTableManage = r.data('id');
    idCustomerBookingTableManage = r.data('customer');
    drawDataFoodUpdateBookingTable([]);
    // Thêm món ăn booking
    $('#select-food-update-booking-table-manage').unbind('select2:select').on('select2:select', async function () {
        let gift_symbol = ($(this).find(':selected').data('is-gift') == 1) ? '<i class="fa fa-2x fa-gift text-warning mr-2"></i>' : '',
            total_price = ($(this).find(':selected').data('is-gift') == 1) ? '' : $(this).find(':selected').data('price-format'),
            sell_method = $(this).find('option:selected').data('weight') === 1 ? 'data-float = "1"' : 'data-number = "1"';
        let check = 0;
        let id = $(this).val();
        let name = $(this).find('option:selected').text()
        await $('#table-food-update-booking-table-manage tr').each(function (i, v) {
            if (id === $(v).find('td:eq(0)').find('input').val()) {
                $('#select-food-update-booking-table-manage').val($('#select-food-update-booking-table-manage option:first').val()).trigger('change');
                WarningNotify(`Món [${name}] đã được chọn !`);
                check = 1;
                return false;
            }
        });
        if (check === 0) {
            let value_selected = $('#select-food-update-booking-table-manage').find(':selected').val()
            let value_category = $('#select-food-update-booking-table-manage').find(':selected').attr('data-category')
            addRowDatatableTemplate(dataTableFoodBookingManage, {
                'name': '<img onerror="this.onerror=null; this.src=\'/images/tms/default.jpeg\'" src="' + $(this).find(':selected').data('avatar') + '" class="img-inline-name-data-table"/>' +
                    '<label>' + $(this).find(':selected').data('name') + '</label><input class="d-none" data-is-gift="' + $(this).find(':selected').data('is-gift') + '" data-select="' + $(this).find(':selected').data('select') + '" value="' + $(this).find(':selected').val() + '">',
                'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                    '  <input style="font-size: 14px !important;" class="form-control quantity text-right rounded text-center border-0 w-100" ' + sell_method + '  data-min="1" data-max="999" value="1">\n' +
                    '  <label class="d-none quantity-label">1</label>\n' +
                    '</div>',
                'price': '<label class="text-center ">' + gift_symbol + '<span class="seemt-fz-14">' + total_price + '</span></label>',
                'total_amount': '<label class="total-price text-center">' + gift_symbol + '<span class="seemt-fz-14">' + total_price + '</span></label>',
                'action': '<div class="btn-group-sm"><button data-value="' + value_selected + '" data-category="' + value_category + '" class="tabledit-delete-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Xóa" onclick="removeFoodUpdateBookingTableManage($(this))"><span class="fi-rr-trash"></span></button></div>',
                'keysearch': r.parents('tr').find('td:eq(6)').text()
            });
            switch (value_category) {
                case '1':
                    $('#select-food-update-booking').find('option[value="' + value_selected + '"]').remove();
                    foodDataUpdateBooking.food_opt = $('#select-food-update-booking').html();
                    break;
                case '2':
                    $('#select-drink-update-booking').find('option[value="' + value_selected + '"]').remove();
                    foodDataUpdateBooking.food_opt = $('#select-drink-update-booking').html();
                    break;
                case '3':
                    $('#select-other-update-booking').find('option[value="' + value_selected + '"]').remove();
                    foodDataUpdateBooking.food_opt = $('#select-other-update-booking').html();
                    break;
                case '6':
                    $('#select-combo-update-booking').find('option[value="' + value_selected + '"]').remove();
                    foodDataUpdateBooking.food_opt = $('#select-combo-update-booking').html();
                    break;
            }
            $('#select-all-update-booking').find('option[value="' + value_selected + '"]').remove()
            foodDataUpdateBooking.all = $('#select-all-update-booking').html();
            $('#select-food-update-booking-table-manage').find(':selected').remove();
            $('#select-food-update-booking-table-manage').val('').trigger('change.select2');
            sumUpdateBookingTableManage();
        }
    });
    $(document).on('input', 'table#table-food-update-booking-table-manage tbody input.quantity', function () {
        let quantity = removeformatNumber($(this).val()),
            price = removeformatNumber($(this).parents('tr').find('td:eq(2)').text()),
            is_gift = parseFloat($(this).parents('tr').find('input.check-gift').data('is-gift'));
        if (is_gift != 1) {
            $(this).parents('tr').find('td:eq(3)').find('label').find('span').text(formatNumber(quantity * price));
        }
        sumUpdateBookingTableManage();
    });

    $('#select-category-update-booking-table-manage').unbind('select2:select').on('select2:select', function () {
        if (foodDataUpdateBooking === null) {
            dataFoodUpdateBookingTableManage();
        } else {
            switch ($(this).find('option:selected').val()) {
                case '-1':
                    foodDataUpdateBooking.all = $('#select-all-update-booking').html();
                    $('#select-food-update-booking-table-manage').html(foodDataUpdateBooking.all);
                    break;
                case '1':
                    foodDataUpdateBooking.food_opt = $('#select-food-update-booking').html();
                    $('#select-food-update-booking-table-manage').html(foodDataUpdateBooking.food_opt);
                    break;
                case '2':
                    foodDataUpdateBooking.drink_opt = $('#select-drink-update-booking').html();
                    $('#select-food-update-booking-table-manage').html(foodDataUpdateBooking.drink_opt);
                    break;
                case '3':
                    foodDataUpdateBooking.other_opt = $('#select-other-update-booking').html();
                    $('#select-food-update-booking-table-manage').html(foodDataUpdateBooking.other_opt);
                    break;
                case '6':
                    foodDataUpdateBooking.combo_opt = $('#select-combo-update-booking').html();
                    $('#select-food-update-booking-table-manage').html(foodDataUpdateBooking.combo_opt);
                    break;
            }
            $('#select-food-update-booking-table-manage').select2('open');
        }
    });
    $(document).on('click', 'table#table-food-update-booking-table-manage tbody input.quantity', function () {
        $(this).select();
    });
    $('#deposit-amount-payment-method-update-booking-table-manage').val('1').trigger('change');

    await dataUpdateBookingTableManage();
    $('#area-select-update-booking-table-manage').unbind('select2:select').on('select2:select', function () {
        $('#table-select-update-booking-table-manage').val([]).trigger('change.select2');
        getTableBookingUpdate( branchUpdateBookingTableManage, idUpdateBookingTableManage);
    });
    $('#icon-gift-update').unbind('click').on('click', function () {
        if ($(this).parent().find('.group-gift-selected').hasClass('d-none')) {
            $(this).parent().find('.group-gift-selected').removeClass('d-none');
        } else {
            $(this).parent().find('.group-gift-selected').addClass('d-none');
        }
    });
    $(document).mouseup(function (e) {
        if ($(e.target).closest(".group-gift-selected").length === 0) {
            $(".group-gift-selected").addClass('d-none');
        }
    });

    $(document).on('click', '#booking-table-update-gift li', function (e) {
        if (e.target.nodeName != 'INPUT' && e.target.nodeName != 'I') {
            openModalDetailGiftMarketing($(this))
        }
    })

    $('#booking-table-update-gift li').each(function (index, item) {
        for (let i = 0; i < giftActiveBookingTableManage.length; i++) {
            if ($(this).find('input[type="checkbox"]').data('id') === giftActiveBookingTableManage[i].restaurant_gift_id) {
                $(this).find('input[type="checkbox"]').prop('checked', true).parents('li').css({
                    'background-color': '#ecf1f5',
                    'border-bottom': '1px solid #fff'
                })
            }
        }
    });
    $('#total-gift-update-booking-table').text($('#booking-table-update-gift').find('input[type="checkbox"]:checked').length)
    let booking_update_time = $('#booking-time-update-booking-table-manage').val();
    $('#booking-time-update-booking-table-manage').on('blur', function () {
        if ($('#booking-time-update-booking-table-manage').val() === '') {
            $(this).val(booking_update_time);
        }
    })
}

async function removeFoodUpdateBookingTableManage(r) {
    dataTableFoodBookingManage.row(r.parents('tr')).remove().draw(false);
    let select_type = await $('#select-category-update-booking-table-manage').find('option:selected').val(),
        avatar = r.parents('tr').find('td:eq(0)').find('img').attr('src'),
        name = r.parents('tr').find('td:eq(0)').find('label').text(),
        is_gift = r.parents('tr').find('td:eq(0)').find('input').attr('data-is-gift'),
        select = r.parents('tr').find('td:eq(0)').find('input').attr('data-select'),
        id = r.parents('tr').find('td:eq(0)').find('input').attr('value'),
        price_format = r.parents('tr').find('td:eq(3)').find('label').text(),
        price = removeformatNumber(r.parents('tr').find('td:eq(3)').find('label').text()),
        category = r.parents('tr').find('td:eq(4)').find('button').attr('data-category');
    let opt = '<option value="' + id + '" data-category="' + category + '" data-avatar="' + avatar + '" data-name="' + name + '" data-price="' + price + '" data-price-format="' + price_format + '"  data-is-gift="' + is_gift + '" data-select="' + select + '">' + name + '</option>';
    if (category == select_type || select_type==-1 ) {
        $('#select-food-update-booking-table-manage').find('option:first').after(opt);
    }
    foodDataUpdateBooking.all = foodDataUpdateBooking.all + opt;
    $('#select-all-update-booking').html(foodDataUpdateBooking.all)
    switch (parseInt(category)) {
        case 1:
            foodDataUpdateBooking.food_opt = foodDataUpdateBooking.food_opt + opt;
            $('#select-food-update-booking').html(foodDataUpdateBooking.food_opt)
            break;
        case 2:
            foodDataUpdateBooking.drink_opt = foodDataUpdateBooking.drink_opt + opt;
            $('#select-drink-update-booking').html(foodDataUpdateBooking.drink_opt)
            break;
        case 3:
            foodDataUpdateBooking.other_opt = foodDataUpdateBooking.other_opt + opt;
            $('#select-other-update-booking').html(foodDataUpdateBooking.other_opt)
            break;
        case 6:
            foodDataUpdateBooking.combo_opt = foodDataUpdateBooking.combo_opt + opt;
            $('#select-combo-update-booking').html(foodDataUpdateBooking.combo_opt)
            break;
    }
    sumUpdateBookingTableManage();
}

async function sumUpdateBookingTableManage() {
    let total = 0;
    await dataTableFoodBookingManage.rows().every(function () {
        let row = $(this.node());
        total += parseFloat(removeformatNumber(row.find('td:eq(3)').find('label').find('span').text()));
    })
    $('#total-final-update-booking-table-manage').text(formatNumber(total));
}

async function dataUpdateBookingTableManage() {
    let restaurant_brands_id = $('.select-brand').val();
    let method = 'get',
        url = 'booking-table-manage.data-update',
        params = {
            id: idUpdateBookingTableManage,
            customer_id: idCustomerBookingTableManage,
            restaurant_brands_id: restaurant_brands_id,
            branch: branchIdBookingTableManage
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-food-update-booking-table-manage'),
        $('#table-food-update-booking-table-manage'),
        $('#boxlist-update-booking-table-manage'),
    ]);
    giftActiveBookingTableManage = res.data[2].customer_gifts
    idUpdateBookingTableManage = res.data[2].id;
    branchUpdateBookingTableManage = res.data[2].branch.id;
    areaUpdateBookingTableManage = res.data[2].area_id;
    tablesIdUpdateBookingTableManage = res.data[2].tables_id;
    depositUpdateBookingTableManage = res.data[2].deposit_amount;
    depositPaymentMethodUpdateBookingTableManage = res.data[2].deposit_payment_method;
    numberUpdateBookingTableManage = res.data[2].number_slot;
    hashUpdateTagBookingTableManage = res.data[5];
    bookingUpdateBookingTableManage = splitDatetime(res.data[2].booking_time)[0];
    bookingTimeUpdateBookingTableManage = splitDatetime(res.data[2].booking_time)[1];
    depositAmountPaymentMethodUpdateBooking = res.data[2].deposit_amount;
    noteUpdateBookingTableManage = res.data[2].note;
    ortherRequirementsUpdateBookingTableManage= res.data[2].orther_requirements;
    $('#status-update-booking-table-manage').html(res.data[2].deposit_status + res.data[2].status);
    $('#branch-update-booking-table-manage').html(res.data[7]);
    $('#branch-update-booking-table-manage').val(res.data[2].branch.id).trigger('change.select2');
    $('#type-update-booking-table-manage').text(res.data[2].booking_type_name);
    $('#hash-update-tag-booking-table-manage').html(res.data[4]);
    $('#hash-update-tag-booking-table-manage').val(res.data[5]).trigger('change.select2');
    $('#employee-update-booking-table-manage').text(res.data[2].employee.name);
    $('#create-update-booking-table-manage').text(res.data[2].created_at);
    $('#booking-update-booking-table-manage').val(res.data[2].booking_time.slice(0, 10));
    $('#booking-time-update-booking-table-manage').val(res.data[2].booking_time.slice(11, 16));
    $('#area-update-booking-table-manage').text(res.data[2].area);
    $('#table-update-booking-table-manage').text(res.data[2].tables);
    $('#customer-name-update-booking-table-manage').text('lastname', res.data[2].customer_last_name);
    $('#customer-name-update-booking-table-manage').text('firstname', res.data[2].customer_first_name);
    $('#customer-name-update-booking-table-manage').text(res.data[2].customer_name);
    $('#customer-phone-update-booking-table-manage').text(res.data[2].customer_phone);
    $('#number-update-booking-table-manage').val(res.data[2].number_slot);
    $('#deposit-amount-update-booking-table-manage').val(res.data[2].deposit_amount);
    $('#deposit-amount-payment-method-update-booking-table-manage').val('1').trigger('change.select2');
    $('#text-deposit-amount-update-booking-table-manage').text(res.data[2].deposit_amount)
    $('#receive-deposit-time-update-booking-table-manage').text(res.data[2].receive_deposit_time);
    $('#receive-deposit-time-update-booking-table-manage').text(res.data[2].receive_deposit_time);
    $('#return-deposit-amount-update-booking-table-manage').text(res.data[2].return_deposit_amount);
    if(res.data[2].is_deposit_confirmed) {
        $('#deposit-received-update-booking-table-manage').parents('.col-lg-6').removeClass('d-none');
        $('#deposit-received-update-booking-table-manage').text(res.data[2].deposit_amount);
    }else {
        $('#deposit-received-update-booking-table-manage').parents('.col-lg-6').addClass('d-none');
    }
    $('#return-deposit-time-update-booking-table-manage').text(res.data[2].return_deposit_time);
    $('#total-final-update-booking-table-manage').text(res.data[2].total_amount);
    $('#note-update-booking-table-manage').val(res.data[2].note);
    $('#orther-requirements-update-booking-table-manage').val(res.data[2].orther_requirements);
    $('#total-update-booking-table-manage').text(res.data[2].total_amount);
    countCharacterTextarea()
    drawDataFoodUpdateBookingTable(res.data[3].original.data);
    await getDataAreaAndTableBookingUpdate(areaUpdateBookingTableManage, tablesIdUpdateBookingTableManage, branchUpdateBookingTableManage, idUpdateBookingTableManage);
    statusUpdateBookingTable = res.data[2].booking_status;
    let status = parseInt(res.data[2].booking_status),
        deposit_status = parseInt(res.data[2].is_deposit_confirmed),
        return_deposit_amount = parseInt(removeformatNumber(res.data[2].return_deposit_amount)),
        deposit_amount = parseInt(removeformatNumber(res.data[2].deposit_amount));
    /**
     * Lúc đầu tiền cọc lớn hơn 0 và trả cọc <= 0 mới được chỉnh sửa
     * Lúc sau tiền cọc lớn hơn >=0 và trả cọc lớn hơn <= được chỉnh sửa
     */
    if (deposit_amount >= 0 && return_deposit_amount <= 0) {
        if (deposit_status === 0 && deposit_amount === 0) {//chưa xác nhận cọc
            $('#deposit-amount-update-booking-table-manage').parents('.form-group').removeClass('d-none');
            $('#deposit-amount-update-booking-table-manage').parents('.form-group').removeClass('d-none');
            $('#text-deposit-amount-update-booking-table-manage').parents('.form-group').addClass('d-none');
            $('#deposit-amount-payment-method-update-booking-table-manage').parents('.form-group').removeClass('d-none');
            $('#btn-confirm-deposit-modal-update-booking-table-manage').addClass('d-none');
            $('#btn-cancel-modal-update-booking-table-manage').removeClass('d-none');
            $('#btn-return-deposit-modal-update-booking-table-manage').addClass('d-none');
            $('#btn-update-deposit-modal-update-booking-table-manage').removeClass('d-none');
            $('#btn-update-deposit-modal-update-booking-table-manage').text($('#btn-update-deposit-modal-update-booking-table-manage').data('update-text'));
        } else if (deposit_status === 0) {
            $('#deposit-amount-update-booking-table-manage').parents('.form-group').removeClass('d-none');
            $('#deposit-amount-update-booking-table-manage').parents('.form-group').removeClass('d-none');
            $('#text-deposit-amount-update-booking-table-manage').parents('.form-group').addClass('d-none');
            $('#deposit-amount-payment-method-update-booking-table-manage').parents('.form-group').removeClass('d-none');
            $('#btn-confirm-deposit-modal-update-booking-table-manage').removeClass('d-none');
            $('#btn-cancel-modal-update-booking-table-manage').removeClass('d-none');
            $('#btn-return-deposit-modal-update-booking-table-manage').addClass('d-none');
            $('#btn-update-deposit-modal-update-booking-table-manage').removeClass('d-none');
            $('#btn-update-deposit-modal-update-booking-table-manage').text($('#btn-update-deposit-modal-update-booking-table-manage').data('update-text'));

        } else {
            $('#text-deposit-amount-update-booking-table-manage').parents('.form-group').removeClass('d-none');
            $('#deposit-amount-update-booking-table-manage').parents('.form-group').addClass('d-none');
            $('#deposit-amount-payment-method-update-booking-table-manage').parents('.form-group').addClass('d-none');
            $('#btn-confirm-deposit-modal-update-booking-table-manage').addClass('d-none');
            $('#btn-cancel-modal-update-booking-table-manage').addClass('d-none');
            $('#btn-return-deposit-modal-update-booking-table-manage').removeClass('d-none');
            $('#btn-update-deposit-modal-update-booking-table-manage').addClass('d-none');
        }
    } else {
        $('#text-deposit-amount-update-booking-table-manage').parents('.form-group').removeClass('d-none');
        $('#deposit-amount-update-booking-table-manage').parents('.form-group').addClass('d-none');
        $('#deposit-amount-payment-method-update-booking-table-manage').parents('.form-group').addClass('d-none');
        $('#btn-cancel-modal-update-booking-table-manage').removeClass('d-none');
        $('#btn-return-deposit-modal-update-booking-table-manage').addClass('d-none');
        $('#btn-confirm-deposit-modal-update-booking-table-manage').addClass('d-none');
        if (return_deposit_amount > 0) {
            $('#btn-update-deposit-modal-update-booking-table-manage').addClass('d-none');
            $('#return-deposit-amount-update-booking-table-manage').addClass('text-danger font-weight-bold');
        } else {
            $('#btn-update-deposit-modal-update-booking-table-manage').removeClass('d-none');
            $('#btn-update-deposit-modal-update-booking-table-manage').text($('#btn-update-deposit-modal-update-booking-table-manage').data('receive-text'));
        }
    }
    if (status === 1 || status === 7) {
        $('#div-table-text').removeClass('d-none');
        $('#div-table-update').addClass('d-none');
        checkChangeBookingTableManage = 0;
    } else {
        $('#text-deposit-amount-update-booking-table-manage').parents('.form-group').removeClass('d-none');
        $('#deposit-amount-update-booking-table-manage').parents('.form-group').addClass('d-none');
        $('#deposit-amount-payment-method-update-booking-table-manage').parents('.form-group').addClass('d-none');
        $('#div-table-text').addClass('d-none');
        $('#div-table-update').removeClass('d-none');
        checkChangeBookingTableManage = 1;
    }

    /*
    * FOOD
    * */
    if (res.data[1] === 1) {
        $('#select-food-update-booking-table-manage').html(res.data[1]);
    } else {
        foodDataUpdateBooking = await res.data[1];
        $('#select-all-update-booking').html(res.data[1].all)
        $('#select-food-update-booking').html(res.data[1].food_opt)
        $('#select-drink-update-booking').html(res.data[1].drink_opt)
        $('#select-other-update-booking').html(res.data[1].other_opt)
        $('#select-combo-update-booking').html(res.data[1].combo_opt)
        switch ($('#select-category-update-booking-table-manage').val()) {
            case '-1':
                $('#select-food-update-booking-table-manage').html(res.data[1].all);
                break;
            case '1':
                $('#select-food-update-booking-table-manage').html(res.data[1].food_opt);
                break;
            case '2':
                $('#select-food-update-booking-table-manage').html(res.data[1].drink_opt);
                break;
            case '3':
                $('#select-food-update-booking-table-manage').html(res.data[1].other_opt);
                break;
            case '4':
                $('#select-food-update-booking-table-manage').html(res.data[1].sea_food_opt);
                break;
            case '6':
                $('#select-food-update-booking-table-manage').html(res.data[1].combo_opt);
                break;
        }
    }
    $('#select-food-create-booking-table-manage').prop("disabled", false);
}

async function drawDataFoodUpdateBookingTable(data) {
    let id1 = $('#table-food-update-booking-table-manage'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'}
        ], option = []
    dataTableFoodBookingManage = await DatatableTemplateNew(id1, data, column, vh_of_table, fixed_left, fixed_right, option);
}

async function dataFoodUpdateBookingTableManage() {
    $('#select-food-create-booking-table-manage').prop("disabled", true);
    let method = 'get',
        url = 'booking-table-manage.food',
        restaurant_brands_id = $('#restaurant-branch-id-selected span').attr('data-value'),
        category = $('#select-category-update-booking-table-manage').val(),
        params = {
            id: idUpdateBookingTableManage,
            branch: branchUpdateBookingTableManage,
            category: category,
            restaurant_brands_id: restaurant_brands_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-food-update-booking-table-manage')
    ])
}

async function saveModalUpdateBookingTableManage() {
    if (checkSaveUpdateBooking === 1) {
        return false;
    }
    if (!checkValidateSave($('#modal-update-booking-table-manage'))) return false;
    let TableData = [];
    dataTableFoodBookingManage.rows().every(function () {
        let row = $(this.node());
        TableData.push({
            "food_id": row.find('td:eq(0)').find('input').val(),
            "quantity": row.find('td:eq(1)').find('input').val()
        })
    })
    let list_gift_update_booking_table = [];
    $('#booking-table-update-gift li').each(function (index, item) {
        if ($(this).find('input[type="checkbox"]').is(':checked')) {
            list_gift_update_booking_table.push($(this).find('input[type="checkbox"]').data('id'))
        }
    });

    let note = $('#note-update-booking-table-manage').val(),
        orther_requirements = $('#orther-requirements-update-booking-table-manage').val(),
        number_slot = $('#number-update-booking-table-manage').val(),
        booking_time = $('#booking-update-booking-table-manage').val() + ' ' + $('#booking-time-update-booking-table-manage').val() + ':00',
        customer_last_name = $('#customer-name-update-booking-table-manage').data('lastname'),
        customer_first_name = $('#customer-name-update-booking-table-manage').data('firstname'),
        customer_phone = $('#customer-phone-update-booking-table-manage').text(),
        deposit_amount = $('#deposit-amount-update-booking-table-manage').val(),
        levelTemplete = $('#level-template').val();

    // Check update
    // if(numberUpdateBookingTableManage == number_slot
    //    && ((levelTemplete > 0) ? compareArray(hashUpdateTagBookingTableManage,$('#hash-update-tag-booking-table-manage').val()) : true)
    //    && bookingUpdateBookingTableManage == splitDatetime(booking_time)[0]
    //    && (bookingTimeUpdateBookingTableManage + ':00') == splitDatetime(booking_time)[1]
    //    && removeformatNumber(depositAmountPaymentMethodUpdateBooking) == removeformatNumber(deposit_amount)
    //    && noteUpdateBookingTableManage == note
    //    && ortherRequirementsUpdateBookingTableManage == orther_requirements
    //    && branchUpdateBookingTableManage == $('#branch-update-booking-table-manage').val()
    //    && dataTableFoodBookingManage.data().length == TableData.length) {
    //     SuccessNotify($('#success-update-data-to-server').text());
    //     closeModalUpdateBookingTableManage();
    //     checkSaveUpdateBooking = 0;
    //     return false;
    // }

        let method = 'post',
        url = 'booking-table-manage.update',
        params = null,
        data = {
            id: idUpdateBookingTableManage,
            customer_id: idCustomerUpdateBookingTableManage,
            table: TableData,
            branch: $('#branch-update-booking-table-manage').val(),
            note: note,
            orther_requirements: orther_requirements,
            number_slot: number_slot,
            booking_time: booking_time,
            customer_first_name: customer_first_name,
            customer_last_name: customer_last_name,
            customer_phone: customer_phone,
            restaurant_customer_gifts: list_gift_update_booking_table,
            deposit_amount: removeformatNumber(deposit_amount),
            hash_tag: $('#hash-update-tag-booking-table-manage').val() !== undefined ? $('#hash-update-tag-booking-table-manage').val() : [],
            deposit_payment_method: $('#deposit-amount-payment-method-update-booking-table-manage').val(),
            change_table: 0,
            list: $('#hash-update-tag-booking-table-manage').val(),
        };

    if (checkChangeBookingTableManage === 1) {
        data['area_id'] = $('#area-select-update-booking-table-manage').val();
        data['tables_ids'] = $('#table-select-update-booking-table-manage').val();
        data['change_table'] = 1;
        checkSaveUpdateBooking = 1;
        let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-booking-table-manage')]);
        checkSaveUpdateBooking = 0;
        let text = '';
        if (res.data[0].status === 200 && res.data[1].status === 200) {
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            if (branchUpdateBookingTableManage != res.data[0].data.branch.id) {
                removeRowDatatableTemplate(dataTableProcessingBookingManage, thisRowDataBookingManage, true)
                $('#total-record-processing').text(parseInt($('#total-record-processing').text()) - 1)
            } else {
                thisRowDataBookingManage.parents('tr').find('td:eq(1)').html(res.data[0].data.customer_name);
                thisRowDataBookingManage.parents('tr').find('td:eq(2)').html(res.data[0].data.customer_phone);
                thisRowDataBookingManage.parents('tr').find('td:eq(3)').html(res.data[0].data.booking_type_name);
                thisRowDataBookingManage.parents('tr').find('td:eq(4)').html(res.data[0].employee_create_name);
                thisRowDataBookingManage.parents('tr').find('td:eq(5)').html(formatNumber(res.data[0].data.deposit_amount));
                thisRowDataBookingManage.parents('tr').find('td:eq(6)').html(res.data[0].return_deposit_amount);
                thisRowDataBookingManage.parents('tr').find('td:eq(7)').html(res.data[0].data.number_slot);
                thisRowDataBookingManage.parents('tr').find('td:eq(8)').html(res.data[0].data.booking_time);
                thisRowDataBookingManage.parents('tr').find('td:eq(9)').html(res.data[0].status_text);
                thisRowDataBookingManage.parents('tr').find('td:eq(10)').html(res.data[0].action);
                thisRowDataBookingManage.parents('tr').find('td:eq(11)').html(res.data[0].keysearch);
                let result = totalInfoBookingTable(dataTableProcessingBookingManage);
                $('#total-deposit-amount-booking-manage-in-processing-table').text(formatNumber(result[0]));
                $('#total-return-deposit-amount-booking-manage-in-processing-table').text(formatNumber(result[1]));
                $('#total-customer-booking-manage-in-processing-table').text(formatNumber(result[2]));
            }

            closeModalUpdateBookingTableManage();
        } else if (res.data[0].status !== 200 && res.data[1].status === 200) {
            text = $('#error-post-data-to-server').text();
            if (res.data[0].message !== null) {
                text = res.data[0].message;
            }
            ErrorNotify(text);
        } else if (res.data[0].status === 200 && res.data[1].status !== 200) {
            text = $('#error-post-data-to-server').text();
            if (res.data[1].message !== null) {
                text = res.data[1].message;
            }
            ErrorNotify(text);
        } else {
            text = $('#error-post-data-to-server').text();
            if (res.data[0].message !== null) {
                text = res.data[0].message;
            }
            WarningNotify(text);
        }
    } else {
        data['change_table'] = 0;
        checkSaveUpdateBooking = 1;
        let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-booking-table-manage')]);
        checkSaveUpdateBooking = 0;
        let text = '';
        switch (res.data.status) {
            case 200:
                text = $('#success-update-data-to-server').text();
                SuccessNotify(text);
                closeModalUpdateBookingTableManage();

                if (branchUpdateBookingTableManage != res.data.data.branch.id) {
                    removeRowDatatableTemplate(dataTableProcessingBookingManage, thisRowDataBookingManage, true)
                    $('#total-record-processing').text(parseInt($('#total-record-processing').text()) - 1)
                } else {
                    thisRowDataBookingManage.parents('tr').find('td:eq(1)').html(res.data.data.customer_name);
                    thisRowDataBookingManage.parents('tr').find('td:eq(2)').html(res.data.data.customer_phone);
                    thisRowDataBookingManage.parents('tr').find('td:eq(3)').html(res.data.data.booking_type_name);
                    thisRowDataBookingManage.parents('tr').find('td:eq(4)').html(res.data.employee_create_name);
                    thisRowDataBookingManage.parents('tr').find('td:eq(5)').html(formatNumber(res.data.data.deposit_amount));
                    thisRowDataBookingManage.parents('tr').find('td:eq(6)').html(res.data.return_deposit_amount);
                    thisRowDataBookingManage.parents('tr').find('td:eq(7)').html(res.data.data.number_slot);
                    thisRowDataBookingManage.parents('tr').find('td:eq(8)').html(res.data.data.booking_time);
                    thisRowDataBookingManage.parents('tr').find('td:eq(9)').html(res.data.status_text);
                    thisRowDataBookingManage.parents('tr').find('td:eq(10)').html(res.data.action);
                    thisRowDataBookingManage.parents('tr').find('td:eq(11)').html(res.data.keysearch);
                    let result = totalInfoBookingTable(dataTableProcessingBookingManage);
                    $('#total-deposit-amount-booking-manage-in-processing-table').text(formatNumber(result[0]));
                    $('#total-return-deposit-amount-booking-manage-in-processing-table').text(formatNumber(result[1]));
                    $('#total-customer-booking-manage-in-processing-table').text(formatNumber(result[2]));
                }
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
    }
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        container: 'body',
        html: true
    });
}

function totalInfoBookingTable (table) {
    if (!table) return false;
    let depositAmount = 0, returnDepositAmount = 0, noCustomer = 0;
    table.rows().every(function () {
        let row = $(this.node());
        depositAmount += removeformatNumber(row.find('td:eq(5)').text());
        returnDepositAmount += removeformatNumber(row.find('td:eq(6)').text());
        noCustomer += removeformatNumber(row.find('td:eq(7)').text());
    })
    return [depositAmount, returnDepositAmount, noCustomer];
}

function closeModalUpdateBookingTableManage() {
    $('#modal-update-booking-table-manage').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateBookingTableManage();
    });
    reloadModalUpdateBookingTableManage();
    countCharacterTextarea()
}

function reloadModalUpdateBookingTableManage() {
    $('.list-gift-update-booking-table-manage').html('');
    $('.list-gift-update-booking-table-manage').find('img').removeClass('item-gift-active');
    $('#div-table-text').addClass('d-none');
    $('#div-table-update').addClass('d-none');
    $('#status-update-booking-table-manage').html('');
    $('#branch-update-booking-table-manage option:first').trigger('change.select2');
    $('#btn-cancel-modal-update-booking-table-manage').addClass('d-none');
    $('#btn-update-deposit-modal-update-booking-table-manage').text('').addClass('d-none');
    $('#btn-return-deposit-modal-update-booking-table-manage').addClass('d-none');
    $('#btn-save-modal-update-booking-table-manage').removeClass('d-none');
    $('#btn-confirm-deposit-modal-update-booking-table-manage').addClass('d-none');
    $('#return-deposit-amount-update-booking-table-manage').removeClass('text-danger font-weight-bold');
    $('#customer-name-update-booking-table-manage').text('---');
    $('#customer-name-update-booking-table-manage').data('lastname', '');
    $('#customer-name-update-booking-table-manage').data('firstname', '');
    $('#customer-phone-update-booking-table-manage').text('---');
    $('#type-update-booking-table-manage').text('---');
    $('#employee-update-booking-table-manage').text('---');
    $('#create-update-booking-table-manage').text('---');
    $('#booking-update-booking-table-manage').val('');
    $('#booking-time-update-booking-table-manage').val('');
    $('#area-update-booking-table-manage').text('---');
    $('#table-update-booking-table-manage').text('---');
    $('#number-update-booking-table-manage').val('');
    $('#receive-deposit-time-update-booking-table-manage').text('---');
    $('#return-deposit-amount-update-booking-table-manage').text(0);
    $('#return-deposit-time-update-booking-table-manage').text('---');
    $('#total-final-update-booking-table-manage').text(0);
    $('#note-update-booking-table-manage').val('');
    $('#orther-requirements-update-booking-table-manage').val('');
    $('#total-update-booking-table-manage').text('---');
    $('#table-food-update-booking-table-manage tbody').empty();
    $('.list-gift-update-booking-table-manage').html('');
    $('#select-category-update-booking-table-manage').val($('#select-category-update-booking-table-manage option:first').val()).trigger('change');
    $('#loading-modal-update-booking-table-manage').scrollTop(0);
    foodDataUpdateBooking = null;
    checkChangeBookingTableManage = 0;
    removeAllValidate();
}

async function returnDepositBookingTableManage() {
    let title = 'Xác nhận trả cọc ?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            const swalee = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-grd-primary btn-sweet-alert swal-button--confirm',
                    cancelButton: 'btn btn-grd-disabled btn-sweet-alert swal-button--cancel'
                },
                buttonsStyling: false
            });

            swalee.fire({
                title: 'Chọn phương thức',
                html: `<div class="select-material-box" style="position: relative;
                                                                display: flex;
                                                                flex-direction: column-reverse;
                                                                padding: 10px 0 !important;
                                                                padding-bottom: 0 !important;
                                                                background: var(--bg-color);
                                                                border-radius: 6px;">
                            <select id="return-payment-order" class="js-example-basic-single select2-hidden-accessible">
                                <option value="1" selected>Tiền mặt</option>
<!--                                <option value="2">Tiền thẻ</option>-->
<!--                                <option value="6" selected>Chuyển khoản</option>-->
                            </select>
                        </div>`,
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Lưu',
                cancelButtonText: 'Hủy',
                onOpen: function () {
                    $(`.swal2-html-container select`).select2({
                        dropdownParent: $('.swal2-html-container')
                    })
                },
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let method = 'post',
                        url = 'booking-table-manage.return-deposit',
                        params = null,
                        data = {
                            id: idUpdateBookingTableManage,
                            branch_id: branchUpdateBookingTableManage,
                            payment_method: $('#return-payment-order').val(),
                        };
                    let res = await axiosTemplate(method, url, params, data);
                    if (res.data.status === 200) {
                        let text = $('#success-return-deposit-data-to-server').text();
                        SuccessNotify(text);
                        $('#deposit-status-text-booking-table').addClass('d-none');
                        $('#btn-cancel-modal-update-booking-table-manage').removeClass('d-none');
                        $('#btn-return-deposit-modal-update-booking-table-manage').addClass('d-none');
                        $('#btn-update-deposit-modal-update-booking-table-manage').addClass('d-none');
                        $('#return-deposit-amount-update-booking-table-manage').addClass('text-danger font-weight-bold');
                        $('#return-deposit-amount-update-booking-table-manage').text(formatNumber(res.data.data.return_deposit_amount));
                        $('#return-deposit-time-update-booking-table-manage').text(res.data.data.return_deposit_time);
                        loadData()
                    } else {
                        let text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) {
                            text = res.data.message;
                        }
                        ErrorNotify(text);
                    }
                }
            })
        }
    })
}

function cancelBookingTableManage() {
    $('#modal-cancel-booking-table-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeCancelBookingTableManage();
    });
    shortcut.add('F4', function () {
        saveCancelBookingTableManage();
    });
    countCharacterTextarea()
}

async function saveCancelBookingTableManage() {
    if (checkSaveCancelBookingTableManage == 1) return;
    if (!checkValidateSave($('#modal-cancel-booking-table-manage'))) return false;

    let cancel_reason = $('#reason-cancel-booking-table-manage').val(),
        method = 'post',
        url = 'booking-table-manage.cancel',
        params = null,
        data = {
            id: idUpdateBookingTableManage,
            branch_id: branchUpdateBookingTableManage,
            cancel_reason: cancel_reason
        };
    checkSaveCancelBookingTableManage = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkSaveCancelBookingTableManage = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            SuccessNotify('Hủy đặt bàn thành công!');
            loadData();
            closeCancelBookingTableManage();
            closeModalUpdateBookingTableManage();
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
}

function closeCancelBookingTableManage() {
    $('#modal-cancel-booking-table-manage').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('ESC', function () {
        closeModalUpdateBookingTableManage();
    });
    shortcut.add('F4', function () {
        saveModalUpdateBookingTableManage();
    });
    $('#reason-cancel-booking-table-manage').val('');
    countCharacterTextarea()
}

function openModalUpdateDepositBookingTableManage(btn) {
    $('#modal-update-deposit-booking-table-manage').modal('show');
    $('#modal-update-reposit-title').text(btn.text());
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeUpdateDepositBookingTableManage();
    });
    shortcut.add('F4', function () {
        saveUpdateDepositBookingTableManage();
    });
    $('#modal-update-deposit-booking-table-manage .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-deposit-booking-table-manage'),
    });

    $('#update-deposit-amount-booking-table-manage').val($('#deposit-amount-update-booking-table-manage').text());
    if (depositPaymentMethodUpdateBookingTableManage != 0) {
        $('#deposit-amount-payment-method-update-booking-table-manage').val(depositPaymentMethodUpdateBookingTableManage).trigger('change.select2');
    }
}

async function getDataAreaAndTableBookingUpdate(area_id, table_id, branch_id, booking_id) {
    let method = 'get',
        url = 'booking-table-manage.data-area-table-update',
        params = {
            area_id: area_id,
            table_id: table_id,
            branch_id: branch_id,
            booking_id: booking_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#area-select-update-booking-table-manage').html(res.data[0]);
    $('#table-select-update-booking-table-manage').html(res.data[1]);
}

async function getDataAreaBookingUpdate(branch_id) {
    let method = 'get',
        url = 'booking-table-manage.data-area-update',
        params = {
            branch_id: branch_id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#area-select-update-booking-table-manage').html(res.data[0]);
    $('#area-select-update-booking-table-manage').val(res.data[1].data.list[0].id).trigger('change.select2');
    $('#table-select-update-booking-table-manage').html('')
}

async function getTableBookingUpdate(branch_id, booking_id) {
    let method = 'get',
        url = 'booking-table-manage.data-table-update',
        params = {
            area_id: $('#area-select-update-booking-table-manage').val(),
            branch_id: branch_id,
            booking_id: booking_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#table-select-update-booking-table-manage').html(res.data[0]);
}

function editDepositAmountBookingTable () {
    checkSaveDepositAmountBooking = 1;
    $('.edit-deposit-amount-btn').addClass('d-none');
    $('.save-deposit-amount-btn').removeClass('d-none');
    $('#deposit-amount-update-booking-table-manage').prop('disabled', false).focus();

}

async function saveUpdateDepositBookingTableManage() {
    // if (!checkValidateSave($('#modal-update-deposit-booking-table-manage'))) return false;
    $('#deposit-amount-update-booking-table-manage').prop('disabled', false).focus();
    let method = 'post',
        url = 'booking-table-manage.update-deposit',
        params = null,
        data = {
            id: idUpdateBookingTableManage,
            branch_id: branchUpdateBookingTableManage,
            deposit_amount: removeformatNumber($('#deposit-amount-update-booking-table-manage').val()),
            payment_method: $('#deposit-amount-payment-method-update-booking-table-manage').val()
        };
    let res = await axiosTemplate(method, url, params, data);
    checkSaveDepositAmountBooking = 0;
    if (res.data.status === 200) {
        SuccessNotify(' Chỉnh sửa tiền cọc thành công!');
        // closeUpdateDepositBookingTableManage();
        $('.edit-deposit-amount-btn').removeClass('d-none');
        $('.save-deposit-amount-btn').addClass('d-none');
        $('#deposit-amount-' + idUpdateBookingTableManage).text(formatNumber(res.data.data.deposit_amount));
        $('#deposit-amount-update-booking-table-manage').text(formatNumber(res.data.data.deposit_amount));
        $('#receive-deposit-time-update-booking-table-manage').text(res.data.data.receive_deposit_time);
        $('#deposit-amount-update-booking-table-manage').prop('disabled', true).focus();

        // if (res.data.data.deposit_amount <= 0) {
        //     $('#btn-update-deposit-modal-update-booking-table-manage').removeClass('d-none');
        //     $('#btn-update-deposit-modal-update-booking-table-manage').text($('#btn-update-deposit-modal-update-booking-table-manage').data('receive-text'));
        // } else {
        //     if (res.data.data.return_deposit_amount <= 0) {
        //         $('#btn-update-deposit-modal-update-booking-table-manage').removeClass('d-none');
        //         $('#btn-update-deposit-modal-update-booking-table-manage').text($('#btn-update-deposit-modal-update-booking-table-manage').data('update-text'));
        //     } else {
        //         $('#btn-update-deposit-modal-update-booking-table-manage').addClass('d-none');
        //         $('#btn-update-deposit-modal-update-booking-table-manage').text('');
        //     }
        // }

        // if (res.data.data.deposit_amount > 0 && res.data.data.return_deposit_amount <= 0) {
        //     if (res.data.data.is_deposit_confirmed === 0) {
        //         $('#btn-confirm-deposit-modal-update-booking-table-manage').removeClass('d-none');
        //     } else {
        //         $('#btn-confirm-deposit-modal-update-booking-table-manage').addClass('d-none');
        //     }
        // } else {
        //     $('#btn-confirm-deposit-modal-update-booking-table-manage').addClass('d-none');
        // }
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeUpdateDepositBookingTableManage() {
    $('#modal-update-deposit-booking-table-manage').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('ESC', function () {
        closeModalUpdateBookingTableManage();
    });
    shortcut.add('F4', function () {
        saveModalUpdateBookingTableManage();
    });
    $('#update-deposit-amount-booking-table-manage').val('100');
    $('#modal-update-reposit-title').text('');
    $('#deposit-amount-payment-method-update-booking-table-manage').val('').trigger('change');
}

let checkConfirmDepositBookingTableManage = 0;

function confirmDepositBookingTableManage() {
    console.log({checkConfirmDepositBookingTableManage})
    if (checkConfirmDepositBookingTableManage === 1) return false;
    if(checkSaveDepositAmountBooking === 1) {
        WarningNotify('Vui lòng hoàn thành chỉnh sửa cọc trước khi xác nhận cọc!');
        return false;
    }
    checkConfirmDepositBookingTableManage = 1;
    let title = 'Xác nhận cọc ?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'booking-table-manage.confirm-deposit',
                params = null,
                data = {
                    booking_id: idUpdateBookingTableManage,
                };
            let res = await axiosTemplate(method, url, params, data, [
                $('#loading-modal-update-booking-table-manage')
            ]);
            checkConfirmDepositBookingTableManage = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    SuccessNotify('Xác nhận cọc thành công!');
                    $('#btn-confirm-deposit-modal-update-booking-table-manage').addClass('d-none');
                    $('#deposit-status-text-booking-table').removeClass('label-warning').addClass('label-success');
                    $('#deposit-status-text-booking-table').text($('#deposit-status-text-booking-table').data('text'));

                    if (res.data.data.deposit_amount > 0 && res.data.data.return_deposit_amount <= 0) {
                        if (res.data.data.is_deposit_confirmed === 0) { //chưa xác nhận cọc
                            $('#btn-confirm-deposit-modal-update-booking-table-manage').removeClass('d-none');
                            $('#btn-cancel-modal-update-booking-table-manage').removeClass('d-none');
                            $('#btn-return-deposit-modal-update-booking-table-manage').addClass('d-none');
                            $('#btn-update-deposit-modal-update-booking-table-manage').removeClass('d-none');
                        } else {
                            $('#btn-confirm-deposit-modal-update-booking-table-manage').addClass('d-none');
                            $('#btn-cancel-modal-update-booking-table-manage').addClass('d-none');
                            $('#btn-return-deposit-modal-update-booking-table-manage').removeClass('d-none');
                            $('#btn-update-deposit-modal-update-booking-table-manage').addClass('d-none');
                        }
                    } else {
                        $('#btn-cancel-modal-update-booking-table-manage').removeClass('d-none');
                        $('#btn-return-deposit-modal-update-booking-table-manage').addClass('d-none');
                        $('#btn-confirm-deposit-modal-update-booking-table-manage').addClass('d-none');
                    }
                    loadData();
                    break;
                case 500:
                    text = 'Xác nhận không thành công';
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    return false;
                    break;
                default:
                    text = 'Xác nhận không thành công';
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
                    return false;
            }
        } else {
            checkConfirmDepositBookingTableManage = 0;
        }
    });
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

function splitDatetime(date){
    let parts = date.split(' ');
    let datePart = parts[0];
    let timePart = parts[1];
    return [datePart,timePart];
}



