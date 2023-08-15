let saveUpdatePaymentBill = 0,
    objectTypeId,
    objectName,
    thisUpdatePaymentBill,
    tableSupplierOrderUpdatePaymentBill = null,
    idUpdatePaymentBill, branchUpdatePaymentBill,
    maxDateUpdatePaymentBill, maxDateUpdatePaymentBillSales, minDateUpdatePaymentBill;


function openModalUpdatePaymentBill(r) {
    thisUpdatePaymentBill = r;
    $('#modal-update-payment-bill').modal('show');
    $('#branch-update-payment-bill').text('---');
    $('#code-update-payment-bill').text('---');
    $('#group-update-payment-bill').text('---');
    $('#target-update-payment-bill').text('---');
    $('#select-type-update-payment-bill').val(null).trigger('change.select2');
    $('#select-value-update-payment-bill').val(1).trigger('change.select2');
    $('#date-update-payment-bill').val(moment(new Date).format('DD/MM/YYYY'));
    $('#description-update-payment-bill').val("");

    if (closingDateOfThePreviousPeriod){
        minDateUpdatePaymentBill = moment(closingDateOfThePreviousPeriod, 'DD/MM/YYYY')
    }else{
        minDateUpdatePaymentBill = $('.date-update-payment-bill').val(moment(new Date).format('DD/MM/YYYY'))
    }
    maxDateUpdatePaymentBill = $('.date-update-payment-bill').val(moment(new Date).format('DD/MM/YYYY'))
    maxDateUpdatePaymentBillSales = $('.date-update-payment-bill-sales-solution').val(moment(new Date).format('DD/MM/YYYY'))
    dateTimePickerTemplate($('.date-update-payment-bill'), minDateUpdatePaymentBill, maxDateUpdatePaymentBill);
    dateTimePickerTemplate($('.date-update-payment-bill-sales-solution'), '', maxDateUpdatePaymentBillSales);
    $('#select-type-update-payment-bill,#select-value-update-payment-bill').select2({
        dropdownParent: $('#modal-update-payment-bill')
    });
    idUpdatePaymentBill = r.data('id');
    branchUpdatePaymentBill = r.data('branch');
    $('#size-modal-update-payment-bill').removeClass('modal-xl');
    $('#size-modal-update-payment-bill').addClass('modal-md');
    $('#left-update-payment-bill').removeClass('col-lg-8');
    $('#left-update-payment-bill').addClass('d-none');
    $('#right-update-payment-bill').removeClass('col-lg-4');
    $('#right-update-payment-bill').addClass('col-lg-12');
    $('#value-update-payment-bill').prop('disabled', false);
    dataUpdatePaymentBill(r.data('id'), r.data('branch'), r.data('fee'));
    $(document).on('click', '#table-inventory-update-payment-bill input[type="checkbox"]', async function () {
        let total = 0;
        await tableSupplierOrderUpdatePaymentBill.rows().every(function (index, element) {
            let x = $(this.node());
            let checked = x.find('td:eq(0)').find('input[type="checkbox"]:checked').val();
            if (checked === 'on') {
                total += removeformatNumber(x.find('td:eq(5)').text());
            }
        });
        $('#value-update-payment-bill').val(formatNumber(total));
    });
    $(document).on('click','#btn-cancel-update-payment-bill', function (){
        cancelPaymentBill(r);
        closeModalUpdatePaymentBill();
    })

    shortcut.add('ESC', function () {
        closeModalUpdatePaymentBill();
    });
    shortcut.add('F4', function () {
        saveModalUpdatePaymentBill();
    });
}

