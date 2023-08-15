let saveCreateReceiptsBill = 0, minDateCreateReceiptBill,
    maxDateCreateReceiptBill, closingDateOfThePreviousPeriod,
    maxDateCreateReceiptBillSalesSolution,
    datatableVatHandleCreateReceiptBill,
    checkGetVATCalculateReceiptBill = 0, checkGetClickVATCalculateReceiptBill = 0,
    checkGetDataReceiptsBill, idOrderReceiptsBill = 0;

$(function () {
    getDatePreviousPeriod();
    $(document).on('click', '#table-receipts-bill-vat-handle input', async function () {
        idOrderReceiptsBill = ($(this).parents('tr').find('td:eq(1)').text())
        datatableVatHandleCreateReceiptBill.rows().every(function (i, v) {
            if ($(this.node()).find('td:eq(1)').text() != idOrderReceiptsBill) {
                $(this.node()).find('td:eq(0) input[type="checkbox"]').prop('checked', false)
            }
        })
        if (checkGetClickVATCalculateReceiptBill !== 0) return false;
        checkGetClickVATCalculateReceiptBill = 1;
        if ($(this).is(':checked')) {
            if ($(this).parents('tr').find('td:eq(0) input').data('vat-amount') == undefined) {
                await dataVATCreateReceiptsBill($(this));
            } else {
                $('#value-create-receipts-bill').val(formatNumber(parseInt($(this).parents('tr').find('td:eq(0)').find('input').attr('data-vat-amount'))));
            }
        } else {
            $('#value-create-receipts-bill').val(formatNumber(removeformatNumber($('#value-create-receipts-bill').val()) - parseInt($(this).parents('tr').find('td:eq(0)').find('input').attr('data-vat-amount'))));
        }
        checkGetClickVATCalculateReceiptBill = 0;
    })

    // hiện nút reset
    $('#modal-create-receipts-bill select').on('change', function () {
        $('#modal-create-receipts-bill .btn-renew').removeClass('d-none');
    })
    $('#modal-create-receipts-bill input, #modal-create-receipts-bill textarea').on('input', function () {
        $('#modal-create-receipts-bill .btn-renew').removeClass('d-none');
    })
    $('#date-create-receipts-bill').on('dp.change', function () {
        $('#modal-create-receipts-bill .btn-renew').removeClass('d-none');
    })

    $('#div-select-target-create-receipts-bill').on('click', function () {
        if ($('#div-select-group-create-receipts-bill option:selected').val() == '-2') {
            $('#select-group-create-receipts-bill').parent().addClass('validate-error');
        }
    })

    // xử lý chọn nhóm
    $('#select-group-create-receipts-bill').on('select2:select', async function () {
        $('#div-input-target-create-receipts-bill').addClass('d-none');
        $('#div-select-target-create-receipts-bill').removeClass('d-none');
        $('#select-target-create-receipts-bill option').remove();
        $('#value-create-receipts-bill').prop('disabled', false);
        $('#value-create-receipts-bill').val(100);
        switch ($(this).val()) {
            // 1: nhà cung cấp
            case '1':
                $('#div-vat-additional-create-receipts-bill').addClass('d-none');
                $('#modal-create-receipts-bill .modal-dialog').attr('class', 'modal-dialog modal-md');
                dataSupplierCreateReceiptsBill();
                break;
            // 2: nhân viên
            case '2':
                $('#div-vat-additional-create-receipts-bill').addClass('d-none');
                $('#modal-create-receipts-bill .modal-dialog').attr('class', 'modal-dialog modal-md');
                dataEmployeeCreateReceiptsBill();
                break;
            // 3: khách hàng
            case '3':
                $('#div-vat-additional-create-receipts-bill').addClass('d-none');
                $('#modal-create-receipts-bill .modal-dialog').attr('class', 'modal-dialog modal-md');
                break;
            // 5: Thu Vat tay ( nhưng group = 4 )
            case '4':
                $('#div-input-target-create-receipts-bill input').val('')
                $('#div-select-target-create-receipts-bill').addClass('d-none');
                $('#div-input-target-create-receipts-bill').removeClass('d-none');
                $('#div-vat-additional-create-receipts-bill').removeClass('d-none');
                $('#modal-create-receipts-bill .modal-dialog').attr('class', 'modal-dialog modal-lg');
                $('#vat-additional-create-receipts-bill').prop('checked', true);
                $('#value-create-receipts-bill').val('0')
                $('#value-create-receipts-bill').prop('disabled', true);
                getListCreateReceiptsBill();
                break;
            // 0 : khác ( nhưng group = 5 )
            case '5':
                $('#div-input-target-create-receipts-bill input').val('')
                $('#div-input-target-create-receipts-bill').removeClass('d-none');
                $('#div-select-target-create-receipts-bill').addClass('d-none');
                $('#div-vat-additional-create-receipts-bill').addClass('d-none');
                $('#modal-create-receipts-bill .modal-dialog').attr('class', 'modal-dialog modal-md');
                break;
        }
    });
})

