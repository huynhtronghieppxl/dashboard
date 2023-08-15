let data_table_card_enable = [],
    data_table_card_dis_enable = [];
$(function () {
    // addLoading('discount.data');
    // addLoading('discount.change-status');
    shortcut.add('F2', function () {
        openModalCreateDiscount();
    });
    loadData();
});

async function loadData() {
    let method = 'get',
        url = 'discount.data',
        branch = $('#change_branch').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-enable-discount-customer"),
        $("#table-disable-discount-customer"),
    ]);
    dataTableDiscount(res);
    dataTotalDiscount(res.data[2]);
}
async function dataTableDiscount(data) {
    let fixed_left = 2,
        fixed_right = 1,
        id1 = $('#table-enable-discount-customer'),
        id2 = $('#table-disable-discount-customer'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'gift', name: 'gift', className: 'text-center'},
            {data: 'value', name: 'value', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    data_table_card_enable = await DatatableTemplate(id1, data.data[0].original.data, column, vh_of_table, fixed_left, fixed_right);
    data_table_card_dis_enable = await DatatableTemplate(id2, data.data[1].original.data, column, vh_of_table, fixed_left, fixed_right);
}

function dataTotalDiscount(data) {
    $('#total-record-enable').text(data.total_record_enable);
    $('#total-record-disable').text(data.total_record_disable);
}

function changeStatusCardValue(r) {
    let title = '',
        content = '',
        icon = '';
    if(r.data('status') === 1){
        title = 'Đổi trạng thái thành tạm ngưng ? ';
        content = '';
        icon = 'question';
    }else {
        title = 'Đổi trạng thái thành hoạt động ? ';
        content = '';
        icon = 'question';
    }
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'discount.change-status',
                params = null,
                data = {id: r.data('id')};
            let res = await axiosTemplate(method, url, params, data);
            if (res.data.status === 200) {
                let text = $('#success-status-data-to-server').text();
                SuccessNotify(text);
                loadData();
            } else {
                let text = $('#error-post-data-to-server').text();
                if (data.data.message !== null) {
                    text = data.data.message;
                }
                ErrorNotify(text);
                return false;
            }
        }
    })
}
