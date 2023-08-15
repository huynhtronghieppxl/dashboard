let closingAmountCashBook = 0,
    tabCurrentCashBook = 1,
    checkSaveCreateCashBookTreasurer = 0,
    tablePaymentBillCashbook = '',
    tableCashBookTreasurer = '',
    totalInCashBookTreasurer = 0,
    totalOutCashBookTreasurer = 0,
    revenueCashBookTreasurer = -1,
    orderTotalAmountCashBookTreasurer = 0,
    openAmountCashBookTreasurer = 0, statusUnConfirmed = 0,
    fromCashBook = $('.from-date-cash-book').val(), toCashBook = $('.to-date-cash-book').val(),
    loadDataPaymentBillCashBook = 0, loadDataPaymentRecurringBillCashBook = 0,
    limit = $('#data-table-length').val(), branch_id = $('.select-branch').val(), typeTabPaymentBillCashBook, typeTabPaymentRecurringBillCashBook, pageTabPaymentBillCashBook, payTabPaymentRecurringCashBook,
    columnPaymentBill = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-left', width: '5%'},
        {data: 'is_count_to_revenue_name', name: 'is_count_to_revenue_name', className: 'text-left'},
        {data: 'employee.name'},
        {data: 'object_name', className: 'text-left'},
        {data: 'addition_fee_reason_name', className: 'text-left'},
        {data: 'fee_month', className: 'text-center'},
        {data: 'amount', className: 'text-right'},
        {data: 'status_text', className: 'text-center', width: '5%'},
        {data: 'action', className: 'text-center', width: '5%'},
    ],
    columnPaymentRecurringBill = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-left', width: '5%'},
        {data: 'is_count_to_revenue_name', name: 'is_count_to_revenue_name', className: 'text-left'},
        {data: 'employee.name'},
        {data: 'object_name', className: 'text-left'},
        {data: 'addition_fee_reason_name', className: 'text-left'},
        {data: 'fee_month', className: 'text-center'},
        {data: 'amount', className: 'text-right'},
        {data: 'status_text', className: 'text-center', width: '5%'},
        {data: 'action', className: 'text-center', width: '5%'},
    ],
    fixedLeftTable = 2,
    fixedRightTable = 0,
    optionRenderTable = [
        {
            'title': 'Chốt kỳ',
            'icon': 'fi-rr-check text-primary',
            'class': '',
            'function': 'createCashBookTreasurer',
        }
    ]

