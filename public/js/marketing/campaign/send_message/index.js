let tableEnableSendMessageCampaign,
    tableDisableSendMessageCampaign,
    tableWaitingAllowMessageCampaign,
    tableAdminCancelMessageCampaign,
    checkSaveNotifyGiftMarketing = 0;

async function loadDataSendMessage() {
    shortcut.add('F2', function () {
        openModalCreateSendMessageCampaign();
    });
    let method = 'get',
        url = 'send-message-campaign.data',
        params = {
            restaurant_brand_id : $('.select-brand').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-not-send-send-message-campaign'),
        $('#table-send-send-message-campaign'),
        $('#table-waiting-allow-message-campaign'),
        $('#table-admin-cancel-message-campaign')
    ]);
    dataTableSendMessageCampaign(res);
    $('#total-record-waiting-allow').text(res.data[3].total_record_waiting_allow);
    $('#total-record-not-send').text(res.data[3].total_record_not_send);
    $('#total-record-send').text(res.data[3].total_record_send);
    $('#total-record-cancel').text(res.data[3].total_record_cancel);
}

async function dataTableSendMessageCampaign(data) {
    let idTableNotSendMessageCampaign = $('#table-not-send-send-message-campaign'),
        idTableSendMessageCampaign = $('#table-send-send-message-campaign'),
        idTableWaitingAllowMessageCampaign = $('#table-waiting-allow-message-campaign'),
        idTableAdminCancelMessageCampaign = $('#table-admin-cancel-message-campaign'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '10%'},
        {data: 'title', className: 'text-left'},
        {data: 'logo', className: 'text-left'},
        {data: 'customer', className: 'text-center', className: 'text-left'},
        {data: 'send_notification_at', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', class: 'd-none'},
    ],
        columnsCancel = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '10%'},
            {data: 'title', className: 'text-left'},
            {data: 'logo', className: 'text-left'},
            {data: 'customer', className: 'text-center', className: 'text-left'},
            {data: 'send_notification_at', className: 'text-center'},
            {data: 'reason_cancel', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', class: 'd-none'},
        ],
        option = [{
            'title': 'Thêm mới (F2)',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateSendMessageCampaign',
        }];
    vh_of_table = await (($("#pcoded").outerHeight(true) - ($('.pcoded-inner-content').outerHeight(true) + $('.navbar').outerHeight(true) + 16)) * 10) / 100 + 'vh';
    tableEnableSendMessageCampaign = await DatatableTemplateNew(idTableNotSendMessageCampaign, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableDisableSendMessageCampaign = await DatatableTemplateNew(idTableSendMessageCampaign, data.data[2].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableWaitingAllowMessageCampaign = await DatatableTemplateNew(idTableWaitingAllowMessageCampaign, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableAdminCancelMessageCampaign = await DatatableTemplateNew(idTableAdminCancelMessageCampaign, data.data[5].original.data, columnsCancel, vh_of_table, fixed_left, fixed_right, option);
}

function sendNotifyGiftMarketing(r) {
    if (checkSaveNotifyGiftMarketing === 1) return false;
    let titles = 'Gửi tin nhắn ?',
        contents = '',
        icon = 'question';
    sweetAlertComponent(titles, contents, icon).then(async (result) => {
        if (result.value) {
            let id = r.data('id'),
                method = 'post',
                url = 'send-message-campaign.send',
                params = null,
                data = {
                    id: id,
                    message_url: r.data('message_url'),
                };
            checkSaveNotifyGiftMarketing = 1;
            let res = await axiosTemplate(method, url, params, data);
            checkSaveNotifyGiftMarketing = 0;
            let text = $('#success-confirm-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    loadDataSendMessage();
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

function cancelNotifyGiftMarketing(r) {
    if (checkSaveNotifyGiftMarketing === 1) return false;
    let titles = 'Hủy duyệt tin nhắn ?',
        contents = '',
        icon = 'question';
    sweetAlertComponent(titles, contents, icon).then(async (result) => {
        if (result.value) {
            let id = r.data('id'),
                method = 'post',
                url = 'send-message-campaign.cancel-submit-admin',
                params = null,
                data = {
                    id: id,
                };
            checkSaveNotifyGiftMarketing = 1;
            let res = await axiosTemplate(method, url, params, data);
            checkSaveNotifyGiftMarketing = 0;
            let text = $('#success-cancel-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    loadDataSendMessage();
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

async function loadDataGiftSendMessageCampaign() {
    if (checkDataGiftCreateSendMessageCampaign === 0) {
        // let brand = $('.select-brand').val();
        let method = 'get',
            url = 'send-message-campaign.gift',
            params = {},
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        checkDataGiftCreateSendMessageCampaign = 1;
        $('#select-gift-create-send-message-campaign').html(res.data[0]);
        $('#select-gift-update-send-message-campaign').html(res.data[0]);
    }
}
