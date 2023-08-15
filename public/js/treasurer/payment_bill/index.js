let loadingDataWaitingConfirmPayment = 1, loadingDataWaitingPayment = 0,
    loadingDataDonePayment = 0, loadingDataCancelPayment = 0,
    savePaymentPaymentBill = 0, saveCancelPaymentBill = 0, saveConfirmPaymentPaymentBill = 0,
    tabCurrentPayment = 1, typeTabWaitingConfirmPayment = 0, typeTabWaitingPayment = 1, typeTabDonePayment = 2, typeTabCancelPayment = 3,
    tableWaitingConfirmPayment = '', tableWaitingPayment = '',
    tableDonePayment = '', tableCancelPayment = '',
    limit = $('#data-table-length').val(),
    // object_type = $('.select-target-payment-bill').find(':selected').val(),
    reason_id = $('.select-reason-payment-bill').find(':selected').val(),
    isDebt = $('.select-debt-payment-bill').find(':selected').val(),
    accounting = $('.select-accounting-payment-bill').find(':selected').val(),
    branch_id = $('#select-branch-payment-bill-treasurer').val(),
    typeWaitingConfirmPayment = 7,
    typeWaitingPayment = 1,
    typeDonePaymentBill = "2,8", typeCancelPaymentBill = "3",
    fromPaymentBill = $('.from-date-payment-bill').val(), toPaymentBill = $('.to-date-payment-bill').val(),
    dataReasonPaymentBill = '', typeIdPaymentBill = -1,
    columnPayment = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', class: 'text-left'},
        {data: 'name', name: 'name', class: 'text-left'},
        {data: 'object_name', className: 'text-left'},
        {data: 'note', className: 'text-left'},
        {data: 'addition_fee_reason_name', className: 'text-left'},
        {data: 'fee_month', className: 'text-center'},
        {data: 'amount', className: 'text-right'},
        {data: 'action', className: 'text-center', width: '5%'},
    ],
    columnPaymented = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', class: 'text-left'},
        {data: 'name', name: 'name', class: 'text-left'},
        {data: 'object_name', className: 'text-left'},
        {data: 'note', className: 'text-left'},
        {data: 'addition_fee_reason_name', className: 'text-left'},
        {data: 'updated_at', className: 'text-center'},
        {data: 'amount', className: 'text-right'},
        {data: 'action', className: 'text-center', width: '5%'},
    ],
    fixedLeftTable = 2,
    fixedRightTable = 2,
    optionRenderTable = [
        {
            'title': 'Duyệt nhiều phiếu',
            'icon': 'fi-rr-check text-success',
            'class': '',
            'function': 'showCheckAllWaitingConfirmPaymentBill',
        },
        {
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreatePaymentBill',
        },
    ],
    optionRenderTableWaiting = [
        {
            'title': 'Duyệt nhiều phiếu',
            'icon': 'fi-rr-check text-success',
            'class': '',
            'function': 'showCheckAllWaitingPaymentBill',
        },
        {
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreatePaymentBill',
        }
    ],
    optionRenderTableNone = [
        {
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreatePaymentBill',
        }
    ];
