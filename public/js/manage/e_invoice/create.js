let checkSaveCreateEInvoice = 0, tableFoodCreateInvoice, checkRemoveFoodEInvoiceCreate,
    discountTypeEInvoiceCreate = 1, optionUnitCreateEInvoice, checkSaveUpdateEInvoiceUpdateCreate = 0,
    idOrderBillEInvoice, idInvoiceCreate;

$(function () {
    $(document).on('input paste keyup keydown', '.quantity-food-create-invoice', function () {
        $(this).val(formatNumber($(this).val().replace(/[^0-9_.]/g, "")))
        updatePriceEInvoiceTotal($(this));
    })

    $(document).on('input paste keyup keydown', '.price-food-create-invoice', function () {
        $(this).val(formatNumber($(this).val().replace(/[^0-9_]/g, "")))
        updatePriceEInvoiceTotal($(this));
    })

    $(document).on('input paste keyup keydown', '.vat-food-create-invoice', function () {
        $(this).val(formatNumber($(this).val().replace(/[^0-9_]/g, "")))
        if ($(this).val() == '-') {
            $(this).val(100)
        }
        updatePriceEInvoiceTotal($(this));
    })
})
$(function () {
    $('#select-food-create-invoice-order').on('select2:select', async function () {
        addRowDatatableTemplate(tableFoodCreateInvoice, {
            'food_name': $(this).find(':selected').text(),
            'food_unit': $(this).find(':selected').data('unit'),
            'unit_price': `${formatNumber($(this).find(':selected').data('price'))}<input class="d-none" value="${$(this).find(':selected').data('price')}">`,
            'quantity': 1,
            'total_price': formatNumber($(this).find(':selected').data('price')),
            'vat_percent': `${formatNumber($(this).find(':selected').data('vat'))} <input class="d-none" value="${$(this).find(':selected').data('vat')}">`,
            'discount_cal': `<label data-cal="${formatNumber($(this).find(':selected').data('discount-cal'))}">${formatNumber($(this).find(':selected').data('discount-cal'))}</label>`,
            'action': `<div class="btn-group-sm">
                            <button class="btn seemt-red seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Xoá" data-invoice-id="${$(this).find(':selected').data('invoice-id')}" data-gift="${$(this).find(':selected').data('gift')}" data-food-id="${$(this).find(':selected').val()}" data-category-type="${$(this).find(':selected').data('type')}" data-price="${$(this).find(':selected').data('price')}" data-vat="${$(this).find(':selected').data('vat')}" data-name="${$(this).find(':selected').data('name')}" data-discount-cal="${$(this).find(':selected').data('discount-cal')}" data-unit="${$(this).find(':selected').data('unit')}" onclick="removeFoodCreateInvoice($(this))">
                            <i class="fi-rr-trash"></i></button>
                        </div>`,
            'keysearch': ''
        });
        $('#select-food-create-invoice-order').find(':selected').remove();
        $('#select-food-create-invoice-order').val('').trigger('change');
        let totalAmount = 0, totalVat = 0, totalVatPercent = 0, discountAmount = 0;
        await tableFoodCreateInvoice.rows().every(function () {
            let row = $(this.node());
            totalAmount += removeformatNumber(row.find('td:eq(5)').text());
            totalVat += (removeformatNumber(row.find('td:eq(5)').text()) - removeformatNumber(row.find('td:eq(7) label').text())) * (removeformatNumber(row.find('td:eq(6) input').val()) / 100)
            totalVatPercent += Number(row.find('td:eq(6) input').val());
            discountAmount += removeformatNumber(row.find('td:eq(7) label').text());
        })
        $('#total-e-invoice-create').text(formatNumber(checkDecimal(totalAmount)));
        $('#money-create-e-invoice').text(formatNumber(checkDecimal(totalAmount)));
        $('#vat-amount-create-e-invoice').text(formatNumber(checkDecimal(totalVat)));
        $('#discount-amount-create-e-invoice').text(formatNumber(checkDecimal(discountAmount)));
        let totalFinal = checkDecimal(removeformatNumber($('#money-create-e-invoice').text()) - removeformatNumber($('#discount-amount-create-e-invoice').text()) + removeformatNumber($('#vat-amount-create-e-invoice').text()));
        $('#total-amount-create-e-invoice').text(Number(totalFinal) < 0 ? 0 : formatNumber(totalFinal));
        if (removeformatNumber($('#discount-percent-create-e-invoice').text()) === 100 && discountTypeEInvoiceCreate == 1) {
            $('#total-amount-create-e-invoice').text(0)
        }
    })

})

