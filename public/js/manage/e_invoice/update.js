let checkSaveUpdateEInvoice, tableFoodUpdateInvoice, checkRemoveFoodEInvoiceUpdate, discountTypeEInvoiceUpdate,
    optionUnitUpdateEInvoice, idOrderBillEInvoiceUpdate, idInvoiceUpdate;
$(function(){
    $(document).on('input', '#loading-modal-update-e-invoice input', function(){
        $('#btn-save-modal-e-invoice-update').removeAttr("disabled");
    })
    $(document).on('change', '#loading-modal-update-e-invoice select', function(){
        $('#btn-save-modal-e-invoice-update').removeAttr("disabled");
    })

    $('#select-food-update-invoice-order').on('select2:select', async function () {
        await addRowDatatableTemplate(tableFoodUpdateInvoice, {
            'food_name': $(this).find(':selected').text(),
            'food_unit': $(this).find(':selected').data('unit'),
            'unit_price': formatNumber($(this).find(':selected').data('price')),
            'quantity': 1,
            'total_price': formatNumber($(this).find(':selected').data('price')),
            'vat_percent': `${$(this).find(':selected').data('vat')} <input class="d-none" value="${$(this).find(':selected').data('vat')}">`,
            'discount_cal': `<label data-cal="${formatNumber($(this).find(':selected').data('discount-cal'))}">${formatNumber($(this).find(':selected').data('discount-cal'))}</label>`,
            'action': `<div class="btn-group-sm">
                            <button class="btn seemt-red seemt-btn-hover-red waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Xoá" data-discount-cal="${$(this).find(':selected').data('discount-cal')}" data-invoice-id="${$(this).find(':selected').data('invoice-id')}" data-gift="${$(this).find(':selected').data('gift')}" data-food-id="${$(this).find(':selected').val()}" data-category-type="${$(this).find(':selected').data('type')}" data-price="${$(this).find(':selected').data('price')}" data-vat="${$(this).find(':selected').data('vat')}" data-name="${$(this).find(':selected').data('name')}" data-unit="${$(this).find(':selected').data('unit')}" onclick="removeFoodUpdateInvoice($(this))">
                            <i class="fi-rr-trash"></i></button>
                        </div>`,
            'keysearch': ''
        });

        $('#select-food-update-invoice-order').find(':selected').remove();
        $('#select-food-update-invoice-order').val('').trigger('change');
        let totalAmount = 0, totalVat = 0, totalVatPercent = 0, discountAmount = 0;
        await tableFoodUpdateInvoice.rows().every(function () {
            let row = $(this.node());
            totalAmount += removeformatNumber(row.find('td:eq(5)').text());
            totalVat += (removeformatNumber(row.find('td:eq(5)').text()) - removeformatNumber(row.find('td:eq(7) label').text())) * (removeformatNumber(row.find('td:eq(6) input').val()) / 100)
            totalVatPercent += Number(row.find('td:eq(6) input').val());
            discountAmount += removeformatNumber(row.find('td:eq(7) label').text());
        })
        $('#total-e-invoice-update').text(formatNumber(checkDecimal(totalAmount)));
        $('#money-update-e-invoice').text(formatNumber(checkDecimal(totalAmount)));
        $('#vat-amount-update-e-invoice').text(formatNumber(checkDecimal(totalVat)));
        $('#discount-amount-update-e-invoice').text(formatNumber(checkDecimal(discountAmount)));
        let totalFinal = checkDecimal(removeformatNumber($('#money-update-e-invoice').text()) - removeformatNumber($('#discount-amount-update-e-invoice').text()) + removeformatNumber($('#vat-amount-update-e-invoice').text()));
        $('#total-amount-update-e-invoice').text(Number(totalFinal) < 0 ? 0 : formatNumber(totalFinal));
    })
})
async function openModalEInvoiceUpdate(r) {
    $('#modal-e-invoice-update').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalEInvoiceUpdate();
    });
    shortcut.add('F4', function () {
        saveModalEInvoiceUpdate();
    });
    idOrderBillEInvoiceUpdate = r.data('id');
    idInvoiceUpdate = r.data('id-invoice');
    $('#select-branch-table , #select-food-update-invoice-order').select2({
        dropdownParent: $('#modal-e-invoice-update'),
    });
    $(document).on('input paste keyup keydown', '.quantity-food-update-invoice', function () {
        $(this).val(formatNumber($(this).val().replace(/[^0-9_.]/g, "")))
        updatePriceVatTotalUpdateEInvoice($(this));
    })
    $(document).on('input paste keyup keydown', '.price-food-update-invoice', function () {
        $(this).val(formatNumber($(this).val().replace(/[^0-9_]/g, "")));
        updatePriceVatTotalUpdateEInvoice($(this));
    })

    $(document).on('input paste keyup keydown', '.vat-food-update-invoice', function () {
        $(this).val(formatNumber($(this).val().replace(/[^0-9_]/g, "")));
        updatePriceVatTotalUpdateEInvoice($(this));
    })

    drawTableFoodUpdateInvoice([]);
    getDataUpdateOrder();
}

