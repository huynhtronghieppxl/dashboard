let tableSupplierOrderCreatePaymentBill,
    saveCreatePaymentBill = 0, statusCreatePaymentBill,
    dataReasonPaymentBillCreate = '',
    closingDateOfThePreviousPeriod,
    maxDateCreatePaymentBill, minDateCreatePaymentBill,
    maxDateCreatePaymentBilljSalesSolution;
$(function (){
    getDatePreviousPeriod()
})

function openModalCreatePaymentBill() {
    if (closingDateOfThePreviousPeriod){
        minDateCreatePaymentBill = moment(closingDateOfThePreviousPeriod, 'DD/MM/YYYY')
    }else{
        minDateCreatePaymentBill = $('.date-create-payment-bill').val(moment(new Date).format('DD/MM/YYYY'))
    }
    maxDateCreatePaymentBill = $('.date-create-payment-bill').val(moment(new Date).format('DD/MM/YYYY'))
    maxDateCreatePaymentBilljSalesSolution = $('.date-create-payment-bill-sales-solution').val(moment(new Date).format('DD/MM/YYYY'))
    $('#modal-create-payment-bill').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreatePaymentBill();
    });
    shortcut.add('F4', function () {
        saveModalCreatePaymentBill();
    });
    dateTimePickerTemplate($('.date-create-payment-bill'), minDateCreatePaymentBill, maxDateCreatePaymentBill);
    dateTimePickerTemplate($('.date-create-payment-bill-sales-solution'), '', maxDateCreatePaymentBilljSalesSolution);
    $('#select-value-create-payment-bill ,#select-type-create-payment-bill, #select-group-create-payment-bill,#select-target-create-payment-bill, #select-status-create-payment-bill').select2({
        dropdownParent: $('#modal-create-payment-bill'),
    });
    $('#select-group-create-payment-bill').unbind('select2:select').on('select2:select', async function () {
        removeAllValidate();
        $('#size-modal-create-payment-bill').removeClass('modal-xl');
        $('#size-modal-create-payment-bill').addClass('modal-md');
        $('#right-create-payment-bill .card-block').removeClass('card');
        $('#left-create-payment-bill').removeClass('col-lg-8');
        $('#left-create-payment-bill').addClass('d-none');
        $('#right-create-payment-bill').removeClass('col-lg-4');
        $('#right-create-payment-bill').addClass('col-lg-12');
        $('#div-input-target-create-payment-bill').addClass('d-none');
        $('#div-select-target-create-payment-bill').removeClass('d-none');
        $('#title-right-create-payment-bill').addClass('d-none');
        $('#original-price-create-payment-bill').parents('.hidden-class').addClass('d-none');
        $('#return-price-create-payment-bill').parents('.hidden-class').addClass('d-none');
        $('#size-modal-create-payment-bill .modal-body').removeClass('background-body-color');
        $('#form-price-create-payment-bill').removeClass('d-none');
        $('#type-price-create-payment-bill').removeClass('col-lg-12');
        $('#type-price-create-payment-bill').removeClass('px-0');
        $('#type-price-create-payment-bill').addClass('col-lg-6');
        $('#type-price-create-payment-bill').addClass('pr-0');
        $('#select-target-create-payment-bill option').remove();
        switch ($(this).val()) {
            case '1':
                $('#size-modal-create-payment-bill').removeClass('modal-md');
                $('#size-modal-create-payment-bill').addClass('modal-xl');
                $('#right-create-payment-bill .card-block').addClass('card');
                $('#right-create-payment-bill .card-block').addClass('ml-0');
                $('#size-modal-create-payment-bill .modal-body').addClass('background-body-color');
                $('#left-create-payment-bill').removeClass('d-none');
                $('#div-select-status-create-payment-bill').removeClass('d-none');
                $('#left-create-payment-bill').addClass('col-lg-8');
                $('#right-create-payment-bill').removeClass('col-lg-12');
                $('#right-create-payment-bill').addClass('col-lg-4');
                $('#title-right-create-payment-bill').removeClass('d-none');
                $('#form-price-create-payment-bill').addClass('d-none');
                $('#original-price-create-payment-bill').parents('.hidden-class').removeClass('d-none');
                $('#return-price-create-payment-bill').parents('.hidden-class').removeClass('d-none');
                $('#type-price-create-payment-bill').removeClass('col-lg-6');
                $('#type-price-create-payment-bill').removeClass('pr-0');
                $('#type-price-create-payment-bill').addClass('col-lg-12');
                $('#type-price-create-payment-bill').addClass('px-0');
                $('#div-total-amount-create-payment-bill-group-supplier').removeClass('d-none');
                await dataSupplierCreatePaymentBill();
                dataSupplierOrderCreatePaymentBill();
                break;
            case '2':
                $('#div-select-status-create-payment-bill').addClass('d-none');
                $('#right-create-payment-bill .card-block').addClass('card');
                $('#div-total-amount-create-payment-bill-group-supplier').addClass('d-none');
                $('#value-create-payment-bill').attr('data-min', 100)
                dataEmployeeCreatePaymentBill();
                break;
            case '3':
                $('#div-total-amount-create-payment-bill-group-supplier').addClass('d-none');
                $('#right-create-payment-bill .card-block').addClass('card');
                break;
            case '5':
                $('#div-select-status-create-payment-bill').addClass('d-none');
                $('#div-select-target-create-payment-bill').addClass('d-none');
                $('#right-create-payment-bill .card-block').addClass('card');
                $('#div-input-target-create-payment-bill').removeClass('d-none');
                $('#div-total-amount-create-payment-bill-group-supplier').addClass('d-none');
                break;
            default:
                break;
        }
    });
    $('#select-branch-create-payment-bill').unbind('select2:select').on('select2:select', async function () {
        removeAllValidate();
        switch ($('#select-group-create-payment-bill').val()) {
            case '1':
                await dataSupplierCreatePaymentBill();
                dataSupplierOrderCreatePaymentBill();
                break;
            case '2':
                dataEmployeeCreatePaymentBill();
                break;
            case '3':
                break;
            default:
                break;
        }
    });
    $('#div-select-target-create-payment-bill').on('click', function () {
        if ($('#div-select-group-create-payment-bill option:selected').val() == '-2') {
            $('#select-group-create-payment-bill').parent().addClass('validate-error');
        }
    })
    $('#select-target-create-payment-bill').unbind('select2:select').on('select2:select', function () {
        if ($('#select-group-create-payment-bill').val() === '1') {
            dataSupplierOrderCreatePaymentBill();
        }
    });
    $('#select-status-create-payment-bill').on('change', function () {
        $('.btn-renew').removeClass('d-none')
        dataSupplierOrderCreatePaymentBill();
    });
    $('#select-group-create-payment-bill,#date-create-payment-bill, #select-target-create-payment-bill, #select-type-create-payment-bill, #select-value-create-payment-bill').on('change', function () {
        $('.btn-renew').removeClass('d-none');
    })
    $('#value-create-payment-bill, #description-create-payment-bill, #accounting-create-payment-bill').on('input', function () {
        $('.btn-renew').removeClass('d-none');
    })
    $('#date-create-payment-bill').on('dp.change', function () {
        $('.btn-renew').removeClass('d-none');
    })

    $('#value-create-payment-bill').on('click', function () {
        console.log(123)
    })

    $('#value-create-payment-bill').on('focus', function () {
        console.log(456)
    })
    $(document).on('input paste','#table-supplier-order-create-payment-bill_filter', function (){
        let totalSupplierOrder = searchTableSupplierOrderCreatePaymentBill(tableSupplierOrderCreatePaymentBill)
        $('#total-debt-create-payment-bill').text(formatNumber(totalSupplierOrder))
    })
    $(document).on('click','#table-supplier-order-create-payment-bill input[type="checkbox"]', function (){
        let totalPaymentCheck = 0
        tableSupplierOrderCreatePaymentBill.rows().every(function (){
            let row = $(this.node())
            if (row.find('td:eq(1)').find('input').is(':checked') === true){
                totalPaymentCheck += removeformatNumber(row.find('td:eq(4)').text())
            }
            else{
                totalPaymentCheck += 0
            }
            $('#total-amount-create-payment-bill-group-supplier').text(formatNumber(totalPaymentCheck))
        })
    })
    $(document).on('click','#check-all-supplier-order-create-payment-bill', function (){
        let totalPaymentCheckAll = 0
        tableSupplierOrderCreatePaymentBill.rows().every(function (){
            let row = $(this.node())
            if ($('#check-all-supplier-order-create-payment-bill').is(':checked') === true){
                totalPaymentCheckAll += removeformatNumber(row.find('td:eq(4)').text())
            }
            else{
                totalPaymentCheckAll = 0
            }
            $('#total-amount-create-payment-bill-group-supplier').text(formatNumber(totalPaymentCheckAll))
        })
    })
    // dataReasonCreatePaymentBill();
}

