$(function () {
    addLoading('message.data', '.page-body');
    shortcut.add('F2', function () {
        openModalCreateCustomerMessage();
    });
    loadData();
});

async function loadData() {
    let method = 'get',
        url = 'message.data',
        branch_id = $('#change_branch').val(),
        params = {branch_id: branch_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,
        [$('#table-enable-customer-message ' ), $('#table-disable-customer-message')]);
    dataTotalMessageCustomer(res.data[2]);
    dataTableMessageCustomer(res);
}

async function dataTableMessageCustomer(data) {
    let scroll_Y = '65vh';
    let fixed_left = 1;
    let fixed_right = 1;
    let id1 = $('#table-enable-customer-message'),
        id2 = $('#table-disable-customer-message'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'branch_name', name: 'branch_name', className: 'text-center'},
            {data: 'type', name: 'branch_name', className: 'text-center'},
            {data: 'content', name: 'content', className: 'text-center'},
            {data: 'status_text', name: 'status_text', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    DatatableTemplate(id1, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplate(id2, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right);

    $('#table-enable-customer-message tbody tr td:nth-child(4)').attr('style', 'white-space:normal')
}

function dataTotalMessageCustomer(data) {
    $('#total-record-enable-message-customer').text(data.total_record_enable);
    $('#total-record-disable-message-customer').text(data.total_record_disable);
}

async function removeCustomerMessage(id) {
    let method = 'POST',
        url = 'message.delete',
        params = null,
        data = {id : id};
    let res = await axiosTemplate(method, url, params, data);

    let text = 'Xóa thành công!';
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            loadData();
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

function changeStatusCustomerMessage(r) {
    let title = "";
        content = "";
        icon = '';
    if(r.data('status') === 1 ) {
        title = "Đổi trạng thái";
        content = "Đổi trạng thái thành tạm ngưng";
        icon = 'warning';
    } else {
        title = "Đổi trạng thái";
        content = "Đổi trạng thái thành hoạt động";
        icon = 'warning';
    }

    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'message.change-status',
                params = null,
                data = {id: r.data('id')};
            let res = await axiosTemplate(method, url, params, data);
            let text = $('#success-status-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    loadData();
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
