let checkSaveUpdateCallHappyHour = 0;

async function loadDataHappyHourPromotion() {
    let method = 'get',
        url = 'happy-hour-promotion.data',
        params = {
            brand: $('#restaurant-branch-id-selected span').attr('data-value'),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-register-happy-hour-promotion"),
        $("#table-not-register-happy-hour-promotion"),
    ]);
    dataTableHappyHourPromotion(res);
    dataTotalHappyHourPromotion(res.data[2]);
}

async function dataTableHappyHourPromotion(data) {
    let tableRegisterHappyHourPromotion = $('#table-register-happy-hour-promotion'),
        tableNotRegisterHappyHourPromotion = $('#table-not-register-happy-hour-promotion'),
        fixed_left = 0,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'customer_phone', name: 'customer_phone', className: 'text-center'},
            {data: 'customer_name', name: 'customer_name', className: 'text-center'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    await DatatableTemplateNew(tableRegisterHappyHourPromotion, data.data[0].original.data, column, vh_of_table, fixed_left, fixed_right);
    await DatatableTemplateNew(tableNotRegisterHappyHourPromotion, data.data[1].original.data, column, vh_of_table, fixed_left, fixed_right);
}

function dataTotalHappyHourPromotion(data) {
    $('#total-record-register').text(data.total_record_register);
    $('#total-record-not-register').text(data.total_record_not_register);
}

function updateCallHappyHour(id) {
    if (checkSaveUpdateCallHappyHour !== 0) return false;
    checkSaveUpdateCallHappyHour = 1;
    let title = 'Cập nhật cuộc gọi',
        element = 'input-sweet-alert-update-call-happy-hour-promotion',
        content = 'Ghi chú sau khi gọi khách';
    sweetAlertInputComponent(title, element, content).then(async (result) => {
        if (result.isConfirmed) {
            let method = 'post',
                note = $('#input-sweet-alert-update-call-happy-hour-promotion').val(),
                url = 'happy-hour-promotion.update',
                params = null,
                data = {id: id, note: note};
            let res = await axiosTemplate(method, url, params, data);
            checkSaveUpdateCallHappyHour = 0;
            if (res.data.status === 200) {
                let text = $('#success-update-data-to-server').text();
                SuccessNotify(text);
                loadDataHappyHourPromotion();
            } else {
                let text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                ErrorNotify(text);
            }
        }
    });
}
