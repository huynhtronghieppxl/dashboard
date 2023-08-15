$(function () {
    addLoading('notification.data', '.page-body');
    shortcut.add('F2', function () {
        openModalCreateNotificationCustomer();
    });
    loadData();
});

async function loadData() {
    let method = 'get',
        url = 'notification.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-customer-notification')]);
    dataTableNotification(res);
}

async function dataTableNotification(data) {
    let scroll_Y = '65vh';
    let fixed_left = 1;
    let fixed_right = 1;
    let id = $('#table-customer-notification'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'title', name: 'title', className: 'text-center'},
            {data: 'content', name: 'content', className: 'text-center'},
            // {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    DatatableTemplate(id, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right);
}
