let tableEnableBookingBonusData,
    tableDisableBookingBonusData,
    thisTableBookingBonusData,
    checkSaveUpdateSettingBookingBonusData = 0,
    checkSaveStatusSettingBookingBonusData = 0,
    tabActiveBookingBonus = 1;
$(function () {
    if(getCookieShared('booking-bonus-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('booking-bonus-data-user-id-' + idSession));
        tabActiveBookingBonus = dataCookie.tab;
    }
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateBookingBonusData()
    })
    loadData();
    $('#second-update-setting-booking-bonus-data').on('change paste', function () {
        if($(this).val() ==0 ){
            $(this).val(3);
        }
        $('#label-second-setting-booking-bonus-data').text($(this).val());
    })

    $('#second-update-setting-booking-bonus-data').on('input paste', function () {
        $(this).val(parseFloat(($(this).val())));
        $(this).parent().removeClass('border-danger');
        if($(this).val() < 3){
            $(this).val(3);
        }else {

        }
    })

    $('#tab-booking-bonus-data-3').on('click',function (){
        $('#button-service-1').addClass('d-none');
    })
    $('#tab-booking-bonus-data-1 ,#tab-booking-bonus-data-2').on('click',function (){
        $('#button-service-1').removeClass('d-none');
    })
    $('#price-update-setting-booking-bonus-data,#price-first-update-setting-booking-bonus-data,#price-second-update-setting-booking-bonus-data,#price-three-update-setting-booking-bonus-data').on('keyup', function (){
        let priceValue = removeformatNumber($(this).val())
        $(this).val(formatNumber(priceValue));
    })
    $('#tab-booking-bonus-data-3').on('click', function (){
        changeBookingBonusData()
    })
    $('#tab-booking-bonus-data-3').on('click', function (){
        $('#mySidenav-321').addClass('d-none');
    })
    $('#tab-booking-bonus-data-1,#tab-booking-bonus-data-2').on('click', function (){
        $('#mySidenav-321').removeClass('d-none');
    })
    $('#tab-nav-bonus-booking .nav-link').on('click', function (){
        tabActiveBookingBonus = $(this).attr('data-tab')
        updateCookieBookingBonus()
    })
    $('#tab-nav-bonus-booking .nav-link[data-tab="' + tabActiveBookingBonus + '"]').click();
    $(document).on('change', '.select-brand.booking-bonus-data', function () {
        $('.select-brand.booking-bonus-data').val($(this).val()).trigger('change.select2');
    });
});

function updateCookieBookingBonus(){
    saveCookieShared('booking-bonus-data-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveBookingBonus,
    }))
}

async function loadData() {
    let method = 'get',
        url = 'booking-bonus-data.data',
        brand = $('.select-brand').val(),
        params = {brand: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    dataTableBookingBonusData(res);
    $('#total-record-enable').text(res.data[2].total_record_enable);
    $('#total-record-disable').text(res.data[2].total_record_disable);
}

async function dataTableBookingBonusData(data) {
    let idTableEnableBookingBonusData = $('#table-enable-booking-bonus-data'),
        idTableDisableBookingBonusData = $('#table-disable-booking-bonus-data'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', className: 'text-left'},
            {data: 'amount', className: 'text-right'},
            {data: 'bonus_percent', className: 'text-center'},
            {data: 'description', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name:'keysearch', className:'d-none'}
        ],
        option = [{
            'title': 'Thêm mới (F2)',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateBookingBonusData',
        }]
    tableEnableBookingBonusData = await DatatableTemplateNew(idTableEnableBookingBonusData, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableDisableBookingBonusData = await DatatableTemplateNew(idTableDisableBookingBonusData, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste keyup keydown', 'input[type="search"]', function (){
        $('#total-record-enable').text(tableEnableBookingBonusData.rows({'search':'applied'}).count());
        $('#total-record-disable').text(tableDisableBookingBonusData.rows({'search':'applied'}).count());
    })
}

function changeStatusBookingBonusData(r) {
    if(checkSaveStatusSettingBookingBonusData !== 0) return false
    thisTableBookingBonusData = r;
    let title,
        content = '',
        status = r.data('status'),
        icon = 'question';
    title = (status == 0) ? $('#notify-on-update-status-component').text() : $('#notify-off-update-status-component').text() ;
     sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkSaveStatusSettingBookingBonusData = 1
            let method = 'post',
                url = 'booking-bonus-data.change-status',
                params = null,
                data = {
                    id: thisTableBookingBonusData.data('id'),
                };
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            checkSaveStatusSettingBookingBonusData = 0
            let text = ''
            switch (res.status ) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    drawTableStatusBookingBonusData(res.data.data);
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
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}

function drawTableStatusBookingBonusData(data) {
    if(data.is_applied) {
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) - 1));
        removeRowDatatableTemplate(tableDisableBookingBonusData, thisTableBookingBonusData, true);
        addRowDatatableTemplate(tableEnableBookingBonusData, {
            'name': data.name,
            'description': data.description,
            'amount': data.amount,
            'bonus_percent': data.bonus_percent,
            'action': data.action,
            'keysearch': data.keysearch,
        });
    }else {
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) - 1));
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) + 1));
        removeRowDatatableTemplate(tableEnableBookingBonusData, thisTableBookingBonusData, true);
        addRowDatatableTemplate(tableDisableBookingBonusData, {
            'name': data.name,
            'description': data.description,
            'amount': data.amount,
            'bonus_percent': data.bonus_percent,
            'action': data.action,
            'keysearch': data.keysearch,
        });
    }
}

