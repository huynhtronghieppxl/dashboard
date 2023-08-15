let checkSaveCreateHappyHour = 0;

function openModalCreateHappyHourPromotion() {
    $('#modal-create-happy-hour-promotion').modal('show');
    $('#modal-create-happy-hour-promotion input').on('click', function () {
        $(this).select();
    })
}

async function saveModalCreateHappyHourPromotion() {
    if (checkSaveCreateHappyHour === 1) return false;
    let brand_id = $('#restaurant-branch-id-selected span').attr('data-value'),
        discount = $('#discount-create-happy-hour-promotion').val(),
        note = $('#condition-create-happy-hour-promotion').val();
    checkSaveCreateHappyHour = 1;
    let method = 'post',
        url = 'happy-hour-promotion.create',
        params = null,
        data = {
            brand_id: brand_id,
            discount: discount,
            note: note,
        };
    let res = await axiosTemplate(method, url, params, data,[$("#loading-modal-create-happy-hour-promotion")]);
    checkSaveCreateHappyHour = 0;
    if (res.data.status === 200) {
        SuccessNotify($('#success-create-data-to-server').text());
        closeModalCreateHappyHourPromotion();
        loadDataHappyHourPromotion();
    } else {
        let error = (res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text();
        ErrorNotify(error);
    }
}

function closeModalCreateHappyHourPromotion() {
    $('#modal-create-happy-hour-promotion').modal('hide');
    $('#condition-create-happy-hour-promotion').html('');
    $('#discount-create-happy-hour-promotion').val('0');
}

function reloadModalCreateHappyHourPromotion(){
    $('#discount-create-happy-hour-promotion').val(0)
    $('#condition-create-happy-hour-promotion').val([]).trigger('change.select2');
}