async function openModalEInvoiceExport(r) {
    $('#modal-e-invoice-create').modal('show');
    shortcut.add('F4', function () {
        saveModalEInvoiceExport();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalEInvoiceCreate();
    });
    idOrderBillEInvoice = r.data('id');
    idInvoiceCreate = r.data('id-invoice');
    $('#select-branch-table , #select-food-create-invoice-order').select2({
        dropdownParent: $('#modal-e-invoice-create'),
    });
    // $('#tax-create-e-invoice').val(3702848646)

    drawTableFoodCreateInvoice([]);
    getDataCreateOrder();
}

async function getDataCreateOrder() {
    let method = 'get',
        url = 'e-invoice-manage.data-create',
        params = {
            id: idInvoiceCreate,
            brand: $('.select-brand-e-invoice-manage').val(),
            id_order: idOrderBillEInvoice,
            branch: $('.select-branch-e-invoice-manage').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-food-e-invoice-create'), $('#form-header-bonus-punish'), $('#boxlist-create-e-invoice')]);
    drawTableFoodCreateInvoice(res.data[0].original.data);
    $('#code-create-e-invoice').text('#' + res.data[3].order_id);
    $('#payment-date-create-e-invoice').text(moment(res.data[3].payment_date).format("DD/MM/YYYY HH:mm"));
    $('#discount-amount-create-e-invoice').text(formatNumber(res.data[3].discount_amount));
    $('#discount-percent-create-e-invoice').text(formatNumber(res.data[3].discount_percent));
    $('#vat-amount-create-e-invoice').text(formatNumber(res.data[3].vat_amount));
    $('#total-amount-create-e-invoice').text(formatNumber(res.data[3].total_amount));
    $('#money-create-e-invoice').text(formatNumber(res.data[3].amount));
    $('#discount-text-create-e-invoice').text(res.data[3].discount_text);
    discountTypeEInvoiceCreate = res.data[3].discount_type;


    // tính tiền
    $('#total-e-invoice-create').text(formatNumber(res.data[3]['amount']));
    // $('#vat-percent-create-e-invoice').text(formatNumber(res.data[4]['total_vat']));

    // select món ăn và đơn vị
    $('#select-food-create-invoice-order').html(res.data[1]);
    optionUnitCreateEInvoice = res.data[2];

    //     chi tiết khách hàng
    $('#name-create-e-invoice').val(res.data[3].customer_name);
    $('#phone-create-e-invoice').val(res.data[3].customer_phone);
    $('#company-create-e-invoice').val(res.data[3].customer_company_name);
    $('#email-create-e-invoice').val(res.data[3].customer_company_email);
    $('#address-create-e-invoice').val(res.data[3].customer_company_address);
    $('#tax-create-e-invoice').val(res.data[3].customer_company_tax_code);
    $('#send-mail-create-e-invoice').prop('checked', Boolean(res.data[3].is_send_mail));
}

async function saveModalEInvoiceExport() {
    if (checkSaveCreateEInvoice === 1) return false;
    if (!checkValidateSave($('#loading-modal-create-e-invoice'))) return false;
    let dataFood = [];
    let dataFoodCreate = [];
    await tableFoodCreateInvoice.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(2) select').length !== 1) {
            dataFoodCreate.push({
                "food_id": row.find('td:eq(8) button:last').data('food-id'),
                "quantity": 1,
                "food_unit": row.find('td:eq(2)').text(),
                "type": row.find('td:eq(8) button:last').data('category-type'),
                "is_gift": row.find('td:eq(8) button:last').data('gift'),
                "commodity_nature_type": 1
            })
        } else {
            dataFood.push({
                "invoice_detail_id": row.find('td:eq(8) button:last').data('invoice-id'),
                "food_name": row.find('td:eq(1)').text(),
                "quantity": removeformatNumber(row.find('td:eq(4) input').val()),
                "food_unit": row.find('td:eq(2) select').find('option:selected').val(),
                "price": removeformatNumber(row.find('td:eq(3) input').val()),
                "vat": row.find('td:eq(6) input').val(),
                "is_gift": row.find('td:eq(8) button:last').data('gift')
            })
        }
    })

    let method = 'post',
        url = 'e-invoice-manage.export',
        params = null,
        data = {
            id: idInvoiceCreate,
            name: $('#name-create-e-invoice').val(),
            name_company: $('#company-create-e-invoice').val(),
            email: $('#email-create-e-invoice').val(),
            phone: $('#phone-create-e-invoice').val(),
            tax: $('#tax-create-e-invoice').val(),
            address: $('#address-create-e-invoice').val(),
            data_create_food: dataFoodCreate,
            data_food: dataFood,
            // payment_date: moment($('#payment-date-create-e-invoice').text()).format("DD/MM/YYYY"),
            payment_date: $('#payment-date-create-e-invoice').text().slice(0, 10),
            is_send_mail: Number($('#send-mail-create-e-invoice').is(':checked'))
        };
    checkSaveCreateEInvoice = 1;
    $('#btn-save-e-invoice-update-create').prop('disabled', true);
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-e-invoice')]);
    checkSaveCreateEInvoice = 0;
    $('#btn-save-e-invoice-update-create').prop('disabled', false);
    if (res.data[0].status !== 200) {
        WarningNotify(res.data[0].message);
    } else if (res.data[1].status !== 200) {
        WarningNotify(res.data[1].message);
    } else if (res.data[2].status !== undefined && res.data[2].status !== 200) {
        WarningNotify(res.data[2].message);
    } else if (res.data[2].status === undefined) {
        let text = 'Xuất hoá đơn thất bại!';
        ErrorNotify(text);
    } else {
        SuccessNotify('Xuất hoá đơn thành công!');
        loadData();
        closeModalEInvoiceCreate();
    }
}