async function changeBookingBonusData() {
    if (checkSaveUpdateSettingBookingBonusData !== 0) return false;

    if (!checkValidateSave($('#booking-bonus-tab3'))) {
        return false;
    }
    checkSaveUpdateSettingBookingBonusData = 1;
    let method = 'post',
        url = 'booking-bonus-data.data-setting',
        brand = $('.select-brand').val(),
        params = null,
        data = {
            id:brand,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#booking-bonus-tab3')]);
    checkSaveUpdateSettingBookingBonusData = 0;
    res.data.data.minimum_order_amount_to_claim_bonus_from_booking !=0 ? $('#price-update-setting-booking-bonus-data').val( formatNumber(res.data.data.minimum_order_amount_to_claim_bonus_from_booking)) : $('#price-update-setting-booking-bonus-data').val( formatNumber(100)) ;
    res.data.data.amount_bonus_booking_order_for_employee!=0 ? $('#price-first-update-setting-booking-bonus-data').val(formatNumber(res.data.data.amount_bonus_booking_order_for_employee)) : $('#price-first-update-setting-booking-bonus-data').val(formatNumber(100)) ;
    res.data.data.maximum_bonus_count_booking_for_employee_second_phase!=0 ? $('#second-update-setting-booking-bonus-data').val(res.data.data.maximum_bonus_count_booking_for_employee_second_phase) : $('#second-update-setting-booking-bonus-data').val(3) ;
    res.data.data.amount_bonus_booking_order_for_employee_second_phase !=0 ? $('#price-second-update-setting-booking-bonus-data').val(formatNumber(res.data.data.amount_bonus_booking_order_for_employee_second_phase)) :$('#price-second-update-setting-booking-bonus-data').val(formatNumber(100));
    res.data.data.amount_bonus_booking_order_for_employee_third_phase !=0 ? $('#price-three-update-setting-booking-bonus-data').val(formatNumber(res.data.data.amount_bonus_booking_order_for_employee_third_phase)) :$('#price-three-update-setting-booking-bonus-data').val(formatNumber(100));
    res.data.data.maximum_bonus_count_booking_for_employee_second_phase !=0 ? $('#label-second-setting-booking-bonus-data').text(res.data.data.maximum_bonus_count_booking_for_employee_second_phase) :$('#label-second-setting-booking-bonus-data').text(3);
 }

async function saveModalUpdateSettingBookingBonusData() {
    if (checkSaveUpdateSettingBookingBonusData !== 0) return false;
    if (!checkValidateSave($('#booking-bonus-tab3'))) return false;
    checkSaveUpdateSettingBookingBonusData = 1;
    let method = 'post',
        url = 'booking-bonus-data.update-setting',
        price = removeformatNumber($('#price-update-setting-booking-bonus-data').val()),
        priceFirst = removeformatNumber($('#price-first-update-setting-booking-bonus-data').val()),
        second = removeformatNumber($('#second-update-setting-booking-bonus-data').val()),
        priceSecond = removeformatNumber($('#price-second-update-setting-booking-bonus-data').val()),
        priceThree = removeformatNumber($('#price-three-update-setting-booking-bonus-data').val()),
        brand = $('.select-brand').val(),
        params = null,
        data = {
            id:brand,
            price: price,
            price_first: priceFirst,
            second: second,
            price_second: priceSecond,
            price_three: priceThree,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#booking-bonus-tab3')]);
    checkSaveUpdateSettingBookingBonusData = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
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
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