// async function dataReasonCreatePaymentBill() {
//     if (dataReasonPaymentBillCreate !== '') {
//         $('#select-type-create-payment-bill').html(dataReasonPaymentBillCreate);
//     } else {
//         let method = 'get',
//             url = 'payment-bill-treasurer.reason',
//             params = null,
//             data = null;
//         let res = await axiosTemplate(method, url, params, data);
//         $('#select-type-create-payment-bill').html(res.data[1]);
//         dataReasonPaymentBillCreate = res.data[1];
//     }
// }

async function dataSupplierCreatePaymentBill() {
    $('#select-target-create-payment-bill').html('<option selected disabled hidden>Vui lòng chọn</option>');
    let method = 'get',
        url = 'payment-bill-treasurer.supplier',
        branch = $('#select-branch-payment-bill-treasurer').val(),
        param = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, param, data, [$('#select-target-create-payment-bill')]);
    $('#select-target-create-payment-bill').html(res.data[0]);
}

async function dataEmployeeCreatePaymentBill() {
    $('#select-target-create-payment-bill').html('<option selected disabled hidden>Vui lòng chọn</option>');
    let method = 'get',
        url = 'payment-bill-treasurer.employee',
        branch = $('#select-branch-payment-bill-treasurer').val(),
        // time = $('#date-create-payment-bill').val(),
        param = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, param, data, [$('#select-target-create-payment-bill')]);
    $('#select-target-create-payment-bill').html(res.data[0]);
}

