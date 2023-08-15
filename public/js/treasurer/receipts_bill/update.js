let idUpdate, saveUpdateReceiptsBill = 0, objectName, paymentMethodId,
    branchIdUpdateReceiptBillManage, maxDateUpdateReceiptBill,
    minDateUpdateReceiptBill, maxDateUpdateReceiptBillSalesSolution;


async function openModalUpdateReceiptsBill(id) {
    shortcut.add('ESC', function () {
        closeModalUpdateReceiptsBill();
    });
    idUpdate = id;
    shortcut.add('F4', function () {
        saveModalUpdateReceiptsBill();
    });
    if (closingDateOfThePreviousPeriod){
        minDateUpdateReceiptBill = moment(closingDateOfThePreviousPeriod, 'DD/MM/YYYY');
    }else{
        minDateUpdateReceiptBill = $('.date-update-receipts-bill').val(moment(new Date).format('DD/MM/YYYY'))
    }
    maxDateUpdateReceiptBill = $('.date-update-receipts-bill').val(moment(new Date).format('DD/MM/YYYY'));
    maxDateUpdateReceiptBillSalesSolution = $('.date-update-receipts-bill-sales-solution').val(moment(new Date).format('DD/MM/YYYY'));
    $('#modal-update-receipts-bill').modal('show');
    dateTimePickerTemplate($('.date-update-receipts-bill'),minDateUpdateReceiptBill, maxDateUpdateReceiptBill);
    dateTimePickerTemplate($('.date-update-receipts-bill-sales-solution'),'', maxDateUpdateReceiptBillSalesSolution);
    $('#modal-update-receipts-bill').on('shown.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalUpdateReceiptsBill();
        });
    });
    $('#select-type-update-receipts-bill').val(null).trigger('change.select2');
    $('#select-type-update-receipts-bill').select2({
        dropdownParent: $('#modal-update-receipts-bill')
    });
    dataUpdateReceiptsBill(id);
}

async function dataUpdateReceiptsBill(id) {
    let method = 'get',
        url = 'receipts-bill-treasurer.data-update',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-update-receipts-bill')]);
    objectName = res.data[0].object_name;
    paymentMethodId = res.data[0].payment_method_id;
    branchIdUpdateReceiptBillManage = res.data[0].branch.id;
    $('#code-update-receipts-bill').text(res.data[0].code);
    $('#branch-update-receipts-bill').text(res.data[0].branch.name);
    // $('#group-update-receipts-bill').text(res.data[0].object_type_text);
    $('#target-update-receipts-bill').text(res.data[0].object_name);
    $('#value-update-receipts-bill').val(res.data[0].amount);
    $('#value-type-update-receipts-bill').text(res.data[0].payment_method);
    $('#date-update-receipts-bill').val(moment(res.data[0].fee_month, 'DD/MM/YYYY').format('DD/MM/YYYY'));
    $('#description-update-receipts-bill').val(res.data[0].note);
    $('#accounting-update-receipts-bill').prop('checked', Boolean(res.data[0].is_count_to_revenue));
    // $('#select-type-update-receipts-bill').html(res.data[1])
    $('#select-type-update-receipts-bill').val(res.data[0].addition_fee_reason_id).trigger('change.select2')
    countCharacterTextarea()
    if(res.data[0].object_type === 4){
        $('#value-update-receipts-bill').prop('disabled', true);
    }
    if(res.data[0].object_type === 4 && res.data[0].is_addition_vat === 1){
        $('#group-update-receipts-bill').text('Thu VAT tay');
    }else{
        $('#group-update-receipts-bill').text(res.data[0].object_type_text);
    }
}

async function saveModalUpdateReceiptsBill() {
    if (saveUpdateReceiptsBill !== 0) return false;
    if (!checkValidateSave($('#modal-update-receipts-bill'))) return false;
    saveUpdateReceiptsBill = 1
    let method = 'post',
        url = 'receipts-bill-treasurer.update',
        params = null,
        data = {
            branch: branchIdUpdateReceiptBillManage,
            id: idUpdate,
            addition_fee_reason_id: $('#select-type-update-receipts-bill').val(),
            date: $('#date-update-receipts-bill').val(),
            note: $('#description-update-receipts-bill').val(),
            is_count_to_revenue: ($('#accounting-update-receipts-bill').prop('checked') == true) ? 1 : 0,
            object_name: objectName,
            amount: removeformatNumber($('#value-update-receipts-bill').val()),
            payment_method_id: paymentMethodId,
        };

    let res = await axiosTemplate(method, url, params, data, [$('#loading-update-receipts-bill')]);
    saveUpdateReceiptsBill = 0;
    let text = $('#success-update-data-to-server').text()
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalUpdateReceiptsBill();
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

function drawTableUpdateReceiptsBill(data) {
    let x = thisUpdatePaymentBill.parents('tr').data('dt-row');
    thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(4)').html(data.note);
    thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(5)').html(data.addition_fee_reason_name);
    thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(6)').text(data.date);
    thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(7)').text(formatNumber(data.amount));
    thisUpdatePaymentBill.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ') td:eq(8)').html(data.accounting);
}

function closeModalUpdateReceiptsBill() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-update-receipts-bill').modal('hide');
    resetModalUpdateReceiptsBill();
    countCharacterTextarea()
}
function resetModalUpdateReceiptsBill(){
    $('#code-update-receipts-bill').text('---');
    $('#branch-update-receipts-bill').text('---');
    $('#group-update-receipts-bill').text('---');
    $('#target-update-receipts-bill').text('---');
    $('#value-update-receipts-bill').val(0);
    $('#value-type-update-receipts-bill').text('---');
    $('#date-update-receipts-bill').val(moment().format('DD/MM/YYYY'));
    $('#description-update-receipts-bill').val('');
    $('#accounting-update-receipts-bill').prop('checked', false);
    $("#loading-update-receipts-bill").scrollTop(0);
    $('#value-update-receipts-bill').prop('disabled', false);
}
