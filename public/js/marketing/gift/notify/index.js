let tableEnableNotifyGiftMarketing,
    tableDisableNotifyGiftMarketing;

$(function () {
    loadData();
    shortcut.add('F2', function () {
        openModalCreateNotifyGiftMarketing();
    });
});

async function loadData() {
    let method = 'get',
        url = 'notify-gift.data',
        params = {
            restaurant_brand_id : $('#restaurant-branch-id-selected span').attr('data-value')
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-not-send-notify-gift-marketing"),
        $("#table-send-notify-gift-marketing"),
    ]);
    dataTableNotifyGiftMarketing(res);
    $('#total-record-not-send').text(res.data[2].total_record_not_send);
    $('#total-record-send').text(res.data[2].total_record_send);
}

async function dataTableNotifyGiftMarketing(data) {
    let id1 = $('#table-not-send-notify-gift-marketing'),
        id2 = $('#table-send-notify-gift-marketing'),
        fixed_left = 1,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'logo', className: 'text-center'},
            {data: 'customer.name', className: 'text-center'},
            {data: 'customer.phone', className: 'text-center'},
            {data: 'title', className: 'text-center'},
            {data: 'content', className: 'text-center'},
            {data: 'restaurant_gift.name', className: 'text-center'},
            {data: 'send_notification_at', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    tableEnableNotifyGiftMarketing = await DatatableTemplateNew(id1, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right);
    tableDisableNotifyGiftMarketing = await DatatableTemplateNew(id2, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right);
}
