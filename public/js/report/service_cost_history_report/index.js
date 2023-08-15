let tabCurrentServiceCostHistory = 1,
    loadingDataServiceCostAdd = 0, loadingDataServiceCostMinus = 0,
    tableServiceCostAdd = '',tableServiceCostMinus = '',
    fromDateServiceCostHistory = '', toDateServiceCostHistory = '',
    reportTypeServiceCostHistory = 1,
    dateStringServiceCostHistory = $('#calendar-day').val(),
    fixedLeftTableServiceCostHistory = 0,
    fixedRightTableServiceCostHistory = 0,
    columnMinus = [
        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
        {data: 'restaurant_brand_name', name: 'restaurant_brand_name', className: 'text-left'},
        {data: 'branch_name', name: 'branch_name', className: 'text-left'},
        {data: 'code', name: 'code', className: 'text-left'},
        {data: 'service_total_amount', name: 'service_total_amount', className: 'text-right'},
        {data: 'order_payment_date', name: 'order_payment_date', className: 'text-center'},
        {data: 'service_restaurant_level_id', name: 'service_restaurant_level_id', className: 'text-center'},
    ],
    columnAdd = [
        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
        {data: 'amount_transfer', name: 'amount_transfer', className: 'text-right'},
        {data: 'created_at', name: 'created_at', className: 'text-center'},
    ];
