let idUpdateBookingBonusData, brandUpdateBookingBonusData, checkSaveUpdateBookingBonusData, thisUpdateBookingBonusData;
function openModalUpdateBookingBonusData(r) {
    thisUpdateBookingBonusData = r;
    checkSaveUpdateBookingBonusData = 0;
    idUpdateBookingBonusData = r.data('id');
    brandUpdateBookingBonusData = r.data('brand');
    $('#name-update-booking-bonus-data').val(r.data('name'));
    $('#description-update-booking-bonus-data').val(r.data('description'));
    $('#amount-update-booking-bonus-data').val(formatNumber(r.data('amount')));
    $('#bonus-update-booking-bonus-data').val(r.data('bonus'));
    $('#total-update-booking-bonus-data').text(formatNumber(parseInt(removeformatNumber(r.data('amount'))) * parseInt(r.data('bonus')) / 100));
    $('#modal-update-booking-bonus-data').modal('show');
    countCharacterTextarea()
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalUpdateBookingBonusData();
    });
    shortcut.add('F4', function () {
        saveModalUpdateBookingBonusData();
    });
    $("#modal-update-booking-bonus-data input").on("click", function () {
        $(this).select();
    });
    $('#amount-update-booking-bonus-data').on("keyup", totalUpdateBookingBonusData);
    $('#bonus-update-booking-bonus-data').on("keyup", totalUpdateBookingBonusData);
}

function totalUpdateBookingBonusData() {
    let value_amount = Number(removeformatNumber($(this).parents('.card-block').find('#amount-update-booking-bonus-data').val()));
    let value_percent = Number($(this).parents('.card-block').find('#bonus-update-booking-bonus-data').val());
    let total_value = $(this).parents('.card-block').find('#total-update-booking-bonus-data');
    total_value.text(formatNumber(value_amount * (value_percent /100)));
}

async function saveModalUpdateBookingBonusData() {
    if (checkSaveUpdateBookingBonusData === 1) return false;
    if (!checkValidateSave($('#modal-update-booking-bonus-data'))) return false;
    let name = $('#name-update-booking-bonus-data').val(),
        description = $('#description-update-booking-bonus-data').val(),
        amount = removeformatNumber($('#amount-update-booking-bonus-data').val()),
        bonus = removeformatNumber($('#bonus-update-booking-bonus-data').val());
    let method = 'POST',
        url = 'booking-bonus-data.update',
        params = null,
        data = {
            id: idUpdateBookingBonusData,
            brand: brandUpdateBookingBonusData,
            name: name,
            description: description,
            amount: amount,
            bonus: bonus,
        };
    checkSaveUpdateBookingBonusData = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-update-booking-bonus-data')]);
    checkSaveUpdateBookingBonusData = 0;
    let text = '';
    switch (res.data.status){
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            closeModalUpdateBookingBonusData();
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function (){
                openModalCreateBookingBonusData()
            })
            drawDataUpdateBookingBonusData(res.data.data);
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

function drawDataUpdateBookingBonusData(data) {
    thisUpdateBookingBonusData.parents('tr').find('td:eq(1)').text(data.name);
    thisUpdateBookingBonusData.parents('tr').find('td:eq(2)').text(data.amount);
    thisUpdateBookingBonusData.parents('tr').find('td:eq(3)').text(data.bonus_percent);
    thisUpdateBookingBonusData.parents('tr').find('td:eq(4)').html(data.description);
    thisUpdateBookingBonusData.parents('tr').find('td:eq(5)').html(data.action);
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
}

function closeModalUpdateBookingBonusData() {
    $('#modal-update-booking-bonus-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateBookingBonusData()
    })
    removeAllValidate();
    resetModalUpdateBookingBonusData()
    countCharacterTextarea()
}

function resetModalUpdateBookingBonusData(){
    $('#closeModalUpdateBookingBonusData').val('');
    $('#amount-update-booking-bonus-data').val(100);
    $('#bonus-update-booking-bonus-data').val(100);
    $('#description-update-booking-bonus-data').val('');
    $('#total-update-booking-bonus-data').text('');
}