async function dataSupplierOrderCreatePaymentBill() {
    $('#check-all-supplier-order-create-payment-bill').prop('checked', false);
    $('#original-price-create-payment-bill').text('0');
    $('#return-price-create-payment-bill').text('0');
    $('#value-create-payment-bill').val(100);
    let method = 'get',
        url = 'payment-bill-treasurer.order',
        branch = $('#select-branch-payment-bill-treasurer').val(),
        is_debt = $('#select-status-create-payment-bill').val(),
        supplier = $('#select-target-create-payment-bill').val(),
        time = $('#date-create-payment-bill').val(),
        param = {supplier: supplier, branch: branch, to: time, is_debt: is_debt},
        data = null;
    let res = await axiosTemplate(method, url, param, data, [$('#table-supplier-order-create-payment-bill')]);
    supplierOrderCreatePaymentBill(res.data[0].original.data);
    $('#total-original-price-create-payment-bill').text(res.data[1].total_original);
    $('#total-return-price-create-payment-bill').text(res.data[1].total_return);
    $('#total-debt-create-payment-bill').text(res.data[1].total_det_amount);
}

async function supplierOrderCreatePaymentBill(data) {
    let id = $('#table-supplier-order-create-payment-bill'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'checkbox', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'employee_complete', name: 'employee_complete'},
            {data: 'restaurant_debt_amount', name: 'restaurant_debt_amount', className: 'text-center'},
            {data: 'retention_money', name: 'retention_money', className: 'text-center'},
            {data: 'received_at', name: 'received_at', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ];
    tableSupplierOrderCreatePaymentBill = await DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right);
}

function searchTableSupplierOrderCreatePaymentBill(datatable){
    let totalPayment = 0
    datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        totalPayment += removeformatNumber(row.find('td:eq(4)').text())
    })
    return totalPayment
}