$(function(){
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    dateTimePickerFromToDateTemplate2($('.from-day-service-cost'),$('.to-day-service-cost'));
    dateTimePickerFromToMonthTemplate2($('.from-month-service-cost'),$('.to-month-service-cost'))
    dateTimePickerFromToYearTemplate2($('.from-year-service-cost'),$('.to-year-service-cost'))
    $(document).on('dp.change', '.input-time-day-service-cost', function () {
        $('.input-time-day-service-cost').val($(this).val());
    })
    $(document).on('dp.change', '.input-time-month-service-cost', function () {
        $('.input-time-month-service-cost').val($(this).val());
    })
    $(document).on('dp.change', '.input-time-year-service-cost', function () {
        $('.input-time-year-service-cost').val($(this).val());
    })
    $('.from-day-service-cost').on('dp.change', function (){
        $('.from-day-service-cost').val($(this).val());
    })
    $('.to-day-service-cost').on('dp.change', function (){
        $('.to-day-service-cost').val($(this).val());
    })
    $('.from-month-service-cost').on('dp.change', function (){
        $('.from-month-service-cost').val($(this).val());
    })
    $('.to-month-service-cost').on('dp.change', function (){
        $('.to-month-service-cost').val($(this).val());
    })
    $('.from-year-service-cost').on('dp.change', function (){
        $('.from-year-service-cost').val($(this).val());
    })
    $('.to-year-service-cost').on('dp.change', function (){
        $('.to-year-service-cost').val($(this).val());
    })
    $('.select-time-service-cost-history').on('change', function(){
        $('.select-time-service-cost-history').val($(this).val()).trigger('change.select2');
        switch(Number($(this).val())){
            case 1:
                $('.form-time-service-cost-history').addClass('d-none');
                $('.form-time-service-cost-history.by-day').removeClass('d-none');
                reportTypeServiceCostHistory = 1;
                dateStringServiceCostHistory = $('#calendar-day').val();
                fromDateServiceCostHistory = '';
                toDateServiceCostHistory = '';
                break;
            case 2:
                $('.form-time-service-cost-history').addClass('d-none');
                reportTypeServiceCostHistory = 2;
                dateStringServiceCostHistory = moment().format('WW/YYYY');
                fromDateServiceCostHistory = '';
                toDateServiceCostHistory = '';
                break;
            case 3:
                $('.form-time-service-cost-history').addClass('d-none');
                $('.form-time-service-cost-history.by-month').removeClass('d-none');
                reportTypeServiceCostHistory = 3;
                dateStringServiceCostHistory = $('#calendar-month').val();
                fromDateServiceCostHistory = '';
                toDateServiceCostHistory = '';
                break;
            case 4:
                $('.form-time-service-cost-history').addClass('d-none');
                reportTypeServiceCostHistory = 4;
                dateStringServiceCostHistory = moment().format('MM/YYYY');
                fromDateServiceCostHistory = '';
                toDateServiceCostHistory = '';
                break;
            case 5:
                $('.form-time-service-cost-history').addClass('d-none');
                $('.form-time-service-cost-history.by-year').removeClass('d-none');
                reportTypeServiceCostHistory = 5;
                dateStringServiceCostHistory = $('#calendar-year').val();
                fromDateServiceCostHistory = '';
                toDateServiceCostHistory = '';
                break;
            case 6:
                $('.form-time-service-cost-history').addClass('d-none');
                reportTypeServiceCostHistory = 6;
                dateStringServiceCostHistory = moment().format('YYYY');
                fromDateServiceCostHistory = '';
                toDateServiceCostHistory = '';
                break;
            case 13:
                $('.form-time-service-cost-history').addClass('d-none');
                $('.form-time-option-date').removeClass('d-none');
                reportTypeServiceCostHistory = 13;
                fromDateServiceCostHistory = $('.from-day-service-cost').val();
                toDateServiceCostHistory = $('.to-day-service-cost').val();
                dateStringServiceCostHistory = '';
                break;
            case 15:
                $('.form-time-service-cost-history').addClass('d-none');
                $('.form-time-option-month').removeClass('d-none');
                reportTypeServiceCostHistory = 15;
                fromDateServiceCostHistory = $('.from-month-service-cost').val();
                toDateServiceCostHistory = $('.to-month-service-cost').val();
                dateStringServiceCostHistory = '';
                break;
            case 16:
                $('.form-time-service-cost-history').addClass('d-none');
                $('.form-time-option-year').removeClass('d-none');
                reportTypeServiceCostHistory = 16;
                fromDateServiceCostHistory = $('.from-year-service-cost').val();
                toDateServiceCostHistory = $('.to-year-service-cost').val();
                dateStringServiceCostHistory = '';
                break;
        }
        loadData();
    })

    $('.search-by-date').on('click', function () {
        reportTypeServiceCostHistory = 1;
        dateStringServiceCostHistory = $('#calendar-day').val();
        fromDateServiceCostHistory = '';
        toDateServiceCostHistory = '';
        loadData();
    })
    $('.search-by-month').on('click', function () {
        reportTypeServiceCostHistory = 3;
        dateStringServiceCostHistory = $('#calendar-month').val();
        fromDateServiceCostHistory = '';
        toDateServiceCostHistory = '';
        loadData();
    })
    $('.search-by-year').on('click', function () {
        reportTypeServiceCostHistory = 5;
        dateStringServiceCostHistory = $('#calendar-year').val();
        fromDateServiceCostHistory = '';
        toDateServiceCostHistory = '';
        loadData();
    })
    $('.custom-search-day-to-day').on('click', function () {
        reportTypeServiceCostHistory = 13;
        dateStringServiceCostHistory = '';
        fromDateServiceCostHistory = $('.from-day-service-cost').val();
        toDateServiceCostHistory = $('.to-day-service-cost').val();
        if(moment(fromDateServiceCostHistory, 'DD/MM/YYYY').isAfter(moment(toDateServiceCostHistory, 'DD/MM/YYYY'))){
            WarningNotify('Ngày bắt đầu không được lớn hơn ngày kết thúc !');
            return false;
        }
        loadData();
    })
    $('.custom-search-month-to-month').on('click', function () {
        reportTypeServiceCostHistory = 15;
        dateStringServiceCostHistory = '';
        fromDateServiceCostHistory = $('.from-month-service-cost').val();
        toDateServiceCostHistory = $('.to-month-service-cost').val();
        if(moment(fromDateServiceCostHistory, 'MM/YYYY').isAfter(moment(toDateServiceCostHistory, 'MM/YYYY'))){
            WarningNotify('Tháng bắt đầu không được lớn hơn tháng kết thúc !');
            return false;
        }
        loadData();
    })
    $('.custom-search-year-to-year').on('click', function () {
        reportTypeServiceCostHistory = 16;
        dateStringServiceCostHistory = '';
        fromDateServiceCostHistory = $('.from-year-service-cost').val();
        toDateServiceCostHistory = $('.to-year-service-cost').val();
        if(moment(fromDateServiceCostHistory, 'YYYY').isAfter(moment(toDateServiceCostHistory, 'YYYY'))) {
            WarningNotify('Năm bắt đầu không được lớn hơn năm kết thúc !');
            return false;
        }
        loadData();
    })
    $('#tab2-service-cost-history').on('change', '.select-brand', async function () {
        if($(this).val() === '-1') {
            $('#tab2-service-cost-history').find('.select-branch-service-cost-history').addClass('d-none');
        }else {
            $('#tab2-service-cost-history').find('.select-branch-service-cost-history').removeClass('d-none');
        }
    })
    $('#tab2-service-cost-history').on('change', '.select-branch' , async function () {

    })
    loadDataBalance();
    changeTabServiceCostHistory(1);
})
async function loadData() {
    loadDataBalance();
    loadingData();

}

async function loadDataBalance(){
    let method = 'get',
        url = 'service-restaurant-balance.data-balance',
        params = null,
        data = null;
    let res = await axiosTemplate(method,url, params, data, $('#box-service-cost-balance-total'));
    $('#total-service-cost').text(formatNumber(res.data.data.used_amount));
    $('#total-after-service-cost-history').text(formatNumber(res.data.data.amount));
}

