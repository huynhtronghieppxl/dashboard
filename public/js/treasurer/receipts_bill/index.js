let loadingTabDoneReceiptsBill = 0, loadingTabCancelReceiptsBill = 0, tabCurrentReceiptsBill = 0, tableReceiptsBillDone = '',
    checkCancelReceiptsBill = 0,
    tableReceiptsBillCancel = '', typeTabDoneReceiptsBill = 0, typeTabCancelReceiptsBill = 1;
let objectTypeReceiptsBill = $('.select-target-receipts-bill').find(':selected').val(),
    reasonIdReceiptsBill = $('.select-reason-receipts-bill').find(':selected').val(),
    accountingReceiptsBill = $('.select-accounting-receipts-bill').find(':selected').val(),
    branchIdReceiptsBill = $('#select-branch-receipts-bill-treasurer').val(),
    fromDateReceiptsBill = $('.from-date-receipts-bill').val(),
    toDateReceiptsBill = $('.to-date-receipts-bill').val(),
    dataReasonReceiptBill = '', typeId = -1,
    columnTable = [
        {data: 'index', class: 'text-center', width: '5%'},
        {data: 'code', class: 'text-left'},
        {data: 'employee.name'},
        {data: 'object_name', className: 'text-left'},
        {data: 'note', className: 'text-left'},
        {data: 'addition_fee_reason_name', className: 'text-left'},
        {data: 'order', className: 'text-left'},
        {data: 'fee_month', className: 'text-left'},
        {data: 'amount', className: 'text-right'},
        {data: 'action', className: 'text-center'},
    ];

$(function () {
    // if(getCookieShared('receipts-bill-treasurer-user-id-' + idSession)){
    //     let data = JSON.parse(getCookieShared('receipts-bill-treasurer-user-id-' + idSession));
    //     fromDateReceiptsBill = data.from;
    //     toDateReceiptsBill = data.to;
    //     objectTypeReceiptsBill = data.object;
    //     reasonIdReceiptsBill = data.reason_id;
    //     accountingReceiptsBill = data.accounting;
    //     tabCurrentReceiptsBill = data.tab;
    //     $('.from-date-receipts-bill').val(fromDateReceiptsBill)
    //     $('.to-date-receipts-bill').val(toDateReceiptsBill)
    //     $('.select-target-receipts-bill').val(objectTypeReceiptsBill).trigger('change.select2')
    //     $('.select-accounting-payment-bill').val(accountingReceiptsBill).trigger('change.select2')
    // }
    dateTimePickerFromMaxToDate($('.from-date-receipts-bill'), $('.to-date-receipts-bill'));
    $('.select-reason-receipts-bill').on('select2:select', function () {
        if($('.select-reason-receipts-bill option:selected').data('auto-generate') === 0){
            reasonIdReceiptsBill = $(this).val();
            typeId = -1
        }
        else {
            reasonIdReceiptsBill = -1;
            typeId = $('.select-reason-receipts-bill option:selected').data('type-id')
        }
        validateDateTemplate($('.from-date-receipts-bill'), $('.to-date-receipts-bill'), loadingData);
    });
    $('.select-accounting-receipts-bill').on('select2:select', function () {
        accountingReceiptsBill = $(this).val();
        $('.select-accounting-receipts-bill').val($(this).val()).trigger('change.select2')
        validateDateTemplate($('.from-date-receipts-bill'), $('.to-date-receipts-bill'), loadingData);
    });
    $('.select-target-receipts-bill').on('select2:select', function () {
        objectTypeReceiptsBill = $(this).val();
        validateDateTemplate($('.from-date-receipts-bill'), $('.to-date-receipts-bill'), loadingData);
    });
    $('.from-date-receipts-bill').on('dp.change', function () {
        $('.from-date-receipts-bill').val($(this).val())
    })
    $('.to-date-receipts-bill').on('dp.change', function () {
        $('.to-date-receipts-bill').val($(this).val())
    })
    $('.search-btn-receipts-bill').on('click', function (e) {
        if(!checkDateTimePicker($(this))){
            // $('.from-date-receipts-bill').val(fromDateReceiptsBill).trigger('dp.change');
            // $('.to-date-receipts-bill').val(toDateReceiptsBill).trigger('dp.change');
            return false;
        }
        fromDateReceiptsBill = $('.from-date-receipts-bill').val()
        toDateReceiptsBill = $('.to-date-receipts-bill').val()
        loadingData();
        // updateCookieReceipts();
    });
    getReceiptsBillReasonDataIndex();
    $('#nav-tab-receipts-bill a[data-id="' + tabCurrentReceiptsBill + '"]').click()
});