async function checkItemSupplierOrderCreatePaymentBill() {
    let total = 0, original = 0, returnAmount = 0, check = 0;
    await tableSupplierOrderCreatePaymentBill.rows().every(function (index, element) {
        let x = $(this.node());
        if (x.find('td:eq(1)').find('input[type="checkbox"]').is(':checked')) {
            check++;
            original += removeformatNumber(x.find('td:eq(3)').text());
            returnAmount += removeformatNumber(x.find('td:eq(4)').text());
            total += removeformatNumber(x.find('td:eq(5)').text());
        }
    });
    (check === tableSupplierOrderCreatePaymentBill.rows().count()) ? $('#check-all-supplier-order-create-payment-bill').prop('checked', true) : $('#check-all-supplier-order-create-payment-bill').prop('checked', false);

    $('#original-price-create-payment-bill').text(formatNumber(original));
    $('#return-price-create-payment-bill').text(formatNumber(returnAmount));
    $('#debt-create-payment-bill').text(formatNumber(total));

}

async function checkAllItemSupplierOrderCreatePaymentBill(r) {
    if (r.is(':checked')) {
        let total = 0, original = 0, returnAmount = 0;
        await tableSupplierOrderCreatePaymentBill.rows().every(function (index, element) {
            let x = $(this.node());
            x.find('td:eq(1)').find('input[type="checkbox"]').prop('checked', true);
            original += removeformatNumber(x.find('td:eq(3)').text());
            returnAmount += removeformatNumber(x.find('td:eq(4)').text());
            total += removeformatNumber(x.find('td:eq(5)').text());
        });
        $('#original-price-create-payment-bill').text(formatNumber(original));
        $('#return-price-create-payment-bill').text(formatNumber(returnAmount));
        $('#debt-create-payment-bill').text(formatNumber(total));
    } else {
        await tableSupplierOrderCreatePaymentBill.rows().every(function (index, element) {
            let x = $(this.node());
            x.find('td:eq(1)').find('input[type="checkbox"]').prop('checked', false);
        });
        $('#original-price-create-payment-bill').text(0);
        $('#return-price-create-payment-bill').text(0);
        $('#debt-create-payment-bill').text(0);
    }
}

async function getDatePreviousPeriod() {
    let method = 'get',
        branch = $('#select-branch-payment-bill-treasurer').val(),
        to_date = $('.to-date-cash-book').val(),
        params = {branch: branch, date: to_date},
        data = null,
        url = 'cash-book-treasurer.time';
    let res = await axiosTemplate(method, url, params, data);
    closingDateOfThePreviousPeriod = res.data.data.from_date;
}