function openModalCreateReceiptsBill() {
    if (closingDateOfThePreviousPeriod) {
        minDateCreateReceiptBill = moment(closingDateOfThePreviousPeriod, 'DD/MM/YYYY')
    } else {
        minDateCreateReceiptBill = $('.date-create-receipts-bill').val(moment(new Date).format('DD/MM/YYYY'))
    }
    maxDateCreateReceiptBill = $('.date-create-receipts-bill').val(moment(new Date).format('DD/MM/YYYY'))
    maxDateCreateReceiptBillSalesSolution = $('.date-create-receipts-bill-sales-solution').val(moment(new Date).format('DD/MM/YYYY'))
    $('#modal-create-receipts-bill').modal('show');
    $('#value-create-receipts-bill').val('100');
    $('#vat-additional-create-receipts-bill').prop('checked', false);
    dateTimePickerTemplate($('.date-create-receipts-bill'), minDateCreateReceiptBill, maxDateCreateReceiptBill);
    dateTimePickerTemplate($('.date-create-receipts-bill-sales-solution'), '', maxDateCreateReceiptBillSalesSolution);
    $('#select-type-create-receipts-bill, #select-value-create-receipts-bill, #select-group-create-receipts-bill, #select-target-create-receipts-bill, #code-create-receipts-bill').select2({
        dropdownParent: $('#modal-create-receipts-bill')
    });
    shortcut.add('ESC', function () {
        closeModalCreateReceiptsBill();
    });
    shortcut.add('F4', function () {
        saveModalCreateReceiptsBill();
    });
    dataReasonCreateReceiptsBill();
}

async function dataVATCreateReceiptsBill(r) {
    let id = r.parents('tr').find('td:eq(1)').text()
    if (checkGetVATCalculateReceiptBill === 1) return false;
    let method = 'get',
        url = 'receipts-bill-treasurer.vat',
        params = {
            bill_id: id,
            branch: $('#select-branch-receipts-bill-treasurer').val(),
        },
        data = null;
    checkGetVATCalculateReceiptBill = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#value-create-receipts-bill')]);
    checkGetVATCalculateReceiptBill = 0;
    r.parents('tr').find('td:eq(0)').find('input').attr('data-vat-amount', res.data.data.vat_amount)
    $('#value-create-receipts-bill').val(formatNumber(res.data.data.vat_amount));
}


async function getListCreateReceiptsBill() {
    if (checkGetDataReceiptsBill === 1) return false;
    // $('#value-create-receipts-bill').val(100);
    let branch = $('#select-branch-receipts-bill-treasurer').val(),
        brand = $('#select-brand-receipts-bill-treasurer').attr('data-value');
    let method = 'get',
        url = 'receipts-bill-treasurer.bill',
        params = {brand: brand, branch_id: branch},
        data = null;
    checkGetDataReceiptsBill = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#table-receipts-bill-vat-handle')]);
    checkGetDataReceiptsBill = 0;
    dataTableReceiptsBillVatHandle(res.data[0].original.data);
}