function updateCookieReceipts(){
    saveCookieShared('receipts-bill-treasurer-user-id-' + idSession, JSON.stringify({
        'tab' : tabCurrentReceiptsBill,
        'reason_id' : reasonIdReceiptsBill,
        'from' : fromDateReceiptsBill,
        'to' : toDateReceiptsBill,
        'object' : objectTypeReceiptsBill,
        'accounting' : accountingReceiptsBill,
    }))
}

async function loadData() {
    branchIdReceiptsBill = $('#select-branch-receipts-bill-treasurer').val();
    validateDateTemplate($('.from-date-receipts-bill'), $('.to-date-receipts-bill'), loadingData);
}

async function getReceiptsBillReasonDataIndex() {
    if (dataReasonReceiptBill !== '') {
        $('.select-reason-receipts-bill').html(dataReasonReceiptBill);
    } else {
        branchIdReceiptsBill = $('#select-branch-receipts-bill-treasurer').val();
        let method = 'get',
            url = 'receipts-bill-treasurer.reason',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        $('.select-reason-receipts-bill').html(res.data[3]);
        checkHasInSelect(reasonIdReceiptsBill, $('.select-reason-receipts-bill'));
        reasonIdReceiptsBill = $('.select-reason-receipts-bill').val();
        dataReasonReceiptBill = res.data[0];
        $('#select-type-update-receipts-bill').html(res.data[0]);
    }
}

async function loadingData() {
    // updateCookieReceipts()
    if (tabCurrentReceiptsBill === 0) {
        loadingTabDoneReceiptsBill = 1;
        loadingTabCancelReceiptsBill = 0;
        tableReceiptsBillDone.ajax.url("receipts-bill-treasurer.data?from=" + $('.from-date-receipts-bill').val() + "&to=" + $('.to-date-receipts-bill').val() + "&object_type=" + objectTypeReceiptsBill + "&reason_id=" + reasonIdReceiptsBill + "&addition_fee_reason_type_id=" + typeId + "&branch_id=" + branchIdReceiptsBill + "&accounting=" + accountingReceiptsBill + "&status=2" + "&type_tab=" + typeTabDoneReceiptsBill).load();
    } else {
        loadingTabDoneReceiptsBill = 0;
        loadingTabCancelReceiptsBill = 1;
        tableReceiptsBillCancel.ajax.url("receipts-bill-treasurer.data?from=" + $('.from-date-receipts-bill').val() + "&to=" + $('.to-date-receipts-bill').val() + "&object_type=" + objectTypeReceiptsBill + "&reason_id=" + reasonIdReceiptsBill + "&addition_fee_reason_type_id=" + typeId + "&branch_id=" + branchIdReceiptsBill + "&accounting=" + accountingReceiptsBill + "&status=3" + "&type_tab=" + typeTabCancelReceiptsBill).load();
    }
}

