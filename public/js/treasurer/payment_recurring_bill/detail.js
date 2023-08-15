function openModalDetailPaymentRecurringBill(r){
    $('#modal-detail-payment-recurring-bill').modal('show');
    dataDetailPaymentRecurringBill(r)
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalDetailPaymentRecurringBill();
    });
}

async function dataDetailPaymentRecurringBill(r){
    let method = 'get',
        url = 'payment-recurring-bill-treasurer.detail',
        params = {
            id: r.data('id'),
            branch: r.data('branch')
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-surcharge-data')]);
    $('#object-name-detail-payment-recurring-bill').text(res.data.data.object_name)
    $('#fee-reason-name-detail-payment-recurring-bill').text(formatNumber(res.data.data.addition_fee_reason_name))
    $('#amount-at-detail-payment-recurring-bill').text(formatNumber(res.data.data.amount))
    $('#type-detail-payment-recurring-bill').text(res.data.data.type)
    $('#start-from-detail-payment-recurring-bill').text(res.data.data.start_from)
    $('#note-detail-payment-recurring-bill').text(res.data.data.note === '' ? '---' : res.data.data.note )
    $('#revenue-detail-payment-recurring-bill').text(res.data.data.is_count_to_revenue)
    hideTextTooLong($('#note-detail-payment-recurring-bill'))
}

function closeModalDetailPaymentRecurringBill() {
    $('#modal-detail-payment-recurring-bill').modal('hide');
    resetModalDetailPaymentRecurringBill()
}

function resetModalDetailPaymentRecurringBill() {
    $('#object-name-detail-payment-recurring-bill').text('---')
    $('#fee-reason-name-detail-payment-recurring-bill').text('---')
    $('#amount-at-detail-payment-recurring-bill').text('---')
    $('#type-detail-payment-recurring-bill').text('---')
    $('#start-from-detail-payment-recurring-bill').text('---')
    $('#note-detail-payment-recurring-bill').text('---')
    $('#revenue-detail-payment-recurring-bill').text('---')
}