async function dataTableReceiptsBillVatHandle(data) {
    let id = $('#table-receipts-bill-vat-handle'),
        column = [
            {data: 'checkbox', name: 'checkbox', class: 'text-center', width: '6%'},
            {data: 'id', name: 'id', className: 'text-center'},
            {data: 'customer_name', name: 'customer_name', className: 'text-center', width: '30%'},
            {data: 'customer_phone', name: 'customer_phone', className: 'text-center'},
            // {data: 'vat_amount', name: 'vat_amount', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        fixedLeft = 2,
        fixedRight = 2,
        option = [];
    datatableVatHandleCreateReceiptBill = await DatatableTemplateNew(id, data, column, '23vh', fixedLeft, fixedRight, option);
}

async function dataReasonCreateReceiptsBill() {
    if (dataReasonReceiptBill !== '') {
        $('#select-type-create-receipts-bill').html(dataReasonReceiptBill);
    } else {
        let method = 'get',
            url = 'receipts-bill-treasurer.reason',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#select-type-create-receipts-bill')]);
        $('#select-type-create-receipts-bill').html(res.data[0]);
        dataReasonReceiptBill = res.data[0];
    }
}

async function dataSupplierCreateReceiptsBill() {
    $('#select-target-create-receipts-bill').html(' <option value="" disabled selected>Dữ liệu rỗng</option>')
    let method = 'get',
        url = 'receipts-bill-treasurer.supplier',
        param = null,
        data = null;
    let res = await axiosTemplate(method, url, param, data, [$('#select-target-create-receipts-bill')]);
    $('#select-target-create-receipts-bill').html(res.data[0]);
}

async function dataEmployeeCreateReceiptsBill() {
    $('#select-target-create-receipts-bill').html(' <option value="" disabled selected>Vui lòng chọn</option>')
    let method = 'get',
        url = 'receipts-bill-treasurer.employee',
        branch = $('#select-branch-receipts-bill-treasurer').val(),
        param = {branch: branch, restaurant_brand_id: $('#select-brand-receipts-bill-treasurer').attr('data-value')},
        data = null;
    let res = await axiosTemplate(method, url, param, data, [$('#select-target-create-receipts-bill')]);
    $('#select-target-create-receipts-bill').html(res.data[0]);
}

async function saveModalCreateReceiptsBill() {
    if (saveCreateReceiptsBill !== 0) return false;
    if (!checkValidateSave($('#modal-create-receipts-bill'))) return false;
    let branch = $('#select-branch-receipts-bill-treasurer').val(),
        type = $('#select-type-create-receipts-bill').val(),
        group = $('#select-group-create-receipts-bill').val(),
        target = $('#select-target-create-receipts-bill').val(),
        target_input = $('#select-target-create-receipts-bill option:selected').text(),
        value = removeformatNumber($('#value-create-receipts-bill').val()),
        value_type = $('#select-value-create-receipts-bill').val(),
        date = $('#date-create-receipts-bill').val(),
        description = $('#description-create-receipts-bill').val(),
        inventory = [];
    if (group == 4) {
        // for lấy id của hoá đơn
        // group = 4 // 4: Thu VAT tay ( order )
        datatableVatHandleCreateReceiptBill.rows().every(function (i, v) {
            if ($(this.node()).find('td:eq(0) input[type="checkbox"]').is(':checked')) {
                // id của hoá đơn
                target = Number($(this.node()).find('td:eq(1)').text());
            }
        })
        if (target === null) {
            WarningNotify('Vui lòng chọn hoá đơn thu VAT');
            return false;
        }
        target_input = $('#input-target-create-receipts-bill').val();
    } else if (group == 5) {
        // 5: Khác
        // group = 5;
        target = 0;
        target_input = $('#input-target-create-receipts-bill').val();
    }
    saveCreateReceiptsBill = 1;
    let method = 'post',
        url = 'receipts-bill-treasurer.create',
        params = null,
        data = {
            branch: branch,
            addition_fee_reason_id: type,
            amount: value,
            date: date,
            is_count_to_revenue: Number($('#accounting-create-receipts-bill').is(':checked')),
            note: description,
            object_id: target,
            object_name: target_input,
            object_type: group,
            payment_method_id: value_type,
            warehouse_session_ids: inventory,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-create-receipts-bill')]);
    saveCreateReceiptsBill = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status) {
        case 200:
            SuccessNotify(text);
            closeModalCreateReceiptsBill();
            loadingData();
            shortcut.remove('ESC');
            shortcut.remove('F4');
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            WarningNotify(text);
    }
}

async function getDatePreviousPeriod() {
    let method = 'get',
        branch = $('#select-branch-receipts-bill-treasurer').val(),
        to_date = $('.to-date-cash-book').val(),
        params = {branch: branch, date: to_date},
        data = null,
        url = 'cash-book-treasurer.time';
    let res = await axiosTemplate(method, url, params, data);
    closingDateOfThePreviousPeriod = res.data.data.from_date;
}

function closeModalCreateReceiptsBill() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    reloadModalCreateReceiptsBill();
    $('#modal-create-receipts-bill').modal('hide');
    removeAllValidate();
    countCharacterTextarea()
}

function reloadModalCreateReceiptsBill() {
    $('#modal-create-receipts-bill .js-example-basic-single').find('option:first').prop('selected', true).trigger('change.select2');
    $('#select-target-create-receipts-bill').html('<option value="-2" disabled selected hidden>Dữ liệu rỗng</option>');
    $('#select-type-create-receipts-bill').val(null).trigger('change.select2');
    $('#value-create-receipts-bill').val('100');
    $('#value-create-receipts-bill').prop('disabled', false);
    $('#accounting-create-receipts-bill').prop('checked', true);
    $('#date-create-receipts-bill').val(moment().format('DD/MM/YYYY'));
    $('#description-create-receipts-bill').val('');
    $('#code-create-receipts-bill').val('');
    $('#input-target-create-receipts-bill').val('');
    $('#div-code-create-receipts-bill').addClass('d-none');
    $('#vat-additional-create-receipts-bill').prop('checked', false);
    $('#div-vat-additional-create-receipts-bill').addClass('d-none');
    $('.btn-renew').addClass('d-none');
    $('#modal-create-receipts-bill .modal-dialog').attr('class', 'modal-dialog modal-md');
    removeAllValidate();
}