async function drawTableFoodCreateInvoice(data) {
    let id = $('#table-food-e-invoice-create'),
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'food_name', name: 'food_name', className: 'text-center'},
            {data: 'food_unit', name: 'food_unit', className: 'text-center'},
            {data: 'unit_price', name: 'unit_price', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'total_price', name: 'total_price', className: 'text-center'},
            {data: 'vat_percent', name: 'vat_percent', className: 'text-center'},
            {data: 'discount_cal', name: 'discount_cal', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none', width: '5%'},
        ];
    tableFoodCreateInvoice = await DatatableTemplateNew(id, data, column, '20vh', fixed_left, fixed_right);
}

function removeFoodCreateInvoice(r) {
    // không cho xoá do còn 1 record
    if (tableFoodCreateInvoice.rows().count() == 1) {
        WarningNotify('Danh sách món không được rỗng! ');
        return false;
    }
    // không cho xoá do còn 1 record
    if ($('#table-food-e-invoice-create select').length == 1 && r.parents('tr').find('td:eq(2) select').length !== 0) {
        WarningNotify('Vui lòng lưu lại món mới trước khi thực hiện thao tác xoá này! ');
        return false;
    }
    if (r.attr('data-invoice-id') != '0') {
        let title = 'Xoá món ăn khỏi hóa đơn ?',
            content = '',
            icon = 'question';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                let method = 'post',
                    url = 'e-invoice-manage.change-status',
                    params = null,
                    data = {id: r.data('invoice-id')};
                checkRemoveFoodEInvoiceCreate = 1;
                let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
                checkRemoveFoodEInvoiceCreate = 0;
                switch (res.data.status) {
                    case 200:
                        SuccessNotify('Xoá món ăn thành công !');
                        $('#select-food-create-invoice-order').append(`<option value="${r.data('food-id')}" data-invoice-id="${r.data('invoice-id')}" data-gift="${r.data('gift')}" data-type="${r.data('category-type')}" data-price="${r.data('price')}" data-vat="${r.data('vat')}" data-unit="${r.data('unit')}" data-discount-cal="${r.data('discount-cal')}" data-name="${r.data('name')}">${r.data('name')}</option>`);
                        removeRowDatatableTemplate(tableFoodCreateInvoice, r, true);
                        updatePriceEInvoiceTotal(r);
                        break;
                    case 500:
                        ErrorNotify($('#error-post-data-to-server').text());
                        break;
                    default:
                        WarningNotify(res.data.message);
                }
            } else {
                checkRemoveFoodEInvoiceCreate = 0
            }
        })
    } else {
        $('#select-food-create-invoice-order').append(`<option value="${r.data('food-id')}" data-invoice-id="${r.data('invoice-id')}" data-gift="${r.data('gift')}" data-type="${r.data('category-type')}" data-price="${r.data('price')}" data-vat="${r.data('vat')}" data-unit="${r.data('unit')}" data-name="${r.data('name')}" data-discount-cal="${r.data('discount-cal')}">${r.data('name')}</option>`);
        removeRowDatatableTemplate(tableFoodCreateInvoice, r, true);
        updatePriceEInvoiceTotal(r);
    }
}


