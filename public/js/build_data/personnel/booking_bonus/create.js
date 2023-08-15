let checkSaveCreateBookingBonusData = 0;

function openModalCreateBookingBonusData() {
    checkSaveCreateBookingBonusData = 0;
    $('#modal-create-booking-bonus-data').modal('show');
    $('#amount-create-booking-bonus-data').val('100');
    $('#bonus-create-booking-bonus-data').val('1');
    shortcut.add('F4', function () {
        saveModalCreateBookingBonusData();
    });
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalCreateBookingBonusData();
    });
    $("#modal-create-booking-bonus-data input").on("click", function () {
        $(this).select();
    });
    $('#name-create-booking-bonus-data').focus();
    $('#amount-create-booking-bonus-data').on("keyup", totalCreateBookingBonusData);
    $('#bonus-create-booking-bonus-data').on("keyup", totalCreateBookingBonusData);

    $('.btn-renew').addClass('d-none');
    $('#loading-create-booking-bonus-data input, #loading-create-booking-bonus-data textarea').on('input', function (){
        $('#modal-create-booking-bonus-data .btn-renew').removeClass('d-none');
    });
}

function totalCreateBookingBonusData() {
    let value_amount = Number(removeformatNumber($(this).parents('.card-block').find('#amount-create-booking-bonus-data').val()));
    let value_percent = Number($(this).parents('.card-block').find('#bonus-create-booking-bonus-data').val());
    let total_value = $(this).parents('.card-block').find('#total-create-booking-bonus-data');
    total_value.text(formatNumber(parseInt(value_amount * (value_percent /100))));
}


async function saveModalCreateBookingBonusData() {
    if (checkSaveCreateBookingBonusData === 1) return false;
    if (!checkValidateSave($('#modal-create-booking-bonus-data'))) return false;
    let brand = $('.select-brand.booking-bonus-data').val(),
        name = $('#name-create-booking-bonus-data').val(),
        description = $('#description-create-booking-bonus-data').val(),
        amount = removeformatNumber($('#amount-create-booking-bonus-data').val()),
        bonus = removeformatNumber($('#bonus-create-booking-bonus-data').val());
    checkSaveCreateBookingBonusData = 1;
    let method = 'post',
        url = 'booking-bonus-data.create',
        params = null,
        data = {
            brand: brand,
            name: name,
            description: description,
            amount: amount,
            bonus: bonus,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-create-booking-bonus-data')]);
     checkSaveCreateBookingBonusData = 0;
    let text = '';
    switch (res.data.status){
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            closeModalCreateBookingBonusData();
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function (){
                openModalCreateBookingBonusData()
            })
            drawDataCreateBookingBonusData(res.data.data);
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

function drawDataCreateBookingBonusData(data) {
    $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
    addRowDatatableTemplate(tableEnableBookingBonusData, {
        'name': data.name,
        'description': data.description,
        'amount': data.amount,
        'bonus_percent': data.bonus_percent,
        'action': data.action,
        'keysearch': data.keysearch,
    });
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
}

function closeModalCreateBookingBonusData() {
    $('#modal-create-booking-bonus-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateBookingBonusData()
    })
    reloadModalCreateBookingBonusData();
    countCharacterTextarea()
}

function reloadModalCreateBookingBonusData() {
    removeAllValidate();
    $('#name-create-booking-bonus-data').val('');
    $('#amount-create-booking-bonus-data').val(100);
    $('#bonus-create-booking-bonus-data').val(1);
    $('#total-create-booking-bonus-data').text('1');
    $('#description-create-booking-bonus-data').val('');
    $('#modal-create-booking-bonus-data .btn-renew').addClass('d-none');
}