$(function () {
    if(getCookieShared('payment-bill-treasurer-user-id-' + idSession)){
        let data = JSON.parse(getCookieShared('payment-bill-treasurer-user-id-' + idSession));
        fromPaymentBill = data.from;
        toPaymentBill = data.to;
        // object_type = data.object;
        reason_id = data.reason_id;
        isDebt = data.debt;
        accounting = data.accounting;
        tabCurrentPayment = data.tab;
        $('.from-date-payment-bill').val(fromPaymentBill)
        $('.to-date-payment-bill').val(toPaymentBill)
        // $('.select-target-payment-bill').val(object_type).trigger('change.select2')
        $('.select-debt-payment-bill').val(isDebt).trigger('change.select2')
        $('.select-accounting-payment-bill').val(accounting).trigger('change.select2')
    }
    dateTimePickerFromMaxToDate($('.from-date-payment-bill'),$('.to-date-payment-bill'));
    $('.from-date-payment-bill').on('dp.change', function () {
        $('.from-date-payment-bill').val($(this).val());
    });
    $('.to-date-payment-bill').on('dp.change', function () {
        $('.to-date-payment-bill').val($(this).val());
    });
    $('#tab-waiting-confirm-payment-payment-treasurer .select-reason-payment-bill').on('select2:select', function () {
        if($('#tab-waiting-confirm-payment-payment-treasurer .select-reason-payment-bill option:selected').data('system-auto-generate') === 0){
            reason_id = $(this).val();
            typeIdPaymentBill = -1
        }
        else {
            reason_id = -1;
            typeIdPaymentBill = $('#tab-waiting-confirm-payment-payment-treasurer .select-reason-payment-bill option:selected').data('reason-type-id')
        }
        validateDateTemplate($('.from-date-payment-bill'), $('.to-date-payment-bill'), loadingData);
    });
    $('#tab-waiting-payment-payment-treasurer .select-reason-payment-bill').on('select2:select', function () {
        console.log($('#tab-waiting-payment-payment-treasurer .select-reason-payment-bill option:selected').data('system-auto-generate'),666666666666)
        if($('#tab-waiting-payment-payment-treasurer .select-reason-payment-bill option:selected').data('system-auto-generate') === 0){
            reason_id = $(this).val();
            typeIdPaymentBill = -1
        }
        else {
            reason_id = -1;
            typeIdPaymentBill = $('#tab-waiting-payment-payment-treasurer .select-reason-payment-bill option:selected').data('reason-type-id')
        }
        validateDateTemplate($('.from-date-payment-bill'), $('.to-date-payment-bill'), loadingData);
    });
    $('#tab-done-payment-treasurer .select-reason-payment-bill').on('select2:select', function () {
        if($('#tab-done-payment-treasurer .select-reason-payment-bill option:selected').data('system-auto-generate') === 0){
            reason_id = $(this).val();
            typeIdPaymentBill = -1
        }
        else {
            reason_id = -1;
            typeIdPaymentBill = $('#tab-done-payment-treasurer .select-reason-payment-bill option:selected').data('reason-type-id')
        }
        validateDateTemplate($('.from-date-payment-bill'), $('.to-date-payment-bill'), loadingData);
    });
    $('#tab-cancel-payment-treasurer .select-reason-payment-bill').on('select2:select', function () {
        if($('#tab-cancel-payment-treasurer .select-reason-payment-bill option:selected').data('system-auto-generate') === 0){
            reason_id = $(this).val();
            typeIdPaymentBill = -1
        }
        else {
            reason_id = -1;
            typeIdPaymentBill = $('#tab-cancel-payment-treasurer .select-reason-payment-bill option:selected').data('reason-type-id')
        }
        validateDateTemplate($('.from-date-payment-bill'), $('.to-date-payment-bill'), loadingData);
    });

    $('.select-debt-payment-bill').on('select2:select', function () {
        $('.select-debt-payment-bill').val($(this).val()).trigger('change.select2');
        isDebt = $(this).val();
        validateDateTemplate($('.from-date-payment-bill'), $('.to-date-payment-bill'), loadingData);
    });
    $('.select-accounting-payment-bill').on('select2:select', function () {
        $('.select-accounting-payment-bill').val($(this).val()).trigger('change.select2');
        accounting = $(this).val();
        validateDateTemplate($('.from-date-payment-bill'), $('.to-date-payment-bill'), loadingData);
    });
    // $('.select-target-payment-bill').on('select2:select', function () {
    //     $('.select-target-payment-bill').val($(this).val()).trigger('change.select2');
    //     object_type = $(this).val();
    //     validateDateTemplate($('.from-date-payment-bill'), $('.to-date-payment-bill'), loadingData);
    // });
    $('.search-btn-payment-bill').on('click', function () {
        if(!checkDateTimePicker($(this))){
            return false
        }
        fromPaymentBill = $('.from-date-payment-bill').val();
        toPaymentBill = $('.to-date-payment-bill').val();
        validateDateTemplate($('.from-date-payment-bill'), $('.to-date-payment-bill'), loadingData);
        dateTimePickerFromMaxToDate($('.from-date-payment-bill'),$('.to-date-payment-bill'));
    });

    $('#checkbox-all-confirm-waiting-payment').change(function () {
        let count=0
        if ($(this).is(':checked')) {
            tableWaitingConfirmPayment.rows().every(function (index, element) {
                let x = $(this.node());
                x.find('td:eq(8)').find('input').prop('checked', true)
                count++
            })
            $('#total-count-confirm-waiting-payment').text(count+'/'+count)
        } else {
            tableWaitingConfirmPayment.rows().every(function (index, element) {
                let x = $(this.node());
                x.find('td:eq(8)').find('input').prop('checked', false)
                count++
            })
            $('#total-count-confirm-waiting-payment').text('0/'+count)
        }
    })

    $('#checkbox-all-waiting-payment').change(function () {
        let count=0
        if ($(this).is(':checked')) {
            tableWaitingPayment.rows().every(function (index, element) {
                let x = $(this.node());
                x.find('td:eq(8)').find('input').prop('checked', true)
                count++
            })
            $('#total-count-waiting-payment').text(count+'/'+count)
        } else {
            tableWaitingPayment.rows().every(function (index, element) {
                let x = $(this.node());
                x.find('td:eq(8)').find('input').prop('checked', false)
                count++
            })
            $('#total-count-waiting-payment').text('0/'+count)
        }
    })

    getPaymentBillReasonDataIndex();
    $('#nav-tab-payment-bill a[data-id="' +tabCurrentPayment+ '"]').click();
    $('#nav-tab-payment-bill a span').on('click', function() {
        $('.checkbox-fade').addClass('d-none');
    });
});