async function updatePriceEInvoiceTotal(r) {
    let totalAmount = 0, totalVat = 0, totalVatPercent = 0, discountAmount = 0;
    let quantity = removeformatNumber(r.parents('tr').find('td:eq(4) input').val())
    let price = removeformatNumber(r.parents('tr').find('td:eq(3) input').val());
    let vat = removeformatNumber(r.parents('tr').find('td:eq(6) input').val());
    r.parents('tr').find('td:eq(5)').text(formatNumber(checkDecimal(quantity * price)));
    if (r.parents('tr').find('td:eq(7) label').data('cal') !== 0) {
        // r.parents('tr').find('td:eq(7) label').text(formatNumber(checkDecimal(((quantity * price) + (quantity * price * (vat / 100))) * removeformatNumber($('#discount-percent-create-e-invoice').text()) / 100)));
        r.parents('tr').find('td:eq(7) label').text(formatNumber(checkDecimal(((removeformatNumber(r.parents('tr').find('td:eq(5)').text()) * removeformatNumber($('#discount-percent-create-e-invoice').text()) / 100)))));
    }
    await tableFoodCreateInvoice.rows().every(function () {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(5)').text());
        totalVat += (removeformatNumber(row.find('td:eq(5)').text()) - removeformatNumber(row.find('td:eq(7) label').text())) * removeformatNumber(row.find('td:eq(6) input').val() / 100);
        totalVatPercent += Number(row.find('td:eq(6) input').val());
        discountAmount += removeformatNumber(row.find('td:eq(7) label').text());
    })
    $('#total-e-invoice-create').text(formatNumber(checkDecimal(totalAmount)));
    $('#money-create-e-invoice').text(formatNumber(checkDecimal(totalAmount)));
    $('#vat-amount-create-e-invoice').text(formatNumber(checkDecimal(totalVat)));
    // $('#discount-amount-create-e-invoice').text(formatNumber(checkDecimal((totalAmount + totalVat) * (Number($('#discount-percent-create-e-invoice').text().replace('%()', '')) / 100))));
    $('#discount-amount-create-e-invoice').text(formatNumber(checkDecimal(discountAmount)));
    let totalFinal = checkDecimal(removeformatNumber($('#money-create-e-invoice').text()) + removeformatNumber($('#vat-amount-create-e-invoice').text()) - removeformatNumber($('#discount-amount-create-e-invoice').text()));
    $('#total-amount-create-e-invoice').text(Number(totalFinal) < 0 ? 0 : formatNumber(totalFinal));

    if (removeformatNumber($('#discount-percent-create-e-invoice').text()) === 100 && discountTypeEInvoiceCreate == 1) {
        $('#total-amount-create-e-invoice').text(0)
    }
}