async function changeTabReceiptsBill(tab) {
    tabCurrentReceiptsBill = tab;
    // updateCookieReceipts()
    if (tab === 0) {
        if (tableReceiptsBillDone === '') {
            let element = $('#table-receipts-bill1'),
                url = "receipts-bill-treasurer.data?from=" + fromDateReceiptsBill + "&to=" + toDateReceiptsBill + "&object_type=" + objectTypeReceiptsBill + "&reason_id=" + reasonIdReceiptsBill + "&addition_fee_reason_type_id=" + typeId + "&branch_id=" + branchIdReceiptsBill + "&accounting=" + accountingReceiptsBill + "&status=2" + "&type_tab=" + typeTabDoneReceiptsBill;
            tableReceiptsBillDone = await loadDataReceiptsBillView(element, url);
            loadingTabDoneReceiptsBill = 1;
        } else {
            tableReceiptsBillDone.ajax.url("receipts-bill-treasurer.data?from=" + fromDateReceiptsBill + "&to=" + toDateReceiptsBill + "&object_type=" + objectTypeReceiptsBill + "&reason_id=" + reasonIdReceiptsBill + "&addition_fee_reason_type_id=" + typeId + "&branch_id=" + branchIdReceiptsBill + "&accounting=" + accountingReceiptsBill + "&status=2" + "&type_tab=" + typeTabDoneReceiptsBill).load();
        }
    } else {
        if (tableReceiptsBillCancel === '') {
            let element = $('#table-receipts-bill3'),
                url = "receipts-bill-treasurer.data?from=" + fromDateReceiptsBill + "&to=" + toDateReceiptsBill + "&object_type=" + objectTypeReceiptsBill + "&reason_id=" + reasonIdReceiptsBill + "&addition_fee_reason_type_id=" + typeId + "&branch_id=" + branchIdReceiptsBill + "&accounting=" + accountingReceiptsBill + "&status=3" + "&type_tab=" + typeTabCancelReceiptsBill;
            tableReceiptsBillCancel = await loadDataReceiptsBillView(element, url);
            loadingTabCancelReceiptsBill = 1;
        } else {
            tableReceiptsBillCancel.ajax.url("receipts-bill-treasurer.data?from=" + fromDateReceiptsBill + "&to=" + toDateReceiptsBill + "&object_type=" + objectTypeReceiptsBill + "&reason_id=" + reasonIdReceiptsBill + "&addition_fee_reason_type_id=" + typeId + "&branch_id=" + branchIdReceiptsBill + "&accounting=" + accountingReceiptsBill + "&status=3" + "&type_tab=" + typeTabCancelReceiptsBill).load();
        }
    }
}

async function loadDataReceiptsBillView(element, url) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [
            {
                'title': 'Thêm mới',
                'icon': 'fa fa-plus text-primary seemt-hover-blue',
                'class': '',
                'function': 'openModalCreateReceiptsBill',
            }
        ]
    return DatatableServerSideTemplateNew(element, url, columnTable, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function callbackLoadData(response) {
    console.log(response)
    $('#total-record-tab1-receipts-bill').text(response.config[1].data.addition_fee_in);
    $('#total-record-tab3-receipts-bill').text(response.config[1].data.addition_fee_in_cancel);
    $('#total-tab1-receipts-bill').text(response.total_amount);
    $('#total-tab3-receipts-bill').text(response.total_amount);
}

function cancelReceiptsBill(id, branch) {
    if (checkCancelReceiptsBill !== 0) return false;
    let title = 'Hủy phiếu thu ?',
        content = 'Hủy phiếu sẽ không thể quay lại được !',
        icon = 'question';
    sweetAlertInputComponent(title,'id-cancel-update-salary-employee-bonus', content, icon).then(async (result) => {
        if (result.value) {
            checkCancelReceiptsBill = 1;
            let method = 'post',
                url = 'receipts-bill-treasurer.cancel',
                params = null,
                reason = result.value,
                data = {branch: branch, id: id, reason: reason};
            let res = await axiosTemplate(method, url, params, data);
            checkCancelReceiptsBill = 0;
            let text = $('#success-cancel-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
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
    })
}