async function loadingData() {
    switch (tabCurrentServiceCostHistory) {
        case 1:
            loadingDataServiceCostAdd = 1;
            loadingDataServiceCostMinus = 0;
            await tableServiceCostAdd.ajax.url("service-restaurant-balance.transaction?report_type=" + reportTypeServiceCostHistory +"&from_date=" + fromDateServiceCostHistory + "&to_date=" + toDateServiceCostHistory + "&date_string=" + dateStringServiceCostHistory  + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val()).load();
            break;
        case 2:
            loadingDataServiceCostAdd = 0;
            loadingDataServiceCostMinus = 1;
            await tableServiceCostMinus.ajax.url("service-restaurant-balance.histories?report_type=" + reportTypeServiceCostHistory + "&from_date=" + fromDateServiceCostHistory + "&to_date=" + toDateServiceCostHistory + "&date_string=" + dateStringServiceCostHistory + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val()).load();
            break;
    }
}

async function changeTabServiceCostHistory(tab) {
    !$('.select-branch').val() ? await updateSessionBrandNew($('.select-brand')) : false;
    tabCurrentServiceCostHistory = tab;
    switch (tab) {
        case 1:
            if (tableServiceCostAdd === '') {
                await loadDataServiceCostHistoryAdd();
                loadingDataServiceCostAdd = 1;
            } else if (loadingDataServiceCostAdd === 0) {
                await tableServiceCostAdd.ajax.url("service-restaurant-balance.transaction?report_type=" + reportTypeServiceCostHistory +"&from_date=" + fromDateServiceCostHistory + "&to_date=" + toDateServiceCostHistory + "&date_string=" + dateStringServiceCostHistory  + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val()).load();
            }
            break;
        case 2:
            if (tableServiceCostMinus === '') {
                await loadDataServiceCostHistoryMinus();
                loadingDataServiceCostMinus = 1;
            } else if (loadingDataServiceCostMinus === 0) {
                await tableServiceCostMinus.ajax.url("service-restaurant-balance.histories?report_type=" + reportTypeServiceCostHistory + "&from_date=" + fromDateServiceCostHistory + "&to_date=" + toDateServiceCostHistory + "&date_string=" + dateStringServiceCostHistory + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val()).load();
            }
            break;
    }
}

async function loadDataServiceCostHistoryAdd() {
    loadingDataServiceCostAdd = 1;
    let id = $("#table-service-cost-history-add"),
        url = "service-restaurant-balance.transaction?report_type=" + reportTypeServiceCostHistory +"&from_date=" + fromDateServiceCostHistory + "&to_date=" + toDateServiceCostHistory + "&date_string=" + dateStringServiceCostHistory + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val();
    tableServiceCostAdd = await DatatableServerSideTemplateNew(id, url, columnAdd, vh_table_tab, fixedLeftTableServiceCostHistory, fixedRightTableServiceCostHistory, [], callbackServiceCostHistory);
}

async function loadDataServiceCostHistoryMinus() {
    loadingDataServiceCostMinus = 1;
    let id = $("#table-service-cost-history-minus"),
        url = "service-restaurant-balance.histories?report_type=" + reportTypeServiceCostHistory + "&from_date=" + fromDateServiceCostHistory + "&to_date=" + toDateServiceCostHistory + "&date_string=" + dateStringServiceCostHistory + "&restaurant_brand_id=" + $('.select-brand').val() + "&branch_id=" + $('.select-branch').val();
    tableServiceCostMinus = await DatatableServerSideTemplateNew(id, url, columnMinus, vh_table_tab, fixedLeftTableServiceCostHistory, fixedRightTableServiceCostHistory, [], callbackServiceCostHistory);
}

function callbackServiceCostHistory(response) {
    $('#service-cost-history-nav').find('a.active').find('span').text(formatNumber(response.config[0].data.total_record));
    if($('#service-cost-history-nav').find('a.active').find('span').is('#total-record-service-cost-history-add')) {
        $('#total-record-service-cost-history-minus').text(formatNumber(response.key[1].data.total_record_out));
        $('#total-amount-service-cost-history-add').text(formatNumber(response.key[0].data.total_amount));
    }else {
        $('#total-record-service-cost-history-add').text(formatNumber(response.key[1].data.total_record_in));
        $('#total-order').text(formatNumber(response.key[0].data.total_record));
        $('#level-and-current-scale').text(
            response.key[0].data.current_service_restaurant_level_id + '/' + response.key[0].data.current_scale
        );
        $('#service-cost').text(formatNumber(response.key[0].data.current_service_charge));
        $('#total-amount-service-cost-history-minus').text(formatNumber(response.key[0].data.total_amount));
    }
}