async function saveModalCreatePaymentBill() {
    if (saveCreatePaymentBill !== 0) return false;
    if (!checkValidateSave($('#modal-create-payment-bill'))) return false;
    let branch = $('#select-branch-payment-bill-treasurer').val(),
        type = $('#select-type-create-payment-bill').val(),
        group = $('#select-group-create-payment-bill').val(),
        target = $('#select-target-create-payment-bill').val(),
        target_input = $('#select-target-create-payment-bill option:selected').text(),
        value = removeformatNumber($('#value-create-payment-bill').val()),
        value_type = $('#select-value-create-payment-bill').val(),
        accounting = 0,
        date = $('#date-create-payment-bill').val(),
        description = $('#description-create-payment-bill').val(),
        is_paid_debt = $('#select-status-create-payment-bill').val(),
        supplier_order_ids = [];
    if ($('#accounting-create-payment-bill').is(':checked') === true) accounting = 1;
    switch (group) {
        case '1':
            tableSupplierOrderCreatePaymentBill.rows().every(function (index, element) {
                let x = $(this.node());
                if (x.find('td:eq(1)').find('input[type="checkbox"]').is(':checked')) {
                    supplier_order_ids.push(x.find('td:eq(1)').find('input[type="checkbox"]').val());
                }
            });
            console.log('supplier_order_ids: ', supplier_order_ids);
            value = removeformatNumber($('#debt-create-payment-bill').val());
            break;
        case '5':
            target = 0;
            target_input = $('#input-target-create-payment-bill').val();
            break;
    }
    if (group === 1 && supplier_order_ids === []) {
        let text = 'Vui lòng chọn phiếu nhập kho cần chi !';
        ErrorNotify(text);
        return false;
    }
    saveCreatePaymentBill = 1;
    let method = 'post',
        url = 'payment-bill-treasurer.create',
        params = null,
        data = {
            branch: branch,
            addition_fee_reason_id: type,
            amount: value,
            date: date,
            is_count_to_revenue: accounting,
            note: description,
            object_id: target,
            object_name: target_input,
            object_type: group,
            payment_method_id: value_type,
            supplier_order_ids: supplier_order_ids,
            is_paid_debt: is_paid_debt
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-create-payment-bill')]);
    saveCreatePaymentBill = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalCreatePaymentBill();
            loadingData();
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

function closeModalCreatePaymentBill() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-create-payment-bill select').find('option:first').prop('selected', true).trigger('change.select2');
    $('#check-all-supplier-order-create-payment-bill').prop('checked', false);
    $('#select-target-create-payment-bill').html('<option value="-2" disabled selected hidden>Vui lòng chọn</option>');
    $('#size-modal-create-payment-bill').removeClass('modal-xl');
    $('#size-modal-create-payment-bill').addClass('modal-md');
    $('#right-create-payment-bill .card-block').removeClass('card');
    $('#left-create-payment-bill').removeClass('col-lg-8');
    $('#left-create-payment-bill').addClass('d-none');
    $('#div-select-status-create-payment-bill').addClass('d-none');
    $('#right-create-payment-bill').removeClass('col-lg-4');
    $('#right-create-payment-bill').addClass('col-lg-12');
    $('#right-create-payment-bill .card-block').addClass('card');
    $('#value-create-payment-bill').prop('disabled', false);
    $('#div-input-target-create-payment-bill').addClass('d-none');
    $('#div-select-target-create-payment-bill').removeClass('d-none');
    $('#input-target-create-payment-bill').val('');
    $('#value-create-payment-bill').val(100);
    $('#original-price-create-payment-bill').text(0);
    $('#return-price-create-payment-bill').text(0);
    $('#debt-create-payment-bill').text(0);
    $('#title-right-create-payment-bill').addClass('d-none');
    $('#note-create-payment-bill').val('');
    $('#accounting-create-payment-bill').prop('checked', true);
    $('#modal-create-payment-bill textarea').val('');
    $("#loading-create-payment-bill").scrollTop(0);
    $('#modal-create-payment-bill').modal('hide');
    $('#size-modal-create-payment-bill .modal-body').removeClass('background-body-color');
    $('#date-create-payment-bill').val(moment().format('DD/MM/YYYY'));
    $('#div-total-amount-create-payment-bill-group-supplier').addClass('d-none');
    $('#total-debt-create-payment-bill').text(0)
    // tableSupplierOrderCreatePaymentBill.clear().draw(false)
    $('#total-amount-create-payment-bill-group-supplier').text(0)
    $('#modal-create-payment-bill .btn-renew').addClass('d-none');
    countCharacterTextarea()
}

function resetModalCreatePaymentBill() {
    $('#select-type-create-payment-bill').val($('#select-type-create-payment-bill').find('option:first-child').val()).trigger('change.select2');
    $('#select-target-create-payment-bill').val($('#select-target-create-payment-bill').find('option:first-child').val()).change();
    $('#select-value-create-payment-bill').val($('#select-value-create-payment-bill').find('option:first-child').val()).trigger('change.select2')
    $('#date-create-payment-bill').val(moment().format('DD/MM/YYYY'));
    $('#description-create-payment-bill').val('')
    $('.btn-renew').addClass('d-none')
    removeAllValidate()
    if($("#select-group-create-payment-bill").val() == 1){
        $('#select-group-create-payment-bill').val(1).trigger('change.select2');
        $('#select-status-create-payment-bill').val(0).trigger('change.select2');
        dataSupplierOrderCreatePaymentBill()
        // $('#select-target-create-payment-bill').val($('#select-target-create-payment-bill').find('option:first-child').val()).trigger('change.select2');
        $('#table-supplier-order-create-payment-bill_filter input').val('');
        $('#check-all-supplier-order-create-payment-bill').prop('checked', false);
        $('.checkbox-supplier-order-create-payment-bill').prop('checked', false);
        $('#value-create-payment-bill').val(100)
    }
    else{
        $('#select-group-create-payment-bill').val(-2).trigger('change.select2')
        $('#value-create-payment-bill').val(100)
        $('#select-target-create-payment-bill').html('<option value="-2" disabled selected hidden>Vui lòng chọn</option>');
        $('#div-select-target-create-payment-bill').removeClass('d-none')
        $('#div-input-target-create-payment-bill').addClass('d-none')
    }
}

