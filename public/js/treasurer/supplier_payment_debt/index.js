let fromPaymentDebt = $('.from-date-supplier-payment-debt-treasurer').val(),
    toPaymentDebt = $('.to-date-supplier-payment-debt-treasurer').val(),
    tabCurrentSupplierPaymentDebt = 1,
    checkGetDataSupplierPaymentDebt = 0;

$(function (){
    if(getCookieShared('supplier-payment-debt-treasurer-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('supplier-payment-debt-treasurer-user-id-' + idSession));
        fromPaymentDebt = dataCookie.from;
        toPaymentDebt = dataCookie.to;
        tabCurrentSupplierPaymentDebt = dataCookie.tab;
        $('.from-date-supplier-payment-debt-treasurer').val(fromPaymentDebt);
        $('.to-date-supplier-payment-debt-treasurer').val(toPaymentDebt);
        dateTimePickerFromMaxToDate($('.from-date-supplier-payment-debt-treasurer'), $('.to-date-supplier-payment-debt-treasurer'))
    }
    dateTimePickerFromMaxToDate($('.from-date-supplier-payment-debt-treasurer'),$('.to-date-supplier-payment-debt-treasurer'));
    $('.search-btn-supplier-payment-debt-treasurer').on('click', function (){
        // if(!checkDateTimePicker($(this))){
        //     $('.from-date-supplier-payment-debt-treasurer').val(fromPaymentDebt).trigger('dp.change');
        //     $('.to-date-supplier-payment-debt-treasurer').val(toPaymentDebt).trigger('dp.change');
        //     return false;
        // }
        // fromPaymentDebt = $('.from-date-supplier-payment-debt-treasurer').val()
        // toPaymentDebt = $('.to-date-supplier-payment-debt-treasurer').val()
        if(!checkDateTimePicker($(this))){
            return false
        }
        validateDateTemplate($('.from-date-supplier-payment-debt-treasurer'), $('.to-date-supplier-payment-debt-treasurer'), loadData);
        dateTimePickerFromMaxToDate($('.from-date-supplier-payment-debt-treasurer'),$('.to-date-supplier-payment-debt-treasurer'))
    })
    $('.from-date-supplier-payment-debt-treasurer').on('dp.change', function () {
        $('.from-date-supplier-payment-debt-treasurer').val($(this).val());
        dateTimePickerFromMaxToDate($('.from-date-supplier-payment-debt-treasurer'),$('.to-date-supplier-payment-debt-treasurer'))
    });
    $('.to-date-supplier-payment-debt-treasurer').on('dp.change', function () {
        $('.to-date-supplier-payment-debt-treasurer').val($(this).val());
                ($('.from-date-supplier-payment-debt-treasurer'),$('.to-date-supplier-payment-debt-treasurer'))
    });
    $('#nav-tab-supplier-payment-debt .nav-link').on('click', function (){
        tabCurrentSupplierPaymentDebt = $(this).attr('data-id')
        updateCookiePaymentDebt()
    })
    loadData();
    $('#nav-tab-supplier-payment-debt a[data-id="' + tabCurrentSupplierPaymentDebt + '"]').click();
})

async function loadData(){
    if (checkGetDataSupplierPaymentDebt === 1) return false;
    updateCookiePaymentDebt()
    checkGetDataSupplierPaymentDebt = 1
    let method = 'get',
        url = 'supplier-payment-debt-treasurer.data',
        params = {
            restaurant : $('.select-brand').val(),
            branch : $('.select-branch').val(),
            dateForm : $('.from-date-supplier-payment-debt-treasurer').val(),
            dateTo : $('.to-date-supplier-payment-debt-treasurer').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-waiting-supplier-payment-debt, #table-complete-supplier-payment-debt')]);
    checkGetDataSupplierPaymentDebt = 0
    dataTableListBill(res);
    $('#total-record-enable').text(res.data[2].total_waiting);
    $('#total-record-disable').text(res.data[2].total_complete);
}

function dataTableListBill(res){
    let idWaiting = $('#table-waiting-supplier-payment-debt'),
        idComplete = $('#table-complete-supplier-payment-debt'),
        fixedLeft = 2,
        fixedRight = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'supplier_name', className: 'text-left'},
            {data: 'total_amount', className: 'text-right'},
            {data: 'number_order', className: 'text-center'},
            {data: 'date', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '8%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = []
    DatatableTemplateNew(idWaiting, res.data[0].original.data, column, vh_of_table, fixedLeft, fixedRight, option);
    DatatableTemplateNew(idComplete, res.data[1].original.data, column, vh_of_table, fixedLeft, fixedRight, option);
}

function updateCookiePaymentDebt(){
    saveCookieShared('supplier-payment-debt-treasurer-user-id-' + idSession, JSON.stringify({
        'from' : fromPaymentDebt,
        'to' : toPaymentDebt,
        'tab' : tabCurrentSupplierPaymentDebt,
    }))
}

async function changeStatusPaymentDebt(r){
    let title = 'Xác nhận phiếu',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'POST',
                url = 'supplier-payment-debt-treasurer.change-status',
                params = {
                    id :  r.data('id')
                },
                data = {};
            let res = await axiosTemplate(method, url, params, data);
            let text = $('#success-confirm-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (data.data.message !== null) text = data.data.message;
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (data.data.message !== null) text = res.data.message;
                    WarningNotify(text);
            }
        }
    })
}
