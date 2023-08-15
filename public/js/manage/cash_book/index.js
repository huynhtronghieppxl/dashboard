$(function () {
    addLoading('cash-book-manage.data');
    loadData();
});

async function loadData() {
    let branch = $('#change_branch').val(),
        method = 'get',
        url = 'cash-book-manage.data',
        params = {
        branch: branch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTableCashBookManage(res);
    dataTotalCashBookManage(res.data[3]);
}

function dataTableCashBookManage(data) {
    let id1 = $('#table-waiting-cash-book-manage'),
        id2 = $('#table-done-cash-book-manage'),
        id3 = $('#table-cancel-cash-book-manage'),
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-center'},
            {data: 'employee_complete_name', name: 'employee_complete_name', className: 'text-center'},
            {data: 'from', name: 'from', className: 'text-center'},
            {data: 'to', name: 'to', className: 'text-center'},
            {data: 'openning_amount', name: 'openning_amount', className: 'text-center'},
            {data: 'in_amount', name: 'in_amount', className: 'text-center'},
            {data: 'out_amount', name: 'out_amount', className: 'text-center'},
            {data: 'order_amount', name: 'order_amount', className: 'text-center'},
            {data: 'closing_amount', name: 'closing_amount', className: 'text-center'},
            {data: 'changing_amount', name: 'changing_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'}
        ],
        scroll_Y = '60vh',
        fixed_left = 2,
        fixed_right = 1;
    DatatableTemplate(id1, data.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right);
    DatatableTemplate(id2, data.data[1].original.data, columns, scroll_Y, fixed_left, fixed_right);
    DatatableTemplate(id3, data.data[2].original.data, columns, scroll_Y, fixed_left, fixed_right);
}

function dataTotalCashBookManage(data) {
    $('#total-record-tab1-cash-book-manage').text(data.total_record_waiting);
    $('#total-record-tab2-cash-book-manage').text(data.total_record_done);
    $('#total-record-tab3-cash-book-manage').text(data.total_record_cancel);
    $('#total-open-tab1-cash-book-manage').text(data.data_total_opening_amount_waiting);
    $('#total-in-tab1-cash-book-manage').text(data.data_total_in_amount_waiting);
    $('#total-out-tab1-cash-book-manage').text(data.data_total_out_amount_waiting);
    $('#total-order-tab1-cash-book-manage').text(data.data_total_order_amount_waiting);
    $('#total-close-tab1-cash-book-manage').text(data.data_total_closing_amount_waiting);
    $('#total-change-tab1-cash-book-manage').text(data.data_total_changing_amount_waiting);
    $('#total-open-tab2-cash-book-manage').text(data.data_total_opening_amount_done);
    $('#total-in-tab2-cash-book-manage').text(data.data_total_in_amount_done);
    $('#total-out-tab2-cash-book-manage').text(data.data_total_out_amount_done);
    $('#total-order-tab2-cash-book-manage').text(data.data_total_order_amount_done);
    $('#total-close-tab2-cash-book-manage').text(data.data_total_closing_amount_done);
    $('#total-change-tab2-cash-book-manage').text(data.data_total_changing_amount_done);
    $('#total-open-tab3-cash-book-manage').text(data.data_total_opening_amount_cancel);
    $('#total-in-tab3-cash-book-manage').text(data.data_total_in_amount_cancel);
    $('#total-out-tab3-cash-book-manage').text(data.data_total_out_amount_cancel);
    $('#total-order-tab3-cash-book-manage').text(data.data_total_order_amount_cancel);
    $('#total-close-tab3-cash-book-manage').text(data.data_total_closing_amount_cancel);
    $('#total-change-tab3-cash-book-manage').text(data.data_total_changing_amount_cancel);
}

function confirmCashBookManage(id, branch) {
    let title = 'Xác nhận ?',
        content = 'Xác nhận chốt kỳ !',
        icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'cash-book-manage.confirm',
                params = null,
                data = {
                    id: id,
                    branch: branch,
                };
            let res = await axiosTemplate(method, url, params, data);
            if (res.data.status === 200) {
                let text = $('#success-confirm-data-to-server').text();
                SuccessNotify(text);
                loadData();
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

function cancelCashBookManage(id, branch) {
    let title = 'Huỷ ?',
        content = 'Huỷ chốt kỳ !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'cash-book-manage.cancel',
                params = null,
                data = {
                    id: id,
                    branch: branch,
                };
            let res = await axiosTemplate(method, url, params, data);
            if (res.data.status === 200) {
                let text = $('#success-cancel-data-to-server').text();
                SuccessNotify(text);
                loadData();
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