$(function () {

    if(getCookieShared('cash-book-treasurer-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('cash-book-treasurer-user-id-' + idSession));
        fromCashBook = dataCookie.from;
        toCashBook = dataCookie.to;
        tabCurrentCashBook = dataCookie.tab;
        revenueCashBookTreasurer = dataCookie.isRevenue
        $('.select-revenue-cash-book').val(revenueCashBookTreasurer).trigger('change')
        $('.from-date-cash-book').val(fromCashBook)
        $('.to-date-cash-book').val(toCashBook)
    }
    $('.select-revenue-cash-book').on('change', function () {
        revenueCashBookTreasurer = $(this).val()
        updateCookieCashBookTreasurer()
        loadingData();
    })
    $('.from-date-cash-book').on('dp.change', function () {
        $('.from-date-cash-book').val($(this).val());
        fromCashBook = $(this).val();
        updateCookieCashBookTreasurer()
    });
    $('.to-date-cash-book').on('dp.change', function () {
        $('.to-date-cash-book').val($(this).val());
        toCashBook = $(this).val();
        updateCookieCashBookTreasurer()
    });
    $('.search-btn-cash-book').on('click', function () {
        fromCashBook = $('.from-date-cash-book').val();
        toCashBook = $('.to-date-cash-book').val();
        validateDateTemplate($('.from-date-cash-book'), $('.to-date-cash-book'), loadingData);
        dataTimeCashBookTreasurer();
    });
    $('.select-branch').on('change', function (){
        $('.select-branch').val($(this).val());
    })
    $('.select-brand').on('change', function (){
        $('.select-brand').val($(this).val());
        if(  $(this).val() == -1){
            $('#select-branch-cask-book').addClass('d-none');
        }
        else{
            $('#select-branch-cask-book').removeClass('d-none');
        }
    })
    typeTabPaymentBillCashBook = 1;
    typeTabPaymentRecurringBillCashBook = 0;
    pageTabPaymentBillCashBook = 1;
    payTabPaymentRecurringCashBook = 1;
    $('#nav-tab-cash-book a[data-id="' + tabCurrentCashBook + '"]').click();
});

async function loadData() {
    clearData();
    dataTimeCashBookTreasurer();
    validateDateTemplate($('.from-date-cash-book'), $('.to-date-cash-book'), loadingData);
}

function updateCookieCashBookTreasurer(){
    saveCookieShared('cash-book-treasurer-user-id-' + idSession, JSON.stringify({
        'from' : fromCashBook,
        'to' : toCashBook,
        'isRevenue': revenueCashBookTreasurer,
        'tab' : tabCurrentCashBook,
    }))
}

function clearData() {
    $('#table-payment-cash-book-treasurer tbody').empty();
    $('#table-receipt-cash-book-treasurer tbody').empty();
    $('#total-record-tab1-cash-book-treasurer').text('0');
    $('#total-record-tab2-cash-book-treasurer').text('0');
    $('#total-tab1-cash-book-treasurer').text('0');
    $('#total-tab2-cash-book-treasurer').text('0');
    $('#before-amount-cash-book-treasurer').text('0');
    $('#in-amount-cash-book-treasurer').text('0');
    $('#out-amount-cash-book-treasurer').text('0');
    $('#after-amount-cash-book-treasurer').text('0');
}

async function dataTimeCashBookTreasurer() {
    let method = 'get',
        branch = $('.select-branch').val(),
        to_date = $('.to-date-cash-book').val(),
        params = {branch: branch, date: to_date },
        data = null,
        url = 'cash-book-treasurer.time';
    let res = await axiosTemplate(method, url, params, data, [
        $('#before-amount-cash-book-treasurer'),
        $('.from-date-cash-book'),
        $('#after-amount-cash-book-treasurer'),
        $('#out-amount-cash-book-treasurer'),
        $('#in-amount-cash-book-treasurer')
    ]);
    $('#before-amount-cash-book-treasurer').html(res.data.data.openning_amount);
    $('#in-amount-cash-book-treasurer').html(res.data.data.in);
    $('#out-amount-cash-book-treasurer').html(res.data.data.out);
    $('#after-amount-cash-book-treasurer').html(res.data.data.closing_amount);
    $('.from-date-cash-book').val(moment(res.data.data.from_date, 'DD/MM/YYYY').format('DD/MM/YYYY'));
    // $('.to-date-cash-book').val(moment(new Date).format('DD/MM/YYYY'))
    $('.to-date-cash-book').val(toCashBook)
    dateTimePickerFromToMinMaxDate($('.from-date-cash-book'),$('.to-date-cash-book'));

    // dateTimePickerFromToMinMaxDate($('.from-date-cash-book'),$('.to-date-cash-book'))
    closingAmountCashBook = removeformatNumber(res.data.data.closing_amount);
    totalInCashBookTreasurer = removeformatNumber(res.data.data.in);
    totalOutCashBookTreasurer = removeformatNumber(res.data.data.out);
    orderTotalAmountCashBookTreasurer = res.data.data.order_total_amount;
    openAmountCashBookTreasurer = removeformatNumber(res.data.data.openning_amount);
}

async function loadingData() {
    updateCookieCashBookTreasurer()
    if (tabCurrentCashBook === 1) {
        statusUnConfirmed = 0
        loadDataPaymentBillCashBook = 1;
        loadDataPaymentRecurringBillCashBook = 0;
        await tablePaymentBillCashbook.ajax.url("cash-book-treasurer.data?from=" + fromCashBook + "&to=" + toCashBook + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val() + "&type=" + typeTabPaymentBillCashBook + "&revenue=" + revenueCashBookTreasurer + "&page=" + pageTabPaymentBillCashBook + "&limit=" + limit).load();
    } else if (tabCurrentCashBook === 0) {
        loadDataPaymentBillCashBook = 0;
        loadDataPaymentRecurringBillCashBook = 1;
        await tableCashBookTreasurer.ajax.url("cash-book-treasurer.data?from=" + fromCashBook + "&to=" + toCashBook + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val() + "&type=" + typeTabPaymentRecurringBillCashBook + "&revenue=" + revenueCashBookTreasurer + "&page=" + payTabPaymentRecurringCashBook + "&limit=" + limit).load();
    }
}

async function changeTabCashBook(tab) {
    tabCurrentCashBook = tab;
    await updateSessionBrandNew($('.select-brand'))
    updateCookieCashBookTreasurer()
    if (tab === 1) {
        statusUnConfirmed = 0
        if (tablePaymentBillCashbook === '') {
            loadDataPaymentBill();

            loadDataPaymentBillCashBook = 1;
        } else if (loadDataPaymentBillCashBook === 0) {
            tablePaymentBillCashbook.ajax.url("cash-book-treasurer.data?from=" + fromCashBook + "&to=" + toCashBook + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val() + "&type=" + typeTabPaymentBillCashBook + "&revenue=" + revenueCashBookTreasurer + "&page=" + pageTabPaymentBillCashBook + "&limit=" + limit).load();
        }
    } else if (tab === 0) {
        if (tableCashBookTreasurer === '') {
            loadDataPaymentRecurringBill();
            loadDataPaymentRecurringBillCashBook = 1;
        } else if (loadDataPaymentRecurringBillCashBook === 0) {
            tableCashBookTreasurer.ajax.url("cash-book-treasurer.data?from=" + fromCashBook + "&to=" + toCashBook + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val() + "&type=" + typeTabPaymentRecurringBillCashBook + "&revenue=" + revenueCashBookTreasurer + "&page=" + payTabPaymentRecurringCashBook + "&limit=" + limit).load();
        }
    }
}

async function loadDataPaymentBill() {
    await dataTimeCashBookTreasurer();
    let id = $('#table-payment-cash-book-treasurer'),
        url = "cash-book-treasurer.data?from=" + fromCashBook + "&to=" + toCashBook + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val() + "&type=" + typeTabPaymentBillCashBook + "&revenue=" + revenueCashBookTreasurer+ "&page=" + pageTabPaymentBillCashBook + "&limit=" + limit;
    tablePaymentBillCashbook = await DatatableServerSideTemplateNew(id, url, columnPaymentBill, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

async function loadDataPaymentRecurringBill() {
    await dataTimeCashBookTreasurer();
    let id = $('#table-receipt-cash-book-treasurer'),
        url = "cash-book-treasurer.data?from=" + fromCashBook + "&to=" + toCashBook + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val() + "&type=" + typeTabPaymentRecurringBillCashBook + "&revenue=" + revenueCashBookTreasurer+ "&page=" + payTabPaymentRecurringCashBook + "&limit=" + limit;
    tableCashBookTreasurer = await DatatableServerSideTemplateNew(id, url, columnPaymentRecurringBill, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function createCashBookTreasurer() {
    if (checkSaveCreateCashBookTreasurer !== 0) return false;
    let title = 'Chốt kỳ ?',
        from = $('.from-date-cash-book').val(),
        to = $('.to-date-cash-book').val(),
        content = 'Xác nhận chốt kỳ từ ngày ' + from + ' đến ' + to + ' ?' +
            ' Nếu còn phiếu chi chưa chi thì không thể chốt kỳ !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkSaveCreateCashBookTreasurer = 1;
            let method = 'post',
                url = 'cash-book-treasurer.create',
                params = null,
                data = {
                    closing_amount: closingAmountCashBook,
                    in: totalInCashBookTreasurer,
                    out: totalOutCashBookTreasurer,
                    order_total_amount: orderTotalAmountCashBookTreasurer,
                    openning_amount: openAmountCashBookTreasurer,
                    date: to,
                };
            let res = await axiosTemplate(method, url, params, data);
            checkSaveCreateCashBookTreasurer = 0;
            let text = '';
            switch (res.data.status){
                case 200:
                    await $('.to-date-cash-book').val(moment().format('DD/MM/YYYY'));
                    text = 'Thêm mới thành công';
                    SuccessNotify(text);
                    $('#search-btn-cash-book-treasurer').click();
                    break;
                case 400:
                    let title = 'Thông báo',
                        content = res.data.message,
                        icon = 'warning';
                    sweetAlertNotifyComponent(title, content, icon);
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    });
}

function callbackLoadData(response) {
    for (let i = 0; i < response.data.length; i++) {
        if (response.data[i].addition_fee_status == 7 || response.data[i].addition_fee_status == 1){
            statusUnConfirmed++
        }
    }
    if (statusUnConfirmed > 0){
        $( ".toolbar-button-datatable label" ).hover(function() {
            $(this).css('background','none');
        })
        $('.toolbar-button-datatable label').addClass('disabled')
        $('.toolbar-button-datatable button').addClass('disabled')
        $('.toolbar-button-datatable > label > button').attr("disabled", true)
    }
    $('#total-record-tab1-cash-book-treasurer').text(response.out_count);
    $('#total-record-tab2-cash-book-treasurer').text(response.in_count);
    $('#total-tab2-cash-book-treasurer').text(response.total_in_amount);
    $('#total-tab1-cash-book-treasurer').text(response.total_out_amount);
}