async function getPaymentBillReasonDataIndex() {
    if (dataReasonPaymentBill !== '') {
        await $('.select-reason-payment-bill').html(dataReasonPaymentBill);
    } else {
        let method = 'get',
            url = 'payment-bill-treasurer.reason',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        await $('.select-reason-payment-bill').html(res.data[0]);
        $('.select-reason-payment-bill').val(reason_id).trigger('change.select2')
        $('#select-type-update-payment-bill').html(res.data[1]);
        $('#select-type-create-payment-bill').html(res.data[1]);
        dataReasonPaymentBill = res.data[0];
    }
}

async function loadData() {
    branch_id = $('#select-branch-payment-bill-treasurer').val();
    validateDateTemplate($('.from-date-payment-bill'), $('.to-date-payment-bill'), loadingData);
}

async function loadingData() {
    $('.btn-confirm-check, .btn-cancel-check, .check-all-bill-payment').addClass('d-none')
    updateCookie();
    switch (tabCurrentPayment) {
        case 1:
            loadingDataWaitingConfirmPayment = 1;
            loadingDataWaitingPayment = 0;
            loadingDataDonePayment = 0;
            loadingDataDonePayment = 0;
            loadingDataCancelPayment = 0;
            await tableWaitingConfirmPayment.ajax.url("payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabWaitingConfirmPayment  + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeWaitingConfirmPayment + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0).load();
            hideButtonCheckAll()
            break;
        case 3:
            loadingDataWaitingConfirmPayment = 0;
            loadingDataWaitingPayment = 1;
            loadingDataDonePayment = 0;
            loadingDataDonePayment = 0;
            loadingDataCancelPayment = 0;
            await tableWaitingPayment.ajax.url("payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabWaitingPayment + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeWaitingPayment + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0).load();
            hideButtonCheckAll()
            break;
        case 4:
            loadingDataWaitingConfirmPayment = 0;
            loadingDataWaitingPayment = 0;
            loadingDataDonePayment = 1;
            loadingDataDonePayment = 0;
            loadingDataCancelPayment = 0;
            await tableDonePayment.ajax.url("payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabDonePayment  + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeDonePaymentBill + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0).load();
            break;
        case 5:
            loadingDataWaitingConfirmPayment = 0;
            loadingDataWaitingPayment = 0;
            loadingDataDonePayment = 0;
            loadingDataDonePayment = 0;
            loadingDataCancelPayment = 1;
            await tableCancelPayment.ajax.url("payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabCancelPayment  + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeCancelPaymentBill + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0).load();
            break;
    }
}

async function changeTabPaymentBill(tab) {
    hideCheckAllWaitingConfirmPaymentBill()
    hideCheckAllWaitingPaymentBill()
    $('#nav-tab-payment-bill .nav-link').removeClass('active')
    $('.btn-confirm-check, .btn-cancel-check, .check-all-bill-payment').addClass('d-none')
    $('.btn-show-check').addClass('d-none');
    tabCurrentPayment = tab;
    updateCookie();
    switch (tab) {
        case 1:
            if (tableWaitingConfirmPayment === '') {
                loadDataWaitingConfirmPayment();
                loadingDataWaitingConfirmPayment = 1;
            } else if (loadingDataWaitingConfirmPayment === 0) {
                await tableWaitingConfirmPayment.ajax.url("payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabWaitingConfirmPayment  + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeWaitingConfirmPayment + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0).load();
            }
            break;
        case 3:
            if (tableWaitingPayment === '') {
                loadDataWaitingPayment();
                loadingDataWaitingPayment = 1;
            } else if (loadingDataWaitingPayment === 0) {
                await tableWaitingPayment.ajax.url("payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabWaitingPayment  + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeWaitingPayment + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0).load();
            }
            break;
        case 4:
            if (tableDonePayment === '') {
                loadDataDone();
                loadingDataDonePayment = 1;
            } else if (loadingDataDonePayment === 0) {
                await tableDonePayment.ajax.url("payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabDonePayment  + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeDonePaymentBill + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0).load();
            }
            break;
        case 5:
            if (tableCancelPayment === '') {
                loadDataCancel();
                loadingDataCancelPayment = 1;
            } else if (loadingDataCancelPayment === 0) {
                await tableCancelPayment.ajax.url("payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabCancelPayment  + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeCancelPaymentBill + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0).load();
            }
            break;
    }
}

async function loadDataWaitingConfirmPayment() {
    loadingDataWaitingConfirmPayment = 1;
    let id = $("#table-waiting-confirm-payment-payment-treasurer"),
        url = "payment-bill-treasurer.data?from=" + fromPaymentBill  + "&to=" + toPaymentBill + "&type_tab=" + typeTabWaitingConfirmPayment   + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeWaitingConfirmPayment + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0;
    tableWaitingConfirmPayment = await DatatableServerSideTemplateNew(id, url, columnPayment, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

async function loadDataWaitingPayment() {
    loadingDataWaitingPayment = 1;
    let id = $("#table-waiting-payment-payment-treasurer"),
        url = "payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabWaitingPayment  + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeWaitingPayment + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0;
    tableWaitingPayment = await DatatableServerSideTemplateNew(id, url, columnPayment, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTableWaiting, callbackLoadData);
}

async function loadDataDone() {
    loadingDataDonePayment = 1;
    let id = $("#table-done-payment-treasurer"),
        url = "payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabDonePayment  + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeDonePaymentBill + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0;
    tableDonePayment = await DatatableServerSideTemplateNew(id, url, columnPaymented, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTableNone, callbackLoadData);
}

async function loadDataCancel() {
    loadingDataCancelPayment = 1;
    let id = $("#table-cancel-payment-treasurer"),
        url = "payment-bill-treasurer.data?from=" + fromPaymentBill + "&to=" + toPaymentBill + "&type_tab=" + typeTabCancelPayment  + "&reason_id=" + reason_id + "&addition_fee_reason_type_id=" + typeIdPaymentBill + "&branch_id=" + branch_id + "&type=" + typeCancelPaymentBill + "&limit=" + limit + "&accounting=" + accounting + '&is_paid_debt=' + isDebt + "&is_take_auto_generated=" + 0;
    tableCancelPayment = await DatatableServerSideTemplateNew(id, url, columnPaymented, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTableNone, callbackLoadData);
}

function callbackLoadData(response) {
    console.log(response);
    $('.total-payment-bill').text(response.total_amount);
    $('#total-record-tab-waiting-confirm-payment-payment-treasurer').text(response.config?.[1].data.waitting_approve_payment);
    $('#total-record-tab-waiting-payment-payment-treasurer').text(response.config?.[1].data.waitting_payment);
    $('#total-record-tab-done-payment-treasurer').text(response.config?.[1].data.addition_fee_completed);
    $('#total-record-tab-cancel-payment-treasurer').text(response.config?.[1].data.addition_fee_cancel);
    switch (tabCurrentPayment) {
        case 1:
            let lengthTableWaitingConfirm = tableWaitingConfirmPayment.page.info().length;
            if (response.recordsTotal > lengthTableWaitingConfirm)
                $('#total-count-confirm-waiting-payment').text('0/'+lengthTableWaitingConfirm);
            else
                $('#total-count-confirm-waiting-payment').text('0/'+response.recordsTotal);
            break;
        case 3:
            let lengthTableWaiting = tableWaitingPayment.page.info().length;
            if (response.recordsTotal > lengthTableWaiting)
                $('#total-count-waiting-payment').text('0/'+lengthTableWaiting);
            else
                $('#total-count-waiting-payment').text('0/'+response.recordsTotal);
            break;
    }
    hideButtonCheckAll();
    $('.btn-confirm-check, .btn-cancel-check, .check-all-bill-payment').addClass('d-none')
}

function hideButtonCheckAll() {
    if (tabCurrentPayment === 1) {
        if (tableWaitingConfirmPayment.rows().count() >= 2) {
            $('.btn-show-check').removeClass('d-none');
        } else {
            $('.btn-show-check').addClass('d-none');
        }
    } else if (tabCurrentPayment === 3) {
        if (tableWaitingPayment.rows().count() >= 2) {
            $('.btn-show-check').removeClass('d-none');
        } else {
            $('.btn-show-check').addClass('d-none');
        }
    }
    $('.check-all-bill-payment input[type="checkbox"]').prop('checked', false);
    $('.check-confirm-payment-bill input[type="checkbox"]').prop('checked', false);
}

function updateCookie(){
    saveCookieShared('payment-bill-treasurer-user-id-' + idSession, JSON.stringify({
        'tab' : tabCurrentPayment,
        'reason_id' : reason_id,
        'from' : fromPaymentBill,
        'to' : toPaymentBill,
        'debt' : isDebt,
        // 'object' : object_type,
        'accounting' : accounting,
    }))
}

function cancelPaymentBill(r) {
    if(saveCancelPaymentBill === 1) return false;
    let title = 'Hủy phiếu chi ?',
        content = 'Đồng ý hủy sẽ không thể hoàn tác lại phiếu chi!',
        icon = 'question';
    sweetAlertInputComponent(title,'id-cancel-update-salary-employee-bonus', content, icon).then(async (result) => {
        if (result.isConfirmed) {
            saveCancelPaymentBill = 1
            let method = 'post',
                url = 'payment-bill-treasurer.cancel',
                reason = result.value,
                params = null,
                data = {
                    branch: r.data('branch'),
                    id: r.data('id'),
                    reason: reason
                };
            let res = await axiosTemplate(method, url, params, data, [$('#table-waiting-confirm-payment-payment-treasurer'), $('#table-cancel-payment-treasurer')]);
            saveCancelPaymentBill = 0
            let text = $('#success-cancel-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    closeModalUpdatePaymentBill();
                    loadingData();
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
                    if (res.data.message !== null)
                        text = res.data.message;
                    WarningNotify(text);
            }
        }
    })
}
