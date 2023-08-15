let dataTableCardEnable,
    dataTableCardDisEnable;
$(function () {
    // addLoading('gift.data');
    shortcut.add('F2', function () {
        openModalCreateGift();
    });
    loadData();
});

async function loadData() {
    let method = 'get',
        url = 'gift.data',
        branch = $('#change_branch').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-enable-gift"),
        $("#table-disable-gift"),
    ]);
    dataTableGift(res);
    dataTotalGift(res.data[2]);
}

async function dataTableGift(data) {
    let scroll_Y = '65vh',
        fixed_left = 2,
        fixed_right = 2,
        id1 = $('#table-enable-gift'),
        id2 = $('#table-disable-gift'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'description', name: 'description', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    dataTableCardEnable = await DatatableTemplate(id1, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right);
    dataTableCardDisEnable = await DatatableTemplate(id2, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right);

    $('#table-enable-gift tbody tr td:nth-child(4)').attr('style', 'white-space:normal')
    $('#table-disable-gift tbody tr td:nth-child(4)').attr('style', 'white-space:normal')
}

function dataTotalGift(data) {
    $('#total-record-enable').text(data.total_record_enable);
    $('#total-record-disable').text(data.total_record_disable);
}

function changeStatusGift(r) {
    let title = '',
        content = '',
        icon = '';
    if(r.data('status') === 1) {
         title = 'Đổi trạng thái thành tạm ngưng ?';
            content = '';
            icon = 'question';
    } else  {
         title = 'Đổi trạng thái thành hoạt động ?';
            content = '';
            icon = 'question';
    }

    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'gift.change-status',
                params = null,
                data = {id: r.data('id')};
            let res = await axiosTemplate(method, url, params, data,[
                $("#table-enable-gift"),
                $("#table-disable-gift"),
            ]);
            if (res.data.status === 200) {
                SuccessNotify($('#success-update-data-to-server').text());
                loadData();
            } else {
                ErrorNotify((data.data.message !== null) ? data.data.message : $('#error-post-data-to-server').text());
                return false;
            }
        }
    })
}