async function getDataUpdateOrder() {
    let method = 'get',
        url = 'e-invoice-manage.data-update',
        params = {
            id: idInvoiceUpdate,
            brand: $('.select-brand-e-invoice-manage').val(),
            id_order: idOrderBillEInvoiceUpdate,
            branch: $('.select-branch-e-invoice-manage').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-food-e-invoice-update'), $('#form-header-bonus-punish-update'), $('#boxlist-update-e-invoice')]);
    drawTableFoodUpdateInvoice(res.data[0].original.data);
    $('#code-update-e-invoice').text('#' + res.data[3].order_id);
    $('#payment-date-update-e-invoice').text(moment(res.data[3].payment_date).format("DD/MM/YYYY HH:mm"));
    $('#discount-amount-update-e-invoice').text(formatNumber(res.data[3].discount_amount));
    $('#discount-percent-update-e-invoice').text(formatNumber(res.data[3].discount_percent));
    $('#vat-amount-update-e-invoice').text(formatNumber(res.data[3].vat_amount));
    $('#total-amount-update-e-invoice').text(formatNumber(res.data[3].total_amount));
    $('#money-update-e-invoice').text(formatNumber(res.data[3].amount));
    $('#discount-text-update-e-invoice').text(res.data[3].discount_text);
    discountTypeEInvoiceUpdate = res.data[3].discount_type;

    // tính tiền
    $('#total-e-invoice-update').text(formatNumber(res.data[3]['amount']));
    // $('#vat-percent-update-e-invoice').text(formatNumber(res.data[4]['total_vat']));

    // select món ăn và đơn vị
    $('#select-food-update-invoice-order').html(res.data[1]);
    optionUnitUpdateEInvoice = res.data[2];
//     chi tiết khách hàng
    $('#name-update-e-invoice').val(res.data[3].customer_name);
    $('#phone-update-e-invoice').val(res.data[3].customer_phone);
    $('#company-update-e-invoice').val(res.data[3].customer_company_name);
    $('#email-update-e-invoice').val(res.data[3].customer_company_email);
    $('#address-update-e-invoice').val(res.data[3].customer_company_address);
    $('#tax-update-e-invoice').val(res.data[3].customer_company_tax_code);

    $('#send-mail-update-e-invoice').prop('checked', Boolean(res.data[3].is_send_mail));
}

async function saveModalEInvoiceUpdate() {
    if (checkSaveUpdateEInvoice === 1) return false;
    if (!checkValidateSave($('#loading-modal-update-e-invoice'))) return false;
    checkSaveUpdateEInvoice = 1;
    let dataFood = [], dataFoodCreate = [];
    tableFoodUpdateInvoice.rows().every(function (){
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
        }else{
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
        url = 'e-invoice-manage.update-waiting-accept',
        params = null,
        data = {
            id: idInvoiceUpdate,
            data_food : dataFood,
            data_update_food : dataFoodCreate,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-e-invoice')]);
    checkSaveUpdateEInvoice = 0;
    let text = ''
    if(res.data[0].status !== 200){
        text = res.data[0].message == undefined ? 'Lỗi rồi!' : res.data[0].message;
        WarningNotify(text);
    }else if(res.data[1].status !== 200){
        text = res.data[1].message == undefined ? 'Lỗi rồi!' : res.data[1].message;
        WarningNotify(text);
    }else{
        SuccessNotify($('#success-update-data-to-server').text());
        loadingData();
        closeModalEInvoiceUpdate();
    }
}

async function drawTableFoodUpdateInvoice(data) {
    let id = $('#table-food-e-invoice-update'),
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
    tableFoodUpdateInvoice = await DatatableTemplateNew(id, data, column, '20vh', fixed_left, fixed_right);
}

function removeFoodUpdateInvoice(r) {
    // không cho xoá do còn 1 record
    if (tableFoodUpdateInvoice.rows().count() == 1) {
        WarningNotify('Danh sách món không được rỗng! ');
        return false;
    }
    // không cho xoá do còn 1 record
    if($('#table-food-e-invoice-update select').length == 1 && r.parents('tr').find('td:eq(2) select').length !== 0){
        WarningNotify('Vui lòng lưu lại món mới trước khi thực hiện thao tác xoá này! ');
        return false;
    }
    if(r.data('invoice-id') !==0){
        let title = 'Xoá món ăn khỏi bill ?',
            content = '',
            icon =  'question';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                let method = 'post',
                    url = 'e-invoice-manage.change-status',
                    params = null,
                    data = {id: r.data('invoice-id')};
                checkRemoveFoodEInvoiceUpdate = 1;
                let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
                checkRemoveFoodEInvoiceUpdate = 0;
                switch(res.data.status) {
                    case 200:
                        SuccessNotify('Xoá món ăn thành công !');
                        $('#select-food-update-invoice-order').append(`<option value="${r.data('food-id')}" data-name="${r.data('name')}" data-invoice-id="${r.data('invoice-id')}" data-unit="${r.data('unit')}" data-gift="${r.data('gift')}" data-type="${r.data('category-type')}" data-price="${r.data('price')}" data-vat="${r.data('vat')}" data-discount-cal="${r.data('discount-cal')}" data-unit="${r.data('unit')}">${r.data('name')}</option>`);
                        removeRowDatatableTemplate(tableFoodUpdateInvoice, r, true);
                        updatePriceVatTotalUpdateEInvoice(r);
                        $('#btn-save-modal-e-invoice-update').removeAttr("disabled");
                        break;
                    case 500:
                        ErrorNotify($('#error-post-data-to-server').text());
                        break;
                    default:
                        WarningNotify(res.data.message);
                }
            }else{
                checkRemoveFoodEInvoiceUpdate = 0
            }
        })
    }else{
        $('#select-food-update-invoice-order').append(`<option value="${r.data('food-id')}" data-name="${r.data('name')}" data-invoice-id="${r.data('invoice-id')}" data-gift="${r.data('gift')}" data-type="${r.data('category-type')}" data-price="${r.data('price')}" data-vat="${r.data('vat')}" data-discount-cal="${r.data('discount-cal')}" data-unit="${r.data('unit')}">${r.data('name')}</option>`);
        removeRowDatatableTemplate(tableFoodUpdateInvoice, r, true);
        updatePriceVatTotalUpdateEInvoice(r);
        $('#btn-save-modal-e-invoice-update').removeAttr("disabled");
    }
}

async function updatePriceVatTotalUpdateEInvoice(r) {
    let totalAmount = 0, totalVat = 0, totalVatPercent = 0, discountAmount = 0;
    let quantity = removeformatNumber(r.parents('tr').find('td:eq(4) input').val())
    let price = removeformatNumber(r.parents('tr').find('td:eq(3) input').val());
    let vat = removeformatNumber(r.parents('tr').find('td:eq(6) input').val());
    r.parents('tr').find('td:eq(5)').text(formatNumber(checkDecimal(quantity * price)));
    if (r.parents('tr').find('td:eq(7) label').data('cal') !== 0) {
        // r.parents('tr').find('td:eq(7) label').text(formatNumber(checkDecimal(((quantity * price) + (quantity * price * (vat / 100))) * removeformatNumber($('#discount-percent-update-e-invoice').text()) / 100)));
        r.parents('tr').find('td:eq(7) label').text(formatNumber(checkDecimal(((removeformatNumber(r.parents('tr').find('td:eq(5)').text()) * removeformatNumber($('#discount-percent-update-e-invoice').text()) / 100)))));
    }
    await tableFoodUpdateInvoice.rows().every(function (i) {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(5)').text());
        totalVat += (removeformatNumber(row.find('td:eq(5)').text()) - removeformatNumber(row.find('td:eq(7) label').text())) * removeformatNumber(row.find('td:eq(6) input').val() / 100);
        totalVatPercent += Number(row.find('td:eq(6) input').val());
        discountAmount += removeformatNumber(row.find('td:eq(7) label').text());
    })
    $('#total-e-invoice-update').text(formatNumber(checkDecimal(totalAmount)));
    $('#money-update-e-invoice').text(formatNumber(checkDecimal(totalAmount)));
    $('#vat-amount-update-e-invoice').text(formatNumber(checkDecimal(totalVat)));
    $('#discount-amount-update-e-invoice').text(formatNumber(checkDecimal(discountAmount)));
    let totalFinal = checkDecimal(removeformatNumber($('#money-update-e-invoice').text()) + removeformatNumber($('#vat-amount-update-e-invoice').text()) - removeformatNumber($('#discount-amount-update-e-invoice').text()));
    $('#total-amount-update-e-invoice').text(Number(totalFinal) < 0 ? 0 : formatNumber(totalFinal));
    if(removeformatNumber($('#discount-percent-update-e-invoice').text()) === 100 && discountTypeEInvoiceUpdate == 1){
        $('#total-amount-update-e-invoice').text(0)
    }
}

function closeModalEInvoiceUpdate() {
    $('#modal-e-invoice-update').modal('hide');
    resetModalEInvoiceUpdate();
}

function resetModalEInvoiceUpdate() {
    $('#modal-e-invoice-update input').val('');
    $('#code-update-e-invoice').text('---');
    $('#payment-date-update-e-invoice').text('---');
    $('#discount-amount-update-e-invoice').text('---');
    $('#vat-amount-update-e-invoice').text('---');
    $('#total-amount-update-e-invoice').text('---');
    $('#money-update-e-invoice').text('---');

    // tính tiền
    $('#total-e-invoice-update').text('---');
    $('#discount-percent-update-e-invoice').text('---');

//     chi tiết khách hàng
    $('#name-update-e-invoice').val('');
    $('#phone-update-e-invoice').val('');
    $('#company-update-e-invoice').val('');
    $('#email-update-e-invoice').val('');
    $('#address-update-e-invoice').val('');

    // disabled btn save
    $("#btn-save-modal-e-invoice-update").attr("disabled", true);

    // $('#nav-tab-e-invoice .nav-link[data-id="'+ tabCurrentInvoice +'"]').click()
}

