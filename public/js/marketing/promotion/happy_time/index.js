let checkPauseHappyTime = 0;

async function loadDataHappyTimePromotion() {
    let method = 'get',
        url = 'happy-time-promotion.data',
        params = {
            restaurant_brand_id: $('#restaurant-branch-id-selected span').attr('data-value'),
            branch_id: $('#change_branch').val(),
            from_date: $('#from-date-happy-time-promotion').val(),
            to_date: $('#to-date-happy-time-promotion').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-applying-happy-time-promotion"),
        $("#table-pending-happy-time-promotion"),
        $("#table-pausing-happy-time-promotion"),
        $("#table-expired-happy-time-promotion"),
    ]);
    dataTableHappyTimePromotion(res.data[0]);
    dataTotalHappyTimePromotion(res.data[1]);
}

async function dataTableHappyTimePromotion(data) {
    let id1 = $('#table-applying-happy-time-promotion'),
        id2 = $('#table-pending-happy-time-promotion'),
        id3 = $('#table-pausing-happy-time-promotion'),
        id4 = $('#table-expired-happy-time-promotion'),
        scroll_Y = vh_of_table,
        fixed_left = 1,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'type-text', name: 'type-text', className: 'text-center'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
        ];
    await DatatableTemplateNew(id1, data.applying, column, scroll_Y, fixed_left, fixed_right);
    await DatatableTemplateNew(id2, data.pending, column, scroll_Y, fixed_left, fixed_right);
    await DatatableTemplateNew(id3, data.pausing, column, scroll_Y, fixed_left, fixed_right);
    await DatatableTemplateNew(id4, data.expired, column, scroll_Y, fixed_left, fixed_right);
}

function dataTotalHappyTimePromotion(data) {
    $('#total-record-pending').text(data.total_record_pending);
    $('#total-record-applying').text(data.total_record_applying);
    $('#total-record-pausing').text(data.total_record_pausing);
    $('#total-record-expired').text(data.total_record_expired);
}

function pauseHappyTimePromotion(id) {
    if (checkPauseHappyTime !== 0) return false;
    checkPauseHappyTime = 1;
    let title = 'Tạm dừng chương trình Happy Time ?';
    sweetAlertComponent(title, '', 'warning').then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'happy-time-promotion.change-status',
                params = null,
                data = {id: id, status: 3};
            let res = await axiosTemplate(method, url, params, data);
            checkPauseHappyTime = 0;
            if (res.data.status === 200) {
                SuccessNotify('Tạm dừng chương trình thành công!');
                loadData();
            } else {
                ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            }
        }
    });
}

function applyHappyTimePromotion(id) {
    let title = 'Áp dụng chương trình khuyến mãi ?';
    sweetAlertComponent(title, '', 'warning').then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'happy-time-promotion.change-status',
                params = null,
                data = {id: id, status: 2};
            let res = await axiosTemplate(method, url, params, data);
            if (res.data.status === 200) {
                SuccessNotify('Áp dụng chương trình thành công!');
                loadData();
            } else {
                ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            }
        }
    });
}