async function dataUpdatePaymentBill(id, branch, fee) {
    let method = 'get',
        url = 'payment-bill-treasurer.data-update',
        params = {id: id, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-update-payment-bill')]);
    objectTypeId = await res.data[0].object_type;
    objectName = await res.data[0].object_name;
    $('#branch-update-payment-bill').text(res.data[0].branch.name);
    $('#code-update-payment-bill').text(res.data[0].code);
    $('#group-update-payment-bill').text(res.data[0].object_type_text);
    $('#target-update-payment-bill').text(res.data[0].object_name);
    $('#status-update-payment-bill').text(res.data[0].is_paid_debt_text);
    $('#value-update-payment-bill').val(formatNumber(res.data[0].amount));
    $('#select-value-update-payment-bill').val(res.data[0].payment_method_id).trigger('change.select2');
    if (res.data[0].is_count_to_revenue === 1) {
        $('#accounting-update-payment-bill').prop('checked', true);
    } else {
        $('#accounting-update-payment-bill').prop('checked', false);
    }
    $('#date-update-payment-bill').val(moment(res.data[0].fee_month, 'DD/MM/YYYY').format('DD/MM/YYYY'));
    $('#description-update-payment-bill').val(res.data[0].note);
    countCharacterTextarea()
    $('#select-type-update-payment-bill').val(res.data[0].addition_fee_reason_id).trigger('change.select2');
    // dataReasonUpdatePaymentBill(fee);
    if (res.data[0].object_type === 1) {
        $('#size-modal-update-payment-bill').removeClass('modal-md');
        $('#size-modal-update-payment-bill').addClass('modal-xl');
        $('#left-update-payment-bill').removeClass('d-none');
        $('#div-status-update-payment-bill').removeClass('d-none');
        $('#left-update-payment-bill').addClass('col-lg-8');
        $('#right-update-payment-bill').removeClass('col-lg-12');
        $('#right-update-payment-bill').addClass('col-lg-4');
        $('#value-update-payment-bill').prop('disabled', true);
        $('#date-update-payment-bill').prop('disabled', true);
        $('#total-debt-update-payment-bill').text(res.data[3].total_restaurant_debt_amount);
        drawTableSupplierOrderUpdatePaymentBill(res.data[1].original.data);
    } else {
        $('#size-modal-update-payment-bill').addClass('modal-md');
        $('#size-modal-update-payment-bill').removeClass('modal-xl');
        $('#left-update-payment-bill').addClass('d-none');
        $('#div-status-update-payment-bill').addClass('d-none');
        $('#left-update-payment-bill').removeClass('col-lg-8');
        $('#right-update-payment-bill').addClass('col-lg-12');
        $('#right-update-payment-bill').removeClass('col-lg-4');
        $('#value-update-payment-bill').prop('disabled', false);
        $('#date-update-payment-bill').prop('disabled', false);
    }
    if (res.data[0].status === 7) {
        $('#cancel-payment-bill-btn').removeClass('d-none');
    } else {
        $('#cancel-payment-bill-btn').addClass('d-none');
    }

}

// async function dataReasonUpdatePaymentBill(fee) {
//     let feeId = fee;
//     if (dataReasonUpdatePaymentBillTreasurer === '') {
//         $('#select-type-update-payment-bill').html('<option value="" disabled selected>Hạng mục chi</option>')
//     } else {
//         let method = 'get',
//             url = 'payment-bill-treasurer.reason',
//             params = null,
//             data = null;
//         let res = await axiosTemplate(method, url, params, data);
//         dataReasonUpdatePaymentBillTreasurer = res.data[0];
//         $('#select-type-update-payment-bill').html(res.data[1]);
//         let data_fee = res.data[2].data.map((data) => {
//             if (feeId === data.id) {
//                 $('#select-type-update-payment-bill').val(feeId).trigger('change.select2');
//             }
//         })
//     }
// }

async function drawTableSupplierOrderUpdatePaymentBill(data) {
    let id = $('#table-supplier-order-update-payment-bill'),
        scroll_Y = '40vh',
        fixedLeft = 0,
        fixedRight = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'checkbox', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'supplier_name', name: 'supplier_name', className: 'text-center'},
            {data: 'employee_complete', name: 'employee_complete'},
            {data: 'restaurant_debt_amount', name: 'restaurant_debt_amount', className: 'text-center'},
            {data: 'received_at', name: 'received_at', className: 'text-center'},
            {data: 'retention_money', name: 'retention_money', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ],option = [];
    tableSupplierOrderUpdatePaymentBill = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight,option);

    $(document).on('input paste','#table-supplier-order-update-payment-bill_filter', function (){
        let totalAmount = 0

        tableSupplierOrderUpdatePaymentBill.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            totalAmount += removeformatNumber(row.find('td:eq(5)').text())
            $('#total-debt-update-payment-bill').text(formatNumber(totalAmount))
        })
    })
}

async function checkItemSupplierOrderUpdatePaymentBill() {
    let total = 0, original = 0, returnAmount = 0;
    await tableSupplierOrderUpdatePaymentBill.rows().every(function (index, element) {
        let x = $(this.node());
        if (x.find('td:eq(1)').find('input[type="checkbox"]').is(':checked')) {
            original += removeformatNumber(x.find('td:eq(5)').text());
            returnAmount += removeformatNumber(x.find('td:eq(6)').text());
            total += removeformatNumber(x.find('td:eq(7)').text());
        }
    });
    $('#original-price-update-payment-bill').text(formatNumber(original));
    $('#return-price-update-payment-bill').text(formatNumber(returnAmount));
    $('#value-update-payment-bill').val(formatNumber(total));
}