async function saveModalEInvoiceUpdateCreate() {
    if (checkSaveUpdateEInvoiceUpdateCreate === 1) return false;
    if (!checkValidateSave($('#loading-modal-create-e-invoice'))) return false;
    let dataFood = [], dataFoodCreate = [];
    tableFoodCreateInvoice.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(2) select').length !== 1) {
            dataFoodCreate.push({
                "food_id": row.find('td:eq(8) button:last').data('food-id'),
                "quantity": 1,
                "food_unit": row.find('td:eq(2)').text(),
                "type": row.find('td:eq(8) button:last').data('category-type'),
                "is_gift": row.find('td:eq(8) button:last').data('gift'),
                "commodity_nature_type": 1
            })
        } else {
            dataFood.push({
                "invoice_detail_id": row.find('td:eq(8) button:last').data('invoice-id'),
                "food_name": row.find('td:eq(1)').text(),
                "quantity": removeformatNumber(row.find('td:eq(4) input').val()),
                "food_unit": row.find('td:eq(2) select').find('option:selected').val(),
                "price": removeformatNumber(row.find('td:eq(3) input').val()),
                "vat": row.find('td:eq(6) input').val(),
                "is_gift": row.find('td:eq(8) button:last').data('gift')
            })
        }
    })
    let name = $('#name-create-e-invoice').val(),
        company = $('#company-create-e-invoice').val(),
        email = $('#email-create-e-invoice').val(),
        phone = $('#phone-create-e-invoice').val(),
        tax = $('#tax-create-e-invoice').val(),
        address = $('#address-create-e-invoice').val();
    let method = 'post',
        url = 'e-invoice-manage.update',
        params = null,
        data = {
            id: idInvoiceCreate,
            data_food: dataFood,
            data_create_food: dataFoodCreate,
            name: name,
            name_company: company,
            email: email,
            phone: phone,
            tax: tax,
            address: address,
            payment_date: moment($('#payment-date-create-e-invoice').text()).format("DD/MM/YYYY"),
            is_send_mail: Number($('#send-mail-create-e-invoice').is(':checked'))
        };
    checkSaveUpdateEInvoiceUpdateCreate = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-e-invoice')]);
    checkSaveUpdateEInvoiceUpdateCreate = 0;
    if (res.data[0].status !== 200) {
        WarningNotify(res.data[0].message);
    } else if (res.data.length > 2 && res.data[1].status !== 200) {
        WarningNotify(res.data[1].message);
    } else {
        SuccessNotify($('#success-create-data-to-server').text());
        loadingData();
        closeModalEInvoiceCreate();
    }
}

function closeModalEInvoiceCreate() {
    $('#modal-e-invoice-create').modal('hide');
    resetModalEInvoiceCreate();
}

function resetModalEInvoiceCreate() {
    $('#modal-e-invoice-create input').val('');
    $('#code-create-e-invoice').text('---');
    $('#payment-date-create-e-invoice').text('---');
    $('#discount-amount-create-e-invoice').text('---');
    $('#vat-amount-create-e-invoice').text('---');
    $('#total-amount-create-e-invoice').text('---');
    $('#money-create-e-invoice').text('---');

    // tính tiền
    $('#total-e-invoice-create').text('---');
    $('#discount-percent-create-e-invoice').text('---');

    $('#discount-text-create-e-invoice').text('---');

    //click lại tab đang ở
    // $('#nav-tab-e-invoice .nav-link[data-id="'+ tabCurrentInvoice +'"]').click()
}
