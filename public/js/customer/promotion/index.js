$(function () {
    addLoading('promotion.data');
    addLoading('promotion.apply');
    addLoading('promotion.pause');
    shortcut.add('F2', function () {
        openModalCreateCustomerPromotion();
    });
    loadData();

    dateTimePickerNormalTemplate($('#from-date-promotion'));
    dateTimePickerNormalTemplate($('#to-date-promotion'));
    $('#from-date-promotion').val('01/' + moment().format('MM/YYYY'));
    $('#to-date-promotion').val(moment().format('DD/MM/YYYY'));

    $('#search-btn-promotion').on('click', function () {
        loadData();
    });
});

async function loadData() {
    let method = 'get',
        url = 'promotion.data',
        params = {
            restaurant_brand_id: $('#restaurant-branch-id-selected span').attr('data-value'),
            branch_id: $('#change_branch').val(),
            from_date: $('#from-date-promotion').val(),
            to_date: $('#to-date-promotion').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTotalPromotionCustomer(res.data[1]);
    dataTablePromotionCustomer(res.data[0]);
}

async function dataTablePromotionCustomer(data) {
    let id1 = $('#table-applying-customer-promotion'),
        id2 = $('#table-pending-customer-promotion'),
        id3 = $('#table-pausing-customer-promotion'),
        id4 = $('#table-expired-customer-promotion'),
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
    await DatatableTemplate(id1, data.applying, column, scroll_Y, fixed_left, fixed_right);
    await DatatableTemplate(id2, data.pending, column, scroll_Y, fixed_left, fixed_right);
    await DatatableTemplate(id3, data.pausing, column, scroll_Y, fixed_left, fixed_right);
    await DatatableTemplate(id4, data.expired, column, scroll_Y, fixed_left, fixed_right);
}

function dataTotalPromotionCustomer(data) {
    $('#total-record-pending').text(data.total_record_pending);
    $('#total-record-applying').text(data.total_record_applying);
    $('#total-record-pausing').text(data.total_record_pausing);
    $('#total-record-expired').text(data.total_record_expired);
    // $('#total-record-canceled').text(data.total_record_canceled);
}

function pausePromotion(id) {
    let title = 'Tạm dừng chương trình khuyến mãi ?';
    sweetAlertComponent(title, '', 'warning').then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'promotion.change-status',
                params = null,
                data = {id: id, status: 3};
            let res = await axiosTemplate(method, url, params, data);
            if (res.data.status === 200) {
                SuccessNotify('Tạm dừng chương trình thành công!');
                loadData();
            } else {
                ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            }
        }
    });
}

function applyPromotion(id) {
    let title = 'Áp dụng chương trình khuyến mãi ?';
    sweetAlertComponent(title, '', 'warning').then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'promotion.change-status',
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

// function applyCustomerPromotion(id) {
//     let title = 'Áp dụng chương trình khuyến mãi ?',
//         content = '',
//         icon = 'warning';
//     sweetAlertComponent(title, content, icon).then(async (result) => {
//         if (result.value) {
//             let method = 'post',
//                 url = 'promotion.apply',
//                 params = null,
//                 data = {id: id};
//             let res = await axiosTemplate(method, url, params, data);
//             if (res.data.status === 200) {
//                 let text = 'Áp dụng thành công !';
//                 SuccessNotify(text);
//                 loadData();
//             } else {
//                 let text = $('#error-post-data-to-server').text();
//                 if (res.data.message !== null) {
//                     text = res.data.message;
//                 }
//                 ErrorNotify(text);
//             }
//         }
//     });
// }

// function pauseCustomerPromotion(id) {
//     let title = 'Tạm ngưng chương trình khuyến mãi ?',
//         content = '',
//         icon = 'warning';
//     sweetAlertComponent(title, content, icon).then(async (result) => {
//         if (result.value) {
//             let method = 'post',
//                 url = 'promotion.pause',
//                 params = null,
//                 data = {id: id};
//             let res = await axiosTemplate(method, url, params, data);
//             if (res.data.status === 200) {
//                 let text = 'Tạm ngưng thành công !';
//                 SuccessNotify(text);
//                 loadData();
//             } else {
//                 let text = $('#error-post-data-to-server').text();
//                 if (res.data.message !== null) {
//                     text = res.data.message;
//                 }
//                 ErrorNotify(text);
//             }
//         }
//     });
// }