async function checkAllItemSupplierOrderUpdatePaymentBill(r) {
    if (r.is(':checked')) {
        let total = 0;
        await tableSupplierOrderUpdatePaymentBill.rows().every(function (index, element) {
            let x = $(this.node());
            x.find('td:eq(1)').find('input[type="checkbox"]').prop('checked', true);
            total += removeformatNumber(x.find('td:eq(5)').text());
        });
        $('#debt-create-payment-bill').text(formatNumber(total));
    } else {
        await tableSupplierOrderUpdatePaymentBill.rows().every(function (index, element) {
            let x = $(this.node());
            x.find('td:eq(1)').find('input[type="checkbox"]').prop('checked', false);
        });
        $('#original-price-create-payment-bill').text(0);
        $('#return-price-create-payment-bill').text(0);
        $('#debt-create-payment-bill').text(0);
    }
}

async function saveModalUpdatePaymentBill() {
    let accounting = 0, supplier_order_ids = [];
    if ($('#accounting-update-payment-bill').is(':checked') === true) accounting = 1;
    if (objectTypeId === 1) {
        tableSupplierOrderUpdatePaymentBill.rows().every(function (index, element) {
            let x = $(this.node());
            let checked = x.find('td:eq(1)').find('input[type="checkbox"]:checked').is(':checked');
            if (checked) {
                supplier_order_ids.push(x.find('td:eq(1)').find('input[type="checkbox"]:checked').val());
            }
        });
    }
    if ($('#value-update-payment-bill').is(':disabled')) {
        if (Number(supplier_order_ids.length) === 0) {
            ErrorNotify('Danh sách đơn hàng không được rỗng!');
            return false;
        }
    }
    if (saveUpdatePaymentBill !== 0) return false;
    if (!checkValidateSave($('#modal-update-payment-bill'))) return false;
    let type = $('#select-type-update-payment-bill').val(),
        value = removeformatNumber($('#value-update-payment-bill').val()),
        value_type = $('#select-value-update-payment-bill').val(),
        date = $('#date-update-payment-bill').val(),
        description = $('#description-update-payment-bill').val();
    saveUpdatePaymentBill = 1;
    let method = 'post',
        url = 'payment-bill-treasurer.update',
        params = null,
        data = {
            id: idUpdatePaymentBill,
            branch: branchUpdatePaymentBill,
            addition_fee_reason_id: type,
            amount: value,
            date: date,
            is_count_to_revenue: accounting,
            note: description,
            payment_method_id: value_type,
            supplier_order_ids: supplier_order_ids,
            object_name: objectName
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-update-payment-bill')]);
    saveUpdatePaymentBill = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalUpdatePaymentBill();
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

function drawTableUpdatePaymentBill(data) {
    let x = thisUpdatePaymentBill.parents('tr').data('dt-row');
    thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(4)').html(data.note);
    thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(5)').html(data.addition_fee_reason_name);
    thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(6)').text(data.fee_month);
    thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(7)').text(formatNumber(data.amount));
    if (data.is_count_to_revenue === 1) {
        thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(8)').html('<div class="btn-group btn-group-sm"><i class="text-success fa fa-dot-circle-o"></i></div>');
    } else {
        thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(8)').html('<div class="btn-group btn-group-sm"><i class="text-warning fa fa-circle-o"></i></div>');
    }
    thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.DTFC_RightWrapper .DTFC_RightBodyWrapper .DTFC_RightBodyLiner DTFC_Cloned tbody tr:eq(' + x + ') ').find('.btn.btn-warning.waves-effect.waves-light').remove();
}

function closeModalUpdatePaymentBill() {
    $('#modal-update-payment-bill').modal('hide');
    resetModalUpdatePaymentBill();
    countCharacterTextarea()
}
function resetModalUpdatePaymentBill(){
    $('#cancel-payment-bill-btn').addClass('d-none');
    $('#div-status-update-payment-bill').addClass('d-none');
    $('#date-update-payment-bill').prop('disabled', false);
    $("#loading-update-payment-bill").scrollTop(0);
    $('#status-update-payment-bill').text('');
    $('#value-update-payment-bill').val(100);
    $('#select-value-update-payment-bill').val(1).trigger('change.select2');
    // $('#select-type-update-payment-bill').html('<option value="" disabled selected>Hạng mục chi</option>')

    $('#accounting-update-payment-bill').prop('checked', true);
}


